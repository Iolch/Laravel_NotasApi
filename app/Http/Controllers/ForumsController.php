<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Forum;
use App\Services\ForumService;

class ForumsController extends Controller
{

    public function __construct()
    {
        $this->forumService = new ForumService();
    }  

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Forum::all();
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
            $forum = $this->forumService->save($request->all());
            return $forum;
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
    public function show(Forum $forum)
    {
        return $forum;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Forum $forum)
    {
        try {
            $updated = $this->forumService->update($request->all(), $forum);
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
    public function destroy(Forum $forum)
    {
        try {
            $deleted = $this->forumService->delete($forum);
            return ['deleted' => $deleted];
        } catch (ValidationException $e) {
            dd($e->validator->getMessageBag());
        }
    }
}
