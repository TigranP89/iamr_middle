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
                  <a class="btn btn-success" href="/admin/categories/create"> Create a new Category</a>
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
                  <th><span class="ml-2">Status</span></th>
                  <th><span class="ml-2">Order</span></th>
                  <th><span class="ml-2">Action</span></th>
                </tr>

                @foreach($categories as $category)
                  <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{$category->title}}</td>
                    <td>{{$category->status == 0 ? 'Inactive' : 'Active' }}</td>
                    <td>{{$category->order->title}}</td>
                    <td class="col-3">
                      <form action="/admin/categories/{{$category->id}}" method="POST">
                        @csrf

                        <a class="btn btn-primary" href="/admin/categories/{{$category->id}}/edit">Edit</a>

                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">Delete</button>
                      </form>
                    </td>
                  </tr>
                @endforeach
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
