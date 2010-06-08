function setUrlTitle(url, elementId)
{
	$.getJSON(
		"http://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20html%20where%20url%3D%22"+ encodeURIComponent(url) +"%22%20and%20xpath%3D'%2F%2Ftitle'&format=json&callback=?",
		function(data){	
			if (data.query)
			if (data.query.results)
			// Check specified below for typeof == "string" is for twitter 
			if (data.query.results.title != null && data.query.results.title != "")
			{
				var title = "";
				if ((typeof data.query.results.title) == "string")
				{
					title = data.query.results.title;
				}
				else if (data.query.results.title.content)
				{
					title = data.query.results.title.content;
				}
				
				if (title != "")
				{
					$("#"+elementId+" a:first").html(title);
				}
			}
		}
	);
}

function getNewId(prefix)
{
	if (! this.currentId) this.currentId = 0;

	this.currentId++;
	
	return prefix + String(this.currentId);
}

function initI()
{
	alert("Init");
}

function showLink(x, y, url)
{
	var links = document.getElementById("links");

	var id = getNewId("link");
	
	var mainLinkHtml = "<a href='"+url+"' target='searchFrame'>"+url+"</a>";
	
	var otherLinksSpan = "<span class='otherLinks'><a href='#' onclick=\"removeLink('"+id+"')\">Close</a></span>";
	
	var mainLinkDivHtml = "<div id='"+id+"' class='linkClass'>"+ mainLinkHtml + otherLinksSpan + "</div>";

	setUrlTitle(url, id);
	links.innerHTML += mainLinkDivHtml;
}
