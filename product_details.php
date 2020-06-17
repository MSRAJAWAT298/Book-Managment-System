<?php 
if(isset($_GET['id']))
{
    $id = $_GET['id'];
}
else
{
    header("location:index.php");
}

require_once 'admin/include/db.php';
require_once 'path_info.php';
$tname = "books";
$user = new db();
$con = " AND book_id ={$id}";
$books = $user->select($tname,$con);
if(!$books){

    header("location:index.php");
}
/*echo "<pre>";
print_r($books);exit;*/
require_once 'header.php';
?>

<body class="bg-info">
  <?php require_once 'navbar.php';?>
  <div class="row">
      <?php require_once 'sidebar.php';?>
      <div class="col-lg-8 mt-4">
         <div id="accordion">
	           <div class="card">
                		<div class="card-header" id="headingOne">
                		    <h2 class="mb-0">Book Details</h2>
                		</div>
                     <div class="card mt-4">
                              <img class="img-fluid h-100 w-100" src="<?php echo IMAGES."books/".$id.'/'.$books[0]['large_pic']?>" alt="<?php echo $books[0]['book_name']?>" style="height:400px;">
                              <div class="card-body">
                                <h3 class="card-title"><?php echo $books[0]['book_name']?></h3>
                                <!--<h4>Price:$24.99</h4>-->
                                <p class="card-text"><?php echo $books[0]['long_desc']?></p>
                                <span class="text-warning">★ ★ ★ ★ ☆</span>
                                4.0 stars
                              </div>
                     </div>
              </div>
        </div>
        <!-- /.row -->
      </div>
  </div>
</div>	

  </body>
<?php require_once 'footer.php';?>