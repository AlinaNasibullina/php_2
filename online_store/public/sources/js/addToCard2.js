"use strict";

let buttons = document.querySelectorAll(".addToCard");
//console.log(buttons);

buttons.forEach(function(button) {
	button.addEventListener("click", function(event){
		console.log(event);
		console.log(event.target);
		console.log(event.target);
	})
});