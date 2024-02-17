@extends('layouts.index')

@section('css')
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #212529;
            color: #fff;
        }
    </style>
@endsection

@section('js')
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
@endsection

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-8">
                <h1 class="mb-4">Your Cart</h1>
            </div>
            <div class="col-lg-4 justify-content-end">
                <a href="{{ route('menu') }}" class="btn btn-outline-danger mb-3"><i class="fas fa-arrow-left"></i> Kembali ke Menu</a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <!-- Cart items list -->
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Product</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Total</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($cart as $item)
                                        <tr>
                                            <td>
                                                <a href="{{ asset('product') .'/'. $item->product->thumbnail }}" target="_blank" rel="noopener noreferrer">
                                                    <img src="{{ asset('product') .'/'. $item->product->thumbnail }}" alt="{{ $item->product->name }}" class="img-fluid" width="80" />
                                                </a>
                                            </td>
                                            <td>{{ $item->product->name }}</td>
                                            <td>
                                                <!-- Quantity input -->
                                                <input type="number" class="form-control d-inline w-25" value="{{ $item->qty }}" disabled>
                                            </td>
                                            <td>{{ "Rp." .number_format($item->product->price*$item->qty, 2, ",", ".") }}</td>
                                            <td>
                                                <!-- Button minus -->
                                                <a href="{{ route('minus_cart') }}" class="btn btn-sm btn-danger" onclick="event.preventDefault(); document.getElementById('minus_cart_{{ $item->id }}').submit();">
                                                    <i class="fa fas fa-minus"></i>
                                                </a>
                                                <!-- Button plus -->
                                                <a href="{{ route('plus_cart') }}" class="btn btn-sm btn-success" onclick="event.preventDefault(); document.getElementById('plus_cart_{{ $item->id }}').submit();">
                                                    <i class="fa fas fa-plus"></i>
                                                </a>
                                            </td>
                                        </tr>

                                        <form id="minus_cart_{{ $item->id }}" action="{{ route('minus_cart') }}" method="POST" style="display: none;">
                                            @csrf

                                            <input type="hidden" name="id" value="{{ $item->id }}">
                                        </form>

                                        <form id="plus_cart_{{ $item->id }}" action="{{ route('plus_cart') }}" method="POST" style="display: none;">
                                            @csrf

                                            <input type="hidden" name="id" value="{{ $item->id }}">
                                        </form>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Data Tidak Ada!</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <form action="{{ route('post_checkout') }}" method="POST">
                    @csrf
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title mb-2">Detail</h5>
                            <div class="mb-2">
                                <label class="form-label">Phone:</label>
                                <input type="text" name="phone" class="form-control">
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Address:</label>
                                <input type="text" name="address" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total</h5>
                            <ul class="list-group list-group-flush">
                                {{-- <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Subtotal
                                    <span>$99.99</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Tax
                                    <span>$9.00</span>
                                </li> --}}
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Pembayaran
                                    <span>{{ "Rp." .number_format($total, 2, ",", ".") }}</span>
                                </li>
                            </ul>
                            <button type="submit" class="btn btn-primary mt-3 w-100" @if($total = 0 || empty($total) || $total == NULL) disabled @endif>Checkout</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
