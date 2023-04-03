<?php
	switch(htmlspecialchars(@$_GET["group"])) {
		case "usrinput":
				require_once("./modules/bugfish/chat_groups_usrinput.php");
			break;
		case "botoutput":
				require_once("./modules/bugfish/chat_groups_botoutput.php");
			break;
		case "winput":
				require_once("./modules/bugfish/chat_groups_winput.php");
			break;
		case "woutput":
				require_once("./modules/bugfish/chat_groups_woutput.php");
			break;			
		default:
			require_once("./modules/bugfish/chat_groups_global.php");
	};
?>