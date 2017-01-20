var index = 0;

var removeNote = function(ref) {
    var list = document.getElementById('ft_list');
    if (confirm('Gotta delete it?')) {
        var node = document.getElementById(ref);
		list.removeChild(node);
		setCookie();
	}
}

var addNote = function (text) {
    var para = document.createElement("div");
    var hr = document.createElement("hr");
    var node = document.createTextNode(text);
    index += 1;
    var divRef = "note" + index;
    para.appendChild(node);
    para.appendChild(hr);
    para.classList.add("note");
    para.setAttribute('id', divRef);
    para.setAttribute('onclick', "removeNote(\'" + divRef + "\');");

    var element = document.getElementById("ft_list");
    element.insertBefore(para, element.firstChild);

    setCookie();
}

var newNote = function() {
    $new = prompt("Enter your new To Do:", "");
    if ($new == "")
        return;
    else if ($new == null)
        return;
    else 
        addNote($new);
};

var setCookie = function() {
	var time = new Date();
	time.setTime(time.getTime()+(365*24*60*60*1000));
	var expires = "expires=" + time.toGMTString();
	var list = document.getElementById('ft_list');
	var doc = "";
	for (var i = list.childNodes.length - 1; i >= 0; i--) {
		if (list.childNodes[i].innerHTML != null)
			doc += list.childNodes[i].innerHTML;
	}
	document.cookie = "todo=" + doc + "; " + expires;
}

var getCookie = function() {
	var ca = document.cookie;
    ca = ca.substring(5);
    ca = ca.split('<hr>');
	for(var i=0; i < ca.length - 1; i++) {
		var c = ca[i];
		addNote(c);
	}
}

getCookie();