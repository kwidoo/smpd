@extends('layouts.frontend')

@section('title', __('messages.doctors'))

@section('content')

<section role="main" class="pl-sm-4 pr-sm-4 mt-1">
	@include('partials.doctor', ['doctor' => $doctor])
</section>
<script>
	const page="arsti"
</script>
@endsection

  