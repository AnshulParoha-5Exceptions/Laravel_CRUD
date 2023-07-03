<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;

class ProductController extends Controller
{


    public function index(Request $request)
    {
        $categories = Category::all();
        $brands = Brand::all();
        $products = Product::all();
        return view('welcome', compact('categories', 'brands', 'products'));
    }



    public function create(Request $request)
    {
        $product = new Product();
        if (
            $request->filled('name') && $request->filled('category') && $request->filled('brand') &&
            $request->filled('price') && $request->filled('description') && $request->filled('imageURL')
        ) {
            $product->name = $request->input('name');
            $product->cat_id = $request->input('category');
            $product->brand_id = $request->input('brand');
            $product->price = $request->input('price');
            $product->description = $request->input('description');
            $product->image = $request->input('imageURL');

            $product->save();

            return redirect('/');
        } else {
            return redirect()->back()->with('field_error', 'Please fill all the fields.');
        }
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

    public function edit($p_id)
    {
        $product = Product::findOrFail($p_id);
        return view('products.index', compact('product'));
    }

    public function update(Request $request, $p_id)
    {
        $product = Product::findOrFail($p_id);
        $product->name = $request->input('name');
        $product->cat_id = $request->input('category');
        $product->brand_id = $request->input('brand');
        $product->price = $request->input('price');
        $product->description = $request->input('description');
        $product->image = $request->input('imageURL');

        // Update more fields as needed

        $product->save();

        return redirect()->route('products.show')->with('success', 'Product updated successfully.');
    }

}