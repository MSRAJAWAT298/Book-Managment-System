<?php
require_once 'admin/include/db.php';  
$tname = "book_category";
$user = new db();
$data = $user->select($tname);
?>
<div class="col-lg-3 col-sm-6 pd-2 m-4">
	<div id="accordion">
		<div class="card">
			<div class="card-header" id="headingOne">
				<h2 class="mb-0">
					Books Category
				</h2>
			</div>
			<div id="collapseOne" class="collapse show"
				aria-labelledby="headingOne" data-parent="#accordion">
				<div class="card-body">
					<ul class="nav nav-pills flex-column list-group ul">
		<?php foreach($data as $v){?>
					    <li class="nav-item">
							<a class="list-group-item font-weight-bold" 
							href="product_by_category.php?id=<?php echo $v['cat_id']?>"
							   title="<?php echo $v['cat_name']?>">
							   <?php echo $v['cat_name']?>
							</a>
						</li>
							<?php }?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
  
  <!--scripts loaded here-->
  
  <script>
  $(document).ready(function() {
    
  $('[data-toggle=offcanvas]').click(function() {
    $('.row-offcanvas').toggleClass('active');
  });
  
});
  </script>