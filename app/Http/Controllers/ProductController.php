<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        //return new ProductCollection(Product::all());
        $products = QueryBuilder::for(Product::class)
        ->allowedFilters('published')
        ->defaultSort('created_at')
        ->paginate();
        return new ProductCollection($products);
    }

    public function show(Request $request, Product $product)
    {
        return new ProductResource($product);
    }

    public function store (StoreProductRequest $request)
    {
        $validated = $request->validated();
        //$product = Product::create($validated);
        $product = Auth::user()->products()->create($validated);
        return new ProductResource($product);
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $validated = $request->validated();
        $product->update($validated);
        return new ProductResource($product);
    }

    public function destroy(Request $request, Product $product)
    {
        $product->delete();
        return response()->noContent();
    }

}
