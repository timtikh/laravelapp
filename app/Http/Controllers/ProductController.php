<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        if (!empty($search)) {

            $products = Product::where('name', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%")
                ->orWhere('article', 'like', "%{$search}%")
                ->orWhere('category', 'like', "%{$search}%")
                ->orWhere('parent_category', 'like', "%{$search}%")
                ->get();

        } else {
            $products = Product::all();
        }

        return view('products.index')->with('products', $products);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->guest()) {
            return redirect()->route('login');
        }
        if (auth()->user()->can('product.create')) {
            return view('products.create');
        }
        return redirect()->route('products.index')
            ->with('error', 'You do not have permission to create products.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'article' => 'required|string|max:255',
            'picture' => 'required|string',
            'category' => 'required|string|max:255',
            'parent_category' => 'required|string|max:255',
        ]);

        $product = Product::create($validated);

        return redirect()->route('products.show', $product->id)
            ->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        if (auth()->guest()) {
            return redirect()->route('login');
        }

        if (auth()->user()->can('product.show')) {
            return view('products.show')->with('product', $product);
        } else {
            return abort(403);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        if (auth()->guest()) {
            return redirect()->route('login');
        }
        if (auth()->user()->can('product.edit')) {
            return view('products.edit')->with('product', $product);
        }
        return redirect()->route('products.index')
            ->with('error', 'You do not have permission to edit products.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        if (auth()->guest()) {
            return redirect()->route('login');
        }

        if (auth()->user()->can('product.edit')) {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'price' => 'required|numeric',
                'description' => 'required|string',
                'article' => 'required|string|max:255',
                'picture' => 'required|string',
                'category' => 'required|string|max:255',
                'parent_category' => 'required|string|max:255',
            ]);

            $product->update($validated);

            return redirect()->route('products.show', $product->id)
                ->with('success', 'Product updated successfully.');

        }
        return redirect()->route('products.index')
            ->with('error', 'You do not have permission to edit products.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if (auth()->guest()) {
            return redirect()->route('login');
        }
        if (auth()->user()->can('product.destroy')) {
            $product->delete();
            return redirect()->route('products.index', $product->id)
                ->with('success', 'Product deleted successfully.');
        }
        return abort(403);
    }
}
