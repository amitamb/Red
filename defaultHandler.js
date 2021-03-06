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
					$("#"+elementId+" a:first span").html(title);
				}
			}
		}
	);
}

// supporting function
// gives hostname part of url
function getHostname(str) {
	var re = new RegExp('^(?:f|ht)tp(?:s)?\://([^/]+)', 'im');
	return str.match(re)[1].toString();
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

function removeLink(id)
{
	id2LinkMap[id].remove();
	$("#"+id).empty().remove();
}

var id2LinkMap = new Array();

function showLink(newLink)
{
	var links = document.getElementById("links");

	var id = getNewId("link");
	
	id2LinkMap[id] = newLink;
	
	var hostName = getHostname(newLink.url);
	
	var iconUrl = "http://s2.googleusercontent.com/s2/favicons?domain=" + hostName;

	var mainLinkHtml = "<a class='titleLink' href='"+newLink.url+"' target='searchFrame'><img class='titleLinkIcon' src='"+iconUrl+"' />&nbsp;<span>"+newLink.url+"</span></a><a class='hostLink' href='http://" + hostName + "' target='searchFrame'>" + hostName + "</a>";
	
	var otherLinksSpan = "<span class='otherLinks'><a href='#' onclick=\"removeLink('"+id+"')\">Remove</a></span>";
	
	var mainLinkDivHtml = "<div id='"+id+"' class='linkClass'>"+ mainLinkHtml + "<br />" + otherLinksSpan + "</div>";

	setUrlTitle(newLink.url, id);
	links.innerHTML += mainLinkDivHtml;
}
