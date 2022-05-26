<section role="prices" class="pl-sm-4 pr-sm-4 mt-1">
	<div id="accordion" class="d-flex flex-column pt-2 p-0 align-items-center">
		@foreach (\App\Categories::where('published',1)->get() as $category)
            @if (count($category->parent()->where('published',1)->get()) == 0)
				<div class="d-flex col-12  flex-row mt-2 p-2 justify-content-between" 
						data-toggle="collapse" 
						data-target="#category-{{ $category->id }}" 
						{{-- data-id="{{ $service->id}}" aria-expanded="true" --}}
						aria-controls="service-{{ $category->id }}">

					<h4 class="pl-2 pt-2">{{ $category->{'name_'.App::getLocale()} }}</h4>
					<h4 class="pt-2"><i class="fa fa-chevron-left" aria-hidden="true"></i></h4>
				</div>
				<div class="col-12 p-2 collapse" id="category-{{ $category->id }}" data-parent="#accordion" role="open">
					<div class="d-flex flex-column mt-2 p-0 justify-content-between">
						 @foreach ($category->services()->where('published',1)->get() as $service)
						 	<div class="d-flex flex-row justify-content-start-left pt-2 pl-4 pr-4 interlaced">
							 	<h5>{{ $service->code }}</h5>
							 	<h5 class="pl-2">{{ $service->{'name_'.App::getLocale()} }}</h5>
							 	<h5 class="ml-auto">
							 		@if ($service->prices()->first()->value_from)
										 no {{ number_format($service->prices()->first()->value_from,2) }} EUR
										 333
									 @else
									 123
 							 			{{ number_format($service->prices()->first()->value,2) }} EUR
									  @endif
									  112
							 	</h5>
						 	</div>
						 @endforeach
					</div>
					@if (count($category->children()->where('published',1)->get()) > 0)
	                   @include('partials.categories', ['parent' => $category->children()->where('published',1)->get()]) 
	                @endif
				</div>
			@endif
		@endforeach
	</div>
</section>


  