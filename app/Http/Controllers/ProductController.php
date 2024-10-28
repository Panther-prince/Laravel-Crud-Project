<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Session;



class ProductController extends Controller
{

    public function index()
    {
        $product = Product::all();
        return view("products/list", ['products' => $product]);
    }
    public function create()
    {
        return view("products/create");
    }
    public function store(Request $request)
    {
        // echo "<script>alert(hello);</script>";
        $rules = [
            'name' => 'required|min:3',
            'sku' => 'required|numeric',
            'price' => 'required|numeric'

        ];
        $validation = validator($request->all(), $rules);
        if ($validation->fails()) {
            return redirect()->Route('products.create')->withInput()->withErrors($validation);
        }

        // here we store data to database 
        $product = new Product();
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();

        if ($request->image != null) {
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time() . '.' . $ext;
            $image->move(public_path('images/products/'), $imageName);
            $product->image = $imageName;
            $product->save();
        }
        return redirect()->route('products.index')->with('success', 'Product Created Successfully');
    }
    public function edit($id)
    {
        $product = Product::find($id);
        return view("products/edit", ['product' => $product]);
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // Define validation rules
        $rules = [
            'name' => 'required|min:3',
            'sku' => 'required|numeric',
            'price' => 'required|numeric'
        ];

        // Validate the request data
        $validation = validator($request->all(), $rules);
        if ($validation->fails()) {
            return redirect()->route('products.edit', $id)->withInput()->withErrors($validation);
        }

        // Update product fields
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->description = $request->description;

        // Check if a new image is uploaded
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $ext = $image->getClientOriginalExtension();
            $imageName = time() . '.' . $ext;
            $image->move(public_path('images/products/'), $imageName);

            // Delete the old image if it exists
            if ($product->image && file_exists(public_path('images/products/' . $product->image))) {
                unlink(public_path('images/products/' . $product->image));
            }

            // Save new image name
            $product->image = $imageName;
        }
        $product->save();

        return redirect()->route('products.index')->with('success', 'Product Updated Successfully');
    }

    public function view($id) {
        $product = Product::find($id);
        return view("products/show", ['product' => $product]);
    }

    public function delete($id) {
        $product = Product::find($id);
        $product->delete();

        if ($product->image && file_exists(public_path('images/products/' . $product->image))) {
            unlink(public_path('images/products/' . $product->image));
        }
        return redirect()->route('products.index')->with('success', 'Product Deleted Successfully');
    }

}
