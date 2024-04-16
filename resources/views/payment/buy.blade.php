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
                        <img src="{{ asset('user\assets\img\bg\bg-09.png') }}" alt="">
                    </div>
                    <div class="breadcrumb-right">
                        <img src="{{ asset('user\assets\img\bg\bg-08.png') }}" alt="">
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-12">
                            <h2 class="breadcrumb-title">Buy <span>Product</span></h2>
                            <nav class="page-breadcrumb" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('users.dashboard') }}"><i class="feather-home me-1"></i>Home</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('users.product') }}">Product</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Buy Product</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Breadcrumb -->

            <!-- Page Content -->
            <div class="content">

                <section class="h-100 gradient-custom">
                    <div class="container py-5">
                        <div class="row d-flex justify-content-center my-4">
                            <div class="col-md-8">
                                <div class="card mb-4">

                                    <div class="card-body">

                                        <!-- Single item -->

                                        <div class="row">
                                            <div class="row">
                                                <div style="width:25%">
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
                                                </div>
                                                <div class="col" style="width:60%">
                                                    <h1>{{ $product->product }}</h1>
                                                    <p>{!! $product->description !!}</p>
                                                    <h3>₹{{ $product->cost }}</h3>
                                                    <div style="width:3cm;">
                                                        <div class="input-group">
                                                            <span class="input-group-btn">
                                                                <button class="quantity-left-minus btn btn-secondary btn-number" data-type="minus" data-field="" type="button">
                                                                    <span class="glyphicon glyphicon-minus">-</span>
                                                                </button>
                                                            </span>
                                                            <input class="form-control input-number" id="quantity" name="quantity" type="text" value="1" style="text-align: center;border:none"
                                                                min="1" max="100">
                                                            <input id="productid" value="{{ $product->id }}" hidden>
                                                            <span class="input-group-btn">
                                                                <button class="quantity-right-plus btn btn-secondary btn-number" data-type="plus" data-field="" type="button">
                                                                    <span class="glyphicon glyphicon-plus">+</span>
                                                                </button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="width: 15%;">
                                                    <a class="btn btn-primary" href="{{ route('users.product') }}" style="margin-top: 150%;padding:10%"> <i class="fa fa-arrow-left"></i> Cancel</a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Single item -->

                                    </div>
                                </div>

                            </div>

                            <div class="col-md-4">
                                <div class="card mb-4">
                                    <div class="card-header py-3">
                                        <h5 class="mb-0">Summary</h5>
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                                Product
                                                <span>{{ $product->cost }}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                                Shipping
                                                <span>₹&nbsp;00.00</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                                <div>
                                                    <strong>Total amount</strong>
                                                </div>
                                                <span><strong id="tot">₹&nbsp;{{ $product->cost }}</strong></span>
                                            </li>
                                        </ul>

                                        <form action="{{ route('session') }}" method="POST">
                                            @csrf
                                            <a class="btn btn-primary addcarts" id="addcarts">
                                                <i class="feather-shopping-cart"></i>&nbsp;Add to cart
                                            </a>
                                            <input name="total" type='hidden' value="{{ $product->cost }}">
                                            <input name="productname" type='hidden' value="{{ $product->product }}">
                                            <input id="totquantity" name="quantity" type='hidden' value="1">
                                            <button class="btn btn-success" id="checkout-live-button" type="submit"> Checkout</button>
                                        </form>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </section>

            </div>

            <!-- /Page Content -->
            @include('layouts.user.userfooter')
        </div>
        <!-- /Main Wrapper -->
    </body>

    <script>
        $(document).ready(function() {
            var quantity = parseInt($('#quantity').val());
            var productid = parseInt($('#productid').val());
            var href = `/PMSC/public/payments/addcarts/${productid}/${quantity}`;
            document.getElementById("addcarts").setAttribute("href", href);

            $('.quantity-right-plus').click(function(e) {
                e.preventDefault();
                var quantity = parseInt($('#quantity').val())+1;
                $('#quantity').val(quantity);
                $('#totquantity').val(quantity);
                var href = `/PMSC/public/payments/addcarts/${productid}/${quantity}`;
                document.getElementById("addcarts").setAttribute("href", href);
                document.getElementById("tot").innerHTML = "₹&nbsp;" + (quantity) * {{ $product->cost }} + ".00";
            });

            $('.quantity-left-minus').click(function(e) {
                e.preventDefault();
                var quantity = parseInt($('#quantity').val());
                if (quantity > 1) {
                    quantity=quantity-1;
                    $('#quantity').val(quantity);
                    $('#totquantity').val(quantity);
                    var href = `/PMSC/public/payments/addcarts/${productid}/${quantity}`;
                    document.getElementById("addcarts").setAttribute("href", href);
                    document.getElementById("tot").innerHTML = "₹&nbsp;" + (quantity) * {{ $product->cost }} + ".00";
                }
            });
        });
    </script>

</html>
