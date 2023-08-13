@extends('layouts.app')

@section('content')
  <div class="jumbotron jumbotron-fluid">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card">
            <div class="card-body">
              <div class="col-6">
                <h3 class="fw-normal text-secondary fs-4 text-uppercase mb-4">Edit User Information</h3>
                {{--Validation output--}}
                <ul id="form_err"></ul>
                <div id="success_message"></div>
              </div>
              <form method="POST" action="/admin/users/{{$selectUser->id}}" class="needs-validation" name="user_update">
                @csrf
                @method('PUT')
                <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{auth()->user()->id}}">
                <div class="col-3 mb-3">
                  <label for="title" class="form-label">Name</label>
                  <input type="text" class="form-control" id="name" name="name" value="{{$selectUser->name}}" required autocomplete="name" autofocus>
                  <snap class="text-danger error-text name_error" id="name_error"></snap>
                </div>
                <div class="col-3 mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" class="form-control" id="email" name="email" value="{{$selectUser->email}}" required autocomplete="email">
                  <snap class="text-danger error-text email_error" id="email_error"></snap>
                </div>
                <div class="col-3 mb-3">
                  <label for="password" class="form-label">New Password</label>
                  <input type="password" class="form-control" id="password" name="password" required autocomplete="new-password">
                  <snap class="text-danger error-text password_error" id="password_error"></snap>
                </div>
                <div class="col-3 mb-3">
                  <label for="password-confirm" class="form-label">Confirm New Password</label>
                  <input type="password" class="form-control" id="password-confirm" name="password_confirmation" required autocomplete="new-password">
                </div>
                <div class="col-3 mb-3">
                  <label for="status" class="form-label me-2">Activity status</label>
                  <input  name="status" type="checkbox" class="js-switch"  {{ $selectUser->status == 1 ? 'checked' : '' }}  />
                </div>
                <div class="col-3 mb-3">
                  <label for="admin" class="form-label me-3">Admin status</label>
                  <input  name="admin" type="checkbox" class="js-switch"  {{ $selectUser->admin == 1 ? 'checked' : '' }}  />
                </div>

                <div class="col-12 mt-b">
                  <button class="btn btn-primary float-end">Submit</button>
                  <a href="/admin/users/" type="button" class="btn btn-outline-secondary float-end me-2">Cancel</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection