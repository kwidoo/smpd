<section role="footer">
	<div class="d-flex flex-row mt-2">
		<div class="col bg-green" style="height:3px">&nbsp;</div>
	</div>
	<ul class="list-group d-flex flex-row text-center text-green mt-4 align-items-stretch hovered">
		<li class="list-group-item border-0 col">
			<a href="tel:{{ Config('smpd.phone') }}">
				<h4 class="h-100 bd-green bd-radius-sm p-2">
					<div class="d-flex flex-column justify-content-center h-100">
						<p class="font-weight-bold m-0">{{__('messages.phone')}}</p>
						<p class="m-0">{{ Config('smpd.phone') }}</p>
					</div>
				</h4>
			</a>
		</li>
		<li class="list-group-item border-0 col">
			<h4 class="h-100 bd-green bd-radius-sm p-2">
				<a href="mailto:{{ Config('smpd.email') }}">
					<div class="d-flex flex-column justify-content-center h-100">
						<p class="font-weight-bold m-0">{{__('messages.email')}}</p>
						<p class="m-0">{{ Config('smpd.email') }}</p>
					</div>
				</a>
			</h4>
		</li>
		<li class="list-group-item border-0 col">
			<h4 class="h-100  bd-green bd-radius-sm p-2">
				<a href="maps://maps.google.com/?q={{ Config('smpd.address') }}">
					<div class="d-flex flex-column justify-content-center h-100">
						<p class="font-weight-bold m-0">{{__('messages.address')}}</p>
						<p class="m-0">{{ Config('smpd.address') }}</p>
					</div>
				</a>
			</h4>
		</li>
		<li class="list-group-item border-0 col">
			<h4 class="h-100 bd-green bd-radius-sm p-2">
				<div class="d-flex flex-column justify-content-center h-100">
					<p class="font-weight-bold m-0">{{__('messages.working-time')}}</p>
					<p class="m-0">{{__('messages.working-time-values')}} {{ Config('smpd.working-time') }}</p>
				</div>
			</h4>
		</li>
	</ul>
</section>