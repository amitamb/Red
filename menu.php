<?
require_once("autoInclude.php");
require_once("sessionStart.php");

// Following is a special code

if ($_GET["keyword"] == "youtube")
{
	header("location:youtube.php?keyword=youtube");
}

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

function setUrlTitle(url, elementId)
{
	$.getJSON(
		"http://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20html%20where%20url%3D%22"+ encodeURIComponent(url) +"%22%20and%20xpath%3D'%2F%2Ftitle'&format=json&callback=?",
		function(data){	
			if (data.query)
			if (data.query.results)
			if (data.query.results.title != null && data.query.results.title != "")
			{
				element = document.getElementById(elementId);

				element.innerHTML = data.query.results.title;
			}
		}
	);
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

function getNewId(prefix)
{
	if (! this.currentId) this.currentId = 0;

	this.currentId++;
	
	return prefix + String(this.currentId);
}

function showLink(x, y, url)
{
	var links = document.getElementById("links");

	var newLink = document.createElement('a');
	newLink.innerHTML = url;
	newLink.target = "searchFrame";
	newLink.href = url;
	var id = getNewId("link");
	newLink.id = id;
	
	links.appendChild(newLink);
	setUrlTitle(url, id);
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
