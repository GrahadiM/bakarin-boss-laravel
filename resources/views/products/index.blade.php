@extends('layouts.index')

@section('css')
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #212529;
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
            <div class="col-lg-10">
                <h1 class="text-light mb-4">Data Produk</h1>
            </div>
            <div class="col-lg-2 text-end">
                <a href="{{ route('logout') }}" class="btn btn-outline-danger mb-3"
                    onclick="event.preventDefault();
                document.getElementById('logout-form').submit();"><i
                        class="fa fas fa-user"></i> Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Produk</div>

                    <div class="card-body">
                        <!-- Button to trigger modal for create product -->
                        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal"
                            data-bs-target="#createProductModal">Add Product</button>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Kategori</th>
                                    <th>Nama</th>
                                    <th>Harga</th>
                                    <th>Thumbnail</th>
                                    <th>Deskripsi</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>{{ $product->category->name }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>
                                            <a href="{{ asset('product') . '/' . $product->thumbnail }}" target="_blank"
                                                rel="noopener noreferrer">
                                                <img src="{{ asset('product') . '/' . $product->thumbnail }}"
                                                    alt="{{ $product->name }}" class="img-fluid" width="80" />
                                            </a>
                                        </td>
                                        <td>{{ $product->desc }}</td>
                                        <td>
                                            <!-- Button to trigger modal for edit product -->
                                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#editProductModal{{ $product->id }}">Edit</button>
                                            <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                                style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for create product -->
    <div class="modal fade" id="createProductModal" tabindex="-1" aria-labelledby="createProductModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createProductModalLabel">Add Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form for creating product -->
                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="categoryName" class="form-label">Kategori</label>
                            <select name="category_id" class="form-control" id="categoryName" required>
                                <option value="1">Makanan</option>
                                <option value="2">Minuman</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="productName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="productName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="productPrice" class="form-label">Price</label>
                            <input type="number" class="form-control" id="productPrice" name="price" required>
                        </div>
                        <div class="mb-3">
                            <label for="productThumbnail" class="form-label">Thumbnail</label>
                            <input type="file" class="form-control" id="productThumbnail" name="thumbnail"
                                accept="image/*" required>
                        </div>
                        <div class="mb-3">
                            <label for="productDesc" class="form-label">Name</label>
                            <textarea name="desc" class="form-control" id="productDesc" rows="5" required></textarea>
                            {{-- <input type="text" class="form-control" id="productDesc" name="desc" required> --}}
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for edit product -->
    @foreach ($products as $product)
        <div class="modal fade" id="editProductModal{{ $product->id }}" tabindex="-1"
            aria-labelledby="editProductModalLabel{{ $product->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editProductModalLabel{{ $product->id }}">Edit Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Form for editing product -->
                        <form action="{{ route('products.update', $product->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <div class="mb-3">
                                <label for="editProductName{{ $product->id }}" class="form-label">Name</label>
                                <input type="text" class="form-control" id="editProductName{{ $product->id }}"
                                    name="name" value="{{ $product->name }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="editProductPrice{{ $product->id }}" class="form-label">Price</label>
                                <input type="number" class="form-control" id="editProductPrice{{ $product->id }}"
                                    name="price" value="{{ $product->price }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="editProductThumbnail{{ $product->id }}" class="form-label">Thumbnail</label>
                                <input type="file" class="form-control" id="editProductThumbnail{{ $product->id }}"
                                    name="thumbnail" accept="image/*">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-10">
                <h1 class="text-light mb-4">Riwayat Transaksi</h1>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Transaksi</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Kode</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->code_order }}</td>
                                        <td>{{ $order->first_name . ' ' . $order->last_name }}</td>
                                        <td>{{ $order->phone }}</td>
                                        <td>{{ 'Rp.' . number_format($order->total, 2, ',', '.') }}</td>
                                        <td><button type="button" class="btn btn-success"
                                                disabled>{{ Str::upper($order->status) }}</button></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
