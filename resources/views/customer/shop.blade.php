@extends('layouts.customer.index')

@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Shop</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active text-white">Shop</li>
        </ol>
    </div>
    <!-- Single Page Header End -->


    <!-- Shop Start-->
    <div class="container-fluid fruite py-5">
        <div class="container py-5">
            <h1 class="mb-4">Sport Shoes Shop</h1>
            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="row g-4">
                        <div class="col-lg-12">
                            <div class="row g-4 justify-content-center">
                                @foreach ($product as $item)
                                <div class="col-sm-12 col-md-4">
                                    <a href="{{ route('shopDetail',$item->id) }}" class="text-decoration-none">
                                        <div class="rounded position-relative fruite-item">
                                            <div class="fruite-img">
                                                <img src="{{ url('storage/product/'.$item->thumbnail) }}" class="img-fluid w-100 rounded-top" alt="">
                                            </div>
                                            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">Shoes</div>
                                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                <h4>{{ $item->name }}</h4>
                                                <div class="d-flex justify-content-between flex-lg-wrap">
                                                    <p class="text-dark fs-5 fw-bold mb-0">{{"Rp." .number_format($item->price, 2, ",", ".") }}</p>
                                                    <a href="{{ route('post_cart') }}" class="btn border border-secondary rounded-pill px-3 text-primary" onclick="event.preventDefault(); document.getElementById('add_cart_form-{{ $item->id }}').submit();">
                                                        <i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart
                                                    </a>
                                                </div>
                                                <form id="add_cart_form-{{ $item->id }}" class="d-none" action="{{ route('post_cart') }}" method="POST">
                                                    @csrf

                                                    <input type="hidden" name="product_id" value="{{ $item->id }}">
                                                </form>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop End-->
@endsection
