<?php
		//DELLANNOUNCE
		@$on 	=	$_GET["on"];
		@$id 	=	htmlspecialchars($_GET["id"]);
		@$op 	=	$_GET["op"];
			
	if (@$_SESSION[ADMIN_SESSION_PRE_."chatdrepandtsonadmincheck"] == @$_GET["chatdrepandtsonadmincheck"] AND @$_GET["chatdrepandtsonadmincheck"] != NULL) {
				
		if ($on == "announce" && $op == "delete" && !empty($id) )
		{			
				
				$query = "DELETE FROM `"._BTM_TABLE_CONSQUEST_."` WHERE id = \"".$id."\"";
				$result = mysqli_query($mysql, $query);			
									
			}	
		}	else {
		$_SESSION[ADMIN_SESSION_PRE_."chatdrepandtsonadmincheck"]	=	mt_rand(10000, 9999999);
		}
		
				//ADDANNOUNCE
			@$xtitle 	=	$_POST["xtitle"];
			@$xtext 	=	$_POST["xtext"];
		if (@$_SESSION[ADMIN_SESSION_PRE_."chatsgrppostsonadmincheck"] == @$_POST["chatsgrppostsonadmincheck"] AND @$_POST["chatsgrppostsonadmincheck"] != NULL ) {	

			if (@$_POST["type"] == "command") {
					$query = "INSERT INTO `"._BTM_TABLE_CONSQUEST_."` (text, relation, directcommand) VALUES (\"".htmlspecialchars(strtolower($_POST["text"]))."\", '".htmlspecialchars($_POST["relation"])."' , '".htmlspecialchars($_POST["command"])."');";				

			}
			
			if (@$_POST["type"] == "reply") {
					$query = "INSERT INTO `"._BTM_TABLE_CONSQUEST_."` (text, relation, directreply) VALUES (\"".htmlspecialchars(strtolower($_POST["text"]))."\", '".htmlspecialchars($_POST["relation"])."' , '".htmlspecialchars($_POST["reply"])."');";			
			
			}
			
			if (@$_POST["type"] == "tocat") {
				$query = "INSERT INTO `"._BTM_TABLE_CONSQUEST_."` (text, relation, directtocat) VALUES (\"".htmlspecialchars(strtolower($_POST["text"]))."\", '".htmlspecialchars($_POST["relation"])."' , '".htmlspecialchars($_POST["categorie"])."');";					
				
			}
			
			if (@$_POST["type"] == "toflow") {
				
					$query = "INSERT INTO `"._BTM_TABLE_CONSQUEST_."` (text, relation, directworkflow) VALUES (\"".htmlspecialchars(strtolower($_POST["text"]))."\", '".htmlspecialchars($_POST["relation"])."' , '".htmlspecialchars($_POST["workflow"])."');";					
			}
			
			$result = mysqli_query($mysql, $query) or die(mysqli_error($mysql));	
		}  else {
		$_SESSION[ADMIN_SESSION_PRE_."chatsgrppostsonadmincheck"]	=	mt_rand(10000, 9999999);
	}

?>

<section id="newsection">
<div id="sectionheading" >Add and Info</div>
<center><font style="color: yellow; font-size: 12px;">Here are Direct Replys!<br />
				Rows Groups: ID [id] | text | relation | directworkflow | directcommand | directreply | directtocat <br /></font></center>



<tr style="width: 100%;font-size: 14px;"><form method="post" action="./?location=bugfish&2ndloc=chat&coloc=direct&on=announce">
	<td style='width: 25%;'><input type='text' name='text' placeholder="Text"></td>
	<td style='width: 25%;'>Relation <select name="relation" >
				<option value="0">0</option>
				
			</select></td>	
	<td style='width: 25%;'><input type='text' name='reply' placeholder="Reply"></td>
	
	<td style='width: 25%;'>Type <select name="type" >
			<option value="command">command</option>
			<option value="reply">reply</option>
			<option value="tocat">tocat</option>
			<option value="toflow">toflow</option>
			</select></td>	
	
	<td style='width: 25%;'>Command <select name="command" >
			  <?php
				$query = "SELECT * FROM `"._BTM_TABLE_CONSCOMMAND_."`";
				$result = mysqli_query($mysql, $query) or die(mysqli_error($mysql));
				while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
							echo '<option value="'.$row["id"].'">'.$row["name"].'</option>';
				}
			  ?>
			</select></td>
	<td style='width: 25%;'>Bot Output <select name="categorie" id="cars">
			  <?php
				$query = "SELECT * FROM `"._BTM_TABLE_CONSGROUPSDB_."` WHERE sector = 'botoutput'";
				$result = mysqli_query($mysql, $query) or die(mysqli_error($mysql));
				while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
							echo '<option value="'.$row["id"].'">'.$row["title"].'</option>';
				}
			  ?>
			</select></td>
	<td style='width: 25%;'>Workflow <select name="workflow" id="cars">
			  <?php
				$query = "SELECT * FROM `"._BTM_TABLE_CONSWORKFLOW_."` WHERE step = '0'";
				$result = mysqli_query($mysql, $query) or die(mysqli_error($mysql));
				while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
							echo '<option value="'.$row["id"].'">'.$row["title"].'</option>';
				}
			  ?>
			</select></td>			
	<?php echo '<input type="hidden" name="chatsgrppostsonadmincheck" value="'.$_SESSION[ADMIN_SESSION_PRE_."chatsgrppostsonadmincheck"].'">';  ?>
	<td style='width: 25%;'><input type='submit' value='+'></td>
</form></tr><br clear="left">
</section>

<section id="newsection">
<?php


	echo '<div id="sectionheading" >Direct Reply Database</div>';

		echo '<table style="width: 100%;" cellpadding="10" cellspacing="0">';
					echo '<tr style="width: 100%;font-size: 14px;">';
						echo "<th style='width: 40%;'>Name</th>";
						echo "<th style='width: 40%;'>Type</th>";						
						echo "<th style='width: 10%;'>Operation</th>";
					echo '</tr>';
		
			$query = "SELECT * FROM `"._BTM_TABLE_CONSQUEST_."`";
			$result = mysqli_query($mysql, $query) or die(mysqli_error($mysql));
			$flag = FALSE;
			while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
				
					echo '<tr style="width: 100%;font-size: 14px;">';
					echo "<td style='width: 50%;'>[".$row["id"]."] ".$row["text"]." [".$row["relation"]."]</td>";
					if ($row["directcommand"] != NULL) { echo "<td style='width: 5%;'>Command: ".htmlspecialchars($row["directcommand"])."</td>"; }
					if ($row["directtocat"] != NULL) { echo "<td style='width: 5%;'>Categorie: ".htmlspecialchars($row["directtocat"])."</td>"; }
					if ($row["directreply"] != NULL) { echo "<td style='width: 5%;'>Reply: ".htmlspecialchars($row["directreply"])."</td>"; }
					if ($row["directworkflow"] != NULL) { echo "<td style='width: 5%;'>Workflow: ".htmlspecialchars($row["directworkflow"])."</td>"; }
					
					echo "<td style='width: 25%;'><a id='thedelbutton' href='./?location=bugfish&2ndloc=chat&coloc=direct&on=announce&op=delete&id=".$row["id"]."&chatdrepandtsonadmincheck=".$_SESSION[ADMIN_SESSION_PRE_."chatdrepandtsonadmincheck"]."'>Delete</a>";
					echo '</tr>';
				$flag = TRUE;
			}
		echo '</table>';
	?>
</section>