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
                            <h2 class="breadcrumb-title">My <span>Cart</span></h2>
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

                                @foreach ($products as $product)
                                    <!-- Single item -->
                                    <div class="card mb-4">
                                        <div class="card-body">
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
                                                    <div class="col" style="width:65%">
                                                        <h3>{{ $product->product }}</h3>
                                                        <p>{!! $product->description !!}</p>
                                                        <h5>₹{{ $product->cost }}</h5>

                                                        <div style="width:3cm;">
                                                            <div class="input-group">
                                                                <span class="input-group-btn">
                                                                    <button class="quantity-left-minus btn btn-secondary" data-type="minus" data-id="{{ $product->id }}" type="button">
                                                                        <span class="glyphicon glyphicon-minus">-</span>
                                                                    </button>
                                                                </span>

                                                                @foreach ($quantities as $qty)
                                                                    @if ($qty->id == $product->id)
                                                                        <input class="form-control input-number" id="quantity-{{ $product->id }}" type="text" value="{{ $qty->quantity }}"
                                                                            style="text-align: center;border:none">
                                                                    @endif
                                                                @endforeach

                                                                <span class="input-group-btn">
                                                                    <button class="quantity-right-plus btn btn-secondary" data-type="plus" data-id="{{ $product->id }}" type="button">
                                                                        <span class="glyphicon glyphicon-plus">+</span>
                                                                    </button>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div style="width: 10%;">
                                                        <a class="btn btn-danger" href="{{route('payment.deletecart',$product->id)}}" style="margin-top: 280%">Delete
                                                        </a>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Single item -->
                                @endforeach
                            </div>

                            <div class="col-md-4">
                                <div class="card mb-4">
                                    <div class="card-header py-3">
                                        <h5 class="mb-0">Summary</h5>
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-group list-group-flush">
                                            <?php $tot = 0.0; ?>
                                            @foreach ($products as $product)
                                                <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                                    Product({{ $loop->iteration }})
                                                    <span>{{ $product->cost }}</span>
                                                </li>
                                            @endforeach

                                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                                Shipping
                                                <span>₹&nbsp;00.00</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                                <div>
                                                    <strong>Total amount</strong>
                                                </div>
                                                <span><strong id="tot">₹&nbsp;{{ $total }}.00</strong></span>
                                            </li>
                                        </ul>

                                        <form action="{{ route('sessioncart') }}" method="POST">
                                            @csrf
                                            <a class="btn btn-primary" href="{{ route('users.product') }}"> <i class="fa fa-arrow-left"></i> Continue Shopping</a>
                                            <button class="btn btn-success" id="checkout-live-button" type="submit" style="margin-left: 10%"><i class="fa fa-money"></i> Checkout</button>
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
            const incrementButtons = document.querySelectorAll('.quantity-right-plus');
            const decrementButtons = document.querySelectorAll('.quantity-left-minus');

            incrementButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const itemId = this.getAttribute('data-id');
                    var quantity = parseInt($(`#quantity-${itemId}`).val()) + 1;
                    $(`#quantity-${itemId}`).val(quantity);
                    fetch(`/PMSC/public/payments/editcart/${itemId}/${quantity}`)
                        .then(response => response.json())
                        .then(data => {
                            document.getElementById("tot").innerHTML = "₹&nbsp;" + data.total + ".00";
                        })
                        .catch(error => console.error('Error fetching subcategories:', error));
                });
            });

            decrementButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const itemId = this.getAttribute('data-id');
                    var quantity = parseInt($(`#quantity-${itemId}`).val());
                    if (quantity > 1)
                        quantity = quantity - 1;
                    $(`#quantity-${itemId}`).val(quantity);
                    fetch(`/PMSC/public/payments/editcart/${itemId}/${quantity}`)
                        .then(response => response.json())
                        .then(data => {
                            document.getElementById("tot").innerHTML = "₹&nbsp;" + data.total + ".00";
                        })
                        .catch(error => console.error('Error fetching subcategories:', error));
                });
            });

        });
    </script>

</html>
