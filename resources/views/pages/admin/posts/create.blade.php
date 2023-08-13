@extends('layouts.app')

@section('content')
  <div class="jumbotron jumbotron-fluid">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card">
            <div class="card-body">
              <div class="col-6">
                <h3 class="fw-normal text-secondary fs-4 text-uppercase mb-4">Add new Post</h3>
                {{--Validation output--}}
                <ul id="form_err"></ul>
                <div id="success_message"></div>
              </div>
              <form method="POST" action="/admin/posts" class="needs-validation" name="store" enctype="multipart/form-data">
                @csrf

                <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{auth()->user()->id}}">
                <div class="col-3 mb-3">
                  <label for="title" class="form-label">Title</label>
                  <input type="text" class="form-control" id="title" name="title" placeholder="Заголовок">
                  <snap class="text-danger error-text title_error" id="title_error"></snap>
                </div>
                <div class="col-3 mb-3">
                  <label for="status" class="form-label">Category</label>
                  <select name="category_id" class="form-select" >
                    @foreach($categories as $category)
                      <option value="{{ $category-> id }}">{{ $category-> title }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-12 mb-3">
                  <label for="title" class="form-label">Description</label>
                  <textarea class="form-control" id="summernote" name="description" placeholder="Описание" rows="3"></textarea>
                  <snap class="text-danger error-text description_error" id="description_errorr"></snap>
                </div>
                <div class="col-3 mb-3">
                  <label for="status" class="form-label me-2">Activity status</label>
                  <input  name="status" type="checkbox" class="js-switch" checked />
                </div>
                <div class="col-3 mb-3">
                  <label for="order_id" class="form-label">Order</label>
                  <select name="order_id" class="form-select" >
                    @foreach($orders as $order)
                      <option value="{{$order->id}}">{{$order->title}}</option>
                    @endforeach
                  </select>
                </div>
                <div>
                  <div class="input-group mb-3">
                    <input type="hidden" name="imageNames" value="" id="imageNames">
                    <input type="file" name="cover" class="form-control" id="image">
                    <label class="input-group-text" for="image">Upload</label>
                    <snap class="text-danger error-text imageFile_error"></snap>
                  </div>
                </div>
                <div class="col-12 mt-b">
                  <button class="btn btn-primary float-end">Submit</button>
                  <a href="/admin/posts/" type="button" class="btn btn-outline-secondary float-end me-2">Cancel</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection