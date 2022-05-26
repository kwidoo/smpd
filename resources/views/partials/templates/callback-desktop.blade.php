@csrf
<input type="hidden" name="version" value="desktop">
<div class="modal-header">
	<div class="d-flex flex-column">
		<h2>
			{{ __('messages.callme') }}
		</h2>
		<h4>
			{{ __('messages.callback')}}
		</h4>
	</div>
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>
<div class="modal-body">
	<div class="col-10 ml-auto mr-auto">
		<label for="name">{{ __('messages.your-name')}} </label>
		<div class="input-group">
			<div class="input-group-prepend input-group-lg">
				<span class="input-group-text"><i class="fa fa-user fa" aria-hidden="true"></i></span>
				</div>
			<input class="form-control @if ($errors->has('name')) is-invalid @endif" type="text" name="name" id="name" value="{{ old('name') }}" required>
		</div>
		@if ($errors->has('name'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
		<br>
		<label for="phone">{{ __('messages.your-phone')}} </label>
		<div class="input-group">
			<div class="input-group-prepend input-group-lg">
				<span class="input-group-text"><i class="fa fa-phone fa" aria-hidden="true"></i></span>
				</div>
				<input class="form-control @if ($errors->has('phone')) is-invalid @endif" type="text" name="phone" id="phone" value="{{ old('phone') }}" required>
		</div>
		@if ($errors->has('phone'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('phone') }}</strong>
            </span>
    	@endif
	</div>
</div>
<div class="modal-footer">
	<div class="d-flex flex-row w-100 justify-content-between">
		<div class="col">
			<button type="button" class="btn btn-lg btn-secondary" data-dismiss="modal">{{__('Закрыть')}} </button>
		</div>
		<div class="col text-right">
			<button type="submit" name="submit" class="btn btn-lg btn-primary">{{__('Отправить') }}</button>
		</div>
	</div>
</div>