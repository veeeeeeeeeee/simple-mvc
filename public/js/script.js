/*
window.onload = function() {
	//alert(1);
	var memes = document.getElementsByClassName("meme");
	for (var i=0; i<memes.length; i++) {
	}
}
*/

$(window).load(function() {
	$(".meme").delay(2000).animate({ height: 'toggle', opacity: 'toggle' }, 'slow');
});
