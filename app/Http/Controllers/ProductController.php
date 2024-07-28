<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }
     // Show the form for creating a new product
     public function create()
     {
         return view('products.create');
     }

     // Store a newly created product in storage
     public function store(Request $request)
     {
         $request->validate([
             'name' => 'required|string|max:255',
             'description' => 'nullable|string',
             'price' => 'required|numeric|min:0',
             'stock' => 'required|integer|min:0',
         ]);

         Product::create($request->all());

         return redirect()->route('products.index')->with('success', 'Product created successfully.');
     }

     // Display the specified product
     public function show(Product $product)
     {
         return view('products.show', compact('product'));
     }

     // Show the form for editing the specified product
     public function edit(Product $product)
     {
         return view('products.edit', compact('product'));
     }

     // Update the specified product in storage
     public function update(Request $request, Product $product)
     {
         $request->validate([
             'name' => 'required|string|max:255',
             'description' => 'nullable|string',
             'price' => 'required|numeric|min:0',
             'stock' => 'required|integer|min:0',
         ]);

         $product->update($request->all());

         return redirect()->route('products.index')->with('success', 'Product updated successfully.');
     }

     // Remove the specified product from storage
     public function destroy(Product $product)
     {
         $product->delete();
         return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
     }
}
