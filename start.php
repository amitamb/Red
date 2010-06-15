<?

require_once("sessionStart.php");
require_once("header.php");

?>

<style>
div.divWithMargin{margin-left:100px;margin-right:100px;}

ol.steps{}
ol.steps li{font-weight:bold; padding:20px;}
ol.steps li span{font-weight:normal;}
</style>

<div class="divWithMargin">
Follow following steps

<ol class="steps">
<li><span>Add Red to your list of search engines.<br /><a href="#" onclick="installSearchEngine(); return false;">Click here</a> (Select <i>Start using it right away</i>) </span>
<li><span>Add keywords that you want to track your searches.<br />
		  If you are planning to visit "<i>France</i>" and doing research on it then add "<i>France</i>" to the list. <br />
		  Or if you are learning new recipes then add "recipe" as a keyword. <br />
		  <a href="keywords.php">Goto Tracked Keywords</a></span>
<li><span>Start using Red. <br /> Drag and drop links to left sidebar so Red will keep track of them.</span>
</ol>

</div>

<!--

 If you can't think of many add #(hash) with a keyword to enable sidebar for that query

<p><a href="https://addons.mozilla.org/en-US/firefox/addon/748/">Install GraseMonkey</a> if you use firefox. For chrome users nothing to do.

<br>

<p>Now install Greasemonkey Script for <a href="greasemonkeyScript.user.js">pune</a>

<br>


<p>Add some keywords here that you think you are expert.
<p>Example:
<p>If you regularly use java and many times search something related to java then add java as keyword)
<p>If you search somthing like "php array", "php user management", etc then add php as keyword.
<p>If you search "javascipt+[keyword]" then add javascript as keyword.
<p>You can share anything you want from the log.
-->

</div>
<?

require_once("footer.php");

?>
