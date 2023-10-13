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
								<form class="formcont" id="forgot" name="forgot" action="{{url('resetpassword')}}" method="post" enctype="multipart/form-data">
									<h4>Forgot password</h4>
									{!! csrf_field() !!}
									<h5>To recover your user and password information, please enter your email address and then press the recover button. If you have an account with us an email will be sent shortly.</h5>
								  	<div class="form-group">
										<label for="exampleInputEmail1">Email<span>*</span></label>
										<input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter email">
									</div>
										<div class="form-group row">
											<div class="col-md-6 col-sm-12 loginbtn"><button type="submit" class="btn btn-primary col-sm-12">Recover</button></div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-md-6 formlogo mx-auto"><img src="{{ asset('images/forgot.png') }}" alt="Logo"></div>
		</div>
	</div>
</body>
<script>
$(document).ready(function () {
    $('#forgot').validate({ 
        rules: {
            email: {
                required: true,
                email: true
            }
        },
        messages :{
            email : {
                required : 'Please enter email.'
            }
        }
    });
});
</script>
@stop