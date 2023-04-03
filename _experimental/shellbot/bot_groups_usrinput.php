<?php
		//DELLANNOUNCE
			@$on 	=	$_GET["on"];
			@$id 	=	htmlspecialchars($_GET["id"]);
			@$op 	=	$_GET["op"];
			
	if (@$_SESSION[ADMIN_SESSION_PRE_."chatsgrpandtsonadmincheck"] == @$_GET["chatsgrpandtsonadmincheck"] AND @$_GET["chatsgrpandtsonadmincheck"] != NULL) {
		
		if ($on == "text" && $op == "delete" && !empty($id) )
		{
				$query = "DELETE FROM `"._BTM_TABLE_CONSGROUPTE_."` WHERE id = '".$id."'";
				$result = mysqli_query($mysql, $query);			
										

		}
		
		
		if ($on == "announce" && $op == "delete" && !empty($id) )
		{
				$query12 = "SELECT * FROM `"._BTM_TABLE_CONSGROUPSDB_."` WHERE tocat = \"".$id."\"";
				$result12 = mysqli_query($mysql, $query12) or die(mysqli_error($mysql));
				$flag = FALSE;
				while ($row = @mysqli_fetch_array($result12, MYSQLI_BOTH)) {	
					$flag = true;
				}				
				$query12 = "SELECT * FROM `"._BTM_TABLE_CONSQUEST_."` WHERE directtocat = \"".$id."\"";
				$result12 = mysqli_query($mysql, $query12) or die(mysqli_error($mysql));
				while ($row = @mysqli_fetch_array($result12, MYSQLI_BOTH)) {	
					$flag = true;
				}		
				$query12 = "SELECT * FROM `"._BTM_TABLE_CONSWORKFLOW_."` WHERE tocat = \"".$id."\"";
				$result12 = mysqli_query($mysql, $query12) or die(mysqli_error($mysql));
				while ($row = @mysqli_fetch_array($result12, MYSQLI_BOTH)) {	
					$flag = true;
				}						
				
				$query12 = "SELECT * FROM `"._BTM_TABLE_CONSGROUPTE_."` WHERE "._BTM_TABLE_CONSGROUPTE_.".group = \"".$id."\"";
				$result12 = mysqli_query($mysql, $query12) or die(mysqli_error($mysql));
				while ($row = @mysqli_fetch_array($result12, MYSQLI_BOTH)) {	
					$flag = true;
				}					
				
						if (!$flag) {
				$query = "DELETE FROM `"._BTM_TABLE_CONSGROUPSDB_."` WHERE id = '".$id."'";
				$result = mysqli_query($mysql, $query);			
										
						} else {
						
							echo "<font size='+2' color='red'>GROUP IS USED BY TEXT OR OBJECT</font>";
						}

			
			}	
		}	else {
		$_SESSION[ADMIN_SESSION_PRE_."chatsgrpandtsonadmincheck"]	=	mt_rand(10000, 9999999);
		}
		
				//ADDANNOUNCE
			@$xtitle 	=	$_POST["xtitle"];
			@$xtext 	=	$_POST["xtext"];
		if (@$_SESSION[ADMIN_SESSION_PRE_."chatsgrppostsonadmincheck"] == @$_POST["chatsgrppostsonadmincheck"] AND @$_POST["chatsgrppostsonadmincheck"] != NULL AND @$_POST["checking"] == "ok") {	


				$flag = false;
				$query12 = "SELECT * FROM `"._BTM_TABLE_CONSGROUPTE_."` INNER JOIN "._BTM_TABLE_CONSGROUPSDB_." ON "._BTM_TABLE_CONSGROUPSDB_.".id = "._BTM_TABLE_CONSGROUPTE_.".group WHERE "._BTM_TABLE_CONSGROUPTE_.".text = \"".str_replace('"', '\"',$xtitle)."\" AND sector = \"usrinput\"";
				$result12 = mysqli_query($mysql, $query12) or die(mysqli_error($mysql));
				while ($row = @mysqli_fetch_array($result12, MYSQLI_BOTH)) {	
					$flag = true;
				}					
				
						if (!$flag) {
			$query = "INSERT INTO `"._BTM_TABLE_CONSGROUPTE_."` (text, "._BTM_TABLE_CONSGROUPTE_.".group, relation) VALUES (\"".str_replace('"', '\"',strtolower($xtitle))."\", '".htmlspecialchars($_POST["catid"])."' , '".$xtext."');";
			$result = @mysqli_query($mysql, $query);			
										
						} else {
						
							echo "<font size='+2' color='red'>TEXT DUPLICATE</font>";
						}

			



		}
		
		
		
		if (@$_SESSION[ADMIN_SESSION_PRE_."chatsgrppostsonadmincheck"] == @$_POST["chatsgrppostsonadmincheck"] AND @$_POST["chatsgrppostsonadmincheck"] != NULL) {		

		if ($on == "announce" && !empty($_POST["xtext"]))
		{
						if (@$_POST["type"] == "command") {
					$query = "INSERT INTO `"._BTM_TABLE_CONSGROUPSDB_."` (title, sector, relation, tocommand) VALUES (\"".htmlspecialchars(strtolower($_POST["text"]))."\", 'usrinput','".htmlspecialchars($_POST["relation"])."' , '".htmlspecialchars($_POST["command"])."');";				

			}
			
			if (@$_POST["type"] == "reply") {
					$query = "INSERT INTO `"._BTM_TABLE_CONSGROUPSDB_."` (title, sector, relation, reply) VALUES (\"".htmlspecialchars(strtolower($_POST["text"]))."\", 'usrinput','".htmlspecialchars($_POST["relation"])."' , \"".htmlspecialchars($_POST["reply"])."\");";			
			
			}
			
			if (@$_POST["type"] == "tocat") {
				$query = "INSERT INTO `"._BTM_TABLE_CONSGROUPSDB_."` (title, sector,  relation, tocat) VALUES (\"".htmlspecialchars(strtolower($_POST["text"]))."\", 'usrinput','".htmlspecialchars($_POST["relation"])."' , '".htmlspecialchars($_POST["categorie"])."');";					
				
			}
			
			if (@$_POST["type"] == "toflow") {
				
					$query = "INSERT INTO `"._BTM_TABLE_CONSGROUPSDB_."` (title, sector, relation, toworkflow) VALUES (\"".htmlspecialchars(strtolower($_POST["text"]))."\",'usrinput', '".htmlspecialchars($_POST["relation"])."' , '".htmlspecialchars($_POST["workflow"])."');";					
			}
			
			$result = mysqli_query($mysql, $query) or die(mysqli_error($mysql));	
		}}  else {
		$_SESSION[ADMIN_SESSION_PRE_."chatsgrppostsonadmincheck"]	=	mt_rand(10000, 9999999);
	}

