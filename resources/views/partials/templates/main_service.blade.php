<div class="col-6 col-sm-4 col-lg-3 p-0 sortable" 
	data-toggle="collapse" 
	data-target="#service" 
	data-id="{{ $service->id}}" 
	aria-expanded="true" 
	aria-controls="service-{{ $service->id}}" 

	
	>
	<div class="d-flex flex-column align-items-center p-4 p-sm-2">
		<img src="/storage/{{ $service->avatar }}" 
			class="img-fluid" 
			alt="{{ $service->{'name_'.App::getLocale()} }}"/>
		<h4>
			{{ $service->{'name_'.App::getLocale()} }}
		</h4>
		
  	</div>
</div>