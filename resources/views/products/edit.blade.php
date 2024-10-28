<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Crud Project</title>
</head>

<body>
    <div class="bg-dark py-3">
        <h1 class="text-white text-center">Crud Project</h1>
    </div>
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8">
                <div class="d-flex justify-content-end my-3">
                    <a href="{{ route('products.index') }}" class="btn btn-dark btn-lg">Back</a>
                </div>
                <div class="card border-0 shadow-lg my-4">
                    <div class="card-header bg-dark">
                        <h2 class="text-center text-white">Edit Product</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('products.update',$product->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <h5 for="name" class="form-label">Name</h5>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name', $product->name) }}" id="name" name="name"
                                    placeholder="Enter Name">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <h5 for="sku" class="form-label">SKU</h5>
                                <input type="number"
                                    class="form-control value="{{ old('sku') }}"@error('sku') is-invalid @enderror"
                                    id="sku" name="sku" placeholder="Enter SKU Number"
                                    value="{{ old('sku', $product->sku) }}">
                                @error('sku')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <h5 for="price" class="form-label">Price</h5>
                                <input type="number" class="form-control @error('price') is-invalid @enderror"
                                    value="{{ old('price', $product->price) }}" id="price" name="price"
                                    placeholder="Enter Price">
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <h5 for="description" class="form-label">Description</h5>
                                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter Description">{{ old('description', $product->description) }}
                                </textarea>
                            </div>
                            <div class="mb-3">
                                <h5 for="image" class="form-label">Image</h5>
                                <input type="file" class="form-control" id="image" name="image">
                                <img src="{{ asset('images/products/' . $product->image) }}" class="my-3 w-50" alt="Not Available">
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg w-100">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
