<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Products Menegment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="bg-dark py-2">
        <h3 class="text-white text-center">Products Menegment</h3>
    </div>
    <div class="container"> <div class="row justify-contant-center mt-4">
        <div class="col-md-10 d-flex justify-contant-end">
            <a href="{{route('products.index')}}" class="btn btn-dark">Back</a>
        </div>
    </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="card borde-0 shadow-lg mg-4">
                    <div class="card-header bg-dark text-white">
                        <h3>Create Product</h3>
                    </div>
                    <form enctype="multipart/form-data" action="{{ route('products.store')}}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="" class="form-label h5">Name</label>
                                <input value="{{old('name')}}" type="text"  class=" @error('name') is-invalid @enderror form-control form-control-lg" placeholder="name" name="name">
                                @error('name')
                                    <p class="invalid-feedback">{{ $message}}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label h5">ID</label>
                                <input value="{{old('product_id')}}" type="text" class=" @error('product_id') is-invalid @enderror form-control form-control-lg" placeholder="id" name="product_id">
                                @error('product_id')
                                    <p class="invalid-feedback">{{ $message}}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label h5">Price</label>
                                <input value="{{old('price')}}" type="text" class=" @error('price') is-invalid @enderror form-control form-control-lg" placeholder="price" name="price">
                                @error('price')
                                    <p class="invalid-feedback">{{ $message}}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label h5">Description</label>
                                <textarea name="description" class="form-control" cols="30" rows="5"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label h5">Image</label>
                                <input type="file" class="form-control form-control-lg" placeholder="Image" name="image">
                            </div>
                            <div class="d-grid">
                                <button class="btn btn-lg btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>