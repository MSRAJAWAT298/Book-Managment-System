<?php

/*
 * ini_set('display_errors', 1);
 * ini_set('display_startup_errors', 1);
 * error_reporting(E_ALL);
 */
 
 
session_start();
require_once '../path_info.php';
if(isset($_SESSION['admin'])){
    $user= $_SESSION['admin'];
}else{
    header("location:index.php");
}
require_once 'include/db.php';
  
$tname = "book_category";
$user = new db();
$data = $user->select($tname);
//print_r($data);
//exit;

/////////////////// FUNCTION FOR ADD Category ///////////////////////////
if (isset($_POST['submit'])) {
    if ($_POST['catname'] == "")
    {
        $msg = "please fill the all fields<br><hr>";
    }
    else 
	{
		$msg="";

	$condtion = " AND cat_name LIKE '{$_POST['catname']}' ";
    $search_cat=$user->select($tname, $condtion);
	//print_r($search_cat);
	//echo $search_cat[0]['cat_name'];
	//exit;
	if($search_cat[0]['cat_name']==$_POST['catname']){
            echo "<script>alert('Catgorie already set!');</script>";
	}else{
	    $array = array('cat_name' => $_POST['catname'],'sort_order' => $_POST['order'], 'status' => 1);
        $insert = $user->insertdata($tname, $array);
        if (isset($insert)) {
            echo "<script>alert('Add catgorie succesfully');</script>";
            //header("location:add_category.php");
		}
	}
	}
}
/////////// update status ///////////////
if (isset($_POST['status'])) {
     $d = array('status' => $_POST['status']);
	 $condtion = " AND cat_id  =  {$_POST['cat_id']}";
     echo $user->update($tname, $d, $condtion);
     exit;
}
/////////// update catgories ///////////////
if (isset($_POST['update'])) {
	//echo '<script>alert("hello update");</script>';
	 $array = array('cat_name' => $_POST['catname'],'sort_order' => $_POST['order']);	 
	 $con = " AND cat_id = {$_GET['edit_id']}";
	 $user->update($tname, $array, $con);
	    header("location:add_category.php");
}

//////////////////////Delete Function/////////////////////
if (isset($_POST['id'])) {
	//echo '<script>alert("hello");</script>';
     $id = $_POST['id'];
     $con=" AND cat_id = {$id}";
	 $del = $user->select("books",$con);
	 if(count($del)==0){
	 $condtion = array('cat_id' => $id);
     $data=$user->delete($tname, $condtion);
	 echo $data;
	 }else{
		 echo "Something went wrong !...";
	 }
	 exit;
}
//////////Edit method///////////////////
if (isset($_GET['edit_id'])) {
	$_GET['edit_id'];
	//echo '<script>alert("hello");</script>';
    $condtion =" AND cat_id = {$_GET['edit_id']}";
	$edit = $user->select($tname,$condtion);	
}
?>

<?php include_once 'include/header.php';?>
<body>  
<?php include 'include/navbar.php';?>
<div class="container-fluid" id="main">
		<div class="row row-offcanvas row-offcanvas-left">
