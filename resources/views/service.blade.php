@extends('layouts.frontend')

@section('title', __('messages.services'))

@section('content')

<section role="main" class="pl-sm-4 pr-sm-4 mt-1">
	@include('partials.service', ['service' => $service])
</section>
<script>
	const page="pakalpojumi"
</script>
@endsection

  