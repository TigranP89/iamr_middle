<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Http\Controllers\BaseController;

class UserController extends BaseController
{
  /**
   * UserController constructor.
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
      $users = User::orderBy('id', 'asc')->get();

      return view('pages.admin.users.index',compact('users'))
          ->with('i');
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
      try {
        return view('pages.admin.users.create');
      } catch (\Exception $e){
        return $e->getMessage();
      }
    } catch (\Exception $e){
      return $e->getMessage();
    }
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreUserRequest $request)
  {

    try {
      $input = $request->all();

      $user = new User;
      $user->name = $input['name'];
      $user->email = $input['email'];
      $user->password = Hash::make($input['password']);
      $user->admin = isset($input['admin']) ? 1 : 0;
      $user->status = isset($input['status']) ? 1 : 0;
      $user->save();

      return  redirect('admin/users');
    } catch (\Exception $e){
      return $e->getMessage();
    }
  }

  /**
   * Display the specified resource.
   */
  public function show(User $user)
  {
    try {
      $selectUser = User::where('id', $user->id)
          ->first();

      return  view('pages.admin.users.show', compact('selectUser'));
    } catch (\Exception $e){
      return $e->getMessage();
    }
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(User $user)
  {
    try {
      $selectUser = User::where('id', $user->id)->first();

      return  view('pages.admin.users.edit', compact('selectUser'));
    } catch (\Exception $e){
      return $e->getMessage();
    }
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateUserRequest $request, User $user)
  {
    try {
      $input = $request->all();

      $user = User::find($user->id);
      $user->name = $input['name'];
      $user->email = $input['email'];
      $user->password = Hash::make($input['password']);
      $user->admin = isset($input['admin']) ? 1 : 0;
      $user->status = isset($input['status']) ? 1 : 0;
      $user->update();

      return  redirect('admin/users');
    } catch (\Exception $e){
      return $e->getMessage();
    }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(User $user)
  {
    try {
      User::destroy($user->id);

      return  redirect('admin/users');
    } catch (\Exception $e){
      return $e->getMessage();
    }
  }
}
