<div class="agileits_header">
  <div class="w3l_offers">
    <a href="#">Today's special Offers !</a>
  </div>
  <div class="w3l_search">
    <form action="#">
      <input type="text" name="Product" value="Search a product..." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search a product...';}" required="">
      <input type="submit" value=" ">
    </form>
  </div>
  <div class="product_list_header"> 
  <a href="{{route('checkout')}}">
    <!-- <span>Count: {{count($carts)}}</span> -->
    <fieldset>               
     <input type="submit" name="submit"  value="View cart ={{count($carts)}}" class="button">
    </fieldset>
    </a>
   
                
          
    
  </div>
  <div class="w3l_header_right">
    <ul>
      <li class="dropdown profile_details_drop">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user" aria-hidden="true"></i><span class="caret"></span></a>
        <div class="mega-dropdown-menu">
          <div class="w3ls_vegetables">
            <ul class="dropdown-menu drp-mnu">
              <li><a href="login.html">Login</a></li> 
              <li><a href="login.html">Sign Up</a></li>
            </ul>
          </div>                  
        </div>	
      </li>
    </ul> 
  </div>
  <div class="w3l_header_right1">
    <h2><a href="mail.html">Contact Us</a></h2>
  </div>
  <div class="clearfix"> </div>
</div>
<!-- script-for sticky-nav -->
<script>
$(document).ready(function() {
   var navoffeset=$(".agileits_header").offset().top;
   $(window).scroll(function(){
    var scrollpos=$(window).scrollTop(); 
    if(scrollpos >=navoffeset){
      $(".agileits_header").addClass("fixed");
    }else{
      $(".agileits_header").removeClass("fixed");
    }
   });
   
});
</script>
<!-- //script-for sticky-nav -->
<div class="logo_products">
  <div class="container">
    <div class="w3ls_logo_products_left">
      <h1><a href="{{url('/')}}"><span>Grocery</span> Store</a></h1>
    </div>
    <div class="w3ls_logo_products_left1">
      <ul class="special_items">
        <li><a href="#">Events</a><i>/</i></li>
        <li><a href="#">About Us</a><i>/</i></li>
        <li><a href="#">Best Deals</a><i>/</i></li>
        <li><a href="#">Services</a></li>
      </ul>
    </div>
    <div class="w3ls_logo_products_left1">
      <ul class="phone_email">
        <li><i class="fa fa-phone" aria-hidden="true"></i>(+0123) 234 567</li>
        <li><i class="fa fa-envelope-o" aria-hidden="true"></i><a href="mailto:store@grocery.com">store@grocery.com</a></li>
      </ul>
    </div>
    <div class="clearfix"> </div>
  </div>
</div>