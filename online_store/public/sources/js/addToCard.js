"use strict";

let xhr = new XMLHttpRequest();


let buttons = document.querySelectorAll(".addToCard");


buttons.forEach(function(button) {
	button.addEventListener("click", function(event){
		console.log(event);
		console.log(event.target);
		console.log(event.target.nextSibling.value);
		let body = {"id": event.target.nextSibling.value};
		console.log(body);
		
		xhr.open("POST", "../../addToCard.php");
		//xhr.setRequestHeader('Content-type', 'application/json; charset=utf-8');
		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhr.send(body);
		
		
		xhr.upload.onprogress = function(event) {
		  console.log(`Отправлено ${event.loaded} из ${event.total} байт`);
		};

		xhr.upload.onload = function() {
		  console.log(`Данные успешно отправлены.`);
		};

		xhr.upload.onerror = function() {
		  console.log(`Произошла ошибка во время отправки: ${xhr.status}`);
		};
	})
});