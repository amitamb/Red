<body>
<div id="debugText">
<!--
No debug text
-->
</div>
<!--
Here I want to show menu
-->
</body>

<script>

function showDebug(msg)
{
	var debugText = document.getElementById("debugText");
	
	debugText.innerHTML = msg;
}

function linkEnter(x, y)
{
	showDebug(document.location+x+y);
}

function linkDragging(x, y)
{
	showDebug(x +","+y);
}

function linkExit()
{
	showDebug("Exit");
}

function linkDropped(x, y, url)
{
	showDebug('dropped'+x+y+url);
}

</script>
<script type="text/javascript" src="communication.js"></script>
