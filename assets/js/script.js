const mtoggle = document.querySelector('.toggle input');

const popup = document.querySelector('div.profiles section');

mtoggle.addEventListener('click', function(){
	popup.classList.toggle('slide');
});