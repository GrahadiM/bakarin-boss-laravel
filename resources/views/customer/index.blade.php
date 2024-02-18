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
                <p>Please enjoy with our menu !</p>
            </main>

            <!-- Carousel Section Start -->
            <section class="carousel">
                <div class="carousel-container">
                    <div class="carousel-slide">
                        <img src="{{ asset('product') . '/1.png' }}" alt="Image 1" id="image1">
                        <img src="{{ asset('product') . '/2.png' }}" alt="Image 2" id="image2">
                        <img src="{{ asset('product') . '/3.png' }}" alt="Image 3" id="image3">
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
