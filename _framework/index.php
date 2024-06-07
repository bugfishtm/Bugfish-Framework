<?php
	/* 
		 _               __ _    _    ___ __  __ ___ 
		| |__ _  _ __ _ / _(_)__| |_ / __|  \/  / __|
		| '_ \ || / _` |  _| (_-< ' \ (__| |\/| \__ \
		|_.__/\_,_\__, |_| |_/__/_||_\___|_|  |_|___/
				  |___/                              

		Copyright (C) 2024 Jan Maurice Dahlmanns [Bugfish]

		This program is free software: you can redistribute it and/or modify
		it under the terms of the GNU General Public License as published by
		the Free Software Foundation, either version 3 of the License, or
		(at your option) any later version.

		This program is distributed in the hope that it will be useful,
		but WITHOUT ANY WARRANTY; without even the implied warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
		GNU General Public License for more details.

		You should have received a copy of the GNU General Public License
		along with this program.  If not, see <https://www.gnu.org/licenses/>.
		
		File Description:
			This is a Forwarding File. It serves to forward the user back 
			to the root directory, if he is somehow getting into that folder.
			This is a seperat security measure if directory listing is activated 
			at the webserver, to prevent direct file browsing and to always lead
			the user to the correct location.
	*/
	@http_response_code(404);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<!--
		 _               __ _    _    ___ __  __ ___ 
		| |__ _  _ __ _ / _(_)__| |_ / __|  \/  / __|
		| '_ \ || / _` |  _| (_-< ' \ (__| |\/| \__ \
		|_.__/\_,_\__, |_| |_/__/_||_\___|_|  |_|___/
				  |___/                              	
										Error / Notification CMS Page
	-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="robots" content="noindex, nofollow">
    <title>Error - CMS</title>
    <style>
        body { 	margin: 0;
				padding: 0;
				height: 100vh;
				min-height: 225px;
				display: flex;
				justify-content: center;
				align-items: center;
				background-color: #080808;
				color: #fff;
				padding-top: 20px;
				padding-bottom: 20px;
				box-sizing: border-box;
				font-family: Arial, sans-serif; }
        h1 { 	font-size: 24px; margin-bottom: 10px; }
        p { 	font-size: 16px; margin-bottom: 20px; }
        .container {
				text-align: center;
				max-width: 400px;
				padding: 20px;
				margin: 20px;
				padding-top: 0px;
				border: 2px solid #FF0000;
				border-radius: 10px;
				background-color: #121212;}
        .box {
            background-color: #444;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
			font-size: 14px !important;
			text-align: left;
			max-height: 75px;
			overflow-y: auto;
			font-family: Courier; }
		a { color: white; text-decoration: none; font-size: 12px; }
    </style>
</head>
<body>
    <div class="container error-container">
        <h1>Error</h1>
        <div class="box info-box">
            Directory listing is not allowed!
        </div><br />
		<a href="../">Click here to get back!</a>
    </div>
</body>
</html>
