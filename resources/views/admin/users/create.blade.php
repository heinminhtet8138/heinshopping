@extends('layouts.admin')
@section('content')

<main>
        <div class="container-fluid px-4">
            <div class="my-3">
                <h3 class="my-4 d-inline">User Create</h3>
                <a href="{{route('backend.users.index')}}" class="btn btn-danger float-end">Cancel</a>
            </div>

            <div class="card mb-4">
                <div class="card-body py-5">
                    <div class="row">
                        <div class="offset-md-1 col-md-10">
                            <form action="{{route('backend.users.store')}}" method="POST" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}" name="name" id="name">
                                    @if($errors->has('name'))
                                        <div class="invalid-feedback">
                                            {{$errors->first('name')}}
                                        </div>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}" name="email" id="email">
                                    @if($errors->has('email'))
                                        <div class="invalid-feedback">
                                            {{$errors->first('email')}}
                                        </div>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="role" class="form-label">Role</label>
                                    <select class="form-select {{$errors->has('role') ? 'is-invalid' : ''}}" name="role">
                                        <option value="Super Admin" >Super Admin</option>
                                        <option value="Admin">Admin</option>
                                        <option value="User">User</option>
                                    </select>
                                    @if($errors->has('role'))
                                        <div class="invalid-feedback">
                                            {{$errors->first('role')}}
                                        </div>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control {{$errors->has('password') ? 'is-invalid' : ''}}" name="password" id="password">
                                    @if($errors->has('password'))
                                        <div class="invalid-feedback">
                                            {{$errors->first('password')}}
                                        </div>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control {{$errors->has('password_confirmation') ? 'is-invalid' : ''}}" name="password_confirmation" id="password_confirmation">
                                    @if($errors->has('password_confirmation'))
                                        <div class="invalid-feedback">
                                            {{$errors->first('password_confirmation')}}
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="d-grid gap-2">
                                    <button class="btn btn-primary" type="submit">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection