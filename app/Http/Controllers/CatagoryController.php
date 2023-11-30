<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreCatagoryRequest;
use App\Http\Requests\UpdateCatagoryRequest;
use App\Http\Resources\CatagoryResource;
use App\Models\Catagory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Resources\CatagoryCollection;

class CatagoryController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Catagory::class, 'catagory');
    }

    public function index()
    {
        $catagory = QueryBuilder::for(Catagory::class)
        ->paginate();
        return new CatagoryCollection($catagory);
    }

    public function store(StoreCatagoryRequest $request)
    {
        $validated = $request->validated();
        $catagory = Auth::user()->catagories()->create($validated);
        return new CatagoryResource($catagory);
    }

    public function update(UpdateCatagoryRequest $request, Catagory $catagory)
    {
        $validated = $request->validated();
        $catagory->update($validated);
        return new CatagoryResource($catagory);
    }

    public function show(Request $request, Catagory $catagory)
    {
        return (new CatagoryResource($catagory))->load('members');            
    }

    public function destroy(Request $request, Catagory $catagory)
    {
        $catagory->delete();
        return response()->noContent();
    }
}
