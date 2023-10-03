<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Task;

class TaskController extends BaseController
{
    public function index(Request $request)
    {
        return response()->json(Task::all());
    }
}
