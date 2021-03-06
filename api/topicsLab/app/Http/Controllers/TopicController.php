<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        logger('ページ番号', ['page' => $request->page]);
        return Topic::simpleAllList()->orderBy('created_at', 'DESC')->paginate(10, ['*'], 'page', $request->page);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = $request->user();

        $topic = new Topic;
        $topic->title = $request->title;
        $topic->body = $request->body;
        $topic->user()->associate($user);
        $topic->save();
        
        if ($request->hasFile('img')) {
            $img = $request->file('img');
            $filename = $img->getClientOriginalName();
            $extension = pathinfo($filename, PATHINFO_EXTENSION);
            $img->storeAs('public', $topic->id . '.' . $extension);
            $topic->img = $topic->id . '.' . $extension;
            $topic->save();
        }

        return $topic;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function show(Topic $topic)
    {
        return Topic::where('id', $topic->id)->with('user', 'comments.user')->withCount('topic_likes')->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function edit(Topic $topic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Topic $topic)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Topic $topic)
    {
        //
    }
}
