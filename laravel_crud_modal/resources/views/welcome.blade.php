<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Home</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>

</head>

<body>

    <!-- Navbar starts here -->
    <div class="container-fluid">
        <nav class="navbar navbar-dark bg-light">
            <div class="container-fluid">
                <a href="/" style="color: black; display: flex; align-items: center; text-decoration: none;">
                    <i class="fa fa-home fa-2xl" aria-hidden="true"></i>
                    <span style="margin-left: 5px;">Home</span>
                </a>
                <a href="#" style="color: black; display: flex; align-items: center; text-decoration: none;"
                    data-bs-toggle="modal" data-bs-target="#addProductModal">
                    <span class="fa fa-plus-circle fa-2xl"></span>
                    <span style="margin-left: 5px;">Add Product</span>
                </a>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
                
            </div>
        </nav>
    </div>
    <!-- Navbar ends here -->




    <!-- Modal for adding Products Starts Here -->
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModalLabel">Add Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('products.create')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="category">Category</label>
                            <select name="category" class="form-control">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="brand">Brand</label>
                            <select name="brand" class="form-control">
                                <option value="">Select Brand</option>
                                @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="text" name="price" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control" rows="4"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="image">Image URL</label>
                            <input type="text" name="imageURL" class="form-control">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-dark">Create</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- Modal for adding Products ends Here -->



    <!-- Products Listing Table starts here -->
    <div id="defaultTable" class="container-fluid mt-2">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-sm-10">
                <h3 class="alert alert-dark text-center">Products List</h3>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr class="alert alert-dark">
                            <th>S.No</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Brand</th>
                            <th>Price</th>
                            <th>Description</th>
                            <th>Image URL</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $startSNo = 1; // Starting value of S.No
                        @endphp
                        @foreach ($products as $product)
                        <tr>
                            <td>{{$startSNo++}}</td>
                            <td>{{$product->name}}</td>
                            <td>{{$product->category->name}}</td>
                            <td>{{$product->brand->name}}</td>
                            <td>₹{{ number_format($product->price, 2, '.', ',') }}</td>
                            <td>{{$product->description}}</td>
                            <td style="text-align: center;">
                                <a href="{{ asset($product->image) }}"><i class="fa-solid fa-image fa-lg"></i></a>
                            </td>
                            <td>
                                <a data-bs-toggle="modal" data-bs-target="#editModal{{$product->id}}">
                                    <i class="fa-regular fa-pen-to-square fa-lg ms-1" style="color: orange"></i>
                                </a>


                                {{-- <button type="button" class="btn btn-link" data-bs-toggle="modal"
                                    data-bs-target="#editModal{{$product->id}}">
                                    <i class="fa-regular fa-pen-to-square fa-lg" style="color: orange"></i>
                                </button> --}}


                                <a href="{{route('products.delete', $product->id)}}">
                                    <i class="fa-solid fa-trash-can fa-lg" style="color: red"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>
    <!-- Products Listing Table ends here -->


    <!-- Search Table starts here -->
    <div id="searchDiv" style="display: none;" class="container-fluid mt-2">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-sm-10">
                <h3 class="alert alert-dark text-center">Search Results</h3>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr class="alert alert-dark">
                            <th>S.No</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Brand</th>
                            <th>Price</th>
                            <th>Description</th>
                            <th>Image URL</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="searchResults">
                        @foreach ($products as $product)
                        <tr>
                            <td>{{$startSNo++}}</td>
                            <td>{{$product->name}}</td>
                            <td>{{$product->category->name}}</td>
                            <td>{{$product->brand->name}}</td>
                            <td>₹{{ number_format($product->price, 2, '.', ',') }}</td>
                            <td>{{$product->description}}</td>
                            <td style="text-align: center;">
                                <a href="{{ asset($product->image) }}"><i class="fa-solid fa-image fa-lg"></i></a>
                            </td>
                            <td>
                                <a data-bs-toggle="modal" data-bs-target="#editModal{{$product->id}}">
                                    <i class="fa-regular fa-pen-to-square fa-lg ms-1" style="color: orange"></i>
                                </a>


                                {{-- <button type="button" class="btn btn-link" data-bs-toggle="modal"
                                    data-bs-target="#editModal{{$product->id}}">
                                    <i class="fa-regular fa-pen-to-square fa-lg" style="color: orange"></i>
                                </button> --}}


                                <a href="{{route('products.delete', $product->id)}}">
                                    <i class="fa-solid fa-trash-can fa-lg" style="color: red"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>

    <!-- Search Table ends here -->



    <!-- Modal For update Products starts here -->
    @foreach ($products as $product)
    <div class="modal fade" id="editModal{{$product->id}}" tabindex="-1"
        aria-labelledby="editModalLabel{{$product->id}}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel{{$product->id}}">Edit Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('products.update', $product->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" value="{{ $product->name }}" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="category">Category</label>
                            <select name="category" class="form-control">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $product->cat_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="brand">Brand</label>
                            <select name="brand" class="form-control">
                                <option value="">Select Brand</option>
                                @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}" {{ $product->brand_id == $brand->id ? 'selected' :''}}>
                                    {{ $brand->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="text" name="price" value="{{ $product->price }}" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control"
                                rows="4">{{ $product->description }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="image">Image URL</label>
                            <input type="text" name="imageURL" value="{{ $product->image }}" class="form-control">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-dark">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <!-- Modal for update products ends here -->




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchForm = document.querySelector('form');
        const searchResultsDiv = document.getElementById('searchDiv');
        const searchResultsTable = document.getElementById('searchResults');
        const defaultTableDiv = document.getElementById('defaultTable');

        searchForm.addEventListener('submit', function (e) {
            e.preventDefault();
            const searchInput = document.querySelector('input[type="search"]');
            const searchValue = searchInput.value.trim().toLowerCase();
            const tableRows = document.querySelectorAll('tbody tr');
            const filteredRows = [];

            if (searchValue === '') {
                searchResultsDiv.style.display = 'none';
                defaultTableDiv.style.display = 'block';
                return;
            }

            for (let i = 0; i < tableRows.length; i++) {
                const rowData = tableRows[i].innerText.toLowerCase();
                if (rowData.includes(searchValue)) {
                    filteredRows.push(tableRows[i].cloneNode(true));
                }
            }

            if (filteredRows.length === 0) {
                searchResultsTable.innerHTML = '<tr><td colspan="8">No results found</td></tr>';
            } else {
                searchResultsTable.innerHTML = filteredRows.map(row => row.outerHTML).join('');
            }

            searchResultsDiv.style.display = 'block';
            defaultTableDiv.style.display = 'none';
        });
    });
</script>


</body>

</html>