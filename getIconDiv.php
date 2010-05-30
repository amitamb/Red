<?

$x = $_GET["x"];
$y = $_GET["y"];
$url = $_GET["url"];

$iconDivStyle = array();

$iconDivStyle["position"] = "absolute";

$iconDivStyle["width"] = "20px";
$iconDivStyle["height"] = "20px";

$iconDivStyle["left"] = ($x - 10)."px";
$iconDivStyle["top"] = ($y - 10)."px";

$iconUrl = "http://www.youtube.com/favicon.ico";

$iconImgStyle = array();

$iconImgStyle["border"] = "0px";

$iconImgStyle["position"] = "absolute";

$iconImgStyle["top"] = "2px";
$iconImgStyle["left"] = "2px";

?>

<div style="<?

foreach ($iconDivStyle as $key=>$value)
{
	print "$key:$value;";
}

?>">
<a href="<? print $url; ?>" onclick="return false;">
<img style="<?

foreach ($iconImgStyle as $key=>$value)
{
	print "$key:$value;";
}

?>" src="<? print $iconUrl; ?>"></img>
</a>
</div>

<?

?>
