<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\Order;
use App\Models\Post;
use Illuminate\Support\Str;


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
      $posts = Post::with('category')
          ->with('order')
          ->orderBy('order_id', 'asc')
          ->paginate(10);

      return view('pages.admin.posts.index',compact('posts'))
          ->with('i', (request()->input('page', 1) - 1) * 10);
    } catch (\Exception $e){
      return $e->getMessage();
    }
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    try {
      $categories = Category::all();
      $orders = Order::all();

      return view('pages.admin.posts.create', compact('categories', 'orders'));
    } catch (\Exception $e){
      return $e->getMessage();
    }
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StorePostRequest $request)
  {
    try {
      $input = $request->all();

      $post = new Post;
      $post->title = $input['title'];
      $post->slug = Str::slug($input['title']);
      $post->category_id = $input['category_id'];
      $post->description = $input['description'];
      $post->status = isset($input['status']) ? 1 : 0;
      $post->order_id = $input['order_id'];

      if ($request->hasFile('cover')){
        $cover =  $request->file('cover');
        $path = public_path() . '/storage/covers';
        $filename = 'book_cover' . '_' .time() . '.' . $cover->getClientOriginalExtension();
        $cover->move($path, $filename);

        $post->image = $filename;
        $post->save();

        return  redirect('admin/posts');
      }

      $post->save();

      return  redirect('admin/posts');

    } catch (\Exception $e){
      return $e->getMessage();
    }
  }

  /**
   * Display the specified resource.
   */
  public function show(Post $post)
  {
    try {
      $categories = Category::all();
      $orders = Order::all();
      $selectPost = Post::where('id', $post->id)
          ->first();

      return  view('pages.admin.posts.show', compact('selectPost','categories','orders'));
    } catch (\Exception $e){
      return $e->getMessage();
    }
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Post $post)
  {
    try {
      $categories = Category::all();
      $orders = Order::all();
      $selectPost = Post::where('id', $post->id)->first();

      return  view('pages.admin.posts.edit', compact('selectPost', 'categories','orders'));
    } catch (\Exception $e){
      return $e->getMessage();
    }
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdatePostRequest $request, Post $post)
  {
    try {
      $input = $request->all();

      $post =  Post::find($post->id);
      $post->title = $input['title'];
      $post->slug = Str::slug($input['title']);
      $post->category_id = $input['category_id'];
      $post->description = $input['description'];
      $post->status = isset($input['status']) ? 1 : 0;
      $post->order_id = $input['order_id'];

      if ($request->hasFile('cover')){

        $cover =  $request->file('cover');
        $path = public_path() . '/storage/covers';
        $filename = 'book_cover' . '_' .time() . '.' . $cover->getClientOriginalExtension();
        $cover->move($path, $filename);

        $post->image = $filename;
        $post->update();

        return  redirect('admin/posts');
      }

      $post->update();

      return  redirect('admin/posts');
    } catch (\Exception $e){
      return $e->getMessage();
    }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Post $post)
  {
    try {
      Post::destroy($post->id);

      return  redirect('admin/posts');
    } catch (\Exception $e){
      return $e->getMessage();
    }
  }
}
