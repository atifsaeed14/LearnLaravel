<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderItemCollection;
use App\Http\Resources\OrderItemResource;
use App\Http\Requests\StoreOrderItemRequest;
use App\Http\Requests\UpdateOrderItemRequest;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Support\Facades\Auth;

class OrderItemController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(OrderItem::class, 'orderitem');
    }

    public function index()
    {
        $orderitems = QueryBuilder::for(OrderItem::class)
        ->defaultSort('created_at')
        ->paginate();
        return new ProductCollection($orderitems);
    }

    public function show(Request $request, OrderItem $orderitem)
    {
        return new OrderItemResource($orderitem);
    }

    public function store (StoreOrderItemRequest $request)
    {
        $validated = $request->validated();
        $orderitem = Auth::user()->orderitems()->create($validated);
        return new OrderItemResource($orderitem);
    }

    public function update(UpdateOrderItemRequest $request, OrderItem $orderitem)
    {
        $validated = $request->validated();
        $orderitem->update($validated);
        return new OrderItemResource($orderitem);
    }

    public function destroy(Request $request, OrderItem $orderitem)
    {
        $orderitem->delete();
        return response()->noContent();
    }

}

