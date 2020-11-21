@extends('layouts.yeffd')

@section('title')
    Events
@endsection

@section('content')

<!-- PAGE -->
<div class="nc-page min-vh-h100 w100 flex-cc animated s008" data-animIn="fadeIn|0" data-animOut="fadeOut|0">
	<div class="container">
		
		<!-- TITLE -->
		<div class="nc-titlewrapper align-c typo-light mr-b-60">
			<h1 class="nc-titlewrapper--tile fs50 f-1 txt-upper animated s008" data-animIn="fadeInUp|0.1" data-animOut="fadeOut|0.1">Events</h1>
		</div><!-- / TITLE -->

		<!-- PAGE BODY -->
		<div class="nc-pagebody">
			<div class="flex-row gt0">
				
				@if(isset($eventsArr))
					@foreach ($eventsArr as $event)
						<div class="flex-col-md-4 typo-light">
							<div class="animated s008" data-animIn="fadeInLeft|0.3" data-animOut="fadeOut|0.1">
								<a href="./event/{{ $event->event_slug }}">
									@if( $event->dp_pictures->file_extn == 'mp4' )
										<p><img src="/images/play-button.png" alt="image" style="height:350px; width:100%;"></p>
									@else
										<p><img src="/event_images/{{ $event->dp_pictures->mod_image }}" alt="image" style="height:350px; width:100%;"></p>
									@endif
								</a>
								
								<h3 class="fs22 f-2 op-08 bold-1 animated s008 fadeIn"><a href="./event/{{ $event->event_slug }}">{{ $event->event_title }}</a></h3>
							</div>
						</div>
					@endforeach
				@endif

			</div>

		</div><!-- / PAGE BODY -->

	</div>
</div><!-- / PAGE -->

@endsection