<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/favicon.png">
    <title>
      Welcome to FlatShop
    </title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic,500,700,500italic,100italic,100' rel='stylesheet' type='text/css'>
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen"/>
    <link href="css/style.css" rel="stylesheet" type="text/css">

     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js" type="text/javascript"></script>
    <!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js">
</script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js">
</script>
<![endif]-->
  </head>
  <body>
    <div class="wrapper">
      <div class="header">
        <div class="container">
          <div class="row">
            <div class="col-md-2 col-sm-2">
              <div class="logo">
                <a href="/">
                  <img src="images/logo.png" alt="FlatShop">
                </a>
              </div>
            </div>
            <div class="col-md-10 col-sm-10">
              <div class="header_top">
                <div class="row">
                  <div class="col-md-3">
                    <ul class="option_nav">
                      <li class="dorpdown">
                        <a href="#">
                          Eng
                        </a>
                        <ul class="subnav">
                          <li>
                            <a href="#">
                              Eng
                            </a>
                          </li>
                          <li>
                            <a href="#">
                              Vns
                            </a>
                          </li>
                          <li>
                            <a href="#">
                              Fer
                            </a>
                          </li>
                          <li>
                            <a href="#">
                              Gem
                            </a>
                          </li>
                        </ul>
                      </li>
                      <li class="dorpdown">
                        <a href="#">
                          USD
                        </a>
                        <ul class="subnav">
                          <li>
                            <a href="#">
                              USD
                            </a>
                          </li>
                          <li>
                            <a href="#">
                              UKD
                            </a>
                          </li>
                          <li>
                            <a href="#">
                              FER
                            </a>
                          </li>
                        </ul>
                      </li>
                    </ul>
                  </div>
                  <div class="col-md-6">
                    <ul class="topmenu">
                      <li>
                        <a href="#">
                          About Us
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          News
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          Service
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          Recruiment
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          Media
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          Support
                        </a>
                      </li>
                    </ul>
                  </div>
                  <div class="col-md-3">
                    <ul class="usermenu">
                       @if(Auth::check())
                          <li><a href="register={{Auth::user()->userID}}" class="log">{{Auth::user()->username}}</a></li> 
                          <li><a href="/logout" class="reg" >LogOut</a></li>
                       @else
                          <li><a href="login" class="log">Login</a></li>
                          <li><a href="register" class="reg">Register</a></li>
                       @endif     
                    </ul>
                  </div>
                </div>
              </div>
              <div class="clearfix">
              </div>
              <div class="header_bottom">
                <ul class="option">
                  <li id="search" class="search">
                    <form>
                      <input class="search-submit" type="submit" value="">
                      <input class="search-input" placeholder="Enter your search term..." type="text" value="" name="search">
                    </form>
                  </li>
                  <li class="option-cart">
                    <a href="#" class="cart-icon">cart <span class="cart_no">{{Cookie::get('amount') < 10 ? '0'.Cookie::get('amount') : Cookie::get('amount')}}</span></a>
                    <ul class="option-cart-item"> 
                       <div class="list-order">
                          <?php    
                             if(Cookie::get('amount') < 4)                                                         
                                $limit = Cookie::get('amount');
                             else
                                $limit = 3;
                             $ls_order = App\Order::where('userID',Auth::check() ? Auth::id() : Cookie::get('user_ip'))->where('isActive',1)->orderBy('orderID','desc')->limit($limit)->get();                                             
                             $total = 0;
                             foreach($ls_order as $order){
                                $prd = App\Product::find($order->productID);
                                $total+= $prd->price;
                                ?>
                                   <li>
                                      <div class="cart-item"><div class="image"><img src="{{$prd->pictures}}" alt=""></div>
                                         <div class="item-description">
                                            <p class="name">{{$prd->productname}}</p>
                                            <p>Size: <span class="light-red">One size</span><br>Quantity: <span class="light-red">01</span></p>
                                         </div>
                                         <div class="right"><p class="price" style="margin-top: -3em">${{$prd->price}}.00</p>
                                            <a href="/delete-order?id={{$order->orderID}}" class="remove"><img src="images/remove.png" alt="remove"></a>
                                         </div>
                                      </div>
                                   </li>
                                <?php
                             }                                                    
                          ?>                                     
                       </div>     
                       <div class="total-cart">
                          @if(count($ls_order) > 0)                                  
                             <li><span class="total" style="margin-left: 56px;padding-top: 0px">Total <strong id="total">${{$total}}</strong></span><button class="login" onClick="location.href='/cart'" style="margin-top: 8px;float: right;">See All</button></li>
                          @else
                             <li>Bạn Chưa Order Sản Phẩm Nào.</li>
                          @endif
                       </div>                                                               
                    </ul>
                 </li>
                </ul>
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">
                      Toggle navigation
                    </span>
                    <span class="icon-bar">
                    </span>
                    <span class="icon-bar">
                    </span>
                    <span class="icon-bar">
                    </span>
                  </button>
                </div>
                <div class="navbar-collapse collapse">
                  <ul class="nav navbar-nav">
                    <li class="active dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        Home
                      </a>
                      <div class="dropdown-menu">
                        <ul class="mega-menu-links">
                          <li>
                            <a href="/">
                              home
                            </a>
                          </li>
                          <li>
                            <a href="home2">
                              home2
                            </a>
                          </li>
                          <li>
                            <a href="home3">
                              home3
                            </a>
                          </li>
                          <li>
                            <a href="productlitst">
                              Productlitst
                            </a>
                          </li>
                          <li>
                            <a href="productgird">
                              Productgird
                            </a>
                          </li>
                          <li>
                            <a href="details">
                              Details
                            </a>
                          </li>
                          <li>
                            <a href="cart">
                              Cart
                            </a>
                          </li>
                          <li>
                            <a href="checkout">
                              CheckOut
                            </a>
                          </li>
                          <li>
                            <a href="register">
                              CheckOut2
                            </a>
                          </li>
                          <li>
                            <a href="contact">
                              contact
                            </a>
                          </li>
                        </ul>
                      </div>
                    </li>
                    <li>
                      <a href="productgird">
                        men
                      </a>
                    </li>
                    <li>
                      <a href="productlitst">
                        women
                      </a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        Fashion
                      </a>
                      <div class="dropdown-menu mega-menu">
                        <div class="row">
                          <div class="col-md-6 col-sm-6">
                            <ul class="mega-menu-links">
                              <li>
                                <a href="productgird">
                                  New Collection
                                </a>
                              </li>
                              <li>
                                <a href="productgird">
                                  Shirts & tops
                                </a>
                              </li>
                              <li>
                                <a href="productgird">
                                  Laptop & Brie
                                </a>
                              </li>
                              <li>
                                <a href="productgird">
                                  Dresses
                                </a>
                              </li>
                              <li>
                                <a href="productgird">
                                  Blazers & Jackets
                                </a>
                              </li>
                              <li>
                                <a href="productgird">
                                  Shoulder Bags
                                </a>
                              </li>
                            </ul>
                          </div>
                          <div class="col-md-6 col-sm-6">
                            <ul class="mega-menu-links">
                              <li>
                                <a href="productgird">
                                  New Collection
                                </a>
                              </li>
                              <li>
                                <a href="productgird">
                                  Shirts & tops
                                </a>
                              </li>
                              <li>
                                <a href="productgird">
                                  Laptop & Brie
                                </a>
                              </li>
                              <li>
                                <a href="productgird">
                                  Dresses
                                </a>
                              </li>
                              <li>
                                <a href="productgird">
                                  Blazers & Jackets
                                </a>
                              </li>
                              <li>
                                <a href="productgird">
                                  Shoulder Bags
                                </a>
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </li>
                    <li>
                      <a href="productgird">
                        gift
                      </a>
                    </li>
                    <li>
                      <a href="productgird">
                        kids
                      </a>
                    </li>
                    <li>
                      <a href="productgird">
                        blog
                      </a>
                    </li>                    
                    <li>
                      <a href="contact">
                        contact us
                      </a>
                    </li>
					<li><a class="manager">manager</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        
         <script type="text/javascript">
            $(document).ready(function(){
               $(document).on('click','.manager',function(){                  
                  var type = <?php echo Cookie::get('login') ?>;                       
                  if(type == 0){
                     if(confirm('Bạn có muốn đăng nhập?')){
                        document.location = '/login';   
                     }
                  }else{
                     document.location = '/manager';
                  }
               });
            });                   
         </script>
        <div class="clearfix">
        </div>
        <div class="page-index">
          <div class="container">
            <p>
              Home - Contact us
            </p>
          </div>
        </div>
      </div>
      <div class="clearfix">
      </div>
      <div class="container_fullwidth">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <h5 class="title contact-title">
                Contact Us
              </h5>
              <div class="clearfix">
              </div>
              <div class="map">                
                <iframe width="600" height="350" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=place_id:EkAxNDAgUGjDuW5nIEtob2FuZywgVHJ1bmcgVsSDbiwgVOG7qyBMacOqbSwgSMOgIE7hu5lpLCBWaeG7h3QgTmFt&key=AIzaSyAhSN8x6hUdyayCr7o7SV7_OwBE8QpLU84" allowfullscreen></iframe>
              </div>
              <div class="clearfix">
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="contact-infoormation">
                    <h5>
                      Contact Info
                    </h5>
                    <p>
                      Lorem ipsum dolor sit amet, consectetur ad ipis cing elit. Suspendisse at sapien mascsa. Lorem ipsum dolor sit amet, consectetur se adipiscing elit. Sed fermentum, sapien scele risque volutp at tempor, lacus est sodales massa, a hendrerit dolor slase turpis non mi. 
                    </p>
                    <ul>
                      <li>
                        <span class="icon">
                          <img src="images/message.png" alt="">
                        </span>
                        <p>
                          contact@michaeldesign.me
                          <br>
                          support@michaeldesign.me
                        </p>
                      </li>
                      <li>
                        <span class="icon">
                          <img src="images/phone.png" alt="">
                        </span>
                        <p>
                          084. 93 668 2236
                          <br>
                          084. 93 668 6789
                        </p>
                      </li>
                      <li>
                        <span class="icon">
                          <img src="images/address.png" alt="">
                        </span>
                        <p>
                          No.86 ChuaBoc St, DongDa Dt,
                          <br>
                          Hanoi, Vietnam
                        </p>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="ContactForm">
                    <h5>
                      Contact Form
                    </h5>
                    <form>
                      <div class="row">
                        <div class="col-md-6">
                          <label>
                            Your Name 
                            <strong class="red">
                              *
                            </strong>
                          </label>
                          <input class="inputfild" type="text" name="">
                        </div>
                        <div class="col-md-6">
                          <label>
                            Your Email
                            <strong class="red">
                              *
                            </strong>
                          </label>
                          <input class="inputfild" type="email" name="">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <label>
                            Your Message 
                            <strong class="red">
                              *
                            </strong>
                          </label>
                          <textarea class="inputfild" rows="8" name="">
                          </textarea>
                        </div>
                      </div>
                      <button class="pull-right">
                        Send Message
                      </button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="clearfix">
          </div>
          <div class="our-brand">
            <h3 class="title">
              <strong>
                Our 
              </strong>
              Brands
            </h3>
            <div class="control">
              <a id="prev_brand" class="prev" href="#">
                &lt;
              </a>
              <a id="next_brand" class="next" href="#">
                &gt;
              </a>
            </div>
            <ul id="braldLogo">
              <li>
                <ul class="brand_item">
                  <li>
                    <a href="#">
                      <div class="brand-logo">
                        <img src="images/envato.png" alt="">
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="brand-logo">
                        <img src="images/themeforest.png" alt="">
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="brand-logo">
                        <img src="images/photodune.png" alt="">
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="brand-logo">
                        <img src="images/activeden.png" alt="">
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="brand-logo">
                        <img src="images/envato.png" alt="">
                      </div>
                    </a>
                  </li>
                </ul>
              </li>
              <li>
                <ul class="brand_item">
                  <li>
                    <a href="#">
                      <div class="brand-logo">
                        <img src="images/envato.png" alt="">
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="brand-logo">
                        <img src="images/themeforest.png" alt="">
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="brand-logo">
                        <img src="images/photodune.png" alt="">
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="brand-logo">
                        <img src="images/activeden.png" alt="">
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="brand-logo">
                        <img src="images/envato.png" alt="">
                      </div>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="clearfix">
      </div>
      <div class="footer">
        <div class="footer-info">
          <div class="container">
            <div class="row">
              <div class="col-md-3">
                <div class="footer-logo">
                  <a href="#">
                    <img src="images/logo.png" alt="">
                  </a>
                </div>
              </div>
              <div class="col-md-3 col-sm-6">
                <h4 class="title">
                  Contact 
                  <strong>
                    Info
                  </strong>
                </h4>
                <p>
                  No. 08, Nguyen Trai, Hanoi , Vietnam
                </p>
                <p>
                  Call Us : (084) 1900 1008
                </p>
                <p>
                  Email : michael@leebros.us
                </p>
              </div>
              <div class="col-md-3 col-sm-6">
                <h4 class="title">
                  Customer
                  <strong>
                    Support
                  </strong>
                </h4>
                <ul class="support">
                  <li>
                    <a href="#">
                      FAQ
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      Payment Option
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      Booking Tips
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      Infomation
                    </a>
                  </li>
                </ul>
              </div>
              <div class="col-md-3">
                <h4 class="title">
                  Get Our 
                  <strong>
                    Newsletter 
                  </strong>
                </h4>
                <p>
                  Lorem ipsum dolor ipsum dolor.
                </p>
                <form class="newsletter">
                  <input type="text" name="" placeholder="Type your email....">
                  <input type="submit" value="SignUp" class="button">
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="copyright-info">
          <div class="container">
            <div class="row">
              <div class="col-md-6">
                <p>
                  Copyright © 2012. Designed by 
                  <a href="#">
                    Michael Lee
                  </a>
                  . All rights reseved
                </p>
              </div>
              <div class="col-md-6">
                <ul class="social-icon">
                  <li>
                    <a href="#" class="linkedin">
                    </a>
                  </li>
                  <li>
                    <a href="#" class="google-plus">
                    </a>
                  </li>
                  <li>
                    <a href="#" class="twitter">
                    </a>
                  </li>
                  <li>
                    <a href="#" class="facebook">
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Bootstrap core JavaScript==================================================-->
    <script type="text/javascript" src="js/jquery-1.10.2.min.js">
    </script>
    <script type="text/javascript" src="js/bootstrap.min.js">
    </script>
    <script defer src="js/jquery.flexslider.js">
    </script>
    <script type="text/javascript" src="js/jquery.carouFredSel-6.2.1-packed.js">
    </script>
    <script type="text/javascript" src="js/script.min.js" >
    </script>
  </body>
</html>