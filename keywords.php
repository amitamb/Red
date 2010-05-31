<?

require_once("sessionStart.php");

$connection = new Mongo();

$keywords = $connection->pune->keywords;

if (isset($_GET['action']))
{
	$action = $_GET['action'];
	
	if ($action == "remove")
	{
		// remove keyword
		if ($_GET['keyword'])
		{
			$keyword = $_GET['keyword'];
			
			$keyword = array("str"=>$keyword, "userSessionId"=>$sessionId);

			$keywords->remove($keyword);
			
			header('location:index.php');
			
			exit();
		}
	}
}
else
{
	if ($_GET['keyword'])
	{
		$keyword = $_GET['keyword'];
		
		$keywords->ensureIndex(array("str"=>1, "userSessionId"=>1));

		$keyword = array("str"=>$keyword, "userSessionId"=>$sessionId);

		$keywords->save($keyword);
		
		header('location:index.php');
		
		exit();
	}
}

$query = array("userSessionId"=>$sessionId);

$cursor = $keywords->find($query);

$keywordsList = array();

while( $cursor->hasNext() ) {
	$keywordsList[] = $cursor->getNext();
}

require_once("header.php");

?>

<!--
<html>
<head>
<title>Keywords to track</title>
</head>
<body>
-->
<form>

<input type="text" name="keyword"></input> <button>Add</button>

</form>
<a href="showLog.php">Show log</a>
<table border="1" width="400px">
<?

$keywords = $keywordsList;

foreach ($keywords as $keyword)
{
	print "<tr><td>".$keyword["str"]."<td width='80px'><a href='?action=remove&keyword=".$keyword["str"]."'>remove</a>";
}

?>
</table>
<?

require_once("footer.php");

?>

