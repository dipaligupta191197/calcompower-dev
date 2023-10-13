@extends('layouts.main')
@section('content')
<body>
	<div class="container">
		@include('layouts.nav')
		<div class="row align-items-center">
			<div class="col-sm-12">
				@include('layouts.error')
                <form class="formcont" id="signup" name="signup" action="{{url('register')}}" method="post" enctype="multipart/form-data">
					{!! csrf_field() !!}
					<div class="row justify-content-md-center">
						<div class="col-sm-12 col-md-10">
							<h3>Register to your account</h3>
							<h5>Personal Information</h5>
						</div>
						<div class="col-sm-12 col-md-10">
							<div class="row">
								<div class="col-sm-12 col-md-6 form-group">
									<label for="exampleInputEmail1">First Name<span>*</span></label>
									<input type="text" class="form-control" value="{{old('first_name')}}" name="first_name" id="first_name" placeholder="First Name">
								</div>
								<div class="col-sm-12 col-md-6 form-group">
									<label for="exampleInputPassword1">Last Name<span>*</span></label>
									<input type="text" class="form-control" value="{{old('last_name')}}" name="last_name" id="last_name" placeholder="Last Name">
								</div>
								<!-- <div class="col-sm-12 col-md-6 form-group">
									<label for="exampleInputPassword1">Profile Picture</label>
									<input type="file" class="form-control" name="avatar" id="avatar">
								</div> -->
								<!-- <div class="col-sm-12 col-md-6 form-group">
									<label for="exampleInputEmail1">Select Cal-Company<span>*</span></label>
									<select class="form-control" name="company_id" id="company_id" required>
										<option value="">Select Cal-company</option>
										@if(@$locations)
											@php
												foreach($locations as $location){
													echo '<option value="'.$location->id.'">'.$location->name.'</option>';
												}
											@endphp
										@endif
									</select>
								</div> -->
							</div>
						</div>
						<div class="col-sm-12 col-md-10">
							<h5>Company Information</h5>
						</div>
						<div class="col-sm-12 col-md-10">
							<div class="row">
								<div class="col-sm-12 col-md-6 form-group">
									<label for="exampleInputEmail1">Company Name<span>*</span></label>
									<input type="text" class="form-control" value="{{old('company')}}" name="company" id="company" placeholder="Company Name">
								</div>
								<div class="col-sm-12 col-md-6 form-group">
									<label for="exampleInputPassword1">Phone<span>*</span></label>
									<input type="text" class="form-control" value="{{old('phone')}}" name="phone" id="phone" placeholder="Phone">
								</div>
								<div class="col-sm-12 form-group">
									<label for="exampleInputPassword1">Address<span>*</span></label>
									<textarea class="form-control" name="address" id="address">{{old('address')}}</textarea>
								</div>
								<div class="col-sm-12 col-md-6 form-group">
									<label for="exampleInputPassword1">City<span>*</span></label>
									<input type="text" class="form-control" value="{{old('city')}}" name="city" id="city" placeholder="City">
								</div>
								<div class="col-sm-12 col-md-6 form-group">
									<label for="exampleInputEmail1">State<span>*</span></label>
									<input type="text" class="form-control" value="{{old('state')}}" name="state" id="state" placeholder="State">
								</div>
								<div class="col-sm-12 col-md-6 form-group">
									<label for="exampleInputPassword1">Zip<span>*</span></label>
									<input type="text" class="form-control" value="{{old('zip')}}" name="zip" id="zip" placeholder="Zip">
								</div>
							</div>
						</div>
						<div class="col-sm-12 col-md-10">
							<h5>User Information</h5>
						</div>
						<div class="col-sm-12 col-md-10">
							<div class="row">
								<div class="col-sm-12 col-md-4 form-group">
									<label for="exampleInputEmail1">Email<span>*</span></label>
									<input type="email" class="form-control" value="{{old('email')}}" name="email" id="email" aria-describedby="emailHelp" placeholder="Email">
								</div>
								<div class="col-sm-12 col-md-4 form-group">
									<label for="exampleInputPassword1">Password<span>*</span></label>
									<input type="password" class="form-control" name="password" id="password" placeholder="Password">
								</div>
								<div class="col-sm-12 col-md-4 form-group">
									<label for="exampleInputEmail1">Confirm Password<span>*</span></label>
									<input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password">
								</div>
							</div>
							<div class="form-group row">
									<div class="col-md-6 col-sm-12"><button type="submit" class="btn btn-primary col-sm-12 col-md-5">Register</button></div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
<script>
$(document).ready(function () {
    $('#signup').validate({ 
        rules: {
            email: {
                required: true,
                email: true
            },
            first_name: {
                required: true
            },
            last_name: {
                required: true
            },
            phone: {
                required: true,
                minlength:9,
                maxlength:15,
                number: true
            },
            password: {
                required: true,
                minlength:6
            },
            password_confirmation: {
                required: true,
                equalTo : "#password"
			},
			// user_name: {
            //     required: true
            // },
            company: {
                required: true
			},
			address: {
                required: true
            },
            city: {
                required: true
			},
			state: {
                required: true
            },
            zip: {
                required: true
            },
			company_id: {
                required: true
			}
        },
        messages :{
            email : {
                required : 'Please enter email.',
                email : 'Please enter valid email.'
            },
            first_name : {
                required : 'Please enter first name.'
            },
            last_name : {
                required : 'Please enter last name.'
            },
            phone : {
                required : 'Please enter phone.'
            },
            password : {
                required : 'Please enter password.'
            },
            password_confirmation : {
                required : 'Please confirm password.'
			},
			// user_name : {
            //     required : 'Please enter username.'
			// },
			company : {
                required : 'Please enter company.'
			},
			address : {
                required : 'Please enter address.'
			},
			city : {
                required : 'Please enter city.'
			},
			state : {
                required : 'Please enter state.'
			},
			zip : {
                required : 'Please enter zip.'
			},
			company : {
                required : 'Please enter cal-company.'
			}
        }
    });
});
</script>
@stop