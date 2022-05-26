{{--}}
	TODO: add different types of discounts
{{--}}
@if ($service->prices()->exists())
@if ($service->prices()->where('type', 0)->first() !== null)
	@if ($service->prices()->where('type', 0)->first()->value_from > 0)
		@if ($service->prices()->where('type', 0)->first()->discounts()->first() !== NULL)
			no <strike>{{ number_format($service->prices()->where('type', 0)->first()->value_from,2) }}</strike>
			{{ number_format($service->prices()->where('type', 0)->first()->discounts()->first()->value, 2) }} EUR
		@else
			no {{ number_format($service->prices()->where('type', 0)->first()->value_from,2) }} EUR
		@endif
	@else
		@if ($service->prices()->where('type', 0)->first()->discounts()->first() !== NULL)
			<strike>{{ number_format($service->prices()->where('type', 0)->first()->value,2) }}</strike>
			{{ number_format($service->prices()->where('type', 0)->first()->discounts()->first()->value, 2) }} EUR
		@else
			{{ number_format($service->prices()->where('type', 0)->first()->value,2) }} EUR	
		@endif
	@endif
@else
{{ info($service->id) }}
@endif
@endif
