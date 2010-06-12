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

if (getAction() == "getSessionByKeyword")
{
	// return raw sessionId
	print json_encode(Session::getId($sessionId));
}
else if (getAction() == "remove")
{
	print json_encode(Link::remove($sessionId));
	
//	print "Remove called".$_GET["_id"];
}
else if (getAction() == "enlist")
{
	Link::getAll($sessionId);
}


?>
