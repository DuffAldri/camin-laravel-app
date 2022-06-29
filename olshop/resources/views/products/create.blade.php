<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Add Product | E-Shop</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <!-- Include summernote css -->
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    </head>

    <body>
        <nav class="navbar navbar-dark bg-dark">
            <a class="navbar-brand" href="{{ route('product.index') }}">
                <img src="/asset/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
                e-SHOP
            </a>
        </nav>

        <div class="container mt-5 mb-5">
            <div class="row">
                <div class="col-md-12">
                    <!-- Notifikasi menggunakan flash sessiond ata -->
                    @if (session('success')) 
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    @if (session('error'))
                    <div class="alert alert-error">
                        {{ session('error') }}
                    </div>
                    @endif

                    <div class="card border-0 shadow rounded">
                        <div class="card-body">

                            <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                        name="name" value="{{ old('name') }}" required>

                                    <!-- Error message untuk name -->

                                    @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea
                                        name="description" id="description"
                                        class="form-control @error('description') is-invalid @enderror"
                                        rows="5"
                                        required>{{ old('description') }}</textarea>

                                    <!-- Error message untuk description -->
                                    @error('description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="category">Category</label>
                                    <select name="category" class="form-control" required>
                                        <option value="Pakaian Pria">Pakaian Pria</option>
                                        <option value="Pakaian Wanita">Pakaian Wanita</option>
                                        <option value="Pakaian Anak">Pakaian Anak</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" min="1" step="1" class="form-control @error('price') is-invalid @enderror" 
                                        name="price" value="{{ old('price') }}" required>

                                    <!-- Error message untuk price -->

                                    @error('price')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="stock">Stock</label>
                                    <input type="number" min="1" step="1" class="form-control @error('stock') is-invalid @enderror" 
                                        name="stock" value="{{ old('stock') }}" required>

                                    <!-- Error message untuk stock -->

                                    @error('stock')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="image">Add image</label>
                                    <input type="file" class="form-control" name="image" style="border:0">
                                </div>

                                <button type="submit" class="btn btn-md btn-primary">Save</button>
                                <a href="{{ route('product.index') }}" class="btn btn-md btn-secondary">Back</a>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
            integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <!-- include summernote js -->
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#content').summernote({
                    height: 250, // set editable area's height
                });
            })
        </script>
    </body>
</html>