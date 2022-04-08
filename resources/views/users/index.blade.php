@extends('layouts.app')

@section('page_title')
    Users
@endsection

@section('content')
	<main>
        <div class="container-fluid px-4">
        	<div class="row">
        		<div class="col-md-6">
		            <h1 class="mt-4">Users</h1>
		        </div>
		        <div class="col-md-6">
		    		<a class="btn btn-primary mt-4 pull-right" href="{{ route('users.create') }}">Create User</a>
		        </div>
        	</div>
        	<div class="row">
        		<div class="col-md-12">
        			@include('partials.flash-message')
        		</div>
        	</div>
            <div class="card mb-4">
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>DOB</th>
                                <th>Gender</th>
                                <th>Phone</th>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                        	@if(!empty($users))
                        		@foreach($users as $user)
                        			<tr>
                        				<td>{{ $user->first_name }}</td>
                        				<td>{{ $user->last_name }}</td>
                        				<td>{{ $user->email }}</td>
                        				<td>{{ $user->dob }}</td>
                        				<td>{{ $user->gender }}</td>
                        				<td>{{ $user->phone }}</td>
                        				<td>
                        					<a class="btn btn-primary" href="{{ route('users.edit', [$user->id]) }}">
                        						<i class="fa fa-pencil"></i>
                        					</a>
                        					<form method="POST" action="{{ route('users.destroy', [$user->id]) }}">
										        {{ csrf_field() }}
										        {{ method_field('DELETE') }}

										        <div class="form-group">
									        		<button type="submit" class="btn btn-danger delete-user" onclick="return confirm('Are you sure you want to delete this item?');">
									        			<i class="fa fa-trash"></i>
									        		</button>
										        </div>
										    </form>
                        				</td>
                        			</tr>
                        		@endforeach
                        	@endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
<script src="{{ asset('theme/js/datatables-simple-demo.js') }}"></script>
@endsection