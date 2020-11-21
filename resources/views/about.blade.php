@extends('layouts.yeffd')

@section('title')
    About
@endsection

@section('content')

<!-- PAGE -->
<div class="nc-page min-vh-h100 w100 flex-cc animated s008" data-animIn="fadeIn|0" data-animOut="fadeOut|0">
	<div class="container">
		
		<!-- TITLE -->
		<div class="nc-titlewrapper align-c typo-light mr-b-60">
			<h1 class="nc-titlewrapper--tile fs50 f-1 txt-upper animated s008" data-animIn="fadeInUp|0.1" data-animOut="fadeOut|0.1">About</h1>
		</div><!-- / TITLE -->

		<!-- PAGE BODY -->
		<div class="nc-pagebody">
			
			<div class="flex-row gt60">
				<div class="flex-col-md-4" data-nc-sm="mr-b-40">
					<div class="nc-left animated s008" data-animIn="fadeInLeft|0.3" data-animOut="fadeOut|0.1">
						<img src="/images/yeffd-bg-7.jpg" alt="{{ config('app.name') }} - about us"> <br>

						<p class="fs20" style="color:#cccccc;">7 Scooops by the Ice Kream Klub is by Kids for Kids, just ask their 6-year-old CEO</p>

						<p class="fs16" style="color:#cccccc;"><a href="https://milwaukeecourieronline.com/index.php/2020/01/11/7-scooops-by-the-ice-kream-klub-is-by-kids-for-kids-just-ask-their-6-year-old-ceo/" target="_blank">Click here to read more...</a></p>
					
					</div>
				</div>
				<div class="fs22 f-2 op-08 bold-1 flex-col-md-8 typo-light">
					
					<p>Y.E.F.F.D. Foundation, Inc. is abbreviated to stand for The Young Entrepreneurs and Future Fashion Designers Inc. Our nonprofit organization or The Y.E.F.F.D. Foundation is a 12 week program in  a class room setting that will provide kids from the ages of 5-12 years of age with an outlet to imagine, create and ultimately bring their designs to life. We intend to spark their young minds and produce the next big "ENTREPRENEUR" and "FASHION DESIGNER" of the world.</p>

					<p>These tools will help them: </p>

					<div class="info-obj img-l g10 align-c mr-b-0 pd-tb-10 bdr-b bdr-op-light-1 txt-white animated s008" data-animIn="fadeInUp|0.5" data-animOut="fadeOut|0.1">
						<div class="img flex-cc fs18">
							<span class="iconwrp">
								<i class="pe-7s-angle-right-circle"></i>
							</span>
						</div>
						<div class="info align-l">
							<h5 class="bold-1 f-2 fs22 mr-b-0">Develop their vision</h5>
						</div>
					</div>

					<div class="info-obj img-l g10 align-c mr-b-0 pd-tb-10 bdr-b bdr-op-light-1 txt-white animated s008" data-animIn="fadeInUp|0.5" data-animOut="fadeOut|0.1">
						<div class="img flex-cc fs18">
							<span class="iconwrp">
								<i class="pe-7s-angle-right-circle"></i>
							</span>
						</div>
						<div class="info align-l">
							<h5 class="bold-1 f-2 fs22 mr-b-0">Create and develop designs</h5>
						</div>
					</div>

					<div class="info-obj img-l g10 align-c mr-b-0 pd-tb-10 bdr-b bdr-op-light-1 txt-white animated s008" data-animIn="fadeInUp|0.5" data-animOut="fadeOut|0.1">
						<div class="img flex-cc fs18">
							<span class="iconwrp">
								<i class="pe-7s-angle-right-circle"></i>
							</span>
						</div>
						<div class="info align-l">
							<h5 class="bold-1 f-2 fs22 mr-b-0">and Bring their designs to life with our professional manufacturing company.</h5>
						</div>
					</div>

				</div>
			</div>

		</div><!-- / PAGE BODY -->

	</div>
</div><!-- / PAGE -->

@endsection