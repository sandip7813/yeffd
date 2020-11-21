@extends('layouts.yeffd')

@section('title')
    Event :: {{ $eventsArr->event_title }}
@endsection

@section('content')

<!-- PAGE -->

<div class="nc-page min-vh-h100 w100 flex-cc animated s008" data-animIn="fadeIn|0" data-animOut="fadeOut|0">
	<div class="container" data-nc-sm="w100">
		
		<!-- TITLE -->
		<div class="nc-titlewrapper align-c typo-light mr-b-60">
			<h1 class="nc-titlewrapper--tile fs50 f-1 txt-upper animated s008" data-animIn="fadeInUp|0.1" data-animOut="fadeOut|0.1">{{ $eventsArr->event_title }}</h1>

			<p class="nc-titlewrapper--subtitle fs22 f-2 bold-1 op-08 mr-auto w70 animated s008" data-animIn="fadeInUp|0.2" data-animOut="fadeOut|0.1" data-nc-md="w90 fs22" data-nc-sm="w100 fs20">
				{{ $eventsArr->event_date }}
			</p>
			
			<p class="nc-titlewrapper--subtitle fs22 f-2 bold-1 op-08 mr-auto w70 animated s008" data-animIn="fadeInUp|0.2" data-animOut="fadeOut|0.1" data-nc-md="w90 fs22" data-nc-sm="w100 fs20">
				{{ $eventsArr->event_description }}
			</p>
		</div><!-- / TITLE -->

		@if(isset($eventsArr->pictures))
		<!-- PAGE BODY -->
		<div class="nc-pagebody">
			
			<div class="swiper-gallery vh60">

				<!-- Large images -->
				<div class="swiper-container gallery-top">
					<div class="swiper-wrapper">

						@foreach ($eventsArr->pictures as $event_pics)
							<!-- Slide -->
							@if($event_pics->file_extn == 'mp4')
								<div class="swiper-slide" data-bg="/images/play-button.png">
									<video width="400" controls>
										<source src="/event_images/{{ $event_pics->mod_image }}" type="video/mp4">
										Your browser does not support HTML5 video.
									</video>
								</div>
							@else
								<div class="swiper-slide" data-bg="/event_images/{{ $event_pics->mod_image }}"></div>
							@endif

						@endforeach

					</div><!-- /.swiper-wrapper -->

					<!-- Navigation buttons -->
					<div class="swiper-button-prev"><i class="fa fa-angle-left"></i></div>
					<div class="swiper-button-next"><i class="fa fa-angle-right"></i></div>
				</div><!-- /Large images -->

				<!-- Thumb images -->
				<div class="swiper-container gallery-thumbs sm-hide">
					<div class="swiper-wrapper">
						@foreach ($eventsArr->pictures as $event_pics)
							<!-- Thumb image -->
							@if($event_pics->file_extn == 'mp4')
								<div class="swiper-slide" data-bg="/images/play-button.png"></div>
							@else
								<div class="swiper-slide" data-bg="/event_images/{{ $event_pics->mod_image }}"></div>
							@endif
							
						@endforeach
					</div><!-- /.swiper-wrapper -->
				</div><!-- /.Thumb images -->

			</div>

		</div><!-- / PAGE BODY -->
		@endif

	</div>
</div><!-- / PAGE -->

@endsection