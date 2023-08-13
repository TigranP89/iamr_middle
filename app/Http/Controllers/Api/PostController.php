<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Controllers\BaseController;

class PostController extends BaseController
{
  /**
   * PostController constructor.
   */
  public function __construct()
  {
    parent::__construct();
  }

  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    try {
      $posts = Post::with('category')->latest()->paginate(5);

      return response()->json([
        'posts' => $posts
      ]);
    } catch (\Exception $e) {
      return response()->json([
        "error" => $e->getMessage(),
        "result" => null
      ]);
    }
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
      //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StorePostRequest $request)
  {
    dd($request->all());
    try {
      $data = $request->input();
      $item = Post::create($data);

      return response()->json([
        'status' => 200
      ]);
    }  catch (\Exception $e) {
      return response()->json([
        "error" => $e->getMessage(),
        "result" => null
      ]);
    }
  }

  /**
   * Display the specified resource.
   */
  public function show(Post $post)
  {
    try {
      $post = Post::with('category')
                  ->where('id', $post->id)
                  ->first();

      return response()->json([
        "post" => $post
      ]);
    }  catch (\Exception $e) {
      return response()->json([
        "error" => $e->getMessage(),
        "result" => null
      ]);
    }
  }

  /**
   * @param $slug
   * @return \Illuminate\Http\JsonResponse
   */
  public function showPostWithSlug($slug)
  {

    try {
      $post = Post::with('category')
        ->where('slug', $slug)
        ->get();

      return response()->json([
        "post" => $post
      ]);
    }  catch (\Exception $e) {
      return response()->json([
        "error" => $e->getMessage(),
        "result" => null
      ]);
    }
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Post $post)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdatePostRequest $request, Post $post)
  {
      //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Post $post)
  {
      //
  }

  public  function redir()
  {
    return view('pages.posts.creat');
  }
}
