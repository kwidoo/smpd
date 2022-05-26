<section role="prices" class="pl-sm-4 pr-sm-4 mt-1">
	<div  id="accordion" 
		class="d-flex flex-column pt-2 p-0 align-items-center">
	{{--}} Gets all published categories for website {{--}}
	@foreach (\App\Categories::where('published',1)->with('services.prices')->orderBy('order', 'ASC')->get() as $category)
			{{--}}Determines wether current category is root or has 0 parent {{--}}
         @if (count($category->parent()->where('published',1)->get()) == 0 || 
         	  in_array(0, $category->parent()->pluck('parent_id')->toArray())
         	  )
				<div class="d-flex col-12  flex-row mt-2 p-2 justify-content-between" 
						data-toggle="collapse" 
						data-target="#category-{{ $category->id }}" 
						aria-controls="service-{{ $category->id }}">
					<h4 class="pl-2 pt-2">{{ $category->{'name_'.App::getLocale()} }}</h4>
					<h4 class="pt-2"><i class="fa fa-chevron-left" aria-hidden="true"></i></h4>
				</div>

				<div class="col-12 p-2 collapse" id="category-{{ $category->id }}" data-parent="#accordion" role="open">
					<div class="d-flex flex-column mt-2 p-0 justify-content-between">
						 @foreach ($category->services()->where('published', 1)->orderBy('pivot_order', 'ASC')->get() as $service)
						 	<div class="d-flex flex-row justify-content-start-left pt-2 pl-4 pr-4 interlaced">
							 	@if (isset($id))
							 		<input type="checkbox" class="icheckbox_flat-green" name="services[]" value="{{$service->id }}"
							 			@if (in_array($id, $service->services()->pluck('services_id')->toArray()))
							 				 checked 
						 				@endif	
						 			/>&nbsp;							 	
						 		@endif
							 	<h5>{{ $service->code }}</h5>
							 	<h5 class="pl-2">{{ $service->{'name_'.App::getLocale()} }}</h5>
							 	<h5 class="ml-auto">
									@include('pricelist.price_field', ['service' => $service])
							 	</h5>
						 	</div>
						 @endforeach
					</div>
					{{--}} Determines if the category has children {{--}}
					@if (count($category->children()->where('published', 1)->get()) > 0)
						{{--}} Sorted by pivot table {{--}}
						@include('pricelist.subcat', [
								'parent' => $category->children()->where('published',1)->orderBy('pivot_order', 'ASC')->get(),
								'parent_id' => $category->id
							])
					@endif
				</div>
			@endif
		@endforeach
	</div>
</section>


  