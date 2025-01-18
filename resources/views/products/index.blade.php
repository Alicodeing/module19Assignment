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
    <div class="container">
        <div class="row justify-contant-center mt-4">
            <div class="col-md-10 d-flex justify-contant-end">
                <a href="{{route('products.create')}}" class="btn btn-dark">Create</a>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            @if (Session::has('success'))
            <div class="col-md-10">
                <div class="alert alert-success">
                    {{Session::get('success')}}
                </div>
            </div>
            @endif
            <div class="col-md-10">
                <div class="card borde-0 shadow-lg mg-4">
                    <div class="card-header bg-dark text-white">
                        <h3>Products</h3>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>ID</th>
                                <th>Images</th>
                                <th>Name</th>
                                <th>Product_id</th>
                                <th>Price</th>
                                <th>Created at</th>
                                <th>Updated at</th>
                                <th>Action</th>
                            </tr>
                            @if ($products->isNotEmpty())
                            @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->id}}</td>
                                <td>
                                    @if ($product->image != "")
                                        <img width="50" src="{{asset('uploads/products/'. $product->image)}}">
                                    @endif
                                </td>
                                <td>{{ $product->name}}</td>
                                <td>{{ $product->product_id}}</td>
                                <td>{{ $product->price}}</td>
                                <td>{{ \Carbon\Carbon::parse($product->created_at)->format('d M, Y')}}</td>
                                <td>
                                    <a href="{{ route('products.edit', $product->id)}}" class="btn btn-dark">Edit</a>
                                    <a href="{{ route('products.update', $product->id)}}" class="btn btn-dark">Update</a>
                                    <a href="{{ route('products.destroy', $product->id)}}" onclick="deleteProduct({{ $product->id }});" class="btn btn-danger">Delete</a>
                                    <form id="delete-product-from-{{ $product->id}}" action="{{route('products.destroy',$product->id )}}" method="post">
                                        @csrf
                                        @method('delete')</form>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </table>
                    
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<script>
    function deleteProduct(id){
        if(confirm("are you sure to delete Product?")){
            ducument.getElementById("delete-product-from-"+id).submit()
        }
    }
</script>