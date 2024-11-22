<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'You are not authorized to access this page');
        }
        return view('dashboard.categories.index', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'You are not authorized to access this page');
        }
        return view('dashboard.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        //
        $request->validated();

        try {
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = $request->name . '_' . time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/images/categories/', $imageName);
            }

            Category::create([
                'name' => $request->name,
                'description' => $request->description,
                'image' => $imageName,
            ]);

            return redirect()->route('categories.index')->with('success', 'Category created successfully');
        } catch (\Exception $e) {
            return redirect()->route('categories.index')->with('error', 'Category failed to create');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
        return view('dashboard.categories.edit', [
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        //
        $request->validated();
        $request->validated();

        try {
            // Cek jika ada gambar lama dan pengguna mengunggah gambar baru
            if ($request->hasFile('image')) {
                // Hapus gambar lama jika ada
                if ($category->image && Storage::exists('public/images/categories/' . $category->image)) {
                    Storage::delete('public/images/categories/' . $category->image);
                }

                // Simpan gambar baru
                $image = $request->file('image');
                $imageName = $request->name . '-' . time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/images/categories', $imageName);
            } else {
                // Jika tidak ada gambar baru, gunakan nama gambar lama
                $imageName = $category->image;
            }


            // Update kategori
            $category->update([
                'name' => $request->name,
                'description' => $request->description,
                'image' => $imageName,
            ]);

            return redirect()->route('categories.index')->with('success', 'Category updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('categories.index')->with('error', 'Category failed to update');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
        try {
            // Hapus gambar jika ada
            if ($category->image && Storage::exists('public/images/categories/' . $category->image)) {
                Storage::delete('public/images/categories/' . $category->image);
            }

            // Hapus kategori
            $category->delete();

            return redirect()->route('categories.index')->with('success', 'Category deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('categories.index')->with('error', 'Category failed to delete');
        }
    }
}
