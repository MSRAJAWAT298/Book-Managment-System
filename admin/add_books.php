<?php

/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
session_start();
require_once '../path_info.php';
require_once 'include/db.php';
if(isset($_SESSION['admin'])){
	$user= $_SESSION['admin'];
}else{
	header("location:index.php");
}

$tname="book_category";
$table_name ="books";
$user = new db();
$data = $user->select($tname);


/////////////////////// A D D______B O O K //////////////////
if (isset($_POST['submit'])) {
	echo '<script>alert("Hello submit");</script>';
	if ($_POST['bookname'] == "" 
		|| $_FILES["image1"]["name"] == "" 
		|| $_FILES["image2"]["name"] == "" 
		|| $_POST['aname']=="" 
		|| $_POST['category']=="" 
		|| $_POST['pdate']==""
		|| $_POST['summary']=="" 
		|| $_POST['details']==""
	) 
	{
		$error = "please fill the all fields<br><hr>";
	}
	if($_FILES["image1"]["name"] == ""){$img_error="please upload image icon";}
	if($_FILES["image2"]["name"] == ""){$img_error2="please upload image ";}
	else {$error="";
    //    $date = date('d-m-Y', time());
	$array = array(
		'book_name' => $_POST['bookname'],
		'author_name' => $_POST['aname'],
		'publish_date' => $_POST['pdate'],
		'small_pic' => $_FILES["image1"]["name"],
		'large_pic' => $_FILES["image2"]["name"],
		'short_desc' => $_POST['summary'],
		'cat_id' => $_POST['category'],
		'long_desc' => $_POST['details'],
		'status' => 1,
	);
	
	$insert = $user->insertdata($table_name, $array);
	$inserdata = "insert data failed";
	if (isset($insert)) {
		$inserdata="submit form succesfully";
		$uploadOk = 1;
		$target_path = "../images/books/" . $insert . "/";
		$target_path2 = "../images/books/" . $insert . "/";
		if (! file_exists($target_path)) {
			mkdir("../images/books/" . $insert, 0777);
		}
		$target_path = $target_path . basename($_FILES['image1']['name']);
		$target_path2 = $target_path2 . basename($_FILES['image2']['name']);
		$imageFileType = strtolower(pathinfo($target_path, PATHINFO_EXTENSION));
		if (file_exists($target_path)) {
			$r = "Sorry, file already exists";
			$uploadOk = 0;
		}
		if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
			$uploadOk = 0;
		}
		if ($uploadOk == 1) {
			
			if (move_uploaded_file($_FILES['image1']['tmp_name'], $target_path) && 	      move_uploaded_file($_FILES['image2']['tmp_name'], $target_path2))
				$uploadOk = 1;
		} else {
			$r .= "sorry file not uploaded";
		}
	} else {
		$r .= "something went wrong!";
	}
	echo '<script type="text/javascript">';
	echo'alert("Add book succesfully!");';
	echo 'window.location.href="http://localhost/book_mang/admin/view_books.php";';
	echo '</script>';
	
}
}

//////////////////////////////// O N U P D A T E //////////////////////////////////////////


