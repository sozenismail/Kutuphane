window.addEventListener('load', function() {
	const nav = document.querySelector('.navbar-menu');
	const navButton = document.querySelector('.navbar-burger');

	navButton.addEventListener('click', function () {
		nav.classList.toggle('is-active');
		navButton.classList.toggle('is-active');
	});
});