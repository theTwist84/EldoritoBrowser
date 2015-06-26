<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>Eldorito Server Browser </title>
<link rel="shortcut icon" href="favicon.png" />

<!-- Fonts -->
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Raleway" />
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Quicksand" />
<!----------->

<!-- Stylesheets -->
	<?php include('./inc/styles.inc.php');?>
<!---------------->

<!-- JavaScript -->
	<?php include('./inc/js.inc.php');?>
<!---------------->

<!-- Background  -->
<div id="fullscreen-1" class="epic-fullscreen" data-image="images/background/background.jpg"></div>
<!-- Background End  -->

<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

</head>

<body class="home page">


<!-- Header -->
<div id="header-wrapper">
	<div id="header-inner">
		<header>
			<div id="logo"></div>
	<div style="clear:both;"></div>
</div>
<!-- Header End -->

<!-- Container -->
<div id="content-wrapper">

	<!-- Content -->
	<section class="homepage">
		<div id="section-title">
			<div id="teaser" class="teaser-no-title">
				<h2 style="font-size:18px">Eldorito Server Browser</h1>
				<button id="refresh">Refresh</button>
				<table id="serverlist" style="width:100%">
  <tr>
     <td>Server Name (host player)</td>
    <td>Map</td> 
    <td>Game Type</td>
    <td>Status</td>
    <td>Players</td>
  </tr>
</table><br>

			<script type="text/javascript">
$(document).ready(function()
{
   // addServer("127.0.0.1:11775", "Test server", "emoose", "Guardian", "guardian", "Team Slayer", "1", "16");
});

$("#refresh").click(function()
{
    $("#serverlist").find("tr:gt(0)").remove();
    $.getJSON( "http://eldewrito-masterserver-personality.c9.io/list", function( data ) {
        if(data.result.code != 0)
        {
            alert("Error received from master: " + data.result.msg);
            return;
        }
        console.log(data);
        for(var i = 0; i < data.result.servers.length; i++)
        {
            var serverIP = data.result.servers[i];
            queryServer(serverIP);
        }
    });
});
    
function queryServer(serverIP)
{
    console.log(serverIP);
    $.getJSON("http://" + serverIP, function(serverInfo) {
        var isPassworded = serverInfo.passworded !== undefined;
        addServer(serverIP, isPassworded, serverInfo.name, serverInfo.hostPlayer, serverInfo.map, serverInfo.mapFile, serverInfo.variant, serverInfo.status, serverInfo.numPlayers, serverInfo.maxPlayers);
        console.log(serverInfo);
    });
}

function promptPassword(serverIP)
{
    var password = prompt("The server at " + serverIP + " is passworded, enter the password to join", "");
    if(password != null)
    {
        window.open("dorito:" + serverIP + "/" + password);
    }
}

function addServer(ip, isPassworded, name, host, map, mapfile, gamemode, status, numplayers, maxplayers)
{
    var servName = "<td><a href=\"dorito:" + ip + "\">" + name + " (" + host + ")</a></td>";
    if(isPassworded)
        servName = "<td><a href=\"#\" onclick=\"promptPassword('" + ip + "');\">[PASSWORDED] " + name + " (" + host + ")</a></td>";
        
    var servMap = "<td>" + map + " (" + mapfile + ")</td>";
    var servType = "<td>" + gamemode + "</td>";
    var servStatus = "<td>" + status + "</td>";
    var servPlayers = "<td>" + numplayers + "/" + maxplayers + "</td>";

    $('#serverlist tr:last').after("<tr>" + servName + servMap + servType + servStatus + servPlayers + "</tr>");
}
</script>
			</div>
		</div>
		
	</section>
	<!-- Content End -->
	
</div>

<!-- Container End -->
</body>
</html>