@extends('partials.layout')
@section('styles')
<style>
    body {
    background-color: #f8f9fa;
    }
    .login-container {
        min-width: 400px;
        max-width: 400px;
    
    }
</style>
@endsection
@section('content')
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card login-container shadow p-4">
            <h4 class="text-center mb-4">Register</h4>
            <form action="{{ route('customer.register') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="first_name" class="form-label">First Name<span class="text-danger">*</span></label>
                    <input type="first_name" name="first_name" autocomplete="off" value="{{ old('first_name') }}" class="form-control" id="first_name" placeholder="Enter firstname" >
                    @error('first_name')
                        <span class="text-danger ml-2">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="last_name" class="form-label">Last Name<span class="text-danger">*</span></label>
                    <input type="last_name" name="last_name" autocomplete="off" value="{{ old('last_name') }}" class="form-control" id="last_name" placeholder="Enter lastname">
                    @error('last_name')
                        <span class="text-danger ml-2">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address<span class="text-danger">*</span></label>
                    <input type="email" name="email" autocomplete="off" value="{{ old('email') }}" class="form-control" id="email" placeholder="Enter email">
                    @error('email')
                        <span class="text-danger ml-2">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password<span class="text-danger">*</span></label>
                    <input type="password" name="password" autocomplete="new-password" class="form-control" id="password" placeholder="Password">
                    @error('password')
                        <span class="text-danger ml-2">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary w-100 mt-4">Register</button>
                <div class="text-center mt-3">
                    <p>Already have an account? <a href="{{ route('login') }}">Login</a></p>
                </div>
            </form>
        </div>
    </div>
@endsection
