<?php

namespace App\Http\Controllers;

use App\Http\Resources\PaymentCollection;
use App\Http\Resources\PaymentResource;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Models\Payment;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
     public function __construct()
    {
        $this->authorizeResource(Payment::class, 'payment');
    }

    public function index()
    {
        $payments = QueryBuilder::for(Payment::class)
        ->allowedFilters('published')
        ->defaultSort('created_at')
        ->paginate();
        return new PaymentCollection($payments);
    }

    public function show(Request $request, Payment $payment)
    {
        return new PaymentResource($payment);
    }

    public function store (StorePaymentRequest $request)
    {
        $validated = $request->validated();
        $product = Auth::user()->payments()->create($validated);
        return new PaymentResource($product);
    }

    public function update(UpdatePaymentRequest $request, Payment $payment)
    {
        $validated = $request->validated();
        $payment->update($validated);
        return new PaymentResource($payment);
    }

    public function destroy(Request $request, Payment $payment)
    {
        $payment->delete();
        return response()->noContent();
    }

}

