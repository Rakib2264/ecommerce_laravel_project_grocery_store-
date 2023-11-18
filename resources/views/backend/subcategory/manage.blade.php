@extends('backend.master')
@section('content')
    <main>
        <div class="container-fluid px-4">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    SubCategory Table
                </div>
                         @if(session()->has('success'))
                             <div class="alert alert-info">{{session()->get('success')}}</div>
                         @endif
                <div class="card-body">
                    <table id="datatablesSimple" class="table">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Category Name</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($subcategories as $subcategory)
                           
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $subcategory->category->name }}</td>
                                    <td>{{ $subcategory->name }}</td>
                                    <td>{{ $subcategory->slug }}</td>
                                    <td>
                                      <a href="{{route('subcategory.edit',$subcategory->id)}}" class="btn btn-sm btn-info">Edit</a>
                                      <a href="{{route('subcategory.delete',$subcategory->id)}}" class="btn btn-sm btn-danger">Delete</a>
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
 