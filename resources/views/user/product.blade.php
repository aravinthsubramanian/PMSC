@include('layouts.user.userheader')

<body>

    <!-- Main Wrapper -->
    <div class="main-wrapper">

        @include('layouts.user.userdashnavbar')
        @include('layouts.alerts.alerts')

        @include('layouts.user.userimports')

        <!-- Breadcrumb -->
        <div class="breadcrumb-bar">
            <div class="breadcrumb-img">
                <div class="breadcrumb-left">
                    <img src="assets/img/bg/bg-09.png" alt="">
                </div>
                <div class="breadcrumb-right">
                    <img src="assets/img/bg/bg-08.png" alt="">
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-12">
                        <h2 class="breadcrumb-title">Buy <span>Products</span></h2>
                        <nav class="page-breadcrumb" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('users.dashboard') }}"><i class="feather-home me-1"></i>Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Buy Products</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Breadcrumb -->

        <!-- Page Content -->
        <div class="content">
            <div class="container">

                <!-- Service List -->
                <div class="row">

                    @foreach ($products as $product)
                        <div class="col-lg-3 col-md-6 d-flex">
                            <div class="card gigs-info w-100">
                                <div class="gigs-item">
                                    <div class="gigs-img">
                                        <a href="#">
                                            <div id="carouselExampleFade.{{$product->id}}" class="carousel slide carousel-fade" data-bs-ride="carousel">
                                                <div class="carousel-inner">
                                                    <?php $sn=1; ?>
                                                    @foreach ($product->images as $image)
                                                        @if($sn == 1)
                                                            <div class="carousel-item active">
                                                                <img class="d-block w-100" src="{{ asset('/storage/' . $image->path) }}" alt="">
                                                            </div>
                                                        @endif
                                                        @if($sn != 1)
                                                            <div class="carousel-item">
                                                                <img class="d-block w-100" src="{{ asset('/storage/' . $image->path) }}" alt="">
                                                            </div>
                                                        @endif
                                                        {{$sn++}}
                                                    @endforeach
                                                </div>
                                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade.{{$product->id}}" data-bs-slide="prev">
                                                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                  <span class="visually-hidden">Previous</span>
                                                </button>
                                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade.{{$product->id}}" data-bs-slide="next">
                                                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                  <span class="visually-hidden">Next</span>
                                                </button>
                                            </div>
                                        </a>
                                        <div class="gigs-badge">
                                            <p>Title</p>
                                        </div>
                                    </div>
                                    <div class="gigs-content">
                                        <h3 class="title">
                                            <a href="#">{{ $product->product }}</a>
                                        </h3>
                                        <p>
                                        <p>Sub Title</p>
                                        </p>
                                        <div class="serv-info">
                                            <div class="rating">
                                                @foreach ($product->specifications as $spec)
                                                    <span>{{ $spec->specification }}</span>
                                                @endforeach
                                            </div>
                                            <h6>₹ {{ $product->cost }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
                <!-- Service List -->

            </div>
        </div>
        <!-- /Page Content -->

        @include('layouts.user.userfooter')

    </div>

</body>
