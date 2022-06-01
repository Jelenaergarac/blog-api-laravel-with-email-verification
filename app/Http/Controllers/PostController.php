<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts = Post::with('comments','user')->orderBy('created_at','desc')->paginate(10);
        return response()->json($posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        $data = $request->validated();

        $post = new Post;
        $post->title = $data['title'];
        $post->body = $data['body'];
        $post->image_url = $data['image_url'];
        $post->user()->associate(Auth::user());
        $post->save();

        return response()->json([
            'post'=>$post,
            'message'=>'Post created successfully!'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $id)
    {
        $post = Post::with('comments.user', 'user.comments')->find($id);

        return response()->json($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request,Post $post)
    {
        $data = $request->validated();
        $post->update($data);
        return response()->json([
            'post'=>$post,
            'message'=>'Post updated successfully!'
        ]);
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
        return response()->noContent();
    }
    public function getMyPosts($user_id){
        $myPosts = Post::with('comments')->where('user_id',$user_id)->orderBy('created_at','desc')->get();
        return response()->json($myPosts);
    }
}
