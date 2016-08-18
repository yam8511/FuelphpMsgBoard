/*
document.onselectstart=decline;
document.ondragstart=decline;
document.oncontextmenu=decline;
function decline() {
	return false;
}


/* 設置滑鼠 與 鍵盤不能按
document.onmousedown=click;
document.onkeydown=click;
if (document.layers) window.captureEvents(Event.MOUSEDOWN); window.onmousedown=click;
if (document.layers) window.captureEvents(Event.KEYDOWN); window.onkeydown=click;
function click(e){
	if (navigator.appName == 'Netscape'){
		if (e.which != 1 && e.which != 13 && e.which != 16){
			return false;
		}
	}
	if (navigator.appName == "Microsoft Internet Explorer"){
		window.alert('A: '+event.button);
		if (event.button != 1  && event.button != 13 && event.button != 16){
			return false;
		}
	}
}
*/