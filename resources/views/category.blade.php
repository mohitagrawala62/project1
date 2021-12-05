<!DOCTYPE html>
<html>
<head>
<title>Ajax Project</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
	<center><h3>Ajax demo project</h3></center><br />
<center><div class="col-lg-8" style="border:1px solid grey;">
 <div class="row">
 <div class="form-group">
    <label class="col-lg-3">Item:</label>
    <input type="text" class="form-control col-lg-8" id="item" placeholder="Enter item name here" onblur="$(this).val($(this).val().trim());" required="required">
  </div>
  </div>
  <div class="form-group">
    <label>Category:</label>
<select class="form-control col-lg-3" id="category" name="category">
<option value="" disabled="disabled">Select category</option>
<option value="Category A">Category A</option>
<option value="Category B">Category B</option>
<option value="Category C">Category C</option>
</select>
  </div><br />
<input type="button" name="add" value="Add" class="btn btn-primary mb-2" onclick="add();">
</div>
</div></center><br/><br />

<center>
<h2>Ajax table</h2>
<div class="col-lg-8">
<table class="table table-hover" id="categoryTable" style="border:1px solid grey;">
  <thead>
    <tr>
      <th scope="col">Item name</th>
      <th scope="col">Category</th>
      <th scope="col">Date</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  	<?php foreach($category as $row):  ?>
        <tr id='sr<?=$row['id']?>'>
            <td><?=$row['itemname'];?></td>
            <td><?=$row['category'];?></td>
            <td><?= date("d-m-y", strtotime($row['date']));?></td>
            <td class="deletet" data-id="<?=$row['id']?>"><button class=" btn btn-danger">Delete</button></td>
        </tr>
<?php endforeach;?>
  </tbody>
</table>
</div>
</center>


<script type="text/javascript">
function add()
{
var category = $('#category').val();
var item = $('#item').val();
var _token = $('meta[name="csrf-token"]').attr('content');


$.ajax({
	url:"{{route('category.add')}}",
	type:"POST",
	data:{
		category:category,
		itemname:item,
		_token:_token
	},
	success:function(response)
	{
		if(response)
		{
			var d = new Date(response.created_at);
			var curr_day = d.getDate();
			var curr_month = d.getMonth()+1;
			var curr_year = d.getFullYear();	
			$("#categoryTable tbody").prepend('<tr id=sr'+response.id+'><td>'+response.itemname+'</td><td>'+response.category+'</td><td>'+curr_day + "-" + curr_month + "-" + curr_year+'</td><td class="deletet" data-id='+response.id+'><button class="btn btn-danger">Delete</button></td>');
			$('#item').val('');
			$('#category').val('');

		}
	}
});
}
</script>
<script type="text/javascript">
$(document).ready(function(){
$(document).on("click",".deletet", function(){
var id = $(this).data("id");
var _token = $('meta[name="csrf-token"]').attr('content');
//alert(catId);
$.ajax({
		url:'/category/'+id,
		type:'DELETE',
		data:{
			_token : _token
		},
		success:function(response)
		{
			$("#sr"+id).remove();
		}
	});
});
});	
</script>
</body>
</html>