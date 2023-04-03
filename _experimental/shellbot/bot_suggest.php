<?php
		//DELLANNOUNCE
			@$on 	=	$_GET["on"];
			@$id 	=	$_GET["id"];
			@$op 	=	$_GET["op"];
			
	if (@$_SESSION[ADMIN_SESSION_PRE_."chatsuggestsonadmincheck"] == @$_GET["chatsuggestsonadmincheck"] AND @$_GET["chatsuggestsonadmincheck"] != NULL) {
		if ($on == "announce" && $op == "delete" && !empty($id) )
		{
			$query = "DELETE FROM `"._BTM_TABLE_CONSSUGGEST_."` WHERE id = '".$id."'";
			$result = mysqli_query($mysql, $query);// or die(mysqli_error($mysql));			
			}
			
		if ($on == "announce" && $op == "deny" && !empty($id) )
		{
			$query = "UPDATE `"._BTM_TABLE_CONSSUGGEST_."` SET status = 2 WHERE id = '".$id."'";
			$result = mysqli_query($mysql, $query);// or die(mysqli_error($mysql));			
			}			
			
		}	else {
		$_SESSION[ADMIN_SESSION_PRE_."chatsuggestsonadmincheck"]	=	mt_rand(10000, 9999999);
		}

?>

<section id="newsection" style="width: 95% !important">
	<div id="sectionheading" >Informations</div>
<center><font style="color: yellow; font-size: 12px;">Here are Chat Suggestions!<br />
				If a user input is unknown it will be stored here...<br />
				Denied will not be suggested again!<br /><br />
				Rows: ID [id] | text [text] | atid [workflow location] | status 2 = deny && else = unknown <br />
				There are no relations to workflows or reply operations here!</font></center>

</section>
<section id="newsection">
	<div id="sectionheading" >Suggestions</div>
	<?php

	echo '<table style="width: 100%;" cellpadding="10" cellspacing="0">';
				echo '<tr style="width: 100%;font-size: 14px;">';
					echo "<th style='width: 75%;'>Text</th>";
					echo "<th style='width: 5%;'>From</th>";
					echo "<th style='width: 5%;'>Deny</th>";
				echo '</tr>';
	
		$query = "SELECT * FROM `"._BTM_TABLE_CONSSUGGEST_."` WHERE status <> 2 ";
		$result = mysqli_query($mysql, $query) or die(mysqli_error($mysql));
		$flag = FALSE;
		while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
				echo '<tr style="width: 100%;font-size: 14px;">';
				echo "<td style='width: 75%;'>".htmlspecialchars($row["text"])."</td>";
				echo "<td style='width: 5%;'>".$row["atid"]."</td>";
				echo "<td style='width: 25%;'><a id='thedelbutton' href='./?location=bugfish&2ndloc=chat&on=announce&op=delete&id=".$row["id"]."&chatsuggestsonadmincheck=".$_SESSION[ADMIN_SESSION_PRE_."chatsuggestsonadmincheck"]."'>Delete</a>";
				echo "<a id='thedelbutton' href='./?location=bugfish&2ndloc=chat&on=announce&op=deny&id=".$row["id"]."&chatsuggestsonadmincheck=".$_SESSION[ADMIN_SESSION_PRE_."chatsuggestsonadmincheck"]."'>Deny</a></td>";
				echo '</tr>';
			$flag = TRUE;
		}
	echo '</table>';
	?>
</section>
<section id="newsection">
	<div id="sectionheading" >Denied</div>
	<?php

	echo '<table style="width: 100%;" cellpadding="10" cellspacing="0">';
				echo '<tr style="width: 100%;font-size: 14px;">';
					echo "<th style='width: 75%;'>Text</th>";
					echo "<th style='width: 5%;'>From</th>";
					echo "<th style='width: 5%;'>Delete</th>";
				echo '</tr>';
	
		$query = "SELECT * FROM `"._BTM_TABLE_CONSSUGGEST_."` WHERE status = 2 ";
		$result = mysqli_query($mysql, $query) or die(mysqli_error($mysql));
		$flag = FALSE;
		while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
				echo '<tr style="width: 100%;font-size: 14px;">';
				echo "<td style='width: 75%;'>".htmlspecialchars($row["text"])."</td>";
				echo "<td style='width: 5%;'>".$row["atid"]."</td>";
				echo "<td style='width: 25%;'><a id='thedelbutton' href='./?location=bugfish&2ndloc=chat&on=announce&op=delete&id=".$row["id"]."&chatsuggestsonadmincheck=".$_SESSION[ADMIN_SESSION_PRE_."chatsuggestsonadmincheck"]."'>Delete</a></td>";
				echo '</tr>';
			$flag = TRUE;
		}
	echo '</table>';
	?>
</section>