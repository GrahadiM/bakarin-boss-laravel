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
    <!-- Midtrans -->
    <script src="https://app.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const payButton = document.getElementById('pay-button');

            payButton.addEventListener('click', function() {
                snap.pay('{{ $snapToken }}');
            });
        });
    </script>
@endsection

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-8">
                <h1 class="mb-4">Checkout</h1>
            </div>
            <div class="col-lg-4 justify-content-end">
                <a href="{{ route('index') }}" class="btn btn-outline-danger mb-3"><i class="fas fa-arrow-left"></i> Kembali
                    ke Index</a>
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
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($orderP as $item)
                                        <tr>
                                            <td>
                                                <a href="{{ asset('product') . '/' . $item->product->thumbnail }}"
                                                    target="_blank" rel="noopener noreferrer">
                                                    <img src="{{ asset('product') . '/' . $item->product->thumbnail }}"
                                                        alt="{{ $item->product->name }}" class="img-fluid" width="80" />
                                                </a>
                                            </td>
                                            <td>{{ $item->product->name }}</td>
                                            <td>
                                                <!-- Quantity input -->
                                                <input type="number" class="form-control d-inline w-25"
                                                    value="{{ $item->qty }}" disabled>
                                            </td>
                                            <td>{{ 'Rp.' . number_format($item->product->price * $item->qty, 2, ',', '.') }}
                                            </td>
                                        </tr>
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
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title mb-2">Detail</h5>
                        <div class="mb-2">
                            <label class="form-label">Code Order:</label>
                            <input type="text" name="code_order" class="form-control" value="{{ $order->code_order }}"
                                disabled>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Phone:</label>
                            <input type="text" name="phone" class="form-control" value="{{ '+62' . $order->phone }}"
                                disabled>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Address:</label>
                            <input type="text" name="address" class="form-control" value="{{ $order->address }}"
                                disabled>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Pembayaran</h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Total Harga
                                <span>{{ 'Rp.' . number_format($order->total, 2, ',', '.') }}</span>
                            </li>
                        </ul>
                        @if ($order->payment_status == 1)
                            <button class="btn btn-primary" id="pay-button">Bayar Sekarang</button>
                        @else
                            Pembayaran berhasil
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
