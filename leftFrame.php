<?
require_once("autoInclude.php");
require_once("sessionStart.php");

?>

<html>
<head>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script>
<script type="text/javascript" src="defaultHandler.js"></script>
<script>

///////////////
//public var
///////////////
var keyword;
<?

print "keyword='".$_GET["keyword"]."';";

?>

function getQueryParam(url, key)
{
	var uParts = url.split("?");
	
	if (uParts.length <= 1)
	{
		return null;
	}

	gy = uParts[1].split("&");
	for (i=0;i<gy.length;i++) 
	{
		ft = gy[i].split("=");
		if (ft[0] == key)
		{
			return ft[1];
		}
	}
}

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
	var insideUrl = getQueryParam(url, "url");
	
	if (insideUrl != null)
	{
		url = unescape(insideUrl);
	}

	$.getJSON(
		"link.php?action=add&keyword="+keyword+"&x="+x+"&y="+y+"&url="+url,
		function(data) {
			// it will return json encoded link
			// do nothing with it
		}
	);
	
	showLink(x, y, url);
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