if(isset($_GET['edit_id'])){//check edit button is click or not
	$con=" AND book_id = {$_GET['edit_id']}";
	$edit = $user->select($table_name,$con);

	$book_id=$edit[0]['book_id'];
	$pdate=$edit[0]['publish_date'];
	$bname=$edit[0]['book_name'];
	$aname=$edit[0]['author_name'];
	$cat_id=$edit[0]['cat_id'];
	$short_desc=$edit[0]['short_desc'];
	$long_desc=$edit[0]['long_desc'];
	$small_pic=$edit[0]['small_pic'];
	$large_pic=$edit[0]['large_pic'];
	$con=" AND cat_id = {$cat_id}";
	$edit_cat = $user->select($tname,$con);
}
////////////////////////////////////////////////////////////////////////////
if (isset($_POST['update'])) {
	//echo '<script>alert("update getting start");</script>';
	if ($_FILES["image1"]["name"] == "") {
		$pic1 = $small_pic;
	}else {     
		unlink("../images/books/".$book_id."/".$small_pic);
		$pic1 = $_FILES["image1"]["name"];
	}
	
	if ($_FILES["image2"]["name"] == "") {
		$pic2 = $large_pic;
	} else {     
		unlink("../images/books/".$book_id."/".$large_pic);
		$pic2 = $_FILES["image2"]["name"];
	}
	
	$array = array(
		'book_id'=>$book_id,
		'small_pic' => $pic1,
		'large_pic' => $pic2,
		'book_name' => $_POST['bookname'],
		'author_name' => $_POST['aname'],
		'publish_date' => $_POST['pdate'],
		'cat_id' => $_POST['category'],
		'short_desc' => $_POST['summary'],
		'long_desc' => $_POST['details'],
	); 
	
	$con=" AND book_id = {$book_id}";
     /*  echo "<pre>";
        print_r($array);
        echo "</pre>";
        exit();*/
        
        $update = $user->update($table_name, $array, $con);
        
        
        if (isset($update)) {
        	$uploadOk = 1;
        	$target_path = "../images/books/".$book_id."/";
        	$target_path2 = "../images/books/".$book_id."/";
        	$target_path = $target_path . basename($_FILES['image1']['name']);
        	$target_path2 = $target_path2 . basename($_FILES['image2']['name']);
        	$imageFileType = strtolower(pathinfo($target_path, PATHINFO_EXTENSION));
       /* if (file_exists($target_path)) {
            $r = "Sorry, file already exists";
            $uploadOk = 0;
        }*/
        /*if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                $uploadOk = 0;
            }*/
            if ($uploadOk == 1) {
            	
            	//echo '<script>alert("Hello update");</script>';
            	if (move_uploaded_file($_FILES['image1']['tmp_name'], $target_path)){
            		$uploadOk = 1;
            		
            		//echo '<script>alert("move1 succesfully");</script>';
            	}
            	
            	//echo '<script>alert("move2 failed");</script>';
            	if(move_uploaded_file($_FILES['image2']['tmp_name'], $target_path2))
            	{
            		echo '<script>alert("move succesfully");</script>';
            		$uploadOk = 1;
            	}
            	
            	//echo '<script>alert("after failed");</script>';
            } else {
            	$r .= "sorry file not uploaded";
            }
        } else {
        	$r .= "something went wrong!";
        }
        
        echo '<script type="text/javascript">';
        echo'alert("Update succesfully!");';
        echo 'window.location.href="http://localhost/book_mang/admin/view_books.php";';
        echo '</script>';
        
    }

    ?>
    <?php include_once 'include/header.php';?>
