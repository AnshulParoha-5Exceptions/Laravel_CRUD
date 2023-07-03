<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request, $p_id = null)
    {
        // Retrieve existing products, categories, and brands
        // $products = Product::paginate(2); // Paginate the products with 10 items per page
        $products = Product::all();
        $categories = Category::all();
        $brands = Brand::all();

        // Check if a product ID is provided for editing
        if ($p_id) {
            $product = Product::find($p_id);
        } else {
            $product = new Product();
        }

        if ($request->isMethod('post')) {
            // Check if any required field is empty
            if (
                $request->filled('name') &&
                $request->filled('category') &&
                $request->filled('brand') &&
                $request->filled('price') &&
                $request->filled('description') &&
                $request->filled('imageURL')
            ) {
                // Create or Update a new product
                $product->name = $request->input('name');
                $product->cat_id = $request->input('category');
                $product->brand_id = $request->input('brand');
                $product->price = $request->input('price');
                $product->description = $request->input('description');
                $product->image = $request->input('imageURL');

                // Save the product
                $product->save();

                return redirect('/');
            } else {
                // Redirect back with an error message
                return redirect()->back()->with('error', 'Please fill all the fields.');
            }
        }

        return view('index', compact('products', 'categories', 'brands', 'product'));
    }

    public function delete($p_id)
    {
        $product = Product::find($p_id);

        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }

        $product->delete();

        return redirect()->back()->with('success', 'Product deleted successfully.');
    }
}
