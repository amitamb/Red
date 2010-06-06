<?
require_once("autoInclude.php");
require_once("sessionStart.php");
?>

<html>
<head>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script>
<script>

///////////////
//public var
///////////////
var keyword;
<?

print "keyword='".$_GET["keyword"]."';";

?>

function showDebug(msg)
{
	var debugText = document.getElementById("debugText");
	
	debugText.innerHTML = msg;
}

function linkEnter(x, y)
{
	//showDebug(document.location+x+y);
}

function linkDragging(x, y)
{
	//showDebug(x +","+y);
}

function linkExit()
{
	//showDebug("Exit");
}

function linkDropped(x, y, url)
{
	//showDebug('dropped'+x+y+url);

	$.getJSON(
		"link.php?action=add&keyword="+keyword+"&x="+x+"&y="+y+"&url="+url,
		function(data) {
			showLink(data.x, data.y, data.url);
		}
	);
}

function showLink(x, y, url)
{
	var links = document.getElementById("links");

	var newLink = document.createElement('a');
	newLink.innerHTML = url;
	newLink.href = url;
	
	links.appendChild(newLink);
	
	links.innerHTML += "<br>";
}

</script>
<script>
$(document).ready(function(){
<?

$links = Link::getAll($sessionId);

foreach ($links as $link)
{
	//print "<a class='bookmarkLink' href='".$link["url"]."' >".$link["url"]."</a><br>";
print "showLink('".$link["x"]."','".$link["y"]."','".$link["url"]."');";
	
}
?>
});
</script>
<script type="text/javascript" src="communication.js"></script>
<link href="global.css" media="screen" rel="stylesheet" type="text/css" />
<style>
body{text-align:left;}
a.bookmarkLink{}
</style>
</head>
<body>
<div id="debugText">
<!--
No debug text
-->
</div>
<div id="links">

</div>
</body>
</html>
