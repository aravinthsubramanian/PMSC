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
                    <img src="{{ asset('user\assets\img\bg\bg-09.png') }}" alt="">
                </div>
                <div class="breadcrumb-right">
                    <img src="{{ asset('user\assets\img\bg\bg-08.png') }}" alt="">
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-12">
                        <h2 class="breadcrumb-title"><span>Products</span></h2>
                        <nav class="page-breadcrumb" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('users.dashboard') }}"><i class="feather-home me-1"></i>Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Products</li>
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

                <!-- Filter -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="service-filter">
                            <form action="{{ route('users.filterproduct') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>Search </label>
                                    <input class="form-control" name="search" type="text" value="{{ old('search') }}" placeholder="Search">
                                </div>

                                <div class="form-group">
                                    <label>Select Category </label>
                                    <select class="form-control" id="categorySelect" name="category">
                                        <option value=""></option>
                                        @foreach ($categories as $category)
                                            @foreach ($category->subcategories as $subcategory)
                                                <option value="{{ $category->id }}">{{ $category->category }}</option>
                                            @break
                                        @endforeach
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Select Subcategory </label>
                                <select class="form-control" id="subcategorySelect" name="subcategory">
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="hidden-label"></label>
                                <button class="btn btn-primary" type="submit">
                                    <i class="feather-search"></i> Search
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /Filter -->

            <!-- Service List -->
            <div class="row">

                @foreach ($products as $product)
                    <div class="col-lg-3 col-md-6 d-flex">
                        <div class="card gigs-info w-100">
                            <div class="gigs-item">
                                <div class="gigs-img">
                                    <a href="#">
                                        <div class="carousel slide carousel-fade" id="carouselExampleFade.{{ $product->id }}" data-bs-ride="carousel">
                                            <div class="carousel-inner" style="height: 200px;">
                                                <?php $sn = 1; ?>
                                                @foreach ($product->images as $image)
                                                    @if ($sn == 1)
                                                        <div class="carousel-item active">
                                                            <img class="img-fluid" src="{{ asset('/storage/' . $image->path) }}" alt="NA">
                                                        </div>
                                                    @endif
                                                    @if ($sn != 1)
                                                        <div class="carousel-item">
                                                            <img class="img-fluid" src="{{ asset('/storage/' . $image->path) }}" alt="NA">
                                                        </div>
                                                    @endif
                                                    {{ $sn++ }}
                                                @endforeach
                                            </div>
                                            <button class="carousel-control-prev" data-bs-target="#carouselExampleFade.{{ $product->id }}" data-bs-slide="prev" type="button">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Previous</span>
                                            </button>
                                            <button class="carousel-control-next" data-bs-target="#carouselExampleFade.{{ $product->id }}" data-bs-slide="next" type="button">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Next</span>
                                            </button>
                                        </div>
                                    </a>
                                    {{-- <div class="gigs-badge">
                                        <p>Title</p>
                                    </div> --}}
                                </div>
                                <div class="gigs-content">
                                    <h3 class="title">
                                        <a href="#">{{ $product->product }}</a>
                                    </h3>
                                    {{-- <p>Sub Title</p> --}}

                                    <div>
                                        @foreach ($product->specifications as $spec)
                                            <span>{{ $spec->specification }}</span><br>
                                        @endforeach
                                    </div>

                                    <div class="gigs-content">
                                        <h6 class="title">₹ {{ $product->cost }}</h6>
                                    </div>
                                </div>
                                <div class="gigs-content">
                                    <a class="btn btn-primary" href="{{route('payment.addcart',$product->id)}}">
                                        <i class="feather-shopping-cart"></i>&nbsp;Add cart
                                    </a>
                                    &nbsp;&nbsp;&nbsp;
                                    <a class="btn btn-primary" href="{{ route('payment.buy', $product->id) }}">
                                        <i class="feather-shopping-bag"></i>&nbsp; Buy Now
                                    </a>
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

    @include('layouts.admin.adminafterimports')
    @include('layouts.user.userfooter')

</div>

</body>
