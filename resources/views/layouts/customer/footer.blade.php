    <!-- Footer start -->
    <footer>
        <div class="socials">
            <a href="#"><i data-feather="instagram"></i></a>
            <a href="#"><i data-feather="twitter"></i></a>
            <a href="#"><i data-feather="facebook"></i></a>
        </div>

        <div class="links">
            <a href="{{ route('index') }}" class="{{ (request()->is('/')) ? 'active' : '' }}">Home</a>
            <a href="{{ route('about') }}" class="{{ (request()->is('/about')) ? 'active' : '' }}">Tentang Kami</a>
            <a href="{{ route('favorite') }}" class="{{ (request()->is('/favorite')) ? 'active' : '' }}">Menu</a>
            <a href="{{ route('menu') }}" class="{{ (request()->is('/menu')) ? 'active' : '' }}">Produk Kami</a>
            <a href="{{ route('blog') }}" class="{{ (request()->is('/blog')) ? 'active' : '' }}">Blog</a>
            <a href="{{ route('contact') }}" class="{{ (request()->is('/contact')) ? 'active' : '' }}">Kontak</a>
        </div>

        <div class="credit">
            <p>Created by <a href="">fianfirdaus</a> | &copy; 2023.</p>
        </div>
    </footer>
    <!-- Footer end -->
