@extends('layouts.frontend')

@section('title', __('messages.services'))

@section('content')

<section role="main" class="pl-sm-4 pr-sm-4 mt-1">
	<div id="accordeon" 
		 class="d-flex flex-row flex-wrap pt-2 p-0" 
		 @auth
			data-target="services.order"
		 @endauth
		>
		{{-- цель для загрузки--}}
		<div class="collapse ontop" id="service" data-parent="#accordeon" role="open">
		</div>
		@foreach (\App\Services::where('published','1')->orderBy('order','ASC')->get() as $service )
			@include('partials.templates.main_service', ['service' => $service])
		@endforeach    	
		
	</div>
</section>
<script>
	const page = "pakalpojumi";
</script>
@endsection


  