@foreach ($parent as $category)
	<div class="d-flex col-12 flex-row mt-2 ml-auto mr-auto p-2 justify-content-between" 
			data-toggle="collapse" 
			data-target="#category-{{ $category->id }}" 
			aria-controls="category-{{$loop->index+1}}">

		<h4 class="pl-2 pt-2">{{ $category->{'name_'.App::getLocale()} }}</h4>
		<h4 class="pt-2"><i class="fa fa-chevron-left" aria-hidden="true"></i></h4>
	</div>
	<div class="col-12 ml-auto mr-auto p-0 collapse" id="category-{{ $category->id }}" data-parent="#category-{{ $category->parent()->where('published', 1)->first()->id }}" role="open">
		<div class="d-flex flex-column mt-2 p-0 justify-content-between">
			 @foreach ($category->services()->get() as $service)
			 	<div class="d-flex flex-row justify-content-start-left pt-2 pl-4 pr-4 interlaced"> 
						@if (isset($id))
					 		<input type="checkbox" class="icheckbox_flat-green" name="services[]" value="{{$service->id }}"
					 			@if (in_array($id, $service->services()->pluck('services_id')->toArray()))
					 				 checked 
				 				@endif	
				 			/>&nbsp;							 	
				 		@endif				 	<h5>{{ $service->code }}</h5>
				 	<h5 class="pl-2">{{ $service->{'name_'.App::getLocale()} }}</h5>
				 	<h5 class="ml-auto">
				 		@if ($service->prices()->where('type', 0)->first()->value_from > 0)
				 			no {{ number_format($service->prices()->where('type', 0)->first()->value_from, 2) }} EUR
				 		@else
				 			{{ number_format($service->prices()->where('type', 0)->first()->value, 2) }} EUR
				 		@endif
 					</h5>
			 	</div>
			 @endforeach
		</div>
	</div>
	@if (count($category->children()->where('published',1)->get()) > 0)
        @include('categories', ['parent' => $category->children()->where('published',1)->get()])
    @endif
@endforeach
	

  