?>

<section id="newsection" style="width: 95% !important;">
<div id="sectionheading" >Add Text</div>
<center><font style="color: yellow; font-size: 12px;">Here are Groups!<br />
				They can be put in a Simple Workflow or a Complex one<br /><br />
				Rows Text: ID [id] | text [text] | group [id] | relation [image 0 default] <br />
				Rows Groups: ID [id] | tocat | sector | tocommand [commandcode] | title |toworkflow | reply | relation <br />
				If a Group is used, it cant be deleted! Categorie name is UNIQUE</font></center>


		<br /><br />
				<a href="./?location=bugfish&2ndloc=chat&coloc=wgroups&group=global" >Global Groups</a> | 
				<a href="./?location=bugfish&2ndloc=chat&coloc=wgroups&group=usrinput" style="color: lightgrey !important;">User Inputs</a> | 			
				<a href="./?location=bugfish&2ndloc=chat&coloc=wgroups&group=botoutput"  >Bot Outputs</a> <!--| 
				<a href="./?location=bugfish&2ndloc=chat&coloc=wgroups&group=winput" >Workflow Inputs</a> | 
				<a href="./?location=bugfish&2ndloc=chat&coloc=wgroups&group=woutput" >Workflow Outputs</a>-->
		</section>




<?php
if (@$_GET["show"] != NULL AND @$_GET["show"] != "" AND @$_GET["type"] == "usrinput") {
?>
<section id="newsection">
<center><font style="font-size: 12px;">CHANGE TEXT FOR SELECTED AREA</font></center>
<tr style="width: 100%;font-size: 14px;"><?php echo '<form method="post" action="./?location=bugfish&2ndloc=chat&group=usrinput&coloc=wgroups&on=announce&show='.@htmlspecialchars($_GET["show"]).'">'; ?>
	<td style='width: 25%;'><input type='text' name='xtitle' placeholder="NAME"></td>
	<td style='width: 25%;'>Relation <select name="xtext" >
				<option value="0">0</option>
				<option value="cry">cry</option>
				<option value="dance">dance</option>
				<option value="dizzy">dizzy</option>
				<option value="gangsta">gangsta</option>
				<option value="idea">idea</option>
				<option value="medic">medic</option>
				<option value="music">music</option>
				<option value="think">think</option>
				<option value="vomit">vomit</option>
				<option value="what">what</option>
				
			</select></td>
	<input type="hidden" name='checking' value="ok">
	<?php echo '<input type="hidden" name="chatsgrppostsonadmincheck" value="'.$_SESSION[ADMIN_SESSION_PRE_."chatsgrppostsonadmincheck"].'">';  ?>
	<?php echo '<input type="hidden" name="catid" value="'.@htmlspecialchars($_GET["show"]).'">';  ?>
	<td style='width: 25%;'><input type='submit' value='+'></td>
</form></tr><br clear="left">
</section>

<section id="newsection">
<div id="sectionheading" >Change Text</div>
	<?php
		echo '<table style="width: 100%;" cellpadding="10" cellspacing="0">';
					echo '<tr style="width: 100%;font-size: 14px;">';
						echo "<th style='width: 40%;'>Text</th>";					
						echo "<th style='width: 10%;'>Relation</th>";
						echo "<th style='width: 10%;'>DEL</th>";
					echo '</tr>';
		
			$query = "SELECT * FROM `"._BTM_TABLE_CONSGROUPTE_."` WHERE "._BTM_TABLE_CONSGROUPTE_.".group = \"".@htmlspecialchars($_GET["show"])."\"";
			$result = mysqli_query($mysql, $query) or die(mysqli_error($mysql));
			$flag = FALSE;
			while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
					echo '<tr style="width: 100%;font-size: 14px;">';
					echo "<td style='width: 75%;'>".htmlspecialchars($row["text"])."</td>";
					echo "<td style='width: 5%;'>".htmlspecialchars($row["relation"])."</td>";
					echo "<td style='width: 25%;'><a id='thedelbutton' href='./?location=bugfish&2ndloc=chat&coloc=wgroups&group=usrinput&show=".@htmlspecialchars($_GET["show"])."&on=text&op=delete&id=".$row["id"]."&chatsgrpandtsonadmincheck=".$_SESSION[ADMIN_SESSION_PRE_."chatsgrpandtsonadmincheck"]."'>Delete</a>";
					echo '</tr>';
				$flag = TRUE;
			}
		echo '</table><br /><br />';
	?>
