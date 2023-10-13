@extends('layouts.main')
@section('content')
<link href="{{ asset('css/datatables.min.css') }}" rel="stylesheet">
<script src="{{ asset('js/datatables-buttons.min.css') }}"></script>
<script src="{{ asset('js/datatables.min.js') }}"></script>
<!-- <script src="{{ asset('js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('js/jszip.min.js') }}"></script>
<script src="{{ asset('js/pdfmake.min.js') }}"></script>
<script src="{{ asset('js/vfs_fonts.js') }}"></script>
<script src="{{ asset('js/buttons.html5.min.js') }}"></script> -->
<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<body>
	<div class="container">
		@include('layouts.nav')
		<form class="formcont">
			<div class="row justify-content-md-center">
				<div class="col-sm-12 col-md-12">
					<div class="row">
						<!-- <form id="searchData" method="get" action="{{url('home')}}">
							<div class="col-sm-12 col-md-4 form-group">
								<label for="exampleInputEmail1">Multi-Locations</label>
								<select name="location" onchange="this.form.submit()" class="form-control">
									<option value="">Select Location</option>
									@php if(isset($locations)){
										foreach($locations as $location){
									@endphp
										<option value="{{$location->id}}" @php if(Request::get('location') == $location->id){ echo 'selected';} @endphp>{{$location->name}}</option>
									@php } } @endphp
								</select>
							</div>
						</form> -->
						<!-- <div class="col-sm-12 col-md-4 form-group">
							<label for="exampleInputPassword1">Search</label>
							<input type="text" class="form-control" id="exampleInputPassword1" placeholder="Search">
						</div> -->
						<!-- <div class="col-sm-12 col-md-2 form-group col align-self-end"><button type="submit" class="btn btn-outline-primary col-sm-12">GO</button></div> -->
						<!-- <div class="col-sm-12 col-md-2 form-group col align-self-end"><button type="submit" class="btn btn-primary col-sm-12">Export To Excel</button></div> -->
					</div>
				</div>
			</div>
		</form>
		<div class="row">
			<div class="col-sm-12">
				<table class="table table-bordered table-striped {{ @count(@$data) > 0 ? 'display datatable' : '' }}">
				  <thead>
					<tr>
						<th scope="col">Location</th>
						<th scope="col">Identifier</th>
						<th scope="col">Manufacturer</th>
						<th scope="col">Equipment Type</th>
						<th scope="col">Model#</th>
						<th scope="col">Serial#</th>
						<th scope="col">Finished</th>
						<th scope="col">Certificate</th>
					</tr>
				  </thead>
				  <tbody>
				  
					@php if(@count(@$data) > 0){
						foreach($data as $row){
					@endphp
						<tr>
							<td>{{$row->callocation->name}}</td>
							<td>{{$row->identifier ? $row->identifier : 'N/A'}}</td>
							<td>{{$row->manufacturer}}</td>
							<td>{{$row->equipment_type}}</td>
							<td>{{$row->model}}</td>
							<td>{{$row->serial}}</td>
							<td>{{$row->finished_date}}</td>
							<td class="text-primary">
							@php	
							if(@$row->certificate){
									$url = Storage::disk('s3')->url("certificates/".$row->certificate);
									echo '<a target="_blank" href="'.$url.'">Received</a>';
							}else{
								echo 'Received';
							}
							@endphp
							</td>
						</tr>
					@php } } else { echo '<tr><td colspan="7">No data found!</td></tr>'; } @endphp
					</tr>
				  </tbody>
				</table>
                <div>
           	  To provide feedback on services you’ve acquire from us, please click <a href="/uploads/survey.pdf" target="new">here</a> for a short survey. 
              </div>
		</div>
	</div>
</body>
<script>
$(document).ready( function () {
    $('.datatable').DataTable({
		dom: 'Bfrtip',
        buttons: [
            'excelHtml5'
        ]
	});
} );
</script>
@stop