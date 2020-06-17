<?php
/*
 * ini_set('display_errors', 1);
 * ini_set('display_startup_errors', 1);
 * error_reporting(E_ALL);
 */
// Start the session
session_start();
require_once '../path_info.php';
if(isset($_SESSION['admin'])){
    $user= $_SESSION['admin'];
}else{
    header("location:index.php");
}

require_once 'include/db.php';
$data=new db();// OBJECT 
$total_cat=$data->select("book_category");
$total_books=$data->select("books");
?>
<?php include_once 'include/header.php';?>

<body>  
    <?php include 'include/navbar.php';?>
    <div class="container-fluid" id="main">
        <div class="row row-offcanvas row-offcanvas-left"><?php include 'include/sidebar.php';?>
        <div class="col main pt-5 mt-3">
            <h1 class="display-4 d-none d-sm-block">Dashboard <?php echo $user;?></h1>
            <div class="alert alert-warning fade collapse" role="alert" id="myAlert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    <span class="sr-only">Close</span>
                </button>
            </div> 

            <div class="row mb-3">
               <div class="col-xl-3 col-sm-6 py-2">
                <div class="card bg-success text-white h-100">
                    <a class="text-white" href="view_books.php" style="text-decoration: none;">
                        <div class="card-body bg-success">
                           <div class="rotate">
                            <i class="fa fa-book fa-4x"></i>
                        </div>
                        <h6 class="text-uppercase">Total Avilable Books</h6>
                        <h1 class="display-4"><?php echo count($total_books);?></h1>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-3 col-sm-6 py-2">
            <div class="card text-white bg-danger h-100">
               <a class="text-white" href="view_category.php" style="text-decoration: none;">
                <div class="card-body bg-danger">
                    <div class="rotate">
                        <i class="fa fa-list fa-4x"></i>
                    </div>
                    <h6 class="text-uppercase">Total Books Catagories</h6>
                    <h1 class="display-4"><?php echo count($total_cat);?></h1>
                </div>
            </a>
        </div>
    </div>
</div>
<!--/row-->

<hr>
</div></div></div>
<?php include 'include/footer.php';?>
</body>
</html>