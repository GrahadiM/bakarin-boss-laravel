@extends('layouts.customer.index')

@section('css')
    <style>
        .row {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .blog-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease-in-out;
        }

        .blog-card:hover {
            transform: translateY(-5px);
        }

        .blog-card-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-bottom: 1px solid #ddd;
        }

        .blog-card-title {
            margin: 15px 0;
            font-size: 18px;
        }

        .blog-card-price {
            color: #777;
        }
    </style>
@endsection

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const blogCardLinks = document.querySelectorAll('.blog-card');

            blogCardLinks.forEach(card => {
                card.addEventListener('click', function() {
                    const url = this.getAttribute('data-url');
                    if (url) {
                        window.open(url, '_blank');
                    }
                });
            });
        });
    </script>
@endsection

@section('content')
    <!-- Blog Section start -->
    <section id="blog" class="blog">
        <h2><span>New</span> News</h2>
        <p>
            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ex, aspernatur
            accusantium. Quidem ab aliquid corporis.
        </p>
        <div class="row">
            @foreach ($articles as $article)
                <div class="blog-card" data-url="{{ $article['url'] }}">
                    <img src="{{ $article['urlToImage'] }}" alt="{{ $article['title'] }}" class="blog-card-img" />
                    <h3 class="blog-card-title">{{ $article['title'] }}</h3>
                    <p class="blog-card-price">{{ $article['description'] }}</p>
                </div>
            @endforeach
        </div>
    </section>
    <!-- Blog Section end -->
@endsection
