@csrf
<input type="hidden" name="version" value="mobile">
<div class="d-flex flex-column col-7 col-sm-5 ml-auto mr-auto mt-5 mb-5">
	<h2>
		{{ __('messages.callme') }}
	</h2>
	<h4>
		{{ __('messages.callback')}}
	</h4>
	<label for="name">{{ __('messages.your-name')}} </label>
	<div class="input-group">
		<div class="input-group-prepend input-group-lg">
			<span class="input-group-text"><i class="fa fa-user fa" aria-hidden="true"></i></span>
			</div>
		<input class="form-control" type="text" name="name" id="name" value="{{ old('name') }}" required>
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
			<input class="form-control" type="text" name="phone" id="phone" value="{{ old('phone') }}">
	</div>
	@if ($errors->has('phone'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('phone') }}</strong>
        </span>
	@endif	
	<div class="d-flex flex-row w-100 mt-3 justify-content-between">
		<div class="col p-0 text-right">
			<button type="submit" name="submit" class="btn btn-primary">{{__('Отправить') }}</button>
		</div>
	</div>		
</div>