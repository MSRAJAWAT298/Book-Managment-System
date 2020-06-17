<?php 
/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/

session_start();
require_once '../path_info.php';
if(isset($_SESSION['admin'])){
    $user= $_SESSION['admin'];
}else{
    header("location:index.php");
}

require_once 'include/db.php';
$user=new db();// OBJECT 
$tname="books";
$data=$user->select($tname);
/////////// update status ///////////////
if (isset($_POST['status'])) {
     $d = array('status' => $_POST['status']);
	 $condtion = " AND book_id  =  {$_POST['cat_id']}";
     echo $user->update($tname, $d, $condtion);
     exit;
}
//////////////////////Delete Function/////////////////////
if (isset($_POST['id'])) {
	//echo '<script>alert("hello");</script      $id = $_POST['id'];
	 $condtion = array('book_id' => $id);
	 $con = " AND book_id  = {$id}";
     $select=$user->select($tname,$con);
	 /*
	 echo "<pre>";
	 print_r($select);
	 exit;*/
    unlink(IMAGES."books/".$id."/".$select[0]['small_pic']); 
	unlink(IMAGES."books/".$id."/".$select[0]['large_pic']); 
    rmdir(IMAGES."books/".$id);
	
     $data=$user->delete($tname, $condtion);
	 echo $data;
	 exit;
}
/*
////////////////////////////////// S E A R C H F U N C T I O N ////////////////////////////
if (isset($_POST['search'])) {
    echo $search = $_POST['search'];
	$condtion = " AND book_name LIKE '%$search%' ";
    $searchdata=$user->select($tname,$condtion);
	foreach($searchdata as $value){
			$con=" AND cat_id = {$value['cat_id']}";
			$edit_cat = $user->select("book_category",$con);
		
		//echo $edit_cat[0]['cat_name'];
		//print_r($edit_cat);exit;
		
		echo "<tr>
				<td>{$value['book_id']}</td>
		        <td><img class='img-fluid'  alt='{$value['book_name']}' 
				         src='../images/books/{$value['book_id']}/{$value['small_pic']}'></td>
		        <td>{$value['book_name']}</td>
				<td>{$edit_cat[0]['cat_name']}</td>
		        <td>{$value['author_name']}</td>
		        <td>{$value['short_desc']}</td>
		        <td>{$value['long_desc']}</td>";
		     	if($value['status']){
				echo "<td class='btn btn-success'>ACTIVE</td>";
				}else{echo "<td class='btn btn-danger'>DEACTIVE</td>";}
				echo "
				<td><a href='add_books.php?edit_id= {$value['book_id']}' 
		       title='add_books.php?edit_id={$value['book_id']}'> 
			   <button class='edit btn btn-info' id='edit_{$value['book_id']}'>Edit
			<i class='fa fa-pencil-square-o' aria-hidden='true'></i></button></a>
	| <button class='delete btn btn-danger' id='del_{$value['book_id']}'>Delete
			<i class='fa fa-trash' aria-hidden='true'></i></button></td>
		</tr>";
	}
	//echo "<pre>	";
   // print_r($searchdata);
    exit;
}
*/
?>
<?php require_once '../path_info.php';?>
<?php include_once 'include/header.php';?>
<body> 

<?php include 'include/navbar.php';?>
<div class="container-fluid" id="main">
    <div class="row row-offcanvas row-offcanvas-left">
<?php include 'include/sidebar.php';?>
 <div class="col-lg-10 main pt-5 mt-3">
    <div class="card mb-4">
        <div class="card-header">View All Books
			<a href="add_books.php"><button class="btn btn-success float-right">Add Books Details</button></a>
		</div>
		<!--    <div class="d-flex">
       		    <div class="searchbar ml-auto">
          		   <input id="search" class="search_input" type="text" name="search" placeholder="Search...">
          		    <a href="#" class="search_icon"><i class="fa fa-search"></i></a>	
        		</div>
      		</div>-->
    <div class="card-body">
        <div class="datatable table-responsive">
          	<table id="example" class="table table-striped table-bordered" style="width:100%">
				<thead class="text-info font-weight-bold">
					<tr>
						<th>S.no#</th>
						<th>Photo</th>
						<th>Book Title</th>
						<th>Book Category</th>
						<th>Author</th>
						<th>Book Summary</th>
						<th>Book Description</th>							
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
			<tbody class="font-weight-bold">
	<?php $count=0;
	foreach($data as $v){ ?>
      <tr>
		<td><?php echo ++$count;?></td>
		<td><img class="img-fluid"  alt="<?php echo $v['small_pic'];?>" 
		src="<?php echo IMAGES."books/".$v['book_id']."/".$v['small_pic'];?>" style="height: 50px;"></td>
		<td><?php echo $v['book_name'];?></td>
		<td><?php 
			$con=" AND cat_id = {$v['cat_id']}";
			$edit_cat = $user->select("book_category",$con);
			echo $edit_cat[0]['cat_name'];		 
			?>
		</td>
		<td><?php echo $v['author_name'];?></td>
		<td><?php echo $v['short_desc'];?></td>
        <td><?php echo substr($v['long_desc'],0,100);?>
			<span id="demo_<?php echo $v['book_id'] ?>" class="collapse">
				<?php echo substr($v['long_desc'],100);?>
			</span>
			<br><?php if(strlen($v['long_desc'])>100){?>
			<button class="btn btn-secondary mt-3 readmore">Read More</button>
			<?php } ?>
		</td>
		<td><i data="<?php echo $v['book_id'];?>" class="status_checks btn
					<?php echo ($v['status'])?
					'btn-success': 'btn-danger'?>"><?php echo ($v['status'])? 'Active' : 'Inactive'?>
			</i></td>
			
		<td><a href="add_books.php?edit_id=<?php echo $v['book_id'];?>" title="add_books.php?edit_id=<?php echo $v['book_id'];?>"> 
			   <button class='edit btn btn-info m-2' id='edit_<?php echo $v['book_id']; ?>'>
			   		Edit<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
			   	</button>
			</a>
			 <button class='delete btn btn-danger m-2' id='del_<?php echo $v['book_id']; ?>'>Delete
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
          {   //alert(data);
              location.reload();
          }
        });
      }      
    });
//end status function
/*
    $("#search").on('change',function(){   
        var name = $(this).val();
 	   //  alert(name);  
//     $("#text-div").text(name);
		 	$.ajax({
		    	url: "view_books.php", 
		    	type:"POST",
		    	data:{search:name},
		    	success: function(result){
	        	$("tbody").html(result);
// 	 	    		alert("Ajax"+result);
	      }});
	    
    });
	*/
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
     url: "view_books.php",
     type: "POST",
     data: {id:deleteid},
     success: function(response){
		 alert(response);
				window.location.href = "view_books.php";
    }
   });
   }
 });
 
 
$("body").on("click",".readmore",function() {
            var val = $(this).text();
			console.log("val:"+val);
            var id = $(this).prev().prev().attr("id");
            console.log(id);
            if(val == "Read More") {
                $(this).text("Read Less");
                $(this).addClass("text-white");
                $(this).addClass("bg-danger");
                $("#"+id).removeClass("collapse");
            }
            else {
                $(this).text("Read More");
                $(this).removeClass("bg-danger");
                $(this).addClass("text-white");
				$(this).addClass("bg-primary");
                $("#"+id).addClass("collapse");
            }
        });
});

</script>

</body>
</html>