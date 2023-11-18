@extends('backend.master')
@section('content')
    <main>
        <div class="px-4 container-fluid">
            <div class="card custom-card">
                <div class="card-header custom-card-header">
                    <i class="fas fa-table me-1"></i>
                    Product Table
                </div>

                @if(session()->has('success'))
                <div style="background-color: #f19066" class="mx-4 mt-3 alert alert-dark alert-dismissible fade show" role="alert">
                    <center>{{ session()->get('success') }}</center>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <div class="card-body">
                    <table id="datatablesSimple" class="table table-bordered table-hover custom-table">
                        <thead class="thead-dark">
                            <tr>
                                <th>SL</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Category/Subcategory</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                             @foreach ($products as  $product)
                                <tr>
                                   <td>{{ $loop->index+1 }}</td>
                                   <td>
                                      <img height="50" width="50" src="{{ asset('product/'.$product->image) }}" alt=""/><br/>
                                      <strong>Name:{{ $product->name }} </strong>
                                 </td>
                                   <td>
                                    <strong>Buy Price:{{ $product->buy_price }} </strong><br/>
                                    <strong>Sale Price:{{ $product->sale_price }} </strong>
                                  </td>
                                   <td>
                                    <strong>Category:{{ optional($product->category)->name ?? 'N/A' }} </strong><br/>
                                    <strong>Sub Category: {{ optional($product->subcategory)->name ?? 'N/A' }}</strong>
                                     </td>
                                   <td>
                                    <a href="{{ route('product.edit',$product->id) }}" class="btn btn-sm btn-info">Edit</a>
                                    <a href="{{ route('product.delete',$product->id) }}" class="btn btn-sm btn-danger">Delete</a>
                                  </td>
                               </tr>
                             @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection
