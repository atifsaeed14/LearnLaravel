<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCouponRequest;
use App\Http\Requests\UpdateCouponRequest;
use App\Http\Resources\CouponResource;
use App\Models\Coupon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Resources\CouponCollection;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Coupon::class, 'coupon');
    }

    public function index()
    {
        $coupons = QueryBuilder::for(Coupon::class)
        ->paginate();
        return new CouponCollection($coupons);
    }

    public function store(StoreCouponRequest $request)
    {
        $validated = $request->validated();
        $coupon = Auth::user()->coupons()->create($validated);
        return new CouponResource($coupon);
    }

    public function update(UpdateCouponRequest $request, Coupon $coupon)
    {
        $validated = $request->validated();
        $coupon->update($validated);
        return new CouponResource($coupon);
    }

    public function show(Request $request, Coupon $coupon)
    {
        return (new CouponResource($coupon))->load('members');
                
    }

    public function destroy(Request $request, Coupon $coupon)
    {
        $coupon->delete();
        return response()->noContent();
    }
}
