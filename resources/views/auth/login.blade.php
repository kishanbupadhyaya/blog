@extends('layouts.auth_layout')

@section('page_title')
    Login
@endsection

@section('content')
<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-floating mb-3">
                                <input class="form-control @error('email') is-invalid @enderror" id="inputEmail" type="email" placeholder="name@example.com" name="email" value="{{ old('email') }}" autofocus/>
                                <label for="inputEmail">Email address</label>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control @error('password') is-invalid @enderror" id="inputPassword" type="password" placeholder="Password" name="password" />
                                <label for="inputPassword">Password</label>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                <a class="small" href="password.html">Forgot Password?</a>
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center py-3">
                        <div class="small">
                            <a href="{{ route('register') }}">Need an account? Sign up!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
