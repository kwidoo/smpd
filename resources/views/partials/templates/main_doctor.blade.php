<div class="col-6 col-sm-3 col-lg-2 p-0 sortable" 
	data-toggle="collapse" 
	data-target="#doctor" 
	data-id="{{ $doctor->id}}" 
	aria-expanded="true" 
	aria-controls="doctor-{{ $doctor->id}}" 
	>
	<div class="d-flex flex-column align-items-center p-4 p-sm-2">
		<img src="/storage/{{ $doctor->avatar }}" 
			class="img-fluid" 
			alt="{{ $doctor->{'name_'.App::getLocale()} }}" 
 			data-gender="{{ $doctor->gender }}"
			/>
		<h4>
			{{ $doctor->{'name_'.App::getLocale()} }}
		</h4>
		<h5 class="text-lowercase text-center">
			{{ $doctor->{'small_'.App::getLocale()} }}
		</h5>
  	</div>
</div>