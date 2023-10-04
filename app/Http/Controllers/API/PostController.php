<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Validator;


class PostController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $isExist = Post::all();

        if (is_null($isExist)) {
            return $this->sendError('Data is not available.');
        } else {
            return $this->sendResponse(PostResource::collection($isExist), 'Data is available.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'title' => 'required',
            'content' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $result = Post::create($input);

        return $this->sendResponse(new PostResource($result), 'Data created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $result = Post::find($id);

        if (is_null($result)) {
            return $this->sendError('Data is not available.');
        } else {
            return $this->sendResponse(new PostResource($result), 'Data is available.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'title' => 'required',
            'content' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $post->title = $input['title'];
        $post->content = $input['content'];
        $post->save();

        return $this->sendResponse(new PostResource($post), 'Data updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return $this->sendResponse([], 'Post deleted successfully.');
    }
}
