<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $products = Product::all();
    //     return view('admin.product')->with('products', $products);
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'price' => 'required|numeric',
            'product_code' => 'required',
            'description' => 'required',
            'image' => 'required|image',
        ]);

        $imagePath = $request->file('image')->store('products', 'public');


        Product::create([
            'title' => $request->input('title'),
            'price' => $request->input('price'),
            'product_code' => $request->input('product_code'),
            'description' => $request->input('description'),
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.products')->with('success', 'Product Added Successfully');
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);

        return view('show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.edit')->with('product', $product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
    
        // Validate form data
        $validatedData = $request->validate([
            'title' => 'required',
            'price' => 'required|numeric',
            'product_code' => 'required',
            'description' => 'required',
            'image' => 'image', // Update the validation rule for the image
        ]);
    
        // Update product attributes
        $product->update([
            'title' => $validatedData['title'],
            'price' => $validatedData['price'],
            'product_code' => $validatedData['product_code'],
            'description' => $validatedData['description'],
        ]);
    
        // Check if a new image is provided
        if ($request->hasFile('image')) {
            // Store the new image and update the product's image field
            $imagePath = $request->file('image')->store('products', 'public');
            $product->update(['image' => $imagePath]);
    
            // Delete the old image if needed (uncomment the line below if you want to delete the old image)
            // Storage::disk('public')->delete($product->image);
        }
    
        // Redirect back to the main page with a success message
        return redirect()->route('admin.products')->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        // Redirect back to the product page with a success message
        return redirect()->route('admin.products')->with('success', 'Product deleted successfully');
    }
}
