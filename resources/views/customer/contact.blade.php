@extends('layouts.customer.index')

@section('content')
    <!-- Contact Section start -->
    <section id="contact" class="contact">
        <h2><span>Kontak</span> Kami</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad, tempore.</p>

        <div class="row">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.7897278742453!2d106.8829223763819!3d-6.158910293828278!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f5ca5fa65ff1%3A0xafe23d29167e2e69!2sBakarin%20Boss!5e0!3m2!1sid!2sid!4v1699441826589!5m2!1sid!2sid"
                allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="map"></iframe>

            <form action="">
                <div class="input-grup">
                    <i data-feather="user"></i>
                    <input type="text" placeholder="name" />
                </div>
                <div class="input-grup">
                    <i data-feather="mail"></i>
                    <input type="text" placeholder="e-mail" />
                </div>
                <div class="input-grup">
                    <i data-feather="phone"></i>
                    <input type="text" placeholder="phone" />
                </div>
                <button type="submit" class="btn">kirim pesan</button>
            </form>
        </div>
    </section>
    <!-- Contact Section end -->
@endsection
