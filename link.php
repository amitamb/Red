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
	print json_encode(Link::add($sessionId));
}
else if (getAction() == "remove")
{
	print json_encode(Link::remove($sessionId));
}
else if (getAction() == "enlist")
{
	Link::getAll($sessionId);
}

?>
