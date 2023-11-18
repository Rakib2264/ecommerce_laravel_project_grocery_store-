@extends('frontend.master')
@section('content')
<div class="products-breadcrumb">
		<div class="container">
			<ul>
				<li><i class="fa fa-home" aria-hidden="true"></i><a href="#">Home</a><span>|</span></li>
				<li>Checkout</li>
			</ul>
		</div>
	</div>

  <div class="banner">
		<div class="w3l_banner_nav_left">
		<nav class="navbar nav_bottom">
     <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header nav_2">
        <button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        </button>
       </div>
       <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
        <ul class="nav navbar-nav nav_1">
       @foreach($categories as $category)
           <li class="dropdown mega-dropdown active">
            <a href="{{route('categoryProducts',$category->slug)}}" >{{$category->name}}<span class="caret"></span></a>
            <div class="dropdown-menu mega-dropdown-menu w3ls_vegetables_menu">
              <div class="w3ls_vegetables">
                <ul>
                @foreach($category->subcategories as $subcategory)
                  <li><a href="vegetables.html">{{$subcategory->name}}</a></li>
                  @endforeach
                 </ul>
              </div>
            </div>
          </li>
          @endforeach
          
        </ul>
       </div><!-- /.navbar-collapse -->
    </nav>
		</div>
		<div class="w3l_banner_nav_right">
<!-- about -->
		<div class="privacy about">
			<h3>Chec<span>kout</span></h3>
			
	      <div class="checkout-right">
					<h4>Your shopping cart contains: <span>3 Products</span></h4>
				<table class="timetable_sub">
					<thead>
						<tr>
							<th>SL No.</th>	
							<th>Product</th>
							<th>Quality</th>						
							<th>Price</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
            @php
                $sum=0;
								$qty=0;
            @endphp
            @foreach($prducts as $key=>$prduct)
            <tr class="rem1">
						<td class="invert">{{$loop->index+1}}</td>
						<td class="invert-image"><a href=""><img src="{{asset('product/'.$prduct->products[0]->image)}}" alt=" " class="img-responsive"></a><br>
            {{$prduct->products[0]->name}}
             
          </td>
						<td class="invert">
							<form action="{{route('cartproductqtyupdate',$prduct->id)}}" method="post">
                @csrf
              <div class="quantity"> 
								<div class="quantity-select">                           
									<input type="number" name="qty" value="{{$totalQty=$prduct->qty}}">
                  <button type="submit" name="btn" class="btn btn-sm btn-info">Update</button>
								</div>
							</div>
              </form>
						</td>						
						<td class="invert">{{$total = $prduct->price * $prduct->qty}} &#2547;</td>
						<td class="invert">
							<div class="rem">
 								<a  href="{{route('productdeleteformcart',$prduct->id)}}"><div class="close1"> </div></a>
							</div>

						</td>
					</tr>
            @php
                $sum += $total;
                $qty += $totalQty;
            @endphp
            @endforeach
				</tbody>
      </table>
			</div>
			<div class="checkout-left">	
				<div class="col-md-4 checkout-left-basket">
					<h4>Continue to basket</h4>
					<ul>
						<li>Sub Total <i>-</i> <span>{{$sum}} &#2547;</span></li>
						<li>Grand Total <i>-</i> <span>{{$sum}} &#2547;</span></li>				 
					</ul>
				</div>
				<div class="col-md-8 address_form_agile">
					  <h4>Add a new Details</h4>

				<form action="{{route("confirmorder")}}" method="post" class="creditly-card-form agileinfo_form">
				@csrf				
				<input type="hidden" name="total_price" value="{{ $sum }}">	
<input type="hidden" name="total_qty" value="{{ $qty }}">	

@foreach($productsname as $product)
    <input type="hidden" name="product_name" value="{{ $product->name }}">	
    <input type="hidden" name="product_image" value="{{ $product->image }}">	
@endforeach


				<section class="creditly-wrapper wthree, w3_agileits_wrapper">
										<div class="information-wrapper">
											<div class="first-row form-group">
												<div class="controls">
													<label class="control-label">Full name: </label>
													<input class="billing-address-name form-control" type="text" name="name" placeholder="Full name">
												</div>
												<div class="w3_agileits_card_number_grids">
													<div class="w3_agileits_card_number_grid_left">
														<div class="controls">
															<label class="control-label">Mobile number:</label>
														    <input class="form-control" name="phone" type="text" placeholder="Mobile number">
														</div>
													</div>
													<div class="w3_agileits_card_number_grid_right">
														<div class="controls">
															<label class="control-label">Email: </label>
														 <input class="form-control" name="email" type="email" placeholder="Email">
														</div>
													</div>
													<div class="clear"> </div>
												</div>
												<div class="controls">
													<label class="control-label">Address: </label>
												 <textarea name="address" class="form-control" rows="5"></textarea>
												</div>
													 
											</div>
											<button type="submit" class="submit check_out">Confirm Order</button>
										</div>
									</section>
								</form>
									 
					</div>
			
				<div class="clearfix"> </div>
				
			</div>

		</div>
<!-- //about -->
		</div>
		<div class="clearfix"></div>
	</div>
<!-- //banner -->
@endsection