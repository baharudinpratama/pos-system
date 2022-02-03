<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {   
        $products = Product::with('category')->get();
        
        if (request('search')) {
            $products = Product::with('category')->where('name', 'like', '%' . request('search') . '%')->orderBy('name')->get();
        }
        
        return view('main.product.index', compact('products'));
    }

    public function api()
    {
        $products = Product::with('category')->get();

        return $products;
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('main.product.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => ['required', 'unique:products','max:64'],
            'category_id' => ['required'],
            'stock' => ['required', 'numeric', 'min:1'],
            'price' => ['required', 'numeric', 'min:0'],
            'image' => ['mimes:jpeg,png,jpg,gif,svg', 'max:2048']
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageNameGenerator = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $imageDestinationPath = 'image/product/';
            $image->move($imageDestinationPath, $imageNameGenerator);
            $productImage = $imageDestinationPath.$imageNameGenerator;

            $product = new Product;
            $product->name = $request->name;
            $product->category_id = $request->category_id;
            $product->stock = $request->stock;
            $product->price = $request->price;
            $product->image = $productImage;
            $product->save();
        } else {
            $product = new Product;
            $product->name = $request->name;
            $product->category_id = $request->category_id;
            $product->stock = $request->stock;
            $product->price = $request->price;
            $product->save();
        }

        return redirect()->route('products.index')->with('message', 'New product added successfully');
    }

    public function show(Product $product)
    {
        return view('main.product.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('main.product.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $this->validate($request,[
            'name' => ['required','max:64'],
            'category_id' => ['required'],
            'stock' => ['required', 'numeric', 'min:1'],
            'price' => ['required', 'numeric', 'min:0'],
            'image' => ['mimes:jpeg,png,jpg,gif,svg', 'max:2048']
        ]);

        $oldImage = $product->image;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageNameGenerator = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $imageDestinationPath = 'image/product/';
            $image->move($imageDestinationPath, $imageNameGenerator);
            $productImage = $imageDestinationPath.$imageNameGenerator;

            $product->name = $request->name;
            $product->category_id = $request->category_id;
            $product->stock = $request->stock;
            $product->price = $request->price;
            $product->image = $productImage;
            $product->save();

            unlink($oldImage);
        } else {
            $product->name = $request->name;
            $product->category_id = $request->category_id;
            $product->stock = $request->stock;
            $product->price = $request->price;
            $product->save();
        }

        return redirect()->route('products.index')->with('message', 'Product '.$product->name.' updated');
    }

    public function destroy(Product $product)
    {
        if ($product->image != NULL) {
            $product->delete();
            unlink($product->image);
        } else {
            $product->delete();
        }

        return redirect()->route('products.index')->with('message', 'Product '.$product->name.' deleted');
    }
}
