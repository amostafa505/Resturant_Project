    <!-- Navigation
    ==========================================-->
    <nav id="menu" class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span> <span class="icon-bar">
                    </span> <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">Touché</a>
            </div>
            
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{route('index')}}" class="page-scroll">Home</a></li>
                    <li><a href="{{route('menu')}}" class="page-scroll">Menu</a></li>
                    <li><a href="{{route('gallary')}}" class="page-scroll">Gallery</a></li>
                    <li><a href="{{route('chef')}}" class="page-scroll">Chefs</a></li>
                    <li><a href="{{route('contact')}}" class="page-scroll">Contact</a></li>
                    {{-- To Show the Cart Icon if there is an item in the cart --}}
                    {{-- @if(session()->has('cart')) --}}
                    <li><a href="{{route('show.cart')}}" class="page-scroll"><span class="fa fa-shopping-cart" aria-hidden="true" id="cartqty"> My Cart ({{ session()->has('cart') ? session()->get('cart')->totalQty : '0'}})</span></a></li>
                    {{-- @endif --}}
                    {{-- To Show the User name and a dropdown menu with a logout link if there is a user signed in --}}
                    @if(Auth::user())
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" style="background-color: transparent" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} 
                            {{-- <span class="caret"></span> --}}
                        </a>
                        
                        <div class="dropdown-menu dropdown-menu-right" style="background-color: #72a411; font-weight:800; text-align: center;" aria-labelledby="navbarDropdown">
                            <a href="{{route('user.profile',Auth()->check()? Auth()->user()->id : '')}}"class="dropdown-item nav-link" style="display: block ; color:white;" >Profile</a>
                            <hr style="height: 2px;position: relative;margin:0; width:100%">
                            <a class="dropdown-item nav-link " href="{{route('show.order',Auth()->check()? Auth()->user()->id : '')}}" style="display: block ;color:white ;">Orders</a>
                            <hr style="height: 2px;position: relative;margin:0; width:100%">
                            <a class="dropdown-item" style="color:white ;" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </a>
                            
                            
                        </div>
                    </li>
                    @endif
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
    </nav>