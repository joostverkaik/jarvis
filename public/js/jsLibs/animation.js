$(function () {

	var tl = new TimelineLite();
	tl.staggerTo('.gsapAnim', 0.3, {opacity: 1}, 0.7, '#begin');
	tl.staggerFrom('.gsapAnim', 1, {scale: 0.3}, 0.3, '#begin');

});