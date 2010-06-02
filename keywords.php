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
	
	header('location:keywords.php');
}
else if (getAction() == "remove")
{
	Keyword::remove($sessionId);
	
	header('location:keywords.php');
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
#keyword{width:400px;}

</style>

<script>

$(document).ready(function(){
	
});

</script>
<div id="tableDiv">
<table border="1" width="400px">

<tr><td>
<form id="addKeywordForm" method="POST" action="keywords.php?action=add">

<input id="keyword" type="text" name="keyword"></input> <button id="addKeyword">Add</button>

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
<?

require_once("footer.php");

?>

