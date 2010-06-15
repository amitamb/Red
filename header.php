<html>
<head>

<link rel="search" type="application/opensearchdescription+xml" title="Red" href="RedSearchPlugin.xml">
<link href="global.css" media="screen" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" /> 

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script>

<title>Red - Making surfing the web easy</title>
</head>

<body>

<div id="topLogo">
<table width="100%"><tr><td style="width:60px; ">
<a href="index">
<img src="img/logo.png" style="padding-right:10px;opacity:0.2;" />
</a>
</td>
<td>
<h1>Red</h1>
<sub>Making surfing the web easy</sub>
</td>
<td align="right">
<? if (!isset($noSearchBoxInHeader) || $noSearchBoxInHeader == false )
{
?>
	<form onsubmit="window.location='search#'+document.getElementById('q').value;return false;">
	<input type="text" id="q" size="25" /><button>Search</button>
	</form>
<?
}
?>
</td>
</tr>
</table>
</div>
<div id="topNav">
<a href="index.php" class="selected">Home</a>
<a href="intro.php" class="selected">Introduction</a>
<a href="start.php">Getting Started</a>
<a href="keywords.php">Keywords</a>
<a href="privacy.php">Privacy</a>
</div>

<br>

<div id="mainDiv">