</section>

<?php
}
?>

<section id="newsection">
<div id="sectionheading" >Add Group</div>
<center><font style="color: yellow; font-size: 12px;">BOT OUTPUT</font></center>



<tr style="width: 100%;font-size: 14px;"><form method="post" action="./?location=bugfish&2ndloc=chat&group=usrinput&coloc=wgroups&on=announce">
	<td style='width: 25%;'><input type='text' name='text' placeholder="NAME"><br /></td>
		<td style='width: 25%;'>Relation <select name="relation" ><br />
				<option value="cry">cry</option>
				<option value="dance">dance</option>
				<option value="dizzy">dizzy</option>
				<option value="gangsta">gangsta</option>
				<option value="idea">idea</option>
				<option value="medic">medic</option>
				<option value="music">music</option>
				<option value="think">think</option>
				<option value="vomit">vomit</option>
				<option value="what">what</option>
				
			</select><br /></td>	

	<td style='width: 25%;'><input type='text' name='reply' placeholder="Reply"></td><br />
	
	<td style='width: 25%;'>Type <select name="type" >
			<option value="command">command</option>
			<option value="reply">reply</option>
			<option value="tocat">tocat</option>
			<option value="toflow">toflow</option>
			</select></td>	<br />
	
	<td style='width: 25%;'>Command <select name="command" >
			  <?php
				$query = "SELECT * FROM `"._BTM_TABLE_CONSCOMMAND_."`";
				$result = mysqli_query($mysql, $query) or die(mysqli_error($mysql));
				while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
							echo '<option value="'.$row["id"].'">'.$row["name"].'</option>';
				}
			  ?>
			</select></td><br />
	<td style='width: 25%;'>Bot Output <select name="categorie" id="cars">
			  <?php
				$query = "SELECT * FROM `"._BTM_TABLE_CONSGROUPSDB_."` WHERE sector = 'botoutput'";
				$result = mysqli_query($mysql, $query) or die(mysqli_error($mysql));
				while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
							echo '<option value="'.$row["id"].'">'.$row["title"].'</option>';
				}
			  ?>
			</select></td><br />
	<td style='width: 25%;'>Workflow <select name="workflow" id="cars">
			  <?php
				$query = "SELECT * FROM `"._BTM_TABLE_CONSWORKFLOW_."` WHERE step = '0'";
				$result = mysqli_query($mysql, $query) or die(mysqli_error($mysql));
				while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
							echo '<option value="'.$row["id"].'">'.$row["title"].'</option>';
				}
			  ?>
			</select></td>	<br />

			

	<input type="hidden" name='xtext' value="usrinput">
	<?php echo '<input type="hidden" name="chatsgrppostsonadmincheck" value="'.$_SESSION[ADMIN_SESSION_PRE_."chatsgrppostsonadmincheck"].'">';  ?>
	<td style='width: 25%;'><input type='submit' value='+'></td>
