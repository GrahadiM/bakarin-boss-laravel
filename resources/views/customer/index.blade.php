@extends('layouts.customer.index')

@section('css')
    <style>
        /* CSS for Carousel */
        .carousel {
            position: relative;
            max-width: 450px;
            margin: 20% auto !important;
            overflow: hidden;
        }

        .carousel-container {
            display: flex;
            transition: transform 0.5s ease;
        }

        .carousel-slide {
            display: flex;
            min-width: 100%;
        }

        .carousel img {
            width: 450px;
            display: block;
            height: auto;
        }

        #prevBtn,
        #nextBtn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
            z-index: 2;
        }

        #prevBtn {
            left: 0;
        }

        #nextBtn {
            right: 0;
        }

        .image-container {
            position: relative;
        }

        .image-description {
            position: absolute;
            bottom: 50%;
            left: 50%;
            transform: translate(-50%, 50%);
            color: white;
            font-size: 14px;
            background-color: rgba(0, 0, 0, 0.2);
            /* Warna hitam dengan efek blur 20% */
            padding: 5px 10px;
            border-radius: 5px;
        }
    </style>
@endsection

@section('js')
    <script>
        // JavaScript for Carousel
        document.addEventListener('DOMContentLoaded', function() {
            const carouselSlide = document.querySelector('.carousel-slide');
            const carouselImages = document.querySelectorAll('.carousel-slide img');

            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');

            let counter = 0;
            const size = carouselImages[0].clientWidth;

            carouselSlide.style.transform = 'translateX(' + (-size * counter) + 'px)';

            function nextImage() {
                if (counter >= carouselImages.length - 1) {
                    counter = 0;
                } else {
                    counter++;
                }
                carouselSlide.style.transition = 'transform 0.5s ease-in-out';
                carouselSlide.style.transform = 'translateX(' + (-size * counter) + 'px)';
            }

            setInterval(nextImage, 2000);

            prevBtn.addEventListener('click', () => {
                if (counter <= 0) {
                    counter = carouselImages.length - 1;
                } else {
                    counter--;
                }
                carouselSlide.style.transition = 'transform 0.5s ease-in-out';
                carouselSlide.style.transform = 'translateX(' + (-size * counter) + 'px)';
            });

            carouselImages.forEach(img => {
                img.addEventListener('click', () => {
                    window.location.href = "{{ route('menu') }}";
                });
            });
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Ambil nilai order_id dari URL
            const urlParams = new URLSearchParams(window.location.search);
            const orderId = urlParams.get('order_id');

            // Jika ada order_id, buka WhatsApp
            if (orderId) {
                // Kirim request AJAX untuk mengambil data order dengan orderId
                $.ajax({
                    url: `/get-order?orderId=${orderId}`, // Ganti dengan rute yang sesuai di backend
                    type: 'GET',
                    success: function(response) {
                        if (response) {
                            // Mendapatkan data dari response order
                            const phoneNumber = '+62' + response.phone;
                            const firstName = response.first_name;
                            const lastName = response.last_name;
                            const totalHarga = response.total;

                            // Membuat pesan WhatsApp dengan informasi order
                            const message = `Halo ${firstName} ${lastName}, ` +
                                `Terima kasih atas pesanan Anda! ` +
                                `Order ID: ${response.code_order} ` +
                                `Total Harga: ${totalHarga}`;

                            // Membuka link WhatsApp dengan pesan yang sudah dibuat
                            const whatsappUrl =
                                `https://wa.me/${phoneNumber}?text=${encodeURIComponent(message)}`;
                            window.open(whatsappUrl, '_blank');
                        } else {
                            console.error('Order not found');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Request failed');
                    }
                });
            }
        });
    </script>
@endsection

@section('content')
    <!-- Hero Section Start -->
    <section class="hero" id="home">
        <div class="mask-container">
            <main class="content">
                <h1>
                    Semua orang bisa membakar, tetapi kami memberikan rasa dan sensasi
                    <span>Berbeda</span> dari yang biasa orang lain bakar
                </h1>
                {{-- <p>Please enjoy with our menu !</p> --}}
            </main>

            <!-- Carousel Section Start -->
            <section class="carousel">
                <div class="carousel-container">
                    <div class="carousel-slide">
                        <div class="image-container">
                            <img src="{{ asset('product') . '/1.png' }}" alt="Image 1" id="image1">
                            <div class="image-description">Please enjoy with our menu !</div>
                        </div>
                        <div class="image-container">
                            <img src="{{ asset('product') . '/2.png' }}" alt="Image 2" id="image2">
                            <div class="image-description">Please enjoy with our menu !</div>
                        </div>
                        <div class="image-container">
                            <img src="{{ asset('product') . '/3.png' }}" alt="Image 3" id="image3">
                            <div class="image-description">Please enjoy with our menu !</div>
                        </div>
                    </div>
                </div>
                <button id="prevBtn">&lt;</button>
                <button id="nextBtn">&gt;</button>
            </section>
            <!-- Carousel Section End -->
        </div>
    </section>
    <!-- Hero Section End -->
@endsection
