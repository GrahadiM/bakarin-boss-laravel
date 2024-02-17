@extends('layouts.customer.index')

@section('content')
    <!-- Menu section start -->
    <section id="menu" class="menu">
        <h2><span>Menu</span> Favorite</h2>
        <p>
            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ex, aspernatur
            accusantium. Quidem ab aliquid corporis.
        </p>

        <div class="row">
            <div class="menu-card">
                <img src="{{ asset('customer') }}/img/Menu/menu.jpg" alt="Mexican Burger" class="menu-card-img" />
                <h3 class="menu-card-title">- Mexican Burger -</h3>
                <p class="menu-card-price">IDR 20K</p>
            </div>
            <div class="menu-card">
                <img src="{{ asset('customer') }}/img/Menu/menu.jpg" alt="Mexican Burger" class="menu-card-img" />
                <h3 class="menu-card-title">- Mexican Burger -</h3>
                <p class="menu-card-price">IDR 20K</p>
            </div>
            <div class="menu-card">
                <img src="{{ asset('customer') }}/img/Menu/menu.jpg" alt="Mexican Burger" class="menu-card-img" />
                <h3 class="menu-card-title">- Mexican Burger -</h3>
                <p class="menu-card-price">IDR 20K</p>
            </div>
            <div class="menu-card">
                <img src="{{ asset('customer') }}/img/Menu/menu.jpg" alt="Mexican Burger" class="menu-card-img" />
                <h3 class="menu-card-title">- Mexican Burger -</h3>
                <p class="menu-card-price">IDR 20K</p>
            </div>
        </div>
    </section>
    <!-- Menu section end -->
@endsection
