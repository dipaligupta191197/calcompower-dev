@extends('layouts.main')
@section('content')
<body>
	<div class="container">
		@include('layouts.nav')
		<div class="row">
			<div class="col-sm-12">
                <div class="settings-tabs grey-bg">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="changepassword-tab" data-toggle="tab" href="#changepassword" role="tab" aria-controls="changepassword" aria-selected="false">Change Password</a>
                    </li>
                    </ul></br>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            @include('layouts.error')
                            <form class="formcont" id="edit_profile" name="edit_profile" action="{{url('profile')}}" method="post" enctype="multipart/form-data">
                                {!! csrf_field() !!}
                                <div class="row justify-content-md-center">
                                    <div class="col-sm-12 col-md-10">
                                        <h3>Update your account</h3>
                                        <h5>Personal Information</h5>
                                    </div>
                                    <div class="col-sm-12 col-md-10">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-6 form-group">
                                                <label for="exampleInputEmail1">First Name<span>*</span></label>
                                                <input type="text" class="form-control" name="first_name" id="first_name" value="{{Auth::user()->first_name}}" placeholder="First Name">
                                            </div>
                                            <div class="col-sm-12 col-md-6 form-group">
                                                <label for="exampleInputPassword1">Last Name<span>*</span></label>
                                                <input type="text" class="form-control" name="last_name" id="last_name" value="{{Auth::user()->last_name}}" placeholder="Last Name">
                                            </div>
                                            <!-- <div class="col-sm-12 col-md-6 form-group">
                                                <label for="exampleInputPassword1">Profile Picture</label>
                                                <input type="file" class="form-control" name="avatar" id="avatar">
                                            </div>
                                            @if(Auth::user()->avatar)
                                            <div class="col-sm-12 col-md-6 form-group">
                                                <img height="100" width="100" src="{{Storage::disk(Config::get('constants.DISK'))->url('user_profiles/'.Auth::user()->avatar)}}">
                                            </div>
                                            @endif -->
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-10">
                                        <h5>Company Information</h5>
                                    </div>
                                    <div class="col-sm-12 col-md-10">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-6 form-group">
                                                <label for="exampleInputEmail1">Company Name<span>*</span></label>
                                                <input type="text" class="form-control" value="{{Auth::user()->company}}" name="company" id="company" readonly>
                                            </div>
                                            <div class="col-sm-12 col-md-6 form-group">
                                                <label for="exampleInputEmail1">Email<span>*</span></label>
                                                <input type="email" class="form-control" value="{{Auth::user()->email}}" name="email" id="email" readonly>
                                            </div>
                                            <div class="col-sm-12 col-md-6 form-group">
                                                <label for="exampleInputPassword1">Phone<span>*</span></label>
                                                <input type="text" class="form-control" value="{{Auth::user()->phone}}" name="phone" id="phone" placeholder="Phone">
                                            </div>
                                            <div class="col-sm-12 col-md-6 form-group">
                                                <label for="exampleInputPassword1">Address<span>*</span></label>
                                                <textarea class="form-control" name="address" id="address">{{Auth::user()->address}}</textarea>
                                            </div>
                                            <div class="col-sm-12 col-md-6 form-group">
                                                <label for="exampleInputPassword1">City<span>*</span></label>
                                                <input type="text" class="form-control" value="{{Auth::user()->city}}" name="city" id="city" placeholder="City">
                                            </div>
                                            <div class="col-sm-12 col-md-6 form-group">
                                                <label for="exampleInputEmail1">State<span>*</span></label>
                                                <input type="text" class="form-control" value="{{Auth::user()->state}}" name="state" id="state" placeholder="State">
                                            </div>
                                            <div class="col-sm-12 col-md-6 form-group">
                                                <label for="exampleInputPassword1">Zip<span>*</span></label>
                                                <input type="text" class="form-control" value="{{Auth::user()->zip}}" name="zip" id="zip" placeholder="Zip">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2 form-group">
                                                <button type="submit" class="btn btn-primary col-sm-12">Done</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="changepassword" role="tabpanel" aria-labelledby="changepassword-tab">
                            @include('layouts.error')
                            <form class="formcont" id="change_password" name="change_password" action="{{url('changepassword')}}" method="post" enctype="multipart/form-data">
                                {!! csrf_field() !!}
                                <div class="row justify-content-md-center">
                                    <div class="col-sm-12 col-md-10">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-6 form-group">
                                                <label for="password">Current Password</label>
                                                <input type="Password" name="password" id="password" class="form-control" placeholder="XXXXXX">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 col-md-6 form-group">
                                                <label for="new_password">New Password</label>
                                                <input type="Password" name="new_password" id="new_password" class="form-control" placeholder="XXXXXX">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 col-md-6 form-group">
                                                <label for="password_confirmation">Confirm Password</label>
                                                <input type="Password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="XXXXXX">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-10">
                                        <div class="row">
                                            <div class="col-md-2 form-group">
                                                <button type="submit" class="btn btn-primary col-sm-12">Done</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
			    </div>
		    </div>
	    </div>
    </div>
</body>
<script>
$(document).ready(function () {
    $('#edit_profile').validate({ 
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
        }
    });
    $('#change_password').validate({ 
        rules: {
            password: {
                required: true
            },
            new_password: {
                required: true,
                minlength:6
            },
            password_confirmation: {
                required: true,
                equalTo : "#new_password"
            }
        },
        messages :{
            password : {
                required : 'Please enter current password.'
            },
            new_password : {
                required : 'Please enter new password.'
            },
            password_confirmation : {
                required : 'Confirm password.'
            }
        }
    });
});
</script>
@stop