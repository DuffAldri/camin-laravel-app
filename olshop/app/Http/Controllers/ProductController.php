<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index() {
        $products = Product::latest()->get();
        return view('products.index', compact('products'));
    }

    public function create() {
        return view('products.create');
    }

    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required|string|max:155',
            'description' => 'required',
            'category' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'image' => 'required|file|image|mimes:jpeg,png,jpg'
        ]);

        $file = $request->file('image');
		$file_name = time()."_".$file->getClientOriginalName();

        $dest = "data_file";
        $file->move($dest,$file_name);

        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'category' => $request->category,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $file_name,
            'slug' => Str::slug($request->name)
        ]);

        echo "Berhasil";
        if ($product) {
            return redirect()
                ->route('product.index')
                ->with([
                    'success' => 'New product has been created successfully'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Some problem occurred, please try again'
                ]);
        }
    }

    public function edit($id) {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }
    
    public function update(Request $request, $id) {
        $this->validate($request, [
            'name' => 'required|string|max:155',
            'description' => 'required',
            'category' => 'required',
            'price' => 'required',
            'stock' => 'required',
            // 'image' => 'file|image|mimes:jpeg,png,jpg'
        ]);
        
        $product = Product::findOrFail($id);

        if($request->image != '') {

            $file = $request->image;
            $file_name = time()."_".$request->image->getClientOriginalName();
    
            $dest = "data_file";
            $file->move($dest,$file_name);

            $product->update([
                'name' => $request->name,
                'description' => $request->description,
                'category' => $request->category,
                'price' => $request->price,
                'stock' => $request->stock,
                'image' => $file_name,
                'slug' => Str::slug($request->name)
            ]);

        } else {
            $product->update([
                'name' => $request->name,
                'description' => $request->description,
                'category' => $request->category,
                'price' => $request->price,
                'slug' => Str::slug($request->name)
            ]);
        }

        if($product) {
            return redirect()->back()->with(['success' => 'Product has been updated successfully']);
        } else {
            return redirect()->back()->withInput()->with(['error' => 'Some problem occured, please try again']);
        }
    }

    public function destroy($id) {
        $product = Product::findOrFail($id);
        $product->delete();

        if($product) {
            return redirect()
                ->route('product.index')
                ->with([
                    'success' => 'Product has been deleted successfully'
                ]);
        } else {
            return redirect()
                ->route('product.index')
                ->with([
                    'error' => 'Some problem has occurred, please try again'
                ]);
        }
    }
}
