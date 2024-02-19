@extends('layouts.customer.index')

@section('content')
    <!-- Menu Detail section start-->
    <section id="about" class="about">
        <h2><span>Menu</span> Detail</h2>

        <div class="row">
            <img src="{{ asset('product') .'/'. $item->thumbnail }}" alt="{{ $item->name }}" className="img-fluid" width="300">
            <div class="content" style="padding-left: 25px;">
                <h3>{{ $item->name }}</h3>
                <p>{{ "Rp." .number_format($item->price, 2, ",", ".") }}</p>
                 </div>
        </div>
    </section>
    <!-- Menu Detail section end-->
@endsection
