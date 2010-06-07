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
	showDebug(document.location+x+y);
}

function linkDragging(x, y)
{
	showDebug(x +","+y);
}

function linkExit()
{
	showDebug("Exit");
}

function linkDropped(x, y, url)
{
	var insideUrl = getQueryParam(url, "url");
	
	if (insideUrl != null)
	{
		url = unescape(insideUrl);
	}
	
	showLink(x, y, url);

	$.getJSON(
		"link.php?action=add&keyword="+keyword+"&x="+x+"&y="+y+"&url="+url,
		function(data) {
			// it will return json encoded link
			// do nothing with it
		}
	);
}

function showLink(x, y, url)
{
	var links = document.getElementById("links");
	
	var ht = 80;
	var wd = 125;
	
	var divLeft= x - (x % wd), divTop = y - (y % ht);
	
	var videoId = getQueryParam(url, "v");
	
	var target = "searchFrame";
	
	

	var divHtml = "<div style='position:absolute;left:"+divLeft+"px;top:"+divTop+"px;'><a target='"+target+"' style='display:block;' href='"+url+"'><img style='position:absolute;left:0px;top0px;width:"+(wd - 16)+"px;height:"+(ht - 16)+"px;' src='http://i2.ytimg.com/vi/"+videoId+"/default.jpg' />"+title+"</a></div>";

	var newLink = document.createElement('a');
	newLink.innerHTML = url;
	newLink.target = "searchFrame";
	newLink.href = url;
	
	//links.appendChild(newLink);
	
	links.innerHTML += divHtml;
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
