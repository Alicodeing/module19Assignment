<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Faker\Core\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    // This method will show product page
    public function index() {
        $products = Product::orderBy('created_at', 'DESC')->get();
        return view('products.index', [
            'products' => $products
        ]);
    }
    // This method will show create product page
    public function create() {
        return view('products.create');
    }
    // This method will store a product n db
    public function store(Request $request) {
        $rules = [
            'name' => 'required|min:5',
            'product_id' => 'required|min:3',
            'price' => 'required|numeric'
        ];

        if($request->image != ""){
            $rules['image'] = 'image';
        }
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return redirect()->route('products.create')->withInput()->withErrors($validator);
        }
        //Here we will insert product in DB
        $product = new Product();
        $product->name = $request->name;
        $product->product_id = $request->product_id;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();

        if($request->image != ""){
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time().'.'.$ext;
    
            $image->move(public_path('uploads/products'),$imageName);
    
            $product->image = $imageName;
            $product->save();
        }

       


        return redirect()->route('products.index')->with('success', 'Product add successfully.');

    }
    // This method will show edit a product
    public function edit($id) {
        $product = Product::findOrFail($id);
        return view('products.edit', [
            'product' => $product
        ]);
    }
    // This method will update a product
    public function update($id, Request $request) {
        $product = Product::findOrFail($id);
        $rules = [
            'name' => 'required|min:5',
            'sku' => 'required|min:3',
            'price' => 'required|numeric'
        ];

        if($request->image != ""){
            
            $rules['image'] = 'image';
        }
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return redirect()->route('products.update', $product->id)->withInput()->withErrors($validator);
        }
        //Here we will update product 
        $product->name = $request->name;
        $product->product_id = $request->product_id;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();

        if($request->image != ""){
            //delete old image
            File::delete(public_path('uploads/products/'. $product->image));
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time().'.'.$ext;
    
            $image->move(public_path('uploads/products'),$imageName);
    
            $product->image = $imageName;
            $product->save();
        }

       


        return redirect()->route('products.index')->with('success', 'Product Updated successfully.');
    }
    // This method will delete product
    public function destroy($id) {
        $product = Product::findOrFile($id);

        File::destroy(public_path('uploads/products/'. $product->image));

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product Delete successfully.');


    }
}
