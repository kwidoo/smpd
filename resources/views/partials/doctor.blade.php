<section role="description">
	<div class="col-12 pt-4" 
		data-toggle="collapse" 
		data-target="#doctor-{{ $doctor->id}}" 
		data-id="{{ $doctor->id}}" 
		aria-expanded="true" 
		aria-controls="doctor-{{ $doctor->id}}">
		<div class="d-flex flex-row align-items-md-start pl-4">
			<div class="d-flex flex-column col-4">
				<img src="{{ '/storage/'.($doctor->image ?? $doctor->avatar) }}" 
					class="img w-100" alt="{{ $doctor->{'name_'.App::getLocale()} }}"  
					data-gender="{{ $doctor->gender }}"
				/>
				<div class="text-white p-0 p-sm-2 ">
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
						<p>Pēc iepriekšēja pieraksta</p>
					</div>
				</div>
			</div>
			<div class="d-flex flex-column">
				<h4>
					{{ $doctor->{'name_'.App::getLocale()} }}
				</h4>
				<h5>
					{{ $doctor->{'title_'.App::getLocale()} }}
				</h5>
				<div class="d-flex flex-column col-8" >
						{!! $doctor->{'text_'.App::getLocale()} !!}
				</div>
			</div>
      	</div>
	</div>
</section>

