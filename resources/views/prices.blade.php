@extends('layouts.frontend')

@section('title', __('messages.services'))

@section('content')

<div class="d-flex flex-row justify-content-center">
	<div class="col-11 col-md-10">
		@include('partials.prices')
	</div>
</div>
<script>
	const page = "cenas";
</script>
@endsection


  