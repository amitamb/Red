function setUrlTitle(url, elementId)
{
	$.getJSON(
		"http://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20html%20where%20url%3D%22"+ encodeURIComponent(url) +"%22%20and%20xpath%3D'%2F%2Ftitle'&format=json&callback=?",
		function(data){	
			if (data.query)
			if (data.query.results)
			if (data.query.results.title != null && data.query.results.title != "")
			{
				element = document.getElementById(elementId);

				element.innerHTML = data.query.results.title;
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

function showLink(x, y, url)
{
	var links = document.getElementById("links");

	var newLink = document.createElement('a');
	newLink.innerHTML = url;
	newLink.target = "searchFrame";
	newLink.href = url;
	var id = getNewId("link");
	newLink.id = id;
	
	// set style attributes
	
	links.appendChild(newLink);
	setUrlTitle(url, id);
	links.innerHTML += "<br>";
	
	alert(parent.window);
	
	alert("as");
}
