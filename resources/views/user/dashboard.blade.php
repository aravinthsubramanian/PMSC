<!DOCTYPE html>
<html lang="en">
@include('layouts.user.userheader')

<body>
	@include('layouts.alerts.alerts')

	@include('layouts.user.userimports')


	<!-- Main Wrapper -->
	<div class="main-wrapper">

		@include('layouts.user.userdashnavbar')

		<!-- Breadcrumb -->
		<div class="breadcrumb-bar">
			<div class="breadcrumb-img">
				<div class="breadcrumb-left">
                    <img src="{{asset('user\assets\img\bg\bg-09.png')}}" alt="">
                </div>
                <div class="breadcrumb-right">
                    <img src="{{asset('user\assets\img\bg\bg-08.png')}}" alt="">
                </div>
			</div>
			<div class="container">
				<div class="row">
					<div class="col-md-12 col-12">
						<h2 class="breadcrumb-title">User <span>Dashboard</span></h2>
						<nav aria-label="breadcrumb" class="page-breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item">
									<a href="{{route('users.dashboard')}}"><i class="feather-home me-1"></i>Home</a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">User Dashboard</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</div>
		<!-- /Breadcrumb -->

		<!-- Page Content -->
		<div class="content">
			
		</div>

		<!-- /Page Content -->
		@include('layouts.user.userfooter')
	</div>
	<!-- /Main Wrapper -->
</body>
</html>