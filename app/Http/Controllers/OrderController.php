<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Resources\OrderCollection;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Order::class, 'order');
    }

    public function index()
    {
        $orders = QueryBuilder::for(Order::class)->paginate();
        return new OrderCollection($orders);
    }

    public function store(StoreOrderRequest $request)
    {
        $validated = $request->validated();
        $order = Auth::user()->orders()->create($validated);
        return new OrderResource($order);
    }

    public function update(UpdateOrderRequest $request, Order $order)
    {
        $validated = $request->validated();
        $order->update($validated);
        return new OrderResource($order);
    }

    public function show(Request $request, Order $order)
    {
        return (new OrderResource($order));
     
    }

    public function destroy(Request $request, Order $order)
    {
        $order->delete();
        return response()->noContent();
    }
    
}
