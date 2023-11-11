<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreShippingRequest;
use App\Http\Requests\UpdateShippingRequest;
use App\Http\Resources\ShippingResource;
use App\Models\Shipping;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Resources\ShippingCollection;

class ShippingController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Shipping::class, 'shipping');
    }

    public function index()
    {
        $shippings = QueryBuilder::for(Shipping::class)
        ->paginate();
        return new ShippingCollection($shippings);
    }

    public function store(StoreShippingRequest $request)
    {
        $validated = $request->validated();
        $shipping = Auth::user()->shippings()->create($validated);
        return new ShippingResource($shipping);
    }

    public function update(UpdateShippingRequest $request, Shipping $shipping)
    {
        $validated = $request->validated();
        $shipping->update($validated);
        return new ShippingResource($shipping);
    }

    public function show(Request $request, Shipping $shipping)
    {
        return (new ShippingResource($shipping))->load('members');
                
    }

    public function destroy(Request $request, Shipping $shipping)
    {
        $shipping->delete();
        return response()->noContent();
    }
}
