@extends('layouts.customer.index')

@section('content')
    <!-- Products Section Start -->
    <section class="products" id="products">
        <h2><span>Daftar</span> Produk</h2>
        <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias ratione,
            temporibus cum laboriosam sunt eligendi.
        </p>

        <div class="row">
            @foreach ($menu as $item)
                <div class="col-12 col-md-4 col-lg-4">
                    <div class="product-card">
                        <div class="product-icon">
                            <a href="{{ route('post_cart') }}" onclick="event.preventDefault(); document.getElementById('post_cart_{{ $item->id }}').submit();">
                                <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <use href="{{ asset('customer') }}/img/feather-sprite.svg#shopping-cart" />
                                </svg>
                            </a>
                            <a href="{{ route('menuDetail', $item->id) }}" class="item-detail-button">
                                <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <use href="{{ asset('customer') }}/img/feather-sprite.svg#eye" />
                                </svg>
                            </a>
                        </div>
                        <div class="product-image">
                            <img src="{{ asset('product') .'/'. $item->thumbnail }}" alt="{{ $item->name }}" />
                        </div>
                        <div class="product-content">
                            <h3 x-text="item.name">{{ $item->name }}</h3>
                            <div class="product-stars">
                                <svg width="24" height="24" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <use href="{{ asset('customer') }}/img/feather-sprite.svg#star" />
                                </svg>
                                <svg width="24" height="24" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <use href="{{ asset('customer') }}/img/feather-sprite.svg#star" />
                                </svg>
                                <svg width="24" height="24" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <use href="{{ asset('customer') }}/img/feather-sprite.svg#star" />
                                </svg>
                                <svg width="24" height="24" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <use href="{{ asset('customer') }}/img/feather-sprite.svg#star" />
                                </svg>
                                <svg width="24" height="24" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <use href="{{ asset('customer') }}/img/feather-sprite.svg#star" />
                                </svg>
                            </div>
                            <div class="product-price">
                                <span x-text="rupiah(item.price)">{{ "Rp." .number_format($item->price, 2, ",", ".") }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <form id="post_cart_{{ $item->id }}" action="{{ route('post_cart') }}" method="POST" style="display: none;">
                    @csrf

                    <input type="hidden" name="product_id" value="{{ $item->id }}">
                </form>
            @endforeach
        </div>
    </section>
    <!-- Products Section end -->
@endsection
