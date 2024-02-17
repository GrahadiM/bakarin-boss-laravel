@extends('layouts.customer.index')

@section('content')
    <!-- Blog Section start -->
    <section id="blog" class="blog">
        <h2><span>Bl</span>og</h2>
        <p>
            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ex, aspernatur
            accusantium. Quidem ab aliquid corporis.
        </p>

        <div class="row">
            <div class="blog-card">
                <img src="{{ asset('customer') }}/img/artikel/berita1.jpg" alt="Coffee" class="blog-card-img" />
                <h3 class="blog-card-title">- Barbeque From Spanyola -</h3>
                <p class="blog-card-price">
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Impedit
                    illo fugiat magnam atque reiciendis! Sequi.
                </p>
            </div>
            <div class="blog-card">
                <img src="{{ asset('customer') }}/img/artikel/berita1.jpg" alt="Coffee" class="blog-card-img" />
                <h3 class="blog-card-title">- Barbeque From Spanyola -</h3>
                <p class="blog-card-price">
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Cum eos
                    minus molestiae recusandae accusantium magnam?
                </p>
            </div>
            <div class="blog-card">
                <img src="{{ asset('customer') }}/img/artikel/berita1.jpg" alt="Coffee" class="blog-card-img" />
                <h3 class="blog-card-title">- Barbeque From Spanyola -</h3>
                <p class="blog-card-price">
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Culpa
                    voluptates aliquid harum porro repellendus mollitia.
                </p>
            </div>
            <div class="blog-card">
                <img src="{{ asset('customer') }}/img/artikel/berita1.jpg" alt="Coffee" class="blog-card-img" />
                <h3 class="blog-card-title">- Barbeque From Spanyola -</h3>
                <p class="blog-card-price">
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nobis
                    repellat non culpa beatae enim quas!
                </p>
            </div>
        </div>
    </section>
    <!-- Blog Section end -->
@endsection
