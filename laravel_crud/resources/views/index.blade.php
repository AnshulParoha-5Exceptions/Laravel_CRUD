
@extends('layouts.app')

@section('title', 'Home')


@section('search')
{{-- <form class="d-flex" action="" method="">
    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-secondary" type="button"><i class="fa-solid fa-magnifying-glass fa-lg mt-3"></i></button>
</form> --}}
<input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" id="searchInput">
@endsection


@section('content')
<div class="container">
    
    <div class="row">
        <div class="col-lg-4">
            <h3 class="text-center alert alert-secondary mt-3">{{ $product->id ? 'Update Product' : 'Create Product' }}</h3>
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{session('error')}}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
            @endif
            <form method="POST" enctype="multipart/form-data" 
            action="{{ $product->id ? route('products.edit', ['p_id' => $product->id]) : route('products.create') }}">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <select name="category" class="form-control">
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $category->id == old('category', $product->cat_id) ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="brand">Brand</label>
                    <select name="brand" class="form-control">
                        <option value="">Select Brand</option>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}" {{ $brand->id == old('brand', $product->brand_id) ? 'selected' : '' }}>{{ $brand->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="text" name="price" class="form-control" value="{{ old('price', $product->price) }}">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control" rows="4">{{ old('description', $product->description) }}</textarea>
                </div>
                <div class="form-group">
                    <label for="image">Image URL</label>
                    <input type="text" name="imageURL" class="form-control" value="{{ old('imageURL', $product->image) }}">
                </div>
                <div class="form-group">   
                    <button type="submit" class="btn btn-dark mt-2">{{ $product->id ? 'Update' : 'Create' }}</button>
                    <a href="/" class="btn btn-danger mt-2" {{ $product->id ? 'Cancel' : 'hidden' }}>{{ $product->id ? 'Cancel' : '' }}</a>
                </div>
            </form>
        </div>
        
        <div class="col-lg-8">
            <h3 class="text-center alert alert-secondary mt-3">Product List</h3>
            <table class="table table-bordered table-hover">
                <thead class="alert alert-success">
                    <tr>
                        <th>S.No.</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Brand</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{session('success')}}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                @endif
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
                                {{-- <img src="{{$product->image}}" alt="{{$product->name}}"  style="max-width: 100px; height: auto;"> --}}
                                {{-- <img src="{{ asset($product->image) }}" alt="{{$product->name}}" style="max-width: 50px; height: auto;"> --}}
                                <a href="{{ asset($product->image) }}"><i class="fa-solid fa-image fa-lg"></i></a>
                            </td>
                            <td>
                                <a href="{{ route('products.edit', $product->id) }}"><i class="fa-regular fa-pen-to-square fa-lg ms-1"></i></a>
                                
                                <a href="{{ route('products.delete', $product->id) }}"><i class="fa-solid fa-trash-can fa-lg"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>    
            </table>
        </div>
    </div>
</div>

@endsection


