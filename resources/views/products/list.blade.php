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


            <div class="col-md-11">
                <div class="d-flex justify-content-end my-3">
                    <a href="{{ route('products.create') }}" class="btn btn-dark btn-lg">Create Product</a>
                </div>
                @if (Session::has('success'))
                    <div class="col-md-12 alert alert-success my-3">
                        {{ Session::get('success') }}
                    </div>
                @endif

                <div class="card border-0 shadow-lg my-4">
                    <div class="card-header bg-dark">
                        <h2 class="text-center text-white">Product List</h2>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">SKU</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($products as $product)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>
                                            <img src="{{ asset('images/products/' . $product->image) }}" alt="No Image"
                                                width="100px">
                                        </td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->sku }}</td>
                                        <td>{{ $product->description }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>
                                            <a href="{{ route('products.show', $product->id) }}"
                                                class="btn btn-primary">View</a>
                                            <a href="{{ route('products.edit', $product->id) }}"
                                                class="btn btn-success">Edit</a>
                                            <a href="{{ route('products.delete', $product->id) }}"
                                                class="btn btn-danger">Delete</a>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