<body>  
<?php include 'include/navbar.php';?>
    <div class="container-fluid" id="main">
    	<div class="row row-offcanvas row-offcanvas-left">
    	<?php include 'include/sidebar.php';?>
    		<div class="col main pt-5 mt-3">
            <hr>
    		<h1 class="display-4 d-none d-sm-block">
    		<?php if (!empty($_GET['edit_id'])){echo "Edit Books";}else{ echo "Add Books";}?></h1>
    		<hr><span class="font-weight-bold text-info"><?php if(!empty($error))echo $error;?></span>
    			<div class="col-lg-2 ml-auto">
    				<a class="nav-link btn btn-outline-light bg-info  border"
                        href="view_books.php">View all Books</a>
    			</div>
    			<form class="font-weight-bold" method="POST" id="myForm" action="" autocomplete="on"  
                      enctype="multipart/form-data">
    			<div class="row">
    				<div class="col-lg-6">
    					<div class="form-group">
    						<label for="file-input">
                                <?php if(!empty($small_pic)){echo $small_pic;}?>
    						</label>
    						<input id="file-input"  type="file" name="image1" 
    								accept="image/gif, image/jpeg, image/png"
    								value="<?php if(!empty($small_pic)){echo $small_pic;}?>" />
    					</div>Upload Image Icon 
    					<span class="text-danger" id="error_img1">
    					<?php if(!empty($img_error)){ echo $img_error;}?>
    					</span>
    				</div>
                    <div class="col-lg-6">
    					<div class="form-group">
    						<label for="file-input"> 
    						<?php if(!empty($large_pic)){ echo $large_pic."<br>";}?>
    						</label>
    						<input id="file-input2" type="file" 
    								accept="image/gif, image/jpeg, image/png" 
    								name="image2"
    						<?php if(!empty($large_pic)){echo "value=$large_pic";}?>  />
    					</div>Upload Book Cover 
    					<span class="text-danger" id="error_img2">
    					<?php //if(!empty($img_error2=="")) {echo $img_error2;}?></span>
    				</div>
    				<div class="col-lg-6">
    					<div class="form-group">
    						<label for="name">Book Name:</label> 
    						<input type="text"
    								class="form-control rounded" 
    								id="bname" 
    								placeholder="Enter Book Name"
    								name="bookname" 
    								value="<?php if(!empty($bname))echo $bname;?>"> 
    						<span class="text-danger" id="error1"></span>
    					</div>
    				</div>
    				<div class="col-lg-6">
    					<div class="form-group ">
    						<label for="sel1">Select Category:</label> 
    							<select class="form-control" name="category" id="category">
    								<option value="<?php if(!empty($cat_id)){echo $cat_id?>">
    								<?php echo $edit_cat[0]['cat_name'];} else{?>">Select Category<?php }?></option>
    								<?php foreach ($data as $v){?>
    								<option value="<?php echo $v['cat_id'];?>"><?php echo $v['cat_name'];?></option>
    								<?php }?>
    							</select>
    						<span class="text-danger" id="error_cat"></span>
    				    </div>
    				</div>
    				<div class="col-lg-6">
    					<div class="form-group">
    						<label for="name">Author Name:</label> 
    							<input  type="text"
    								    class="form-control rounded" 
    								    id="aname" 
    									placeholder="Enter Author Name"
    								    name="aname" 
    									value="<?php if(!empty($aname))echo $aname;?>"> 
    						<span class="text-danger" id="error2"></span>
    					</div>
    				</div>
    				<div class="col-lg-6">
    					<div class="form-group">
    						<label for="date">Publish Date:</label> 
    							<input  type="date"
    									class="form-control rounded" 
    									id="date" 
    									placeholder="Enter Book Name"
    									name="pdate" 
    									value="<?php if(!empty($pdate))echo $pdate;?>"> 
    						<span class="text-danger" id="error_date"></span>
    					</div>
    				</div>
    				<div class="col-lg-6">
    					<div class="form-group">
    						<label for="summary">Book Summary:</label>
    						<textarea class="form-control" rows="5" id="summary" name="summary"><?php if(!empty($short_desc))echo $short_desc;?></textarea>
    						<span class="text-danger" id="error_summary"></span>
    					</div>
    				</div>
    									
    				<div class="col-lg-6">
    					<div class="form-group">
    						<label for="name">Book details:</label>
    						<textarea class="form-control" rows="5" id="details"  name="details" ><?php if(!empty($long_desc))echo $long_desc;?></textarea>
    						<span class="text-danger" id="error_details"></span>
    					</div>
    				</div>
    				<div class="col-lg-6">
    				<?php if (!empty($_GET['edit_id'])) {?>
    			     <input type="submit" class="btn btn-success" name="update" value="update Book details">
    				<?php }else{?> 
    		          <input type="submit" id="submit" class="btn btn-success" name="submit" value="Add Book"><?php } ?>
    		          </div>
    			</div>
    		</form>
    	</div>
    </div>
</div>
<?php include 'include/footer.php';?>
</body>
</html>