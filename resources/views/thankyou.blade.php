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
								Thank you for signing up. Your account is currently under review.
								Once approved you will receive an email with instuctions on how to login.
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-md-6 formlogo mx-auto"><img src="images/big-logo.png" alt="Logo"></div>
		</div>
	</div>
</body>
@stop