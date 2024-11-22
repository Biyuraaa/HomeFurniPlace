<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Initialize the query with a base Product model query.
        $query = Product::query();

        // Filter products based on the user's role.
        if (Auth::user()->role === 'seller') {
            $query->where('seller_id', Auth::user()->seller->id);
        } elseif (Auth::user()->role !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'You are not authorized to access this page');
        }

        // Apply search filter if provided.
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->input('search') . '%');
        }

        // Apply category filter if provided.
        if ($request->filled('category')) {
            $query->where('category_id', $request->input('category'));
        }

        // Fetch the filtered products.
        $products = $query->get();

        // Pass products and categories to the view.
        return view('dashboard.products.index', [
            'products' => $products,
            'categories' => Category::all() // Pass categories for the filter dropdown
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('dashboard.products.create', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {

        //
        $request->validated();


        try {
            $imageName = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = $request->name . '_' . time() . '.' . $request->image->extension();
                $image->storeAs('public/images/products/', $imageName);
            }


            Product::create([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'stock' => $request->stock,
                'category_id' => $request->category_id,
                'image' => $imageName,
                'seller_id' => Auth::user()->seller->id
            ]);

            return redirect()->route('products.index')->with('success', 'Product created successfully');
        } catch (\Throwable $th) {
            return redirect()->route('products.index')->with('error', 'Product failed to create');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
        return view('dashboard.products.show', [
            'product' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
        return view('dashboard.products.edit', [
            'product' => $product,
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
        $request->validated();

        try {
            if ($product->seller_id !== Auth::user()->seller->id) {
                return redirect()->route('products.index')->with('error', 'You are not authorized to update this product');
            }
            $imageName = $product->image;
            if ($request->hasFile('image')) {
                if ($product->image) {
                    unlink(storage_path('app/public/images/products/' . $product->image));
                }
                $image = $request->file('image');
                $imageName = $request->name . '_' . time() . '.' . $request->image->extension();
                $image->storeAs('public/images/products/', $imageName);
            }

            $product->update([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'stock' => $request->stock,
                'category_id' => $request->category_id,
                'image' => $imageName,
                'seller_id' => Auth::user()->seller->id
            ]);

            return redirect()->route('products.index')->with('success', 'Product updated successfully');
        } catch (\Throwable $th) {
            return redirect()->route('products.index')->with('error', 'Product failed to update');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
        try {
            if ($product->seller_id !== Auth::user()->seller->id) {
                return redirect()->route('products.index')->with('error', 'You are not authorized to delete this product');
            }
            if ($product->image) {
                unlink(storage_path('app/public/images/products/' . $product->image));
            }
            $product->delete();
            return redirect()->route('products.index')->with('success', 'Product deleted successfully');
        } catch (\Throwable $th) {
            return redirect()->route('products.index')->with('error', 'Product failed to delete');
        }
    }
}
