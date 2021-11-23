<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use App\Notifications\NewPost;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Notification;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $requestBody = $request->validated();

        try {
            $post = Post::create($requestBody);

            return response()->json([
                'website_id' => $post->website_id,
                'title' => $post->title,
                'description' => $post->description,
                'created_at' => $post->created_at->toDateTimeString(),
            ], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'status' => 'error',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
