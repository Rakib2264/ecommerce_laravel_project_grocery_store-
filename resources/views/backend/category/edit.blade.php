@extends('backend.master')
@section('content')

     <div class="container-fluid">
          <div class="col-md-12">
               <div class="card">
                   <div class="card-header">
                       <div class="card-title">Edit Caregory</div>
                       <div class="card-body">
                         @if(session()->has('success'))
                             <div class="alert alert-info">{{session()->get('success')}}</div>
                         @endif
                            <form action="{{route('category.update',$category->id)}}" method="post">
                              @csrf
                                 <div class="form-group">
                                      <label for="name">Name</label>
                                      <input value={{$category->name}} type="text" name="name" id="name" class="form-control" placeholder="Enter Name">
                                 </div>   
                                 <button type="submit" class="btn btn-sm btn-info">Save</button>
                            </form>
                       </div>
                   </div>
               </div>
          </div>
     </div>

@endsection