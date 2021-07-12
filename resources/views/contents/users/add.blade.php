 @extends('layouts.mainlayout')
 @section('content')
 @include('partial.tittle',['name'=>'Add User'])
  @if(!empty($message_error))
              <div class="alert alert-danger my-alert-danger" role="alert">
            {{$message_error}}
          </div>
            @endif
 <form action="{{route('users.store')}}" method="post">
 	@csrf
 	<div class="form-group">
    <label for="exampleInputEmail1">UserName</label>
    <input  value="{{old('name')}}" type="text" name="name" class="form-control @error('name') is-invalid @enderror"placeholder="Enter name">
    	@error('name')
          <div class=" alert alert-danger">
                {{$message}}
           </div>
        @enderror
    
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input  value="{{old('email')}}" type="email" name="email" class="form-control  @error('email') is-invalid @enderror " id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
   	@error('email')
          <div class=" alert alert-danger">
                {{$message}}
           </div>
        @enderror
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input  type="password" name="password" class="form-control  @error('password') is-invalid @enderror"  placeholder="Password" id="myInput">
    	@error('password')
          <div class=" alert alert-danger">
                {{$message}}
           </div>
        @enderror
    	
  </div>
  <div class="form-group">
  	<input type="checkbox" onclick="myFunction()">Show Password
  		
  	</div>	
 
  <button type="submit" class=" m-3 btn btn-primary">Submit</button>
</form>
 @endsection
