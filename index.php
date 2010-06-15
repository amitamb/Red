<?

$noSearchBoxInHeader = true;

require_once("sessionStart.php");
require_once("header.php");

?>
<style>
#mainSearchBar{text-align:center;}
#topInfoBox{text-align:center;font-size:130%;}
</style>

<p id="topInfoBox">
First time visiter? Go to <a href="intro.php">Introduction</a>
</p>

<br />
<br />
<br />
<br />
<div id="mainSearchBar">
	<form onsubmit="window.location='search#'+document.getElementById('q').value;return false;">
	<input type="text" id="q" size="45" /><button>Search</button>
	</form>
</div>

<br />
<br />
<br />
<br />

<?

require_once("footer.php");

?>
