@extends('layouts.app')

@section('content')
  <div class="jumbotron jumbotron-fluid">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card">
            <div class="card-body">
              <div class="col-6">
                <h3 class="fw-normal text-secondary fs-4 text-uppercase mb-4">Change Category</h3>
                {{--Validation output--}}
                <ul id="form_err"></ul>
                <div id="success_message"></div>
              </div>
              <form method="POST" action="/admin/categories/{{$selectCategory->id}}" class="needs-validation" name="store" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{auth()->user()->id}}">
                <div class="col-3 mb-3">
                  <label for="title" class="form-label">Title</label>
                  <input type="text" class="form-control" id="title" name="title" placeholder="Заголовок" value="{{$selectCategory->title}}">
                  <snap class="text-danger error-text title_error" id="title_error"></snap>
                </div>
                <div class="col-3 mb-3">
                  <label for="status" class="form-label">Activity status</label>
                  <input  name="status" type="checkbox" class="js-switch"  {{ $selectCategory->status == 1 ? 'checked' : '' }}  />
                </div>
                <div class="col-3 mb-3">
                  <label for="order_id" class="form-label">Порядок</label>
                  <select name="order_id" class="form-select">
                    @foreach($orders as $order)
                      <option value="{{$order->id}}" {{ $order->id == $selectCategory->order_id ? 'selected' : '' }}>{{$order->title}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-12 mt-b">
                  <button class="btn btn-primary float-end">Order</button>
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