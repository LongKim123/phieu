 @extends('layouts.loginlayout')
 @section('content')
 @include('partial.tittle',['name'=>'Login User'])
 @if(!empty($error))
    <div class="alert alert-danger my-alert-danger" role="alert">
        {{$error}}
    </div>
  @endif
 <form action="{{route('login.check')}}" method="post">
 	@csrf
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
    <input  type="checkbox" name="remember_me" >Remember Me
  	<input style="margin-left:10%" type="checkbox" onclick="myFunction()">Show Password
  		
  	</div>	
 
  <button type="submit" class=" m-3 btn btn-primary">Submit</button>
</form>
 @endsection
