@extends('layouts.customer.index')

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
                <div class="blog-card">
                    <img src="{{ $article['urlToImage'] }}" alt="{{ $article['title'] }}" class="blog-card-img" />
                    <h3 class="blog-card-title">{{ $article['title'] }}</h3>
                    <p class="blog-card-price">{{ $article['description'] }}</p>
                </div>
            @endforeach
        </div>
    </section>
    <!-- Blog Section end -->
@endsection
