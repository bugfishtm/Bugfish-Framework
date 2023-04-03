	<?php @$chatcoloc	=	@$_GET["coloc"]; ?>
	<section id="newsection" style="width:95% !important;border: none !important; background: none;"  class="navlinksecondarygive">
				<a href="./?location=bugfish&2ndloc=chat&coloc=direct" <?php if(@$chatcoloc == "direct") { echo 'style="color: black !important;background:yellow !important;"'; } ?>>Direct Replys</a>
				<!--<a href="./?location=chat&coloc=workflow" <?php if(@$chatcoloc == "workflow") { echo 'style="color: black !important;background:yellow !important;"'; } ?>>Workflows</a> | -->
				<a href="./?location=bugfish&2ndloc=chat&coloc=wgroups" <?php if(@$chatcoloc == "wgroups") { echo 'style="color: black !important;background:yellow !important;"'; } ?>>Groups</a>
				<a href="./?location=bugfish&2ndloc=chat&coloc=coms" <?php if(@$chatcoloc == "coms") { echo 'style="color: black !important;background:yellow !important;"'; } ?>>Commands</a>
				<a href="./?location=bugfish&2ndloc=chat&coloc=suggest" <?php if(@$chatcoloc == "suggest" or @$chatcoloc == null) { echo 'style="color: black !important;background:yellow !important;"'; } ?>>Suggestions</a>
		</section>
		
		
<?php

	switch(@$chatcoloc) {
		case "direct":
			require_once("./modules/bugfish/chat_dr.php");
			break;
		case "workflow":
			require_once("./modules/bugfish/chat_workflows.php");
			break;
		case "wgroups":
			require_once("./modules/bugfish/chat_groups.php");
			break;
		case "coms":
			require_once("./modules/bugfish/chat_commands.php");
			break;
		default: 		
			require_once("./modules/bugfish/chat_suggest.php");
	};
?>