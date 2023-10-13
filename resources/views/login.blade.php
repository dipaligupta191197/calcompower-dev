@extends('layouts.main')
@section('content')
<body class="loginpage">
	<div class="container h-100">
		@include('layouts.nav')
		<div class="row align-items-center h-100">
			<div class="col-sm-12 col-md-6 mx-auto">
				<div class="row justify-content-md-center">
					<div class="col-sm-12 col-md-8">
						<div class="row">
							<div class="col-sm-12">
								@include('layouts.error')
								<form class="formcont" id="login" name="login" action="{{url('signin')}}" method="post" enctype="multipart/form-data">
								 <h4>Login to your account</h4>
								 {!! csrf_field() !!}
								  <div class="form-group">
									<label for="exampleInputEmail1">Email<span>*</span></label>
									<input type="text" class="form-control" name="email" id="email" placeholder="Email">
								  </div>
								  <div class="form-group">
									<label for="exampleInputPassword1">Password<span>*</span></label>
									<input type="password" class="form-control" name="password" id="password" placeholder="Password">
								  </div>
								  <div class="form-group">
									  <a href="{{url('forgot')}}" title="Forgot Password?">Forgot Password?</a>
								  </div>
									<div class="form-group row">
										<div class="col-md-6 col-sm-12 loginbtn"><button type="submit" class="btn btn-primary col-sm-12">Login</button></div>
										<div class="col-md-6 col-sm-12"><a href="{{url('signup')}}" class="btn btn-outline-primary col-sm-12">Register</a></div>
								  </div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-md-6 formlogo mx-auto"><img src="images/big-logo.png" alt="Logo"></div>
		</div>
	</div>
</body>
<script>
$(document).ready(function () {
    $('#login').validate({ 
        rules: {
            email: {
                required: true,
				email:true
            },
            password: {
                required: true,
                minlength:6
            }
        },
        messages :{
            email : {
                required : 'Please enter email.'
            },
            password : {
                required : 'Please enter password.'
            }
        }
    });
});
</script>
@stop