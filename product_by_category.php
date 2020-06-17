<?php 
if(isset($_GET['id']))
{
    $id= $_GET['id'];
}
else
{
    header("location:index.php");
}

require_once 'admin/include/db.php';
require_once 'path_info.php';
$tname = "books";
$user = new db();
$con=" AND cat_id ={$id}";
$books = $user->select($tname, $con);


/*echo "<pre>";
print_r($books);exit;*/

/////////////search function////////////////
if (isset($_POST['search1'])) {

    $search = $_POST['search1'];
	$condtion = " AND book_name LIKE '%$search%'";
    $searchdata=$user->select($tname, $condtion);
	//echo "<pre>";
	//print_r($searchdata);
	
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
                  <a href='product_details.php?id={$v['book_id']}'>{$v['book_name']}</a>
                </h4>
                <p class='card-text'>{$v['short_desc']}</p>
              </div>
              <div class='card-footer'>
                <small class='text-muted'>★ ★ ★ ★ ☆</small>
              </div>
            </div>
          </div>";
	  }
	  exit;
	}
	else
	{
		echo '<script type="text/javascript">alert("Sorry! No result found ");</script>';
		echo "<span class='bg-info display-4 ml-5 p-3'> Sorry! No result found..... </span>";  
		exit;
	}
    exit;
}
require_once 'header.php';

?>

<body class="bg-info">
<?php require_once 'navbar.php';?>
<div class="row">
<?php require_once 'sidebar.php';?>
<div class="col-lg-8" id="category">
<div class="container">
    <!-- Jumbotron Header -->
    <header class="jumbotron my-4">
      <h1 class="display-3">Welcome!</h1>
      <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa, ipsam, eligendi, in quo sunt possimus non incidunt odit vero aliquid similique quaerat nam nobis illo aspernatur vitae fugiat numquam repellat.</p>
      <a href="#" class="btn btn-primary btn-lg">Call to action!</a>
    </header>
<div id="accordion">
	<div class="card">
		<div class="card-header" id="headingOne">
		    <h2 class="mb-0">All Books Category wise</h2>
		</div>
    <!-- Page Features -->
    <div class="row" id="search">
		    <div class="col-lg-12 mb-3">
				<div class="d-flex mr-5 mt-2 ml-5">
       				<div class="searchbar ml-auto">
          				<input id="search1" class="search_input" type="text" name="search" placeholder="Search...">
          				<a href="#" class="search_icon"><i class="fa fa-search"></i></a>	
        		    </div>
      			</div>
			</div>
	   <?php foreach($books as $v){?>
          <div class="col-lg-4 col-md-6 ml-5 mb-4">
            <div class="card h-100">
              <a href="product_details.php?id=<?php echo $v['book_id']?>"><img class="img-fluid card-img-top w-100" src="<?php echo IMAGES."books/".$v['book_id']."/".$v['small_pic']?>" 
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
    <!-- /.row -->
</div>
  </div>
</div>
  </div>
    
</div>	
<script>
///////////////////////////////////////////////////////////////////////////////
//////////// J Q U E R Y F U N C T I O N S////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////

$(document).ready(function(){
    $("#search1").on('change',function(){   
        var name = $(this).val();
 	    // alert(name);  //ye balnk Q aa rha hai

//     $("#text-div").text(name);
		 	$.ajax({
		    	url: "", 
		    	type:"post",
		    	data:{search1:name},
		    	success: function(data){
	        	$("#search").html(data);
 	 	    	//	alert(data);
	      }});
    });
	
	
});
</script>
  </body>
<?php require_once 'footer.php';?>