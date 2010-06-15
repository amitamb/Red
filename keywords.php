<?

require_once("autoInclude.php");
require_once("sessionStart.php");

function getAction()
{
	if (isset($_GET['action']))
	{
		return $_GET['action'];
	}
	else
	{
		return null;
	}
}

if (getAction() == "add")
{
	Keyword::add($sessionId);
	
	header('location:keywords.php?update=true');
}
else if (getAction() == "remove")
{
	Keyword::remove($sessionId);
	
	header('location:keywords.php');
}
else if (getAction() == "enlist")
{
	$keywords = Keyword::getKeywords($sessionId);
	
	foreach ($keywords as $keyword)
	{
		//print "<tr><td>".$keyword["str"]."<td width='80px'><form method='post' action='keywords.php?action=remove' ><input type='hidden' name='_id' value='".$keyword["_id"]."'><button>Remove</button></form>";
		print $keyword["str"]."\n";
	}
	
	exit();
}
else
{
	$keywords = Keyword::getKeywords($sessionId);
}

require_once("header.php");

?>

<style>

#tableDiv{text-align:center;width:100%;margin-left:auto;margin-right:auto;}
#tableDiv table{text-align:center;width:100%;}
#keyword{width:100%;text-align:center;}

</style>

<script>

$(document).ready(function(){
	
});

</script>

<div style="text-align:center;">
Example keywords: mumbai, java, php
</div>

<div id="tableDiv">
<table border="1" width="400px">

<tr><td>
<form id="addKeywordForm" method="POST" action="keywords.php?action=add">

<input id="keyword" type="text" name="keyword"></input>

</td>
<td>

<button id="addKeyword">Add</button>

</form>
</td></tr>
<?

foreach ($keywords as $keyword)
{
	print "<tr><td>".$keyword["str"]."<td width='80px'><form method='post' action='keywords.php?action=remove' ><input type='hidden' name='_id' value='".$keyword["_id"]."'><button>Remove</button></form>";
}

?>
</table>

</div>
<script>


/////////////////////
// Following part should be copied as it is from search.htm
/////////////////////

function getCookie(c_name)
{
	if (document.cookie.length>0)
	{
		c_start=document.cookie.indexOf(c_name + "=");
		if (c_start!=-1)
		{
			c_start=c_start + c_name.length+1;
			c_end=document.cookie.indexOf(";",c_start);
			if (c_end==-1) c_end=document.cookie.length;
			return unescape(document.cookie.substring(c_start,c_end));
		}
	}
	return "";
}

function setKeywordsArrayLocal(keywords)
{
	var username = getCookie("username");
	localStorage.setItem(username+".keywords", keywords);
	localStorage.setItem(username+".lastUpdateDateTime", new Date());
}

// synchrounous http call
// wait for it
function updateKeywordsArray()
{
	var xmlhttp;
	if (window.XMLHttpRequest)
	{
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else
	{
		// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}

	// making the call syncronous
	xmlhttp.open("GET","keywords.php?action=enlist",false); // false
	xmlhttp.send(null);

	var lines = xmlhttp.responseText.split("\n");

	var keywords = new Array();
	
	for (var i=0;i<lines.length;i++)
	{
		var line = lines[i];
		
		if (line.length > 0)
		{
			keywords.push(line);
		}
	}

	setKeywordsArrayLocal(keywords);
	
	return keywords;
}

<? if (isset($_GET["update"]) && $_GET["update"] == "true" )
{ ?>

updateKeywordsArray();

<? 
}
?>

</script>
<?

require_once("footer.php");

?>

