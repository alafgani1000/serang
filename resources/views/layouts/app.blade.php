<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>{{ config('app.name', 'Laravel') }}</title>

		<meta name="description" content="Static &amp; Dynamic Tables" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
		<link rel="stylesheet" href="{{ asset('assets/font-awesome/4.5.0/css/font-awesome.min.css') }}" />

		<!-- css data tables -->
		<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery.dataTables.css') }}">
		<!-- text fonts -->
		<link rel="stylesheet" href="{{ asset('assets/css/fonts.googleapis.com.css') }}" />

		<!-- ace styles -->
		<link rel="stylesheet" href="{{ asset('assets/css/ace.min.css') }}" class="ace-main-stylesheet" id="main-ace-style" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="{{ asset('assets/css/ace-part2.min.css') }}" class="ace-main-stylesheet" />
		<![endif]-->
		<link rel="stylesheet" href="{{ asset('assets/css/ace-skins.min.css') }}" />
		<link rel="stylesheet" href="{{ asset('assets/css/ace-rtl.min.css') }}" />

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="{{ asset('assets/css/ace-ie.min.css') }}" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->
		<script src="{{ asset('assets/js/ace-extra.min.js') }}"></script>

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="{{ asset('assets/js/html5shiv.min.js') }}"></script>
		<script src="{{ asset('assets/js/respond.min.js') }}"></script>
		<![endif]-->
		
		<!-------------------------------awal dari color box------------------------------------>				
		<link rel="stylesheet" href="{{ asset('javascript/colorbox/colorbox.css') }}" />
		<script src="{{ asset('javascript/colorbox/jquery.min.js') }}"></script>
		<script src="{{ asset('javascript/colorbox/jquery.colorbox.js') }}"></script>
		
		<script>
			$(document).ready(function(){
				//$(".iframe").colorbox({iframe:true, width:"80%", height:"80%"});
				$(".popup").colorbox({
					iframe:true, 
					width:"80%", 
					height:"80%",
					transition:'none',
					title: "Preview Data"
				});
				
				$("#notif").html();
			});
		</script>
		<!-------------------------------akhir dari color box------------------------------------>
		
		<link rel="stylesheet" href="{{ asset('javascript/datepicker/jquery-ui.css') }}">
		<script src="{{ asset('javascript/datepicker/jquery-ui.js') }}"></script>
		<script>
			$(function() {
				$(".tanggal").datepicker({
					changeMonth: true,
					changeYear: true
				});
			});
		</script>
		
		<style>
			.slidingDiv {
				background-color: #99CCFF;
			}

			.show_hide {
				display:none;
			}

			.kodokijo { margin: auto; }
			.kodokijo .content-form { display: none; }
			.kodokijo .content-view { display: none; }
			.close-form { float: right; margin-right: 5px; cursor: pointer; }

			.scroll{
				width: 100%;
				padding: 0px;
				overflow: auto;
				height: 100%;
				border:0px 0 0" 
				
				/*script tambahan khusus untuk IE */
				scrollbar-face-color: #CE7E00; 
				scrollbar-shadow-color: #FFFFFF; 
				scrollbar-highlight-color: #6F4709; 
				scrollbar-3dlight-color: #11111; 
				scrollbar-darkshadow-color: #6F4709; 
				scrollbar-track-color: #FFE8C1; 
				scrollbar-arrow-color: #6F4709;
			}
		</style>
	</head>
	@if(Auth::user())
		<body class="no-skin">
			<div id="navbar" class="navbar navbar-default  ace-save-state">
				<div class="navbar-container ace-save-state" id="navbar-container">
					<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
						<span class="sr-only">Toggle sidebar</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>

					<div class="navbar-header pull-left">
						
						<a href="index.html" class="navbar-brand">
							<small>
								MONITORING HELPDESK
							</small>
						</a>
					</div>

					<div class="navbar-buttons navbar-header pull-right" role="navigation">
						<ul class="nav ace-nav">
							
							<li class="purple dropdown-modal">
								<a data-toggle="dropdown" class="dropdown-toggle" href="#">
									<i class="ace-icon fa fa-envelope icon-animated-vertical"></i>
									<span class="badge badge-success">{{Auth::user()->unreadNotifications->count()}}</span>
								</a>

								<ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
									<li class="dropdown-header">
										<i class="ace-icon fa fa-envelope-o"></i>
										{{Auth::user()->unreadNotifications->count()}} Messages
									</li>
									<li class="dropdown-content">
										<ul class="dropdown-menu dropdown-navbar">
											@foreach (Auth::user()->notifications as $notification)
												@if($notification->type == "App\Notifications\RequestCreated")
													<a href="{{ route('requests.approveshow', $unreadNotifications->data['id']) }}" class="clearfix">
														<img src="{{url('assets/images/avatars/avatar.png')}}" class="msg-photo" alt="Alex's Avatar" />
														<span class="msg-body">
															<span class="msg-title">
																	<span class="blue">{{ $notification->data['stage_id'] }} : </span>
																	<span class="blue">{{ $notification->data['business_benefit'] }} </span>
															</span>	
															<span class="msg-time">
																<i class="ace-icon fa fa-clock-o"></i>
																<span>Request</span>
															</span>
														</span>
													</a>
												@else
													<a 
														@if($notification->data['stage_id'] == 3) 
															href="{{ route('incidents.ticketshow', $notification->data['id']) }}" 
														@elseif($notification->data['stage_id'] == 4)
															href="{{ route('incidents.show', $notification->data['id']) }}"
														@endif
													class="clearfix">
														<img src="{{url('assets/images/avatars/avatar.png')}}" class="msg-photo" alt="Alex's Avatar" />
														<span class="msg-body">
															<span class="msg-title">
																	<span class="blue">{{ $notification->data['stage_id'] }} : </span>
																	<span class="blue">{{ $notification->data['description'] }} </span>
															</span>
															
															<span class="msg-time">
																<i class="ace-icon fa fa-clock-o"></i>
																<span>Incident</span>
															</span>
														</span>
													</a>
												@endif
											@endforeach											
										</ul>
									</li>
								</ul>
							</li>
							<li class="light-blue dropdown-modal">
								<a data-toggle="dropdown" href="#" class="dropdown-toggle">
									<img class="nav-user-photo" src="{{url('assets/images/avatars/user.jpg')}}" alt="Jasons Photo" />
									<span class="user-info">
										<small>Welcome,</small>
										<b>{{ Auth::user()->name }}</b>
									</span>
				
									<i class="ace-icon fa fa-caret-down"></i>
								</a>
				
								<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
									<li>

										<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
											{{ __('Logout') }}
										</a>

										<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
											@csrf
										</form>

									</li>
								</ul>
							</li>
						</ul>
					</div>
				</div><!-- /.navbar-container -->
			</div>

			<div class="main-container ace-save-state" id="main-container">
				<script type="text/javascript">
					try{ace.settings.loadState('main-container')}catch(e){}
				</script>

				<div id="sidebar" class="sidebar responsive ace-save-state">
					<script type="text/javascript">
						try{ace.settings.loadState('sidebar')}catch(e){}
					</script>

					<div class="sidebar-shortcuts" id="sidebar-shortcuts">
						<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
							<button class="btn btn-success">
								<i class="ace-icon fa fa-signal"></i>
							</button>

							<button class="btn btn-info">
								<i class="ace-icon fa fa-pencil"></i>
							</button>

							<button class="btn btn-warning">
								<i class="ace-icon fa fa-users"></i>
							</button>

							<button class="btn btn-danger">
								<i class="ace-icon fa fa-cogs"></i>
							</button>
						</div>

						<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
							<span class="btn btn-success"></span>

							<span class="btn btn-info"></span>

							<span class="btn btn-warning"></span>

							<span class="btn btn-danger"></span>
						</div>
					</div><!-- /.sidebar-shortcuts -->

					<ul class="nav nav-list">
						<li class="">
							<a href="index.html">
								<i class="menu-icon fa fa-tachometer"></i>
								<span class="menu-text"> Dashboard </span>
							</a>
				
							<b class="arrow"></b>
						</li>
						@auth 
							@role('service desk')
							<li class="">
								<a href="{{ route('requests.index') }}">
									<i class="menu-icon fa fa-desktop"></i>
									<span class="menu-text"> Request </span>
								</a>                    
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="{{ route('incidents.index') }}">
									<i class="menu-icon fa fa-desktop"></i>
									<span class="menu-text"> Incident </span>
								</a>                    
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="{{route('services.index')}}">
									<i class="menu-icon fa fa-desktop"></i>
									<span class="menu-text"> Service </span>
								</a>                    
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="{{ route('stages.index') }}">
									<i class="menu-icon fa fa-desktop"></i>
									<span class="menu-text"> Stage </span>
								</a>                    
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="{{ route('statuses.index') }}">
									<i class="menu-icon fa fa-desktop"></i>
									<span class="menu-text"> Status </span>
								</a>                    
								<b class="arrow"></b>
							</li>
							@endrole
							@role('operation sd|operation ict|so web')
							<li class="">
								<a href="{{ route('requests.index') }}">
									<i class="menu-icon fa fa-desktop"></i>
									<span class="menu-text"> Request </span>
								</a>                    
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="{{ route('incidents.index') }}">
									<i class="menu-icon fa fa-desktop"></i>
									<span class="menu-text"> Incident </span>
								</a>                    
								<b class="arrow"></b>
							</li>
							@endrole
							@hasanyrole('employee|boss') 
								<li class="">
									<a href="{{ route('requests.index') }}">
										<i class="menu-icon fa fa-desktop"></i>
										<span class="menu-text"> Request </span>
									</a>                    
									<b class="arrow"></b>
								</li>
								<li class="">
									<a href="{{ route('incidents.index') }}">
										<i class="menu-icon fa fa-desktop"></i>
										<span class="menu-text"> Incident </span>
									</a>                    
									<b class="arrow"></b>
								</li>
							@endrole                        
						@endauth
					</ul>
					<!-- /.nav-list -->

					<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
						<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
					</div>
				</div>

				<div class="main-content">
					<div class="main-content-inner">
						<div class="breadcrumbs ace-save-state" id="breadcrumbs">
							<ul class="breadcrumb">
								<li>
									<i class="ace-icon fa fa-home home-icon"></i>
									<a href="#">HOME</a>
								</li>
								<li class="active">  {{ config('app.name', 'Laravel') }} </li>
							</ul><!-- /.breadcrumb -->

							<div class="nav-search" id="nav-search">&nbsp;</div><!-- /.nav-search -->
						</div>

						<div class="page-content">
							<div class="row">
								<div class="col-xs-12">
									<!-- PAGE CONTENT BEGINS -->
									
									<div class="row">
										<div class="col-xs-12">
											<div class="scroll">
												@yield('content')
											</div>
										</div>
									</div>

									<!-- PAGE CONTENT ENDS -->
								</div><!-- /.col -->
							</div><!-- /.row -->
						</div><!-- /.page-content -->
					</div>
				</div><!-- /.main-content -->

				<div class="footer">
					<div class="footer-inner">
						<div class="footer-content">
							<span class="bigger-120">
								<!-- <img src="images/logo.png" width="100" height="100" /> -->
								<b>Krakatau Steel &copy; 2019</b> 
							</span>
						</div>
					</div>
				</div>

				<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
					<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
				</a>
			</div><!-- /.main-container -->

			<!-- basic scripts -->
			<!-- <script src="assets/js/jquery-1.12.0.min.js"></script> -->		
			<script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
			<script>
				$(document).ready(function(){
					$('#dataTables').DataTable();
				});
			</script>
			
			
			<script type="text/javascript">
				if('ontouchstart' in document.documentElement) document.write("<script src='{{ asset('assets/js/jquery.mobile.custom.min.js') }}'>"+"<"+"/script>");
			</script>
			<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

			<!-- ace scripts -->
			<script src="{{ asset('assets/js/ace-elements.min.js') }}"></script>
			<script src="{{ asset('assets/js/ace.min.js') }}"></script>
			
			<!---tabel--->
			<script src="{{ asset('javascript/tabel/jquery-1.12.0.min.js') }}"></script>
			<script src="{{ asset('javascript/tabel/jquery.dataTables.min.js') }}"></script>
			<script>
				$(document).ready(function() {
					$('#dataTables').DataTable();
				});
			</script>
		</body>
	@else
		


		<body class="login-layout blur-login">
			<div class="main-container">
				<div class="main-content">
					<div class="row">
						<div class="col-sm-10 col-sm-offset-1">
							<div class="login-container">
								<div class="center">
									<p>&nbsp;</p>
								</div>

								<div class="space-6"></div>

								<div class="position-relative">
									<div id="login-box" class="login-box visible widget-box no-border">
										<div class="widget-body">
											<div class="widget-main">
												
												<div class="social-login center">
													<img src="images/logo.gif" width="200" height="150" />
												</div>
												
												<h4 class="header blue lighter bigger">
													<i class="ace-icon fa fa-coffee green"></i>
													login
												</h4>

												<div class="space-6"></div>
												<form method="POST" action="{{ route('login') }}">
													@csrf
													<fieldset>
														<div class="form-group row">
															<label for="email" class="col-md-8 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
											
															<div class="col-md-12">
																<input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
											
																@if ($errors->has('email'))
																	<span class="invalid-feedback" role="alert">
																		<strong>{{ $errors->first('email') }}</strong>
																	</span>
																@endif
															</div>
														</div>
											
														<div class="form-group row">
															<label for="password" class="col-md-8 col-form-label text-md-right">{{ __('Password') }}</label>
											
															<div class="col-md-12">
																<input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
											
																@if ($errors->has('password'))
																	<span class="invalid-feedback" role="alert">
																		<strong>{{ $errors->first('password') }}</strong>
																	</span>
																@endif
															</div>
														</div>
											
														<div class="form-group row">
															<div class="col-md-12 offset-md-8">
																<div class="form-check">
																	<label class="form-check-label" for="remember">
																		{{ __('Remember Me') }}
																	</label>
																</div>
															</div>
														</div>
											
														<div class="form-group row mb-0">
															<div class="col-md-8 offset-md-8">
																<button type="submit" class="btn btn-primary">
																	{{ __('Login') }}
																</button>
															</div>
														</div>

														<div class="space-4"></div>
													</fieldset>
												</form>
												
												
												<div class="space-6"></div>

												
											</div><!-- /.widget-main -->
										</div><!-- /.widget-body -->
									</div><!-- /.login-box -->
									<h4 class="blue" id="id-company-text">&copy; 2019</h4>
									
								</div>
							</div>
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.main-content -->
			</div>
		</body>
		

	@endif
</html>