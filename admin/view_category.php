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
	 $array = array('cat_name' => $_POST['catname']);	 
	 $con = " AND cat_id = {$_GET['edit_id']}";
	 $user->update($tname, $array, $con);
	    header("location:add_category.php");
}
/*
/////////////search function////////////////
if (isset($_POST['search'])) {
    $search = $_POST['search'];
	$condtion = " AND cat_name LIKE '%$search%' ";
    $searchdata=$user->select($tname, $condtion);
	$count=0; 
	
	foreach($searchdata as $value){
		echo "<tr>
				<td>{$value['cat_id']}</td>
		        <td>{$value['cat_name']}</td>
		        <td>{$value['sort_order']}</td>";    	
				if($value['status']){
				echo "<td class='btn btn-success'>ACTIVE</td>";
				}else{echo "<td class='btn btn-danger'>DEACTIVE</td>";}
				echo "
				<td><a class='btn btn-info' href='add_category.php?edit_id={$value['cat_id']}'
					   title='add_category.php?edit_id={$value['cat_id']}'> 
					<i class='fa fa-pencil-square-o' aria-hidden='true'></i>
					Edit</a>
				    |
				<button class='delete btn btn-danger' id='del_{$value['cat_id']}'>Delete
					<i class='fa fa-trash' aria-hidden='true'></i></button>
					
				</td>
		</tr>";
	}
	
    exit;
}*/
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
 <div class="col main pt-5 mt-3">
			 	<hr>
				<h1 class="display-4 d-none d-sm-block">View All Category</h1>
				<hr><span class="font-weight-bold text-info">
				<!--
				<div class="d-flex m-2 ">
       				<div class="searchbar ml-auto">
          				<input id="search" class="search_input" type="text" name="search" placeholder="Search...">
          				<a href="#" class="search_icon"><i class="fa fa-search"></i></a>	
        		    </div>
      			</div>-->
				
                        <div class="card mb-4">
                            <div class="card-header">Category
							<a href="add_category.php"><button class="btn btn-success float-right">Add Category</button></a>
							</div>
                            <div class="card-body">
                                <div class="datatable table-responsive">
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
				 <?php echo ($v['status'])? 'btn-success': 'btn-danger'?>">
				 <?php echo ($v['status'])? 'Active' : 'Inactive'?>
		</i>
	</td>
		<td><a href="add_category.php?edit_id=<?php echo $v['cat_id'];?>" 
		       title="add_category.php?edit_id=<?php echo $v['cat_id'];?>"> 
			   <button class='edit btn btn-info' id='edit_<?php echo $v['cat_id']; ?>'>Edit
			<i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>
			| <button class='delete btn btn-danger' id='del_<?php echo $v['cat_id']; ?>'>Delete
			<i class="fa fa-trash" aria-hidden="true"></i></button></td>
		</tr> 
	<?php }?>
      </tr>
    </tbody>
  </table>
			 </div>
			 </div>
			 </div>
			 </div>
			 </div>
			
			 
			<div id="result"></div>
		</div>
	</div>
<?php include 'include/footer.php';?>

<script>
///////////////////////////////////////////////////////////////////////////////
//////////// J Q U E R Y F U N C T I O N S////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////

$(document).ready(function(){
	//start status funtion//
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
          {     
				//alert(data);
              location.reload();
          }
        });
      }      
    });
//end status function
//search function//
    $("#search").on('change',function(){   
        var name = $(this).val();
// 	     alert(name);  
//     $("#text-div").text(name);
		 	$.ajax({
		    	url: "view_category.php", 
		    	type:"POST",
		    	data:{search:name},
		    	success: function(result){
	        	$("tbody").html(result);
// 	 	    		alert("Ajax"+result);
	      }});
	    
    });//end serch function
        
	
 // Delete  function
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
     url: "view_category.php",
     type: "POST",
     data: {id:deleteid},
     success: function(response){
		 alert(response);
				window.location.href = "view_category.php";
    }
   });
   }
 });

		
});

</script>
</body>
</html>