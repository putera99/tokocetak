<nav class="main_nav">
	<div class="container">
		<div class="row">
			<div class="col">
				<div class="main_nav_content d-flex flex-row">
					<!-- Categories Menu -->
					<div class="cat_menu_container">
						<div class="cat_menu_title d-flex flex-row align-items-center justify-content-start">
							<div class="cat_burger"><span></span><span></span><span></span></div>
							<div class="cat_menu_text">categories</div>
						</div>
						@if($prodCategories)
						<ul class="cat_menu">
							@foreach($prodCategories as $categories)
								<?php 
									$productData = \App\models\Products::where('ProductCategoryID', $categories->ID)
									->where('Status',1)->get();
								?>
								@if($productData->count())
									<li class="hassubs">
										<a href="#">{{$categories->Name}}<i class="fas fa-chevron-right"></i></a>
										<ul>
											@foreach($productData as $products)
												<li id="prod{{$products->ID}}" name="{{$products->ProductName}}" value="{{$products->ProductName}}">
												<a href="{!! route('product', ['cat'=>str_replace(' ','-',strtolower($categories->Name)),'prodName'=>str_replace(' ','-',strtolower($products->ProductName))]) !!}">{{$products->ProductName}}
													<i class="fas fa-chevron-right"></i>
												</a>
												</li>
											@endforeach
										</ul>
									</li>
								@else
								<li id="cat{{$categories->ID}}" name="{{$categories->Name}}" value="{{$categories->Name}}"><a href="#">{{$categories->Name}}<i class="fas fa-chevron-right ml-auto"></i></a></li>
								@endif
							@endforeach
						</ul>
						@endif
					</div>

					<!-- Main Nav Menu -->
					@if($dataMenu)
					<div class="main_nav_menu ml-auto">
						<ul class="standard_dropdown main_nav_dropdown">
							@foreach($dataMenu as $menu)
								<?php
									$dataSubMenu = \App\models\TSubMenu::where('TMenuID',$menu->TMenuID)
									->where('Status',1)->get();
								?>
								@if($dataSubMenu->count())
								<li class="hassubs">
									<a href="#">{{$menu->MenuName}}<i class="fas fa-chevron-down"></i></a>
									<ul>
										@foreach($dataSubMenu as $subMenu)
											<li id="subMenu{{$subMenu->TSubMenuID}}" name="{{$subMenu->SubMenuName}}" value="{{$subMenu->SubMenuName}}"><a href="#">{{$subMenu->SubMenuName}}<i class="fas fa-chevron-down"></i></a></li>
										@endforeach
									</ul>
								</li>
								@else
								<li id="menu{{$menu->TMenuID}}" name="{{$menu->MenuName}}" value="{{$menu->MenuName}}">
									@if($menu->URLKey!='#')	
									<a href="{{route($menu->URLKey)}}">{{$menu->MenuName}}<i class="fas fa-chevron-down"></i></a>
									@else
									<a href="{{ url('/') }}">{{$menu->MenuName}}<i class="fas fa-chevron-down"></i></a>
									@endif
								</li>
								@endif
							@endforeach
						</ul>
					</div>
					@endif
					<!-- Menu Trigger -->

					<div class="menu_trigger_container ml-auto">
						<div class="menu_trigger d-flex flex-row align-items-center justify-content-end">
							<div class="menu_burger">
								<div class="menu_trigger_text">menu</div>
								<div class="cat_burger menu_burger_inner"><span></span><span></span><span></span></div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</nav>
<!-- Menu -->

<div class="page_menu">
	<div class="container">
		<div class="row">
			<div class="col">
				
				<div class="page_menu_content">
					
					<div class="page_menu_search">
						<form action="#">
							<input type="search" required="required" class="page_menu_search_input" placeholder="Search for products...">
						</form>
					</div>
					@if($dataMenu)
						<ul class="page_menu_nav">
						@foreach($dataMenu as $menu)
							<?php
								$dataSubMenu = \App\models\TSubMenu::where('TMenuID',$menu->TMenuID)
								->where('Status',1)->get();
							?>
							@if($dataSubMenu->count())
							<li class="page_menu_item has-children">
								<a href="#">{{$menu->MenuName}}<i class="fa fa-angle-down"></i></a>
								<ul class="page_menu_selection">	
									@foreach($dataSubMenu as $subMenu)
									<li id="subMenu{{$subMenu->TSubMenuID}}" name="{{$subMenu->SubMenuName}}" value="{{$subMenu->SubMenuName}}"><a href="#">{{$subMenu->SubMenuName}}<i class="fas fa-chevron-down"></i></a></li>
									@endforeach
								</ul>
							</li>
							@else
								<li class="page_menu_item" id="menu{{$menu->TMenuID}}" name="{{$menu->MenuName}}" value="{{$menu->MenuName}}">
									@if($menu->URLKey!='#')	
									<a href="{{route($menu->URLKey)}}">{{$menu->MenuName}}<i class="fas fa-chevron-down"></i></a>
									@else
									<a href="{{ url('/') }}">{{$menu->MenuName}}<i class="fas fa-chevron-down"></i></a>
									@endif
								</li>
								@endif
							
						@endforeach
						</ul>
					@endif
					
					<div class="menu_contact">
						<div class="menu_contact_item"><div class="menu_contact_icon"><img src="{{asset('images/phone_white.png')}}" alt=""></div>+38 068 005 3570</div>
						<div class="menu_contact_item"><div class="menu_contact_icon"><img src="{{asset('images/mail_white.png')}}" alt=""></div><a href="mailto:fastsales@gmail.com">fastsales@gmail.com</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>		