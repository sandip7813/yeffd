@extends('layouts.yeffd')

@section('title')
    Donation
@endsection

@section('content')

<!-- PAGE -->
<div class="nc-page min-vh-h100 w100 flex-cc animated s008 pd-tb-small" data-animIn="fadeIn|0" data-animOut="fadeOut|0">
					
	<div class="container">
		
		<!-- TITLE -->
		<div class="nc-titlewrapper align-c typo-light mr-b-60">
			<h1 class="nc-titlewrapper--tile fs50 f-1 txt-upper animated s008" data-animIn="fadeInUp|0.1" data-animOut="fadeOut|0.1">Donate</h1>
		</div><!-- / TITLE -->

		<!-- PAGE BODY -->
		<div class="nc-pagebody">
			<div class="flex-row gt60 middle-md">
				
				<div class="flex-col-md-12 typo-light align-c">
					<div class="fs22 f-2 op-08 bold-1 animated s008" data-animIn="fadeIn|0.4" data-animOut="fadeOut|0.1">
						@if ($message = Session::get('success'))
							<p>{!! $message !!}</p>
							<?php Session::forget('success');?>
						@endif

						@if ($message = Session::get('error'))
							<p>{!! $message !!}</p>
							<?php Session::forget('error');?>
						@endif
					</div>
				</div>
				
				<!-- CONTACT INFO BOX -->
				<div class="flex-col-md-6" data-nc-sm="mr-b-40">
					
					<div class="info-obj mr-0 img-l middle-md g20 tiny typo-light animated s008 fs22 f-2 op-08 bold-1" data-animIn="fadeInUp|0.4" data-animOut="fadeOut|0.1">
						<p>Y.E.F.F.D. Foundation, Inc. or Young entrepreneurs and future fashion designers Inc. is a Section 501(c) (3) charitable organization, All donations are deemed tax-deductible absent any limitations on deductibility applicable to a particular taxpayer. No goods or services were provided in exchange for your contribution.</p>
					</div>

					<hr class="light mr-tb-20 animated s008" data-animIn="fadeInUp|0.4" data-animOut="fadeOut|0.1">

					<!-- CONTACT BOX -->
					<div class="info-obj mr-0 img-l middle-md g20 tiny typo-light animated s008" data-animIn="fadeInUp|0.3" data-animOut="fadeOut|0.1">
						<div class="img txt-primary"><span class="iconwrp"><i class="pe-7s-mail-open-file"></i></span></div>
						<div class="info">
							<h3 class="title mini mr-b-0 f-2 bold-1">y.e.f.f.d.fdn@gmail.com</h3>
						</div>
					</div><!-- / CONTACT BOX -->


				</div><!-- CONTACT INFO BOX -->
				
				<!-- DONATION FORM -->
				<div class="flex-col-md-6">
					<div class="nc-form-wrapper animated s008" data-animIn="fadeIn|0.4" data-animOut="fadeOut|0.1">

						@if (count($errors) > 0)
							<div class="alert alert-danger">
								There were some problems with your input.
								<ul>
									@foreach ($errors->all() as $error)
										<li>{{ $error }}</li>
									@endforeach
								</ul>
							</div>
						@endif
							
						<form action="{{ url('/paypal') }}" class="form-widget-inputicon" method="POST">
							{{ csrf_field() }}

							<div class="field-wrp">
								
								<div class="flex-row gt20 mb5">
									<div class="flex-col-md-6">
										<div class="form-group">
											<span class="form-widget--icon flex-cc txt-primary"><i class="ti-user"></i></span>
											<input class="form-control form-widget--form-control form-control-light" type="text" name="first_name" placeholder="First Name" value="{{ old('first_name') }}">
										</div>
									</div>
									<div class="flex-col-md-6">
										<div class="form-group">
											<span class="form-widget--icon flex-cc txt-primary"><i class="ti-user"></i></span>
											<input class="form-control form-widget--form-control form-control-light" type="text" name="last_name" placeholder="Last Name" value="{{ old('last_name') }}">
										</div>
									</div>
									<div class="flex-col-md-6">
										<div class="form-group">
											<span class="form-widget--icon flex-cc txt-primary"><i class="ti-email"></i></span>
											<input class="form-control form-widget--form-control form-control-light" type="email" name="email_id" placeholder="Email ID" value="{{ old('email_id') }}">
										</div>
									</div>

									<div class="flex-col-md-6">
										<div class="form-group">
											<span class="form-widget--icon flex-cc txt-primary"><i class="ti-mobile"></i></span>
											<input class="form-control form-widget--form-control form-control-light" type="phone" name="mobile_num" placeholder="Mobile" value="{{ old('mobile_num') }}">
										</div>
									</div>

									<div class="flex-col-md-12">
										<div class="form-group">
											<span class="form-widget--icon flex-cc txt-primary"><i class="ti-money"></i></span>

											<select name="donation_amount" class="form-control form-widget--form-control form-control-light">
												<option value="">Select Amount</option>

												@foreach($amount_array as $amt) 
													@if (old('donation_amount') == $amt)
														<option value="{{ $amt }}" selected>${{ $amt }}</option>
													@else
														<option value="{{ $amt }}">${{ $amt }}</option>
													@endif
												@endforeach

											</select>
										</div>
									</div>

									<div class="flex-col-md-12">
										<div class="form-group">
											<span class="form-widget--icon flex-cc txt-primary"><i class="ti-text"></i></span>
											<textarea class="form-control form-widget--form-control form-control-light" name="message" placeholder="Add your message" cols="30" rows="10"> {{ old('message') }}</textarea>
										</div>
									</div>
								</div>
								
							</div>
							<button type="submit" class="form-widget--btn w100 btn solid btn-primary">Proceed to PayPal</button>
						</form>	
						

					</div>
				</div><!-- / DONATION FORM -->

			</div>
		</div><!-- / PAGE BODY -->

	</div>
</div><!-- / PAGE -->

@endsection