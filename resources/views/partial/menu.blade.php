<div class=" myDiv" >
  <ul class="nav nav-tabs nav-pills  justify-content-end">
  <li class="nav-item">
    <a class="nav-link " href="{{route('users.index')}}">User</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{route('roles.index')}}">Role</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Link</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Link1</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Link2</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Link3</a>
  </li>
  @if(Auth::check())
  <li class="nav-item dropdown">
 
    <a class="nav-link dropdown-toggle " data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">{{Auth::user()->name}}</a>
    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="{{route('logout')}}">Logout</a></li>
          </ul>
    
  </li>
 @else
    <li class="nav-item">
      <a class="nav-link " href="{{route('/')}}">Login</a>
   </li>
  @endif
  
</ul>
</div>