<?php include 'include/sidebar.php';?>
 <div class="col-lg-4 main pt-5 mt-3">
				<hr><h1 class="display-4 d-none d-sm-block">
				<?php if (!empty($_GET['edit_id'])){echo "Edit Category";}else{ echo "Add Category";}?></h1>
				<hr>
				<span class="font-weight-bold text-info">
				<?php if(!empty($error)){echo $msg;}	//echo "<pre>"; print_r($edit); ?></span>
			<!--	<div class="col-lg-2 ml-auto">
					<a class="nav-link btn btn-outline-light bg-info  border"
						href="view_category.php">View all Category</a>
				</div>-->
				<form method="POST" id="myForm" autocomplete="on"
					enctype="multipart/form-data">
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label for="name">Book Category title:</label> 
								<input type="text"
									  class="form-control rounded" 
									  id="catname" 
									  placeholder="Enter Book Category title"
									  name="catname" 
									  value="<?php if(isset($edit)){ echo $edit[0]['cat_name'];}?>">
                                <span class="text-danger" id="error1"></span>
							</div>
						</div>
							<div class="col-lg-12">
							<div class="form-group">
								<label for="order">Sort Order</label> 
								<input type="number"
									  class="form-control rounded" 
									  id="order" min="1"
									  placeholder="Enter sort order"
									  name="order" 
									  value="<?php if(isset($edit)){ echo $edit[0]['sort_order'];}?>">
                                <span class="text-danger" id="error2"></span>
							</div>
						</div>
							<?php  //echo $insert;?>
						<div class="col-lg-6">
						<?php if(isset($edit)) {?>
							<input type="submit" class="btn
							btn-success" name="update"
								value="update Category">
								<?php }else{?> 
							<input type="submit" class="btn btn-success" name="submit"
								value="Add Category"><?php }?>
						</div>
					</div>
				</form>
			</div>
			
			 <div class="col-lg-6 pt-5 mt-3">
			 
			 <?php //echo "<pre>";print_r($data);?>
			 	<hr>
				<h1 class="display-4 d-none d-sm-block">View All Category</h1>
				<hr><span class="font-weight-bold text-info">
			  <table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
      <tr>
        <th>Category_id #</th>
        <th>Category Name</th>
		<th>Sort_order</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
	<?php 
	foreach($data as $v){ ?>
      <tr>
	<td><?php echo $v['cat_id'];?></td>
        <td><?php echo $v['cat_name'];?></td>	
        <td><?php echo $v['sort_order'];?></td>	
	
	<td><i data="<?php echo $v['cat_id'];?>" class="status_checks btn
  <?php echo ($v['status'])?
  'btn-success': 'btn-danger'?>"><?php echo ($v['status'])? 'Active' : 'Inactive'?>
 </i></td>
			
		<td><a href="add_category.php?edit_id=<?php echo $v['cat_id'];?>" 
		       title="add_category.php?edit_id=<?php echo $v['cat_id'];?>"> 
			   <button class='edit btn btn-info m-2 w-75' id='edit_<?php echo $v['cat_id']; ?>'>Edit
			<i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>
			 <button class='delete btn btn-danger m-2 w-75' id='del_<?php echo $v['cat_id']; ?>'>Delete
			<i class="fa fa-trash" aria-hidden="true"></i></button></td>
		</tr> 
	<?php }?>
      </tr>
    </tbody>
  </table>
			 </div>
			<div id="result"></div>
		</div>
	</div>
<?php include 'include/footer.php';?>

<script>
$(document).ready(function(){
// 	  alert("helo");
	  var flag=true;
	   $("#myForm").submit(function(event){
//	  alert("helo");
		  if($("#catname").val()==""){ 
			  $("#error1").text("Enter Category name");
			  flag=false;  
		  }else{
			  $("#error1").text("");}
		  
		  if($("#order").val()==""){ 
			  $("#error2").text("Enter Category order");
			  flag=false;  
		  }else{
			  $("#error2").text("");}
		
	 	  if(flag==false){event.preventDefault();}
		  
		  });
});
///////////////////////////////////////////////////////////////////////////////
//////////// J Q U E R Y F U N C T I O N S////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////

$(document).ready(function(){
$(document).on('click','.status_checks',function(){
      var status = ($(this).hasClass("btn-success")) ? '0' : '1';
      var msg = (status=='0')? 'Deactivate' : 'Activate';
      if(confirm("Are you sure to "+ msg)){
        var current_element = $(this);
        $.ajax({
          type:"POST",
          url: "",
          data: {cat_id:$(current_element).attr('data'),status:status},
          success: function(data)
          {   //alert(data);
              location.reload();
          }
        });
      }      
    });

    $("#search").on('change',function(){   
        var name = $(this).val();
// 	     alert(name);  
//     $("#text-div").text(name);
		 	$.ajax({
		    	url: "add_category.php", 
		    	type:"POST",
		    	data:{search:name},
		    	success: function(result){
	        	$("tbody").html(result);
// 	 	    		alert("Ajax"+result);
	      }});
	    
    });
        
	
 // Delete 
 $('.delete').click(function(){
   var el = this;
   var id = this.id;
   var splitid = id.split("_");

   // Delete id
   var deleteid = splitid[1];
   
   var del =confirm("Are you sure! you want to delete");
   if(del){
   // AJAX Request
   $.ajax({
     url: "add_category.php",
     type: "POST",
     data: {id:deleteid},
     success: function(response){
		 alert(response);
				window.location.href = "add_category.php";
    }
   });
   }
 });	
});

</script>
</body>
</html>