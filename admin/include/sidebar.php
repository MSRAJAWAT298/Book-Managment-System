<div class="col-md-4 col-lg-2 sidebar-offcanvas bg-light pl-0 mt-3" id="sidebar" role="navigation">
	<ul class="nav flex-column sticky-top pl-0 pt-5 mt-3">
		<li class="nav-item">
			<a class="nav-link" href="dasboard.php"><i class="fa fa-home fa-2x"> Dashboard</i>
			</a>
		</li><hr>  
		<li class="nav-item">
			<a class="nav-link" href="add_category.php"><i class="fa fa-plus"> Add Category</i>
			</a>
		</li><hr>
		<li class="nav-item">
			<a class="nav-link" href="add_books.php"><i class="fa fa-plus"> Add Books</i>
			</a>
		</li><hr>
				
		<li class="nav-item">
			<a class="nav-link" href="view_category.php"><i class="fa fa-list-alt"> View Category</i>
			</a>
		</li><hr>
		<li class="nav-item">
			<a class="nav-link" href="view_books.php"><i class="fa fa-book"> View Books</i>
			</a>
		</li><hr>
		<li class="nav-item">
			<a class="nav-link btn btn-outline-light bg-danger m-3 p-1 border" href="logout.php"> Logout
		    </a>
	    </li>
	</ul>
</div>
<!--/col-->
<!--scripts loaded here-->
<script>
  $(document).ready(function() {
    
  $('[data-toggle=offcanvas]').click(function() {
    $('.row-offcanvas').toggleClass('active');
  });
  
});
</script>
