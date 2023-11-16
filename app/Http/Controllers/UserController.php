<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ContactMessage;
use App\Models\Blog;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Payment;
use App\Models\Product;
use Razorpay\Api\Api;
use Exception;
use Illuminate\Support\Facades\Session;


class UserController extends Controller
{
    public function showRegistrationForm()
    {
        return view('register');
    }
    public function showLoginForm()
    {
        return view('login');
    }

    public function register(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:4',
        ]);

        Log::info('Validated Data:', $validatedData); // Logging the validated data

        $validatedData['password'] = bcrypt($validatedData['password']);
        Log::info('Data with Encrypted Password:', $validatedData); // Logging after encrypting password
        User::create($validatedData);

        return redirect()->route('register')->with('success', 'User registered successfully!');
    }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if ($credentials['email'] === 'admin@gmail.com') {
            // Redirect the admin user to a different route
            return redirect()->route('adminDashboard');
        }

        $user = User::where('email', $credentials['email'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            Auth::login($user);
            return redirect('/main');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
    public function mainPage()
    {
        return view('main');
    }
    public function logout()
    {
        Auth::logout();
        session()->flush(); // Clear all session data
        return redirect('/'); // Redirect to the main page after logout
    }
    public function showDashboard()
    {
        // Fetch data from the models
        $totalProducts = Product::count();
        $totalOrders = Payment::count();
        $newCustomers = User::count();

        // Fetch recent orders data from the Payment model
        $recentOrders = Payment::select('id', 'user_email as customer', 'amount')->orderBy('created_at', 'desc')->take(5)->get();

        // Pass data to the view
        return view('admin.main', [
            'totalProducts' => $totalProducts,
            'totalOrders' => $totalOrders,
            'newCustomers' => $newCustomers,
            'recentOrders' => $recentOrders,
        ]);
    }


    public function products()
    {
        return view('admin.products');
    }
    public function submitContactForm(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        // Store the message in the database
        ContactMessage::create($validatedData);

        return back()->with('success', 'Message submitted successfully!');
    }
    public function submitBlogForm(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'content' => 'required',
        ]);

        $imagePath = $request->file('image')->store('blog_images', 'public');

        Blog::create([
            'title' => $validatedData['title'],
            'name' => $validatedData['name'],
            'image' => $imagePath,
            'content' => $validatedData['content'],
        ]);

        return back()->with('success', 'Blog submitted successfully!');
    }
    public function store(Request $request)
    {
        $input = $request->all();
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        $payment = $api->payment->fetch($input['razorpay_payment_id']);

        if (count($input) && !empty($input['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount' => $payment['amount']));
                $payment = Payment::create([
                    'r_payment_id' => $response['id'],
                    'method' => $response['method'],
                    'currency' => $response['currency'],
                    'user_email' => $response['email'],
                    'amount' => $response['amount'] / 100,
                    'json_response' => json_encode((array)$response)
                ]);
            } catch (Exception $e) {
                session(['error' => $e->getMessage()]);
                return redirect()->back();
            }
        }

        // session(['success' => 'Payment Successful']);
        return redirect('/paymentsuccess');
    }
}
