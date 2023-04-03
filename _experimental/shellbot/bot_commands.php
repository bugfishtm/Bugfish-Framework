<?php
			@$on 	=	htmlspecialchars($_GET["on"]);
			@$id 	=	htmlspecialchars($_GET["id"]);
			@$op 	=	htmlspecialchars($_GET["op"]);
			
	if (@$_SESSION[ADMIN_SESSION_PRE_."chatscommandtsonadmincheck"] == @$_GET["chatscommandtsonadmincheck"] AND @$_GET["chatscommandtsonadmincheck"] != NULL) {
		if ($on == "announce" && $op == "delete" && !empty($id) )
		{
				$query12 = "SELECT * FROM `"._BTM_TABLE_CONSGROUPSDB_."` WHERE tocommand = \"".$id."\"";
				$result12 = mysqli_query($mysql, $query12) or die(mysqli_error($mysql));
				$flag = FALSE;
				while ($row = mysqli_fetch_array($result12, MYSQLI_BOTH)) {	
					$flag = true;
				}				
				$query12 = "SELECT * FROM `"._BTM_TABLE_CONSQUEST_."` WHERE directcommand = \"".$id."\"";
				$result12 = mysqli_query($mysql, $query12) or die(mysqli_error($mysql));
				while ($row = mysqli_fetch_array($result12, MYSQLI_BOTH)) {	
					$flag = true;
				}		
				
				$query12 = "SELECT * FROM `"._BTM_TABLE_CONSWORKFLOW_."` WHERE tocommand = \"".$id."\"";
				$result12 = mysqli_query($mysql, $query12) or die(mysqli_error($mysql));
				while ($row = mysqli_fetch_array($result12, MYSQLI_BOTH)) {	
					$flag = true;
				}		
								
				
						if (!$flag) {
				$query = "DELETE FROM `"._BTM_TABLE_CONSCOMMAND_."` WHERE id = \"".$id."\"";
				$result = mysqli_query($mysql, $query);			
										
						} else {
						
							echo "<font size='+2' color='red'>COMMAND IS USED BY AN OBJECT</font>";
						}

			
			}	
		}	else {
		$_SESSION[ADMIN_SESSION_PRE_."chatscommandtsonadmincheck"]	=	mt_rand(10000, 9999999);
		}
		
		if (@$_SESSION[ADMIN_SESSION_PRE_."chatscopostdtsonadmincheck"] == @$_POST["chatscopostdtsonadmincheck"] AND @$_POST["chatscopostdtsonadmincheck"] != NULL) {		
		//ADDANNOUNCE
			@$xtitle 	=	$_POST["xtitle"];
			@$xtext 	=	$_POST["xtext"];
		if ($on == "announce" && !empty($xtitle) && !empty($xtext))
		{
			$query = "INSERT INTO `"._BTM_TABLE_CONSCOMMAND_."` (name, command) VALUES (\"".htmlspecialchars($xtitle)."\", \"".str_replace('"', '\"', $xtext)."\");";
			$result = mysqli_query($mysql, $query) or die(mysqli_error($mysql));			
		}}  else {
		$_SESSION[ADMIN_SESSION_PRE_."chatscopostdtsonadmincheck"]	=	mt_rand(10000, 9999999);
	}

?>

<section id="newsection">
	<div id="sectionheading" >Commands</div>
<center><font style="color: yellow; font-size: 12px;">Here are Commands!<br />
				It can be run by categories / direct replys or workflows<br /><br />
				Rows: ID [id] | command [commandcode] | name [nameofcommand] <br />
				If a command is used it cant be deleted!</font></center>


				<tr style="width: 100%;font-size: 14px;"><form method="post" action="./?location=bugfish&2ndloc=chat&coloc=coms&on=announce">
					<td style='width: 25%;'><input type='text' name='xtitle' placeholder="NAME"></td>
					<td style='width: 25%;'><textarea name='xtext' placeholder="COMMAND"></textarea></td>
					<?php echo '<input type="hidden" name="chatscopostdtsonadmincheck" value="'.$_SESSION[ADMIN_SESSION_PRE_."chatscopostdtsonadmincheck"].'">';  ?>
					<td style='width: 25%;'><input type='submit' value='+'></td>
				</form></tr>
</section>

<section id="newsection">
	<div id="sectionheading" >Commands</div>
	<?php

	echo '<table style="width: 100%;" cellpadding="10" cellspacing="0">';
				echo '<tr style="width: 100%;font-size: 14px;">';
					echo "<th style='width: 20%;'>Name</th>";
					echo "<th style='width: 75%;'>Command</th>";
					echo "<th style='width: 5%;'>Delete</th>";
				echo '</tr>';
	
		$query = "SELECT * FROM `"._BTM_TABLE_CONSCOMMAND_."` ";
		$result = mysqli_query($mysql, $query) or die(mysqli_error($mysql));
		$flag = FALSE;
		while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
				echo '<tr style="width: 100%;font-size: 14px;">';
				echo "<td style='width: 20%;'>".$row["name"]."</td>";
				echo "<td style='width: 75%;'>".htmlspecialchars($row["command"])."</td>";
				
				echo "<td style='width: 5%;'><a id='thedelbutton' href='./?location=bugfish&2ndloc=chat&coloc=coms&on=announce&op=delete&id=".$row["id"]."&chatscommandtsonadmincheck=".$_SESSION[ADMIN_SESSION_PRE_."chatscommandtsonadmincheck"]."'>Delete</a>";
				
				
				echo '</tr>';
			$flag = TRUE;
		}
	echo '</table>';
	?>
</section>

