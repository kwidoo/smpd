@foreach ($parent as $category)
	<div class="d-flex col-12 flex-row mt-2 ml-auto mr-auto p-2 justify-content-between" 
			data-toggle="collapse" 
			data-target="#sub_category-{{ $category->id }}" 
			aria-controls="category-{{ $category->id }}">
		<h4 class="pl-2 pt-2">
			{{ $category->{'name_'.App::getLocale()} }}
		</h4>
		<h4 class="pt-2">
			<i class="fa fa-chevron-left" aria-hidden="true"></i>
		</h4>
	</div>
	<div class="col-12 ml-auto mr-auto p-0 collapse" 
			id="sub_category-{{ $category->id }}" 
			data-parent="#category-{{ $parent_id }}" 
			role="open">
		<div class="d-flex flex-column mt-2 p-0 justify-content-between">
			 @foreach ($category->services()->where('published', 1)->orderBy('pivot_order', 'ASC')->get() as $service)
			 	<div class="d-flex flex-row justify-content-start-left pt-2 pl-4 pr-4 interlaced"> 
				 	<h5>{{ $service->code }}</h5>
				 	<h5 class="pl-2">{{ $service->{'name_'.App::getLocale()} }}</h5>
				 	<h5 class="ml-auto">
				 		@include('pricelist.price_field', ['service' => $service])
 					</h5>
			 	</div>
			 @endforeach
		</div>
	</div>
	{{--}} Determines if the category has children {{--}}
	@if (count($category->children()->where('published', 1)->get()) > 0)
		{{--}} Sorted by pivot table {{--}}
		@include('pricelist.subcat', [
				'parent' => $category->children()->where('published',1)->orderBy('pivot_order', 'ASC')->get(),
				'parent_id' => $category->id
			])
	@endif
	
@endforeach
	

  