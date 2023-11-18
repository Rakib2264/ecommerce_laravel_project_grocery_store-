@extends('frontend.master')
@section('content')

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
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{$category->name}}<span class="caret"></span></a>
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
			<div class="w3l_banner_nav_right_banner3">
				<h3>Best Deals For New Products<span class="blink_me"></span></h3>
			</div>
			<div class="agileinfo_single">
				<h5>{{$product->name}}</h5>
				<div class="col-md-4 agileinfo_single_left text-center" >
					<img id="example"   src="{{asset('product/'.$product->image)}}" alt=" " class="img-responsive" />
				</div>
				<div class="col-md-8 agileinfo_single_right">
					<div class="rating1">
						<span class="starRating">
							<input id="rating5" type="radio" name="rating" value="5">
							<label for="rating5">5</label>
							<input id="rating4" type="radio" name="rating" value="4">
							<label for="rating4">4</label>
							<input id="rating3" type="radio" name="rating" value="3" checked>
							<label for="rating3">3</label>
							<input id="rating2" type="radio" name="rating" value="2">
							<label for="rating2">2</label>
							<input id="rating1" type="radio" name="rating" value="1">
							<label for="rating1">1</label>
						</span>
					</div>
					<div class="w3agile_description">
						<h4>Description :</h4>
						<p>{{$product->short_description}}</p>
					</div>
					<div class="snipcart-item block">
						<div class="snipcart-thumb agileinfo_single_right_snipcart">
							<h4>{{$product->sale_price}} &#x9F3;</h4>
						</div>
						<div class="snipcart-details agileinfo_single_right_details">
							<form action="{{route('addtocart')}}" method="post">
								@csrf
								<fieldset>	
								        <input type="number" name="qty" min="1" />					 
								        <input type="hidden" name="price" value="{{$product->sale_price}}" />
                        <input type="hidden" name="product_id" value="{{$product->id}}" />
                        
									<input type="submit" name="submit" value="Add to cart" class="button" />
								</fieldset>
							</form>
						</div>
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
@endsection