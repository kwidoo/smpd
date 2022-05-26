<section role="description">
	<div class="col-12 pt-4" 
		data-toggle="collapse" 
		data-target="#service-{{ $service->id}}" 
		data-id="{{ $service->id}}" 
		
		aria-expanded="true" 
		aria-controls="service-{{ $service->id}}">
		@auth
		<div class="d-flex flex-column align-items-md-end pl-4">
			<button type="button" class="close pull-right" data-dismiss="collapse" aria-label="Close">
          		<span aria-hidden="true">&times;</span>
        	</button>
        </div>
        @endauth
		<div class="d-flex flex-column align-items-md-start pl-4">
			<img src="/storage/{{ $service->image ?? $service->avatar }}" 
				 class="img-fluid w-30" alt="{{ $service->{'name_'.App::getLocale()} }}" 
			/>
			<h4>
				{{ $service->{'name_'.App::getLocale()} }}
			</h4>
      	</div>
	</div>
	<div class="d-flex flex-column mt-4 pl-4 pr-4">
		<div class="d-flex flex-row">
			<div class="d-flex flex-column col-8" 
				@auth
					data-service="notebook" 				
					data-target="services.text_{{ App::getLocale() }}" 
					data-id="{{ $service->id }}"
				@endauth	
			>
				{!! $service->{'text_'.App::getLocale()} !!}
			</div>
			<div class="col-4 text-white p-0 p-sm-2 ">
				<div class="p-sm-4 p-3 common" >
					<p>{{__('messages.register-phone')}}</p>
					<p>
						<a href="tel:{{ Config('smpd.phone') }}">
							<i class="fa fa-phone" aria-hidden="true"></i>
							{{ Config('smpd.phone') }}
						</a>
					</p>
					<p>
						<a href="maps://maps.google.com/?q={{ Config('smpd.address') }}">
							<i class="fa fa-home" aria-hidden="true"></i>
							{{ Config('smpd.address') }}
						</a>
					</p>
					<p>{{__('messages.working-time')}}:</p>
					<p>{{__('messages.working-time-values')}} {{ $service->time }} </p>
				</div>
			</div>
		</div>
		<section role="price">
			@if (count($service->services2()->get()) > 0 || Auth::check())
				<div class="col-12 col-sm-9 col-md-10 col-lg-8 col-xl-7 ml-auto mr-auto mt-4">
					<ul class="d-flex flex-column p-0" >
						@foreach ($service->services2()->orderBy('pivot_order', 'ASC')->get() as $service2)
							<li class="d-flex flex-row">
								<div class="col-8" 
									data-service="editable" 
									data-type="text"
									data-id="{{ $service2->pivot->id}}" 
									data-mode="popup" 
									data-target="servicesPivot.name_{{ App::getLocale() }}"					
									>
									

									@if ($service2->pivot->{'name_'.App::getLocale()} !== NULL)
										{{ $service2->pivot->{'name_'.App::getLocale()} }}
									@else
										{{ $service2->{'name_'.App::getLocale()} }}
									@endif
								</div>
								<div class="col-4 text-right">
									@include('pricelist.price_field', ['service' => $service2])
								</div>
							</li >
						@endforeach
						<li class="d-flex flex-row justify-content-end mt-4 ">
							<a href="{{ route('prices') }}" class="btn btn-primary btn-lg p-3 pl-5 pr-5 mr-2 text-uppercase">{{ __('messages.all-prices')}} </a>
						</li>
					</ul>
				</div>
			@endif
		</section>
		@if (count($service->doctors()->get()) > 0) 
			<h4 class="mt-4" 
				@auth
					data-service="editable" 				
					data-type="text" 
					data-target="services.doctors_{{ App::getLocale() }}" 
					data-id="{{ $service->id }}
				@endauth
			">
				{{ $service->{'doctors_'.App::getLocale()} }}
			</h4>
		@endif		
		<div class="d-flex flex-row mb-3 doctors">
			@foreach ($service->doctors()->orderBy('pivot_order', 'ASC')->get() as $doctor)
				<a href="{{ route('doctors', ['id' => $doctor->id]) }}" class="col-4 col-lg-2 pt-2 pl-4">
					<img src="/storage/{{ $doctor->avatar }}" class="img-fluid" alt="{{ $doctor->{'name_'.App::getLocale()} }}" data-gender="{{ $doctor->gender }}"/>
					<h4 class="mb-0 text-center">
						{{ $doctor->{'name_'.App::getLocale()} }}
					</h4>
					<h5 class="text-center text-lowercase">
						{{ $doctor->{'small_'.App::getLocale()} }}	
					</h5>
				</a>
			@endforeach
		</div>
	</div>
</section>
