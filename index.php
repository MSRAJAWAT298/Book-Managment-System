<?php 
require_once 'admin/include/db.php';
require_once 'path_info.php';
require_once 'header.php';
$tname = "books";
$user = new db();
$books = $user->select($tname);
/*echo "<pre>";
print_r($data);exit;*/

/////////////search function////////////////
if (isset($_POST['search_name'])) {
    $search = $_POST['search_name'];

	$condtion = " AND book_name LIKE '%$search'";
    $searchdata=$user->select($tname, $condtion);
	/*echo "<pre>";
		echo $search;
	print_r($searchdata);
	exit;*/
	if(count($searchdata)){
	foreach($searchdata as $v){
    echo "<div class='col-lg-4 col-md-6 mb-4'>
            <div class='card h-100'>
                <a href='#'>
			       <img class='img-fluid card-img-top w-100' 
						src='images/books/{$v['book_id']}/{$v['small_pic']}' 
				       alt='{$v['book_name']}' > 
				</a>
            <div class='card-body'>
                <h4 class='card-title'>
                  <a href='#'>{$v['book_name']}</a>
                </h4>
                <p class='card-text'>{$v['short_desc']}</p>
              </div>
              <div class='card-footer'>
                <small class='text-muted'>★ ★ ★ ★ ☆</small>
              </div>
            </div>
          </div>";
	  }
	}else{echo "Sorry! No result found"; exit;}
    exit;
}
?>

<body>
  <?php require_once 'navbar.php';
		require_once 'main_containt.php';
  ?>

<div class="features" id="abou">

  <div class="container ">
    <div class="row text-center">
      <div class="col-sm-12 text-center">
        <h1 class="text-center" >Our Features</h1>

      </div>

    </div>
    <div class="row">
      <div class="col-md-3 col-sm-6 text-center  "  data-aos="fade-right"
    data-aos-delay="300">
        <i class="fa fa-home" ></i>
        <h3>Great Idea</h3>
        <p class="lead" >Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
         Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat
  </p>
      </div>
      <div class="col-md-3 col-sm-6 text-center"  data-aos="fade-right"
    data-aos-delay="50">
        <i class="fa fa-home" ></i>
        <h3>Great Idea</h3>
        <p class="lead" >Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
         Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat
  </p>    </div>
      <div class="col-md-3 col-sm-6 text-center"  data-aos="fade-left"
    data-aos-delay="50">
        <i class="fa fa-home" ></i>
        <h3>Great Idea</h3>
       <p class="lead" >Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
           Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat
    </p>     </div>
      <div class="col-md-3 col-sm-6 text-center"  data-aos="fade-left"
    data-aos-delay="300">
        <i class="fa fa-home" ></i>
        <h3>Great Idea</h3>
        <p class="lead" >Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
         Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat
  </p>      </div>


    </div>

  </div>

</div>

<div class="row">
<?php require_once 'sidebar.php';?>
<div class="col-lg-8" id="category">

	    <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1" class=""></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2" class=""></li>
          </ol>
          <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
              <img class="d-block img-fluid w-100" src="images/img22.jpg" alt="First slide">
            </div>
            <div class="carousel-item">
              <img class="d-block img-fluid w-100" src="images/bg-2.jpg" alt="Second slide">
            </div>
            <div class="carousel-item">
              <img class="d-block img-fluid w-100" src="http://placehold.it/900x350" alt="Third slide">
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
		
		
		
		
<div id="accordion">
	<div class="card">
		<div class="card-header" id="headingOne">
		    <h2 class="mb-0">All Books</h2>
		</div>
        <div class="row" id="search">
		    <div class="col-lg-12 mb-3">
				<div class="d-flex m-2 ">
       				<div class="searchbar ml-auto">
          				<input id="search" class="search_input" type="text" name="search" placeholder="Search...">
          				<a href="#" class="search_icon"><i class="fa fa-search"></i></a>	
        		    </div>
      			</div>
			</div>
     
	 <?php foreach($books as $v){?>
          <div class="col-lg-4 col-md-6  mb-4">
            <div class="card h-100">
              <a href="product_details.php?id=<?php echo $v['book_id']?>"><img class="img-fluid" src="<?php echo IMAGES."books/".$v['book_id']."/".$v['small_pic']?>" 
							   alt="<?php echo $v['book_name']?>"></a>
              <div class="card-body">
                <h4 class="card-title">
                  <a href="product_details.php?id=<?php echo $v['book_id']?>"><?php echo $v['book_name']?></a>
                </h4>
               <!-- <h5>Price: $24.99</h5>-->
                <p class="card-text"><?php echo $v['short_desc']?></p>
              </div>
              <div class="card-footer">
                <small class="text-muted">★ ★ ★ ★ ☆</small>
              </div>
            </div>
          </div>
	 <?php }?>
	</div>
</div>
        <!-- /.row -->
</div>
</div>	     
</div>

<div class="comp text-center">
  <div class="container"   >

  <h1 data-aos="zoom-in-up" data-aos-delay="300">Company Overview</h1>
  <p data-aos="zoom-in-up" data-aos-delay="350">Lorem ipsum dolor sit amet, consectetur adipiscing elit,
     sed do eiusmod
   Duis aute irure dolor in reprehenderit in voluptate <br>
    velit esse cillum dolore eu fugiat
   Lorem ipsum dolor sit amet, consectetur <br> adipiscing elit, sed do eiusmod
    Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat
    Lorem ipsum dolor sit amet, consectetur adipiscing elit,
       sed do eiusmod
     Duis aute irure dolor in reprehenderit in voluptate <br>
      velit esse cillum dolore eu fugiat
     Lorem ipsum dolor sit amet, consectetur <br> adipiscing elit, sed do eiusmod
      Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat </p>
    <h5>Let's Star Today</h5>
    <button>View More</button>

  </div>

</div>
<!--start features work-->
<script>
///////////////////////////////////////////////////////////////////////////////
//////////// J Q U E R Y F U N C T I O N S////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////

$(document).ready(function(){
$(document).on('change','#search',function(){		
        var name = $(this).val();
     //alert(name);  
//     $("#text-div").text(name);
		 	$.ajax({
		    	url: "", 
		    	type:"POST",
		    	data:{search_name:name},
		    	success: function(result){
	        	$("#search").html(result);
// 	 	    		alert("Ajax"+result);
	      }});
    });
	
	
});
</script>
  </body>
<?php require_once 'footer.php';?>