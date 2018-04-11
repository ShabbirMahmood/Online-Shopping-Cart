<!-- navigation -->
<nav class="navbar navbar-default">
 <div class="container-fluid">
   <div class="navbar-header">
     <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
       <span class="icon-bar"></span>
       <span class="icon-bar"></span>
       <span class="icon-bar"></span>
     </button>
     <a class="navbar-brand" href="{{ route('product.index') }}"> <span class="glyphicon glyphicon-home" aria-hidden="true"></span> Online Book Shop</a>
   </div>
   <div class="collapse navbar-collapse" id="myNavbar">
     <ul class="nav navbar-nav navbar-right">

       <li >
           <a href="{{ route('product.shoppingcart') }}">
               <i class="fa fa-shopping-cart" aria-hidden="true"></i> Shopping Cart
               <span class="badge">{{ Session::has('cart') ? Session::get('cart')->totalQty : '' }}</span>
           </a>
       </li>
         @if(Auth::check() && Auth::user()->role == "admin")
         <li class="dropdown">
             <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" >
                 <i class="fa fa-user" aria-hidden="true"></i>
                 Admin Action
                 <span class="caret"></span>
             </a>
             <ul class="dropdown-menu">

                     <li><a href="{{ route('AddProduct') }}"><span class="glyphicon glyphicon-plus-sign"></span> Add Product</a></li>

                     <li role="separator" class="divider"><a href="#"></a></li>
                     <li><a href="{{ route('AddCategory') }}"><span class="glyphicon glyphicon-plus-sign"></span> Add Category</a></li>

                     <li role="separator" class="divider"><a href="#"></a></li>
                     <li><a href="{{ route('AllOrder') }}"><span class="glyphicon glyphicon-folder-open"></span> Show Orders</a></li>


             </ul>
         </li>
         @endif

       <li class="dropdown">
         <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" >
           <i class="fa fa-user" aria-hidden="true"></i>
           User Account
           <span class="caret"></span>
         </a>
         <ul class="dropdown-menu">
           @if(Auth::check())
             <li><a href="{{ route('user.profile') }}"><span class="glyphicon glyphicon-user"></span> User Profile</a></li>

             <li role="separator" class="divider"><a href="#"></a></li>
             <li><a href="{{ route('user.logout') }}"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
           @else
             <li><a href="{{ route('user.signup') }}"><span class="glyphicon glyphicon-log-out"></span> Sign Up</a></li>
             <li><a href="{{ route('user.signin') }}"><span class="glyphicon glyphicon-log-in"></span> Sign In</a></li>
           @endif
         </ul>
       </li>
     </ul>
   </div>
 </div>
</nav>

<!-- end navigation -->
