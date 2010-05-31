<?

function parse_query($var)
{
	/**
	*  Use this function to parse out the query array element from
	*  the output of parse_url().
	*/
	$var  = parse_url($var, PHP_URL_QUERY);
	$var  = html_entity_decode($var);
	$var  = explode('&', $var);
	$arr  = array();
	
	foreach($var as $val)
	{
		$x          = explode('=', $val);
		$arr[$x[0]] = $x[1];
	}
	unset($val, $x, $var);
	return $arr;
}

$x = $_GET["x"];
$y = $_GET["y"];
$url = $_GET["url"];

$iconDivStyle = array();

$iconDivStyle["position"] = "absolute";


////////
// Width and height should divide 250
////////

$width = 50;
$height = 50;

$iconDivStyle["width"] = $width."px";
$iconDivStyle["height"] = $height."px";

/*
$apparentLeft = ($x - ($width / 2));
$apparentTop = ($y - ($height / 2));
*/

$actualLeft = $x - ($x % $width);
$actualTop = $y - ($y % $height);

print $actualLeft."<br>";
print $actualTop;

$iconDivStyle["left"] = $actualLeft."px";
$iconDivStyle["top"] = $actualTop."px";

$iconUrl = "http://www.blogger.com/favicon.ico";

$iconImgStyle = array();

$iconImgStyle["border"] = "0px";

$iconImgStyle["position"] = "absolute";

$iconImgStyle["top"] = "0px";
$iconImgStyle["left"] = "0px";

$iconImgStyle["width"] = "100%";
$iconImgStyle["height"] = "100%";

$overlayImgStyle = array();

$overlayImgStyle["position"] = "absolute";

$overlayImgStyle["border"] = "0px";

$overlayImgStyle["top"] = "0px";
$overlayImgStyle["left"] = "0px";
$overlayImgStyle["width"] = "100%";
$overlayImgStyle["height"] = "100%";

$urlComponents = parse_url($url);

$queryParts = parse_query($url);

//print_r($queryParts);

if (array_key_exists("v", $queryParts))
{
	$videoId = $queryParts["v"];
}

//$iconUrl = "http://i2.ytimg.com/vi/$videoId/default.jpg";

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
<img style="<?

foreach ($overlayImgStyle as $key=>$value)
{
	print "$key:$value;";
}

?>" src="img/canvas.png"></img>

</a>
</div>

<?

?>
