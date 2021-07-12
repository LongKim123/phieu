 @extends('layouts.mainlayout')
 @section('css')
   
 <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
  .select2-selection__choice__display{
    color: white;
  }
  
</style>
@endsection
 @section('content')
  @include('partial.tittle',['name'=>'Edit User'])
  @if(!empty($message_error))
              <div class="alert alert-danger my-alert-danger" role="alert">
            {{$message_error}}
          </div>
            @endif
 <form action="{{route('users.update',['id'=>$user->id])}}" method="post">
 	@csrf
 	<div class="form-group">
    <label for="exampleInputEmail1">UserName</label>
    <input  value="{{$user->name}}" type="text" name="name" class="form-control @error('name') is-invalid @enderror"placeholder="Enter name">
    	
    
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input  value="{{$user->email}}" type="email" name="email" class="form-control   @error('email') is-invalid @enderror " id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
   
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1"> Old Password</label>
    <input  value="" type="password" name="old_password" class="form-control @error('old_password') is-invalid @enderror"  placeholder="Password" id="myInput">
    	
    	
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1"> New Password</label>
    <input  value="" type="password" name="password" class="form-control @error('password') is-invalid @enderror "  placeholder="Password" id="myInput1">
      
      
  </div>
  <div class="form-group">
    <label>Select Roles</label>
   <select class="form-select select2_init " name="role[]"  multiple aria-label="Default select example">
    
    @foreach($roles as $item)
     <option {{ $user_roles->contains('id',$item->id) ? 'selected' :''}} value="{{$item->id}}">{{$item->name}}</option>
    @endforeach
  
  </select>
    
  </div>
  <div class="form-group">
  	<input type="checkbox" onclick="myFunction()">Show Password Old
  		
  	</div>	
    <div class="form-group">
    <input type="checkbox" onclick="myFunction1()">Show Password New
      
    </div>
 
  <button type="submit" class=" m-3 btn btn-primary">Submit</button>
</form>
 @endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>

   $('.select2_init').select2({
      'placeholder':'Chon vai tro'
    })
</script>
<script>
  function myFunction1() {
  var x = document.getElementById("myInput1");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
@endsection