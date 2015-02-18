<?php
	if(isset($_POST['save']))
	{
		$response_array=array();
		
		$val=$_POST['val'];
		$field=$_POST['field'];
		$id=$_POST['id'];
		
		################# HERE YOU CAN WRITE MYSQL QUERY TO UPDATE DATA ###################
		#																				  #
		#  mysql_query("UPDATE tbl SET $field='$val' WHERE id=$id");                      #
		#																				  #
		###################################################################################
		
		$response_array['query']= "UPDATE tbl SET $field='$val' WHERE id=$id";
		
		print json_encode($response_array);
		exit(0);
	}
?>
<style>
	input[type='text']{
		width:50px;
		padding:2px;
		font-size:100%;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;
		font-size:85%;
	}
	.hide
	{
		display:none;
	}
	td{
		min-width:50px;
		padding:8px;line-height:18px;text-align:left;vertical-align:top;border-top:1px solid #dddddd;
		font-size:100%;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;
		font-size:85%;
	}
</style>
<table>
	<?php for($i=1;$i<=15;$i++) { ?>
		<tr>
			<?php for($j=1;$j<=20;$j++) { 
				$val=rand();
			?>
				<td class="editable"><span><?= $val ?></span><input field="dis" unique-id="<?= $i.$j ?>" class="hide" type="text" value="<?= $val ?>"> </td>	
			<?php } ?>
		</tr>
	<?php } ?>
</table>

<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script>
$(document).ready(function(){
	$(".editable").click(function(){
		$(this).find("span").hide();
		$(this).find("input").show().focus();
	});
	
	$("input").blur(function(){		
		var td=$(this).parents("td");
		$(this).hide();
		var field = $(this).attr("field");
		var val   = $(this).val();
		var id    = $(this).attr("unique-id");
		$(td).find("span").show().text($(this).val());		
		
		$.ajax({
			url:'index.php',
			type:'POST',
			dataType:'json',
			data:"save=true&val=" + val + "&field=" + field + "&id=" + id,
			success:function(data){
				console.log(data);
			}
		});
	});
});
</script>
