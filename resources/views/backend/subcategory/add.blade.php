@extends('backend.master')
@section('content')

     <div class="container-fluid">
          <div class="col-md-12">
               <div class="card">
                   <div class="card-header">
                       <div class="card-title">Add New SubCategory</div>
                       <div class="card-body">
                         @if(session()->has('success'))
                             <div class="alert alert-info">{{session()->get('success')}}</div>
                         @endif
                            <form action="{{route('subcategory.store')}}" method="post">
                              @csrf
                                 <div class="form-group">
                                      <label for="name">Name</label>
                                      <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name">
                                 </div>   

                                 <div class="form-group">
                                   <label for="name">Category Name</label>
                                   <select name="category_id" class="form-control">
                                        <option selected disabled>Select A Category</option>
                                        @foreach ($catagories as $catagory)
                                        <option value="{{ $catagory->id }}">{{ $catagory->name }}</option>
                                        @endforeach  
                                   </select>
                               </div> 
                                 <button type="submit" class="btn btn-sm btn-info">Save</button>
                            </form>
                       </div>
                   </div>
               </div>
          </div>
     </div>

@endsection