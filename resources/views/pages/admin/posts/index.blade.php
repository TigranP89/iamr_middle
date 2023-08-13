@extends('layouts.app')

@section('content')
  <div class="container" style="padding: 30px 0;">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-default">

          <div class="card-header-heading">
            <div class="row">
              @if (session('status'))
                <div class="alert alert-success" role="alert">
                  {{ session('status') }}
                </div>
              @endif

              @if ($message = Session::get('success'))
                <div class="alert alert-success">
                  <p>{{ $message }}</p>
                </div>
              @endif
              <div>
                <div class="float-right m-3">
                  <a class="btn btn-success" href="/admin/posts/create"> Create new Post</a>
                </div>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <table class="table table-bordered">
                <tr>
                  <th><span class="ml-2">No</span></th>
                  <th><span class="ml-2">Title</span></th>
                  <th><span class="ml-2">slug</span></th>
                  <th><span class="ml-2">category</span></th>
                  <th><span class="ml-2">image</span></th>
                  <th><span class="ml-2">description</span></th>
                  <th><span class="ml-2">status</span></th>
                  <th><span class="ml-2">order</span></th>
                  <th><span class="ml-2">Action</span></th>
                </tr>

                @foreach($posts as $post)

                  <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{$post->title}}</td>
                    <td>{{$post->slug}}</td>
                    <td>{{$post->category->title}}</td>
                    <td class="desctop-image">
                      @if(($post->image) != '/img/no_image/no_image.png')
                        <img src="{{ url('/storage/covers/'. $post->image) }}" class="img-fluid img-thumbnail">
                      @else
                        <img class="border border-5 opacity-50 rounded-2" src="{{ asset('assets/img/no_image/no_image.png') }}">
                      @endif
                    </td>
                    <td>{{$post->description}}</td>
                    <td>{{$post->status == 0 ? 'Inactive' : 'Active' }}</td>
                    <td>{{$post->order->title}}</td>
                    <td class="col-3">
                      <form action="/admin/posts/{{$post->id}}" method="POST">
                        @csrf

                        <a class="btn btn-primary" href="/admin/posts/{{$post->id}}/edit">Edit</a>

                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">Delete</button>
                      </form>
                    </td>
                  </tr>
                @endforeach
              </table>

                {{ $posts->links() }}
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
@endsection
