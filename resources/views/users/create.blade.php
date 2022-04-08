@extends('layouts.app')

@section('page_title')
    Create User
@endsection

@section('content')
<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-body">
                        @include('partials.flash-message')
                        <form method="POST" id="register-from" action="{{ route('users.store') }}">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control @error('first_name') is-invalid @enderror" id="inputFirstName" type="text" placeholder="Enter your first name" name="first_name" value="{{ old('first_name') }}" />
                                        <label for="inputFirstName">First name</label>
                                        @error('first_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                        <span class="first_name_error error" role="alert">
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input class="form-control @error('last_name') is-invalid @enderror" id="inputLastName" type="text" placeholder="Enter your last name" name="last_name" value="{{ old('last_name') }}" />
                                        <label for="inputLastName">Last name</label>
                                        @error('last_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <span class="last_name_error error" role="alert">
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control @error('email') is-invalid @enderror" id="inputEmail" type="email" placeholder="Email" name="email" value="{{ old('email') }}" />
                                        <label for="inputEmail">Email address</label>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <span class="email_error error" role="alert">
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control @error('dob') is-invalid @enderror" id="inputDOB" type="date" placeholder="inputDOB" max="{{ date('Y-m-d') }}" name="dob" value="{{ old('dob') }}" />
                                        <label for="inputEmail">DOB</label>
                                        @error('dob')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <span class="dob_error error" role="alert">
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control @error('phone') is-invalid @enderror" id="inputPhone" type="text" placeholder="9876543210" maxlength="10" name="phone" value="{{ old('phone') }}" />
                                        <label for="inputPhone">Phone</label>

                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <span class="phone_error error" role="alert">
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <select class="form-control @error('gender') is-invalid @enderror" id="inputGender" name="gender">
                                            <option value="">-- Select Gender --</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                        <label for="inputGender">Gender</label>
                                        @error('gender')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <span class="gender_error error" role="alert">
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control @error('password') is-invalid @enderror" id="inputPassword" type="password" placeholder="Create a password" name="password" />
                                        <label for="inputPassword">Password</label>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <span class="password_error error" role="alert">
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control @error('confirm_password') is-invalid @enderror" id="inputPasswordConfirm" type="password" placeholder="Confirm password" name="confirm_password" />
                                        <label for="inputPasswordConfirm">Confirm Password</label>
                                        @error('confirm_password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <span class="confirm_password_error error" role="alert">
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 mb-0">
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#register-from").validate({
            rules:{
                first_name: {
                    required: true,
                },
                last_name: {
                    required: true,
                },
                email: {
                    required: true,
                    email: true,
                },
                dob: {
                    required: true,
                },
                phone: {
                    required: true,
                },
                gender: {
                    required: true,
                },
                password: {
                    required: true,
                },
                confirm_password: {
                    required: true,
                },
            },
            messages: {
                first_name: {
                    required: "Please enter first name",
                },
                last_name: {
                    required: "Please enter last name",
                },
                email: {
                    required: "Please enter email address",
                    email: "Please enter valid email address",
                },
                dob: {
                    required: "Please choose date of birth",
                },
                phone: {
                    required: "Please enter phone",
                },
                gender: {
                    required: "Please choose gender",
                },
                password: {
                    required: "Please enter password",
                },
                confirm_password: {
                    required: "Please enter confirm password",
                },
            },
            errorPlacement: function (error, element) {
                // error.insertAfter(element);
                var name = $(element).attr("name");
                error.appendTo($("." + name + "_error"));
            },
        });
    });
</script>
@endsection