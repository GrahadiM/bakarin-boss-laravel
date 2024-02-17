@extends('layouts.customer.index')

@section('content')
    <!-- About section start-->
    <section id="about" class="about">
        <h2><span>Tentang</span> Kami</h2>

        <div class="row">
            <div class="about-img">
                <img src="{{ asset('customer') }}/img/menu2.jpg" alt="Tentang Kami" />
            </div>
            <div class="content">
                <h3>Kenapa Memilih Menu kami?</h3>
                <h3>Selamat datang di Bakarin Boss,</h3>
                <p>
                    Tempat paling asyik untuk menikmati sajian bakar-bakaran yang
                    menggugah selera! Kami di Bakarin Boss percaya bahwa makanan yang
                    lezat tidak hanya memenuhi perut, tetapi juga menciptakan pengalaman
                    tak terlupakan. Dengan bangga kami hadirkan beragam menu
                    bakar-bakaran yang diracik dengan teliti untuk memanjakan lidah
                    Anda. Tak hanya itu, Bakarin Boss bukan hanya sekadar tempat makan,
                    tapi juga sebuah gaya hidup. Kami menciptakan suasana yang hangat
                    dan ramah, di mana setiap hidangan tidak hanya berbicara tentang
                    rasa, tetapi juga tentang identitas unik kami. Setiap hidangan
                    adalah karya seni, mencerminkan dedikasi kami dalam menciptakan
                    momen istimewa melalui makanan dan minuman. Selamat menikmati
                    sensasi bakaran yang menggoda di Bakarin Boss, di mana setiap
                    gigitan adalah perjalanan rasa yang tak terlupakan.
                </p>
            </div>
        </div>
    </section>
    <!-- About section end-->
@endsection
