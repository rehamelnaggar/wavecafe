<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
						<div class="menu_section">
							<h3>General</h3>
							<ul class="nav side-menu">
								<li><a><i class="fa fa-users"></i> Users <span class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu">
										<li><a href="{{ route('admin.users') }}">Users List</a></li>
										<li><a href="{{ route('admin.addUser') }}">Add User</a></li>
									</ul>
								</li>
								<li><a><i class="fa fa-edit"></i> Categories <span class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu">
										<li><a href="{{ route('admin.addCategory') }}">Add Category</a></li>
										<li><a href="{{ route('admin.categories') }}">Categories List</a></li>
									</ul>
								</li>
								<li><a><i class="fa fa-desktop"></i> Beverages <span class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu">
										<li><a href="{{ route('admin.addBeverageForm') }}">Add Beverage</a></li>
										<li><a href="{{ route('admin.beverages') }}">Beverages List</a></li>
									</ul>
								</li>
								<li><a><i class="fa fa-desktop"></i> Messages <span class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu">
										<li><a href="{{ route('admin.contact') }}">Messages List</a></li>
									</ul>
								</li>
							</ul>
						</div>

					</div>