</form></tr><br clear="left">
</section>
<section id="newsection">

<?php


	echo '<div id="sectionheading" >[Global]</div>';

		echo '<table style="width: 100%;" cellpadding="10" cellspacing="0">';
					echo '<tr style="width: 100%;font-size: 14px;">';
						echo "<th style='width: 40%;'>Name</th>";					
						echo "<th style='width: 10%;'>Operation</th>";
					echo '</tr>';
		
			$query = "SELECT * FROM `"._BTM_TABLE_CONSGROUPSDB_."` WHERE sector = 'usrinput'";
			$result = mysqli_query($mysql, $query) or die(mysqli_error($mysql));
			$flag = FALSE;
			while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
					$counter = 0;
					$query12 = "SELECT * FROM `"._BTM_TABLE_CONSGROUPTE_."` WHERE "._BTM_TABLE_CONSGROUPTE_.".group = ".$row["id"]."";
					$result12 = mysqli_query($mysql, $query12) or die(mysqli_error($mysql));
					while ($row22 = @mysqli_fetch_array($result12, MYSQLI_BOTH)) {	
						$counter = $counter + 1;
					}						
					echo '<tr style="width: 100%;font-size: 14px;">';
					echo "<td style='width: 75%;'><a href='./?location=bugfish&2ndloc=chat&coloc=wgroups&type=usrinput&group=usrinput&show=".$row["id"]." '>".$row["title"]." [ ".$counter." ]</a></td>";
										if ($row["tocommand"] != NULL) { echo "<td style='width: 5%;'>Command: ".htmlspecialchars($row["tocommand"])."</td>"; }
					if ($row["tocat"] != NULL) { echo "<td style='width: 5%;'>Categorie: ".htmlspecialchars($row["tocat"])."</td>"; }
					if ($row["reply"] != NULL) { echo "<td style='width: 5%;'>Reply: ".htmlspecialchars($row["reply"])."</td>"; }
					if ($row["toworkflow"] != NULL) { echo "<td style='width: 5%;'>Workflow: ".htmlspecialchars($row["toworkflow"])."</td>"; }
					
					echo "<td style='width: 25%;'><a id='thedelbutton' href='./?location=bugfish&2ndloc=chat&coloc=wgroups&group=usrinput&on=announce&op=delete&id=".$row["id"]."&chatsgrpandtsonadmincheck=".$_SESSION[ADMIN_SESSION_PRE_."chatsgrpandtsonadmincheck"]."'>Delete</a>";
					echo '</tr>';
				$flag = TRUE;
			}
		echo '</table>';
	?>
</section>
