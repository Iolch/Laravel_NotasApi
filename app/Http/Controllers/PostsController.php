<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Services\PostService;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->postService = new PostService();
    }  

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Post::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $post = $this->postService->save($request->all());
            return $post;
        } catch (ValidationException $e) {
            dd($e->validator->getMessageBag());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return $post;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        try {
            $updated = $this->postService->update($request->all(), $post);
            return ['updated' => $updated];
        } catch (ValidationException $e) {
            dd($e->validator->getMessageBag());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        try {
            $deleted = $this->postService->delete($post);
            return ['deleted' => $deleted];
        } catch (ValidationException $e) {
            dd($e->validator->getMessageBag());
        }
    }
}
