<!DOCTYPE html>

<html lang="en">

<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>

		{{ config('app.name') }} - Admin - @yield('title')

    </title>

	<link type="text/css" href="/admin/bootstrap/css/bootstrap.min.css" rel="stylesheet">

	<link type="text/css" href="/admin/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">

	<link type="text/css" href="/admin/css/theme.css" rel="stylesheet">

	<link type="text/css" href="/admin/images/icons/css/font-awesome.css" rel="stylesheet">

	<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>



  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />

</head>

<body>



	<div class="navbar navbar-fixed-top">

		<div class="navbar-inner">

			<div class="container">

				<a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">

					<i class="icon-reorder shaded"></i>

				</a>



			  	<a class="brand" href="#">

				  {{ config('app.name') }}

			  	</a>



				<div class="nav-collapse collapse navbar-inverse-collapse">



					<ul class="nav pull-right">

						<li class="nav-user dropdown">

							<a href="#" class="dropdown-toggle" data-toggle="dropdown">

								<img src="/admin/images/user.png" class="nav-avatar" />

								<b class="caret"></b>

							</a>

							<ul class="dropdown-menu">

								<li class="divider"></li>

								<li>

									<a href="{{ route('logout') }}" 

									onclick="event.preventDefault(); document.getElementById('logout-form').submit();">

										{{ __('Logout') }}

									</a>

								</li>

							</ul>

						</li>

					</ul>

				</div><!-- /.nav-collapse -->

			</div>

		</div><!-- /navbar-inner -->

	</div><!-- /navbar -->



	<div class="wrapper">

		<div class="container">

			<div class="row">

				<div class="span3">

					<div class="sidebar">



						<ul class="widget widget-menu unstyled">

							<li class="active">

								<a href="{{ url('/admin/dashboard') }}">

									<i class="menu-icon icon-dashboard"></i>

									Dashboard

								</a>

							</li>



							<li>

								<a class="collapsed" data-toggle="collapse" href="#toggleEvents">

									<i class="menu-icon icon-group"></i>

									<i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right"></i>

									Events

								</a>

								<ul id="toggleEvents" class="collapse unstyled">

									<li>

										<a href="{{ route('admin.events.index') }}">

											<i class="icon-eye-open"></i>

											View Events

										</a>

									</li>

									<li>

										<a href="{{ route('admin.events.create') }}">

											<i class="icon-plus"></i>

											Add Event

										</a>

									</li>

								</ul>

							</li>



							<li>

								<a class="collapsed" data-toggle="collapse" href="#toggleSuccessStories">

									<i class="menu-icon icon-bullhorn"></i>

									<i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right"></i>

									Success Stories

								</a>

								<ul id="toggleSuccessStories" class="collapse unstyled">

									<li>

										<a href="{{ route('admin.success-stories.index') }}">

											<i class="icon-eye-open"></i>

											View Success Stories

										</a>

									</li>

									<li>

										<a href="{{ route('admin.success-stories.create') }}">

											<i class="icon-plus"></i>

											Add Success Story

										</a>

									</li>

								</ul>

							</li>



							<li class="active">

								<a href="{{ route('admin.donations') }}">

									<i class="menu-icon icon-money"></i>

									Donations

								</a>

							</li>



							<li>

								<a href="{{ route('logout') }}" 

								onclick="event.preventDefault(); document.getElementById('logout-form').submit();">

									<i class="menu-icon icon-signout"></i>

									{{ __('Logout') }}

								</a>

							</li>



						</ul><!--/.widget-nav-->



					</div><!--/.sidebar-->

				</div><!--/.span3-->



				<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">

					{{ csrf_field() }}

				</form>





				<div class="span9">

					<div class="content">



						@yield('content')

						

					</div><!--/.content-->

				</div><!--/.span9-->

			</div>

		</div><!--/.container-->

	</div><!--/.wrapper-->



	<div class="footer">

		<div class="container">

			 



			<b class="copyright">&copy; {{ date('Y') }} {{ config('app.name') }} </b> All rights reserved.

		</div>

	</div>



	<script src="/admin/scripts/jquery-1.9.1.min.js"></script>

	<script src="/admin/scripts/jquery-ui-1.10.1.custom.min.js"></script>

	<script src="/admin/bootstrap/js/bootstrap.min.js"></script>

	<script src="/admin/scripts/datatables/jquery.dataTables.js"></script>



	

	<script>

		$(document).ready(function() {

			$('.datatable-1').dataTable();

			$('.dataTables_paginate').addClass("btn-group datatable-pagination");

			$('.dataTables_paginate > a').wrapInner('<span />');

			$('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');

			$('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');



			$('[data-toggle="tooltip"]').tooltip();



			

		});

	</script>



	@stack('scripts')

</body>