 @extends('layouts.mainlayout')
 @section('js')
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
   <script src="{{asset('users/index.js')}}"></script>
  @endsection
 @section('content')
  @include('partial.tittle',['name'=>'List Role'])
<div class="col-sm-6">
 	<a href="{{route('roles.create')}}" class="btn btn-success">Add</a>
 </div>
 <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">STT</th>
      <th scope="col">Name</th>
      <th scope="col">Display Name</th>
     
      <th scope="col"> Action</th>
    </tr>
  </thead>
  <tbody>
  	@php
    $i=0;
    @endphp
    @foreach($list_role as $item)
    <tr>
      <th scope="row">{{$i++}}</th>
      <td>{{$item->name}}</td>
      <td>{{$item->display_name}}</td>
     
      <td><a href=""class="btn btn-warning">Update</a>
      	<a data-url="{{route('roles.delete',['id'=>$item->id])}}" class="btn btn-danger action_delete">Delete</a></td>
    </tr>
    @endforeach
   
  </tbody>
</table>


 @endsection