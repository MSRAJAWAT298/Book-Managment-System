$(document).ready(function(){
	var flag=true;
	$("#myForm").submit(function(event){

		if($("#bname").val()=="")
		{ 
			$("#error1").text("Enter name");
			flag=false;  
		}
		else
		{
			flag=true;
			$("#error1").text("");
		}

		if($("#category").val()=="")
		{ 
			$("#error_cat").text("Select category");
			flag=false;  
		}
		else
		{
			flag=true;
			$("#error_cat").text("");
		}
			
		if($("#aname").val()=="")
		{ 
			$("#error2").text("Enter author_name");
			flag=false;  
		}
		else
			{
				flag=true;
				$("#error2").text("");
			}

		if($("#date").val()=="")
		{ 
			$("#error_date").text("Enter publish_date ");
			flag=false;  
		}
		else
			{
				flag=true;
				$("#error_date").text("");
			}

		if($("#summary").val()=="")
		{ 
			$("#error_summary").text("Enter book summary");
			flag=false;  
		}
		else
			{
				flag=true;
				$("#error_summary").text("");
			}

		if($("#details").val()=="")
			{
				$("#error_details").text("Enter book description");
				flag=false;  
			}
			else
				{
					flag=true;
					$("#error_details").text("");
				}
				//console.log(flag);
				//alert("testing");
				if(flag==false){event.preventDefault();}
	});

$('#submit').click(function(){
	// alert("testing");
	if($("#file-input").val()=="")
	{ 
		$("#error_img1").text("Please Upload Icon");
		flag=false; 		  
	}
	else
	{
		flag=true;
		$("#error_img1").text("");
	}
	
	if($("#file-input2").val()=="")
	{ 
		$("#error_img2").text("Please Upload Image cover");
		flag=false;  
	}
	else
		{
			flag=true;
			$("#error_img2").text("");
		}
	});
});
