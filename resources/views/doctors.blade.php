@extends('layouts.frontend')

@section('title', __('messages.doctors'))

@section('content')

<section role="main" class="pl-sm-4 pr-sm-4 mt-1">
	<div id="accordeon" 
		 class="d-flex flex-row flex-wrap pt-2 p-0" 
		 @auth
			data-target="doctors.order"
		 @endauth
		>
		{{-- цель для загрузки--}}
		<div class="collapse ontop" id="doctor" data-parent="#accordeon" role="open">
		</div>
		@foreach ( \App\Doctors::where('published','1')->orderBy('order','ASC')->get() as $doctor )
			@include('partials.templates.main_doctor', ['doctor' => $doctor])
		@endforeach
	</div>
</section>
<script>
	const page="arsti"
</script>
@endsection

  