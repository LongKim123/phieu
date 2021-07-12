 @extends('layouts.mainlayout')
  @section('js')
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
   <script src="{{asset('users/index.js')}}"></script>
  @endsection
 @section('content')
@include('partial.tittle',['name'=>'List User'])
 <div class="col-sm-6">
 	<a href="{{route('users.create')}}" class="btn btn-success">Add</a>
 </div>
 <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">STT</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Password</th>
      <th>Ngày tạo</th>
      <th  scope="col">Roles</th>
      <th scope="col"> Action</th>
    </tr>
  </thead>
  <tbody>
  	@php
    $i=0;
    @endphp
    @foreach($list_user as $item)
    <tr>
      <th scope="row">{{$i++}}</th>
      <td>{{$item->name}}</td>
      <td>{{$item->email}}</td>
      <td>{{substr($item->password,0,30)}}</td>
      <td>{{$item->created_at}}</td>
      <td>
        @foreach($item->roles as $value)
        <button type="button" class="btn btn-primary btn-sm ">{{$value->name}}</button>
        @endforeach
      </td>
      <td><a href="{{route('users.edit',['id'=>$item->id])}}"class="btn btn-warning">Update</a>
      	<a data-url="{{route('users.delete',['id'=>$item->id])}}" class="btn btn-danger action_delete">Delete</a></td>
    </tr>
    @endforeach
   
  </tbody>
</table>


 @endsection