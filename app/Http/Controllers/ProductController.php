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
        ]);

        Product::create($validatedData);

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
    public function edit($id) {
        $product = Product::findOrFail($id);
        return view('admin.edit')->with('product', $product);
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // Update product attributes
        $product->update([
            'title' => $request->input('title'),
            'price' => $request->input('price'),
            'product_code' => $request->input('product_code'),
            'description' => $request->input('description'),
        ]);

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
