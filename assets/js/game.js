var persoA = { PV: 210, MP: 33, name: "Yacine", MaxPV: 300, MaxMP: 40, move: ["Charge", "Retour", "Frappe Atlas", "Casse-Brique", "Eclate-Roc"], speed: 10 }
var persoB = { PV: 500, MP: 10, name: "Fabien", MaxPV: 600, MaxMP: 20, move: ["Griffe", "Cogne", "Vandetta"], speed: 40 }
var persoC = { PV: 52, MP: 999, name: "Nadir", MaxPV: 300, MaxMP: 999, move: ["Close Combat", "Mach Punch"], speed: 30 }
var ennemy1 = { name: "Brice", speed: 44, currentmove: "Roue de Feu",currentTarget:"Yacine" }
var ennemy2 = { name: "Jeremy", speed: 9, currentmove: "Vampigraine",currentTarget:"Nadir" }
var ennemy3 = { name: "Hugo", speed: 22, currentmove: "Pistolet a O",currentTarget:"Yacine" }
var options = ["Attack", "Magic", "Defend", "Item"]
var persos = [persoA, persoB, persoC]
var ennemy = [ennemy1, ennemy2, ennemy3]

MainPhase(0);
document.addEventListener('build', function (e) {
	console.log(e.detail)
	if (e.detail == 2) {
		AttackPhase();
	} else {
		MainPhase(++e.detail);
	}
})

function MainPhase(character_id) {
	console.log(persos[character_id].name)
	displayinfo();
	createli(options, document.querySelector('.move'));
	setMenuListeners(character_id);
}

function AttackPhase() {
	var attack_order = persos.concat(ennemy)
	attack_order.sort((a, b) => (a.speed < b.speed) ? 1 : -1)
	console.log(persos)
	console.log(attack_order)
	for (var i = 0; i < attack_order.length; i++) {
		console.log(attack_order[i].name + " utilise " + attack_order[i].currentmove +" sur "+attack_order[i].currentTarget)
	}

}










function attack(i) {
	createli(persos[i].move, document.querySelector('.move'));
	returnMenu(i);
	move(i);
}


function createli(array, ul) {
	ul.innerHTML = "";
	for (var i = 0; i < array.length; i++) {
		var item = document.createElement('li');
		item.id = array[i]
		item.appendChild(document.createTextNode(array[i]));
		ul.appendChild(item);
	}
}

function returnMenu(i) {
	var item = document.createElement('li');
	item.appendChild(document.createTextNode("Back"));
	document.querySelector('.move').appendChild(item)
	item.addEventListener('click', function (e) {
		createli(options, document.querySelector('.move'))
		setMenuListeners(i);
	})

}

function setMenuListeners(i) {
	document.getElementById('Attack').addEventListener('click', function (e) {
		attack(i);
	})

	document.getElementById('Magic').addEventListener('click', function (e) {

	})

	document.getElementById('Defend').addEventListener('click', function (e) {

	})

	document.getElementById('Item').addEventListener('click', function (e) {

	})
}
function displayinfo() {
	document.querySelector('.info').innerHTML = "";
	for (var i = 0; i < persos.length; i++) {
		var item = document.createElement('li');
		item.appendChild(document.createTextNode(persos[i].name));
		document.querySelector('.info').appendChild(item);
	}
	for (var i = 0; i < persos.length; i++) {
		var item = document.createElement('li');
		item.appendChild(document.createTextNode("PV :" + persos[i].PV + " / " + persos[i].MaxPV + " \t MP:" + persos[i].MP + " / " + persos[i].MaxMP));
		document.querySelector('.info').appendChild(item);
	}
}

function move(i) {
	for (var j = 0; j < persos[i].move.length; j++) {
		(function (x) {
			document.getElementById(persos[i].move[x]).addEventListener('click', function (e) {
				console.log("vous allez utiliser " + persos[i].move[x])
				choosennemy(i, x);


			})
		})(j)
	}
}

function choosennemy(x, m) {
	document.querySelector('.move').innerHTML = "";
	for (var j = 0; j < ennemy.length; j++) {
		var item = document.createElement('li');
		item.appendChild(document.createTextNode(ennemy[j].name));
		document.querySelector('.move').appendChild(item);
		(function (j, m) {
			item.addEventListener('click', function (e) {
				console.log("Vous utilisez " + persos[x].move[m] + " Sur " + ennemy[j].name)
				persos[x].currentmove = persos[x].move[m];
				persos[x].currentTarget = ennemy[j].name;
				var event = new CustomEvent('build', { 'detail': x });
				document.dispatchEvent(event)
			})
		})(j, m)
	}
	returnMenu(x);
}

