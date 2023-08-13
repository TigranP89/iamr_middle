@extends('layouts.app')

@section('content')
  <div class="jumbotron jumbotron-fluid">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card">
            <div class="card-body">
              <div class="col-6">
                <h3 class="fw-normal text-secondary fs-4 text-uppercase mb-4">Add New Category</h3>
                {{--Validation output--}}
                <ul id="form_err"></ul>
                <div id="success_message"></div>
              </div>
              <form method="POST" action="/admin/categories" class="needs-validation" name="store">
                @csrf

                <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{auth()->user()->id}}">
                <div class="col-3 mb-3">
                  <label for="title" class="form-label">Title</label>
                  <input type="text" class="form-control" id="title" name="title" placeholder="Title">
                  <snap class="text-danger error-text title_error" id="title_error"></snap>
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
                <div class="col-12 mt-b">
                  <button class="btn btn-primary float-end">Submit</button>
                  <a href="/admin/categories/" type="button" class="btn btn-outline-secondary float-end me-2">Cancel</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection