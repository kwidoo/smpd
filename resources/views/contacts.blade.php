@extends('layouts.frontend')

@section('title', 'Pakalpojumi')

@section('content')

<section role="contacts" class="pl-sm-4 pr-sm-4 mt-1">
	 <div class="d-flex flex-column mt-5">
	 	<div class="col-12 col-sm-8 col-md-6 ml-auto mr-auto">
	 		<div class="mt-4 mb-4 pt-2 pb-2">ATGRIEZENISKĀS SAITES FORMA</div>
		 	<div class="form-group">
		 		<label for="name">Vārds<span>*</span></label>
		 		<input type="text" class="form-control" id="name" name="name">
		 		@if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
		 	</div>
		 	<div class="form-group">
		 		<label for="email">Epasts<span>*</span></label>
		 		<input type="email" class="form-control" id="email" name="email">
		 		@if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif		 	
            </div>
		 	<div class="form-group">
		 		<label for="phone">Tālrunis<span>*</span></label>
		 		<input type="text" class="form-control" id="phone" name="phone">
		 		@if ($errors->has('phone'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('phone') }}</strong>
                    </span>
                @endif
		 	</div>
		 	<div class="form-group">
		 		<label for="message">Paziņojums<span>*</span></label>
		 		<textarea class="form-control" id="message" name="message" rows="8"></textarea>
		 		@if ($errors->has('message'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('message') }}</strong>
                    </span>
                @endif
		 	</div>
		 	<div class="col text-right mb-5">
				<button type="button" name="submit" class="btn btn-lg btn-primary">{{__('Отправить') }}</button>
			</div>
		</div>
	 	<div class="d-flex flex-row flex-wrap mt-5">
	 		<div class="d-flex flex-row w-100">
		 		<div class="col-6 ml-auto mr-auto">
				 	<h3>Mūsu rekvizīti</h3>
				 	<h5>SMP Doktorāts SIA</h5>
					<h5>Ārstniecības iestādes kods 010001557</h5>
					<h5>Vienotais reģ. Nr. 40003736608</h5>
					<h5>PVN maks. Nr. LV40003736608</h5>
					<h3 class="mt-3">Pieejamība</h3>
					<h5>Iestādē ir nodrošināta vides pieejamība personām ar funkcionāliem traucējumiem.</h5>
				</div>
			</div>
			<div class="col-12 col-sm-8 ml-auto mr-auto mt-5">
				<h4>Karte:</h4>
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2175.628908536014!2d24.122995315428238!3d56.95515890608622!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46eecfcd01ec151f%3A0x446f1374d0c3a45!2sSMP+Doktorats!5e0!3m2!1sru!2slv!4v1476350217658" width="100%" height="410" frameborder="0" style="border:0" allowfullscreen=""></iframe>
			</div>
		</div>
	 </div>
</section>
<script>
	const page = "contacts";
</script>
@endsection


  