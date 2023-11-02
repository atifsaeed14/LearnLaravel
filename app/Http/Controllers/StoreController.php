<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreStoreRequest;
use App\Http\Requests\UpdateStoreRequest;
use App\Http\Resources\StoreResource;
use App\Models\Store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Resources\StoreCollection;

class StoreController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Store::class, 'store');
    }

    public function index()
    {
        /*$store = QueryBuilder::for(Store::class)
        ->allowedFilters('id')
        ->defaultSort('created_at')
        ->paginate();
        return new StoreCollection($store);*/
        //return new StoreCollection(Store::all());
        $stores = QueryBuilder::for(Store::class)
        ->allowedIncludes('products')
        ->paginate();
        return new StoreCollection($stores);
    }

    public function store(StoreStoreRequest $request)
    {
        $validated = $request->validated();
        $store = Auth::user()->stores()->create($validated);
        return new StoreResource($store);
    }

    public function update(UpdateStoreRequest $request, Store $store)
    {
        $validated = $request->validated();
        $store->update($validated);
        return new StoreResource($store);
    }

    public function show(Request $request, Store $store)
    {
        //return new StoreResource($store);
        return (new StoreResource($store))->load('products')->load('members');
                
    }

    public function destroy(Request $request, Store $store)
    {
        $store->delete();
        return response()->noContent();
    }
}
