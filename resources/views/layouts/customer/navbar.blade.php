<!-- Navbar start -->
<nav class="navbar" x-data>
    <a href="{{ route('index') }}" class="navbar-logo">Bakarin<span>Boss</span>.</a>

    <div class="navbar-nav">
        <a href="{{ route('index') }}" class="{{ (request()->is('/')) ? 'active' : '' }}">Home</a>
        <a href="{{ route('about') }}" class="{{ (request()->is('/about')) ? 'active' : '' }}">Tentang Kami</a>
        <a href="{{ route('favorite') }}" class="{{ (request()->is('/favorite')) ? 'active' : '' }}">Menu</a>
        <a href="{{ route('menu') }}" class="{{ (request()->is('/menu')) ? 'active' : '' }}">Produk Kami</a>
        <a href="{{ route('blog') }}" class="{{ (request()->is('/blog')) ? 'active' : '' }}">Blog</a>
        <a href="{{ route('contact') }}" class="{{ (request()->is('/contact')) ? 'active' : '' }}">Kontak</a>
    </div>

    <div class="navbar-extra">
        <a href="{{ route('cart') }}" id="shopping-cart-button">
            <i class="fa fas fa-shopping-cart"></i>
        </a>
        @auth
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fa fas fa-user"></i>
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
        @else
        <a href="{{ route('login') }}">
            <i class="fa fas fa-user"></i>
        </a>
        @endauth
        <a href="#" id="hamburger-menu"><i data-feather="menu"></i></a>
    </div>

    <!-- search form start -->
    <div class="search-form">
        <input type="search" id="search-box" placeholder="search here..." />
        <label for="search-box"><i data-feather="search"></i></label>
    </div>
    <!-- search form end -->

    <!-- Shopping Cart Start -->
    <div class="shopping-cart">
        <template x-for="(item, index) in $store.cart.items" x-keys="index">
            <div class="cart-item">
                <img :src="{{ asset('customer') }}/img / product / $ { item.img }" :alt="item.name" />
                <div class="item-detail">
                    <h3 x-text="item.name"></h3>
                    <div class="item-price">
                        <span x-text="rupiah(item.price)"></span> &times;
                        <button id="remove" @click="$store.cart.remove(item.id)">
                            &minus;
                        </button>
                        <span x-text="item.quantity"></span>
                        <button id="add" @click="$store.cart.add(item)">&plus;</button>
                        &equals;
                        <span x-text="rupiah(item.total)"></span>
                    </div>
                </div>
            </div>
        </template>
        <h4 x-show="!$store.cart.items.length" style="margin-top: 1rem">
            Cart it Empty
        </h4>
        <h4 x-show="$store.cart.items.length">
            Total : <span x-text="rupiah($store.cart.total)"></span>
        </h4>

        <div class="form-container" x-show="$store.cart.items.length">
            <form action="" id="checkoutForm">
                <h5>Customer Detail</h5>

                <label for="name">
                    <span>Name</span>
                    <input type="text" name="name" id="name" />
                </label>

                <label for="email">
                    <span>Email</span>
                    <input type="email" name="email" id="email" />
                </label>
                <label for="phone">
                    <span>Phone</span>
                    <input type="number" name="phone" id="phone" autocomplete="off" />
                </label>
                <button class="checkout-button" type="submit" id="checkout-button" value="checkout">
                    Checkout
                </button>
            </form>
        </div>
    </div>
    <!-- Shopping Cart End -->
</nav>
<!-- Navbar end -->
