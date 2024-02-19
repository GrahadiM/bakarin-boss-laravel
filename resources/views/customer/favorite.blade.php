@extends('layouts.customer.index')

@section('content')
    <!-- Menu section start -->
    <section id="menu" class="menu">
        <h2><span>Menu</span> Favorite</h2>
        <p>
            Temukan menu favorit Bakarin Boss yang selalu menjadi pilihan utama para pelanggan setia kami. 
            Nikmati kelezatan tiada tara dan kepuasan yang tak terlupakan di setiap gigitan.
        </p>

        <div class="row">
            @foreach ($menu as $item)
            <div class="menu-card">
                <img src="{{ asset('product') .'/'. $item->product->thumbnail }}" alt="{{ $item->product->name }}" class="menu-card-img" />
                <h3 class="menu-card-title">{{ $item->product->name }}</h3>
                <p class="menu-card-price">{{ "Rp." .number_format($item->product->price, 2, ",", ".") }}</p>
            </div>
            @endforeach
        </div>
    </section>
    <!-- Menu section end -->
@endsection
