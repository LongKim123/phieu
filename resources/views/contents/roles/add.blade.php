@extends('layouts.mainlayout')
 @section('content')
 @include('partial.tittle',['name'=>'Add Role'])
  @if(!empty($message_error))
              <div class="alert alert-danger my-alert-danger" role="alert">
            {{$message_error}}
          </div>
 @endif
<form action="{{route('roles.store')}}" method="post">
 	@csrf
 	<div class="form-group">
    <label for="exampleInputEmail1">Name</label>
    <input  value="{{old('name')}}" type="text" name="name" class="form-control"placeholder="Enter name">
    
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Display Name</label>
    <textarea   class="form-control "  value="{{old('display_name')}}" name="display_name"></textarea>
    
  </div>

 
  <button type="submit" class=" m-3 btn btn-primary">Submit</button>
</form>
 @endsection