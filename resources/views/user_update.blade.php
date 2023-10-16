@extends('app')
@section('content')
<div class="card-body">
                        <h3 class="card-header text-center">User Data :</h3>
                        <form action="{{ route('user.editUser') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <input type="hidden" placeholder="Id" id="id" class="form-control" name="id"
                                    autofocus value="{{$user->id}}"/>
                            </div>
                            <div class="form-group mb-3">
                            <label>
                                Email
                            </label>
                                <input placeholder="Email" id="email" class="form-control" name="email"
                                    required autofocus value="{{$user->email}}">
                                @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <label>
                                Name
                                </label>
                                <input placeholder="Name" id="name" class="form-control" name="name"
                                    required autofocus value="{{$user->name}}">
                                @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <label>
                                Old Password
                                </label>
                                <input type="text" placeholder="Old Password" id="password" class="form-control"
                                    name="password" required>
                                @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                            <label>
                                New Password
                                </label>
                                <input type="text" placeholder="New Password" id="newPassword" class="form-control"
                                    name="newPassword" required>
                                @if ($errors->has('newPassword'))
                                <span class="text-danger">{{ $errors->first('newPassword') }}</span>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                            <label>
                                Confirm Password
                                </label>
                                <input type="text" placeholder="Confirm New Password" id="confirmPassword" class="form-control"
                                    name="confirmPassword" required>
                                @if ($errors->has('confirmPassword'))
                                <span class="text-danger">{{ $errors->first('confirmPassword') }}</span>
                                @endif
                            </div>
                            <div class="d-grid mx-auto">
                                <button type="submit" class="btn btn-dark btn-block">Update</button>
                            </div>
                        </form>
                    </div>
@endsection