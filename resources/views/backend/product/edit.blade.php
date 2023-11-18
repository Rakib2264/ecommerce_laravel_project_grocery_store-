@extends('backend.master')
@section('content')
<div class="container-fluid">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Update Product</div>
            </div>
            <div class="card-body">
                @if(session()->has('success'))
                <div style="background-color: rgb(38, 173, 155)" class="mx-4 mt-3 alert alert-dark alert-dismissible fade show" role="alert">
                    <center>{{ session()->get('success') }}</center>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <form action="{{ route('product.update',$product->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="category_id">Category Name</label>
                        <select name="category_id" class="form-control" id="category_id">
                            <option selected disabled>Select A Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : ''}}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="sub_category_id">SubCategory Name</label>
                        <select name="sub_category_id" class="form-control" id="sub_category_id">
                            <option selected disabled>Select A SubCategory</option>
                            @foreach ($subcategories as $subcategory)
                                <option value="{{ $subcategory->id }}" {{ $product->category_id == $subcategory->id ? 'selected' : ''}}>{{ $subcategory->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="buy_price">Product</label>
                        <input type="text" name="name" value="{{ $product->name }}" id="buy_price" class="form-control"
                            placeholder="Product Name">
                    </div>
                    <div class="form-group">
                        <label for="buy_price">Buy Price</label>
                        <input type="text" name="buy_price" value="{{ $product->buy_price }}" id="buy_price" class="form-control"
                            placeholder="Enter Buy Price">
                    </div>

                    <div class="form-group">
                        <label for="sale_price">Sale Price</label>
                        <input type="text" name="sale_price" value="{{ $product->sale_price }}" id="sale_price" class="form-control"
                            placeholder="Enter Sale Price">
                    </div>

                    <div class="form-group">
                        <label for="short_description">Short Description</label>
                        <textarea name="short_description" rows="5" class="form-control">{{ $product->short_description }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="long_description">Long Description</label>
                        <textarea name="long_description" class="form-control" id="summernote">{{ $product->long_description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="image">Product Image</label>
                        <input type="file" name="image" id="image" class="form-control">
                        <img src="{{ asset('/product/'.$product->image) }}" height="70" width="70" alt="">
                    </div>
                    <button type="submit" class="btn btn-sm btn-info">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
