var Charge = { name: "Charge", puissance: 20, type: "Physical", cost: 0, element: "Normal" }
var Retour = { name: "Retour", puissance: 20, type: "Physical", cost: 5, element: "Normal" }
var Exploforce = { name: "Exploforce", puissance: 20, type: "Physical", cost: 50, element: "Normal" }
var Cogne = { name: "Cogne", puissance: 20, type: "Physical", cost: 10, element: "Normal" }
var Eclate = { name: "Eclate", puissance: 20, type: "Physical", cost: 10, element: "Normal" }
var MitraPoing = { name: "MitraPoing", puissance: 20, type: "Physical", cost: 30, element: "Normal" }
var ViveAttaque = { name: "ViveAttaque", puissance: 20, type: "Physical", cost: 15, element: "Normal" }


var Warmog = { element: "Plante" }
var SpiritVisage = { element: "Terre" }
var Banshee = { element: "Electrique" }

var Ragnarok = { element: "Feu" }
var Masamune = { element: "Eau" }
var Ultima = { element: "Glace" }

var Brasier = { name: "Brasier", puissance: 20, type: "Magical", cost: 3, element: "Feu" }
var Glace = { name: "Glace", puissance: 20, type: "Magical", cost: 11, element: "Glace" }
var Foudre = { name: "Foudre", puissance: 20, type: "Magical", cost: 3, element: "Electrique" }
var Poison = { name: "Poison", puissance: 20, type: "Magical", cost: 6, element: "Normal" }

var Potion = { stat: "PV", number: 100, name: "Potion" }
var Ether = { stat: "MP", number: 100, name: "Ether" }
var Phoenix = { stat: "Revive", number: 1, name: "Phoenix" }
var AttUp = { stat: "Strength", number: 3, name: "AttDown", turn: 3 }

var Debufflist = [];

var TypeTable = {
	Normal: { Feu: 1, Eau: 1, Plante: 1, Glace: 1, Terre: 1, Electrique: 1, Normal: 1 },
	Feu: { Feu: 0.5, Eau: 0.5, Plante: 2, Glace: 2, Terre: 1, Electrique: 1, Normal: 1 },
	Eau: { Feu: 2, Eau: 0.5, Plante: 0.5, Glace: 1, Terre: 2, Electrique: 1, Normal: 1 },
	Plante: { Feu: 0.5, Eau: 2, Plante: 0.5, Glace: 1, Terre: 2, Electrique: 1, Normal: 1 },
	Terre: { Feu: 2, Eau: 1, Plante: 0.5, Glace: 1, Terre: 1, Electrique: 2, Normal: 1 },
	Electrique: { Feu: 1, Eau: 2, Plante: 0.5, Glace: 1, Terre: 0, Electrique: 0.5, Normal: 1 },
	Glace: { Feu: 1, Eau: 0.5, Plante: 2, Glace: 0.5, Terre: 2, Electrique: 1, Normal: 1 },
};


var Inventaire = [
	{ item: Potion, quantite: 10 },
	{ item: Ether, quantite: 3 },
	{ item: Phoenix, quantite: 1 },
	{ item: AttUp, quantite: 1 }]



var persoA = { PV: 500, MP: 500, name: "Yacine", MaxPV: 1000, MaxMP: 40, move: [Charge, ViveAttaque, Brasier], speed: 10, strength: 30, inteligence: 20, Exp: 200, weapon: Ragnarok, armor: Warmog }
var persoB = { PV: 500, MP: 500, name: "Fabien", MaxPV: 1000, MaxMP: 20, move: [Retour, Glace], speed: 40, strength: 60, inteligence: 20, Exp: 300, weapon: Ragnarok, armor: SpiritVisage }
var persoC = { PV: 500, MP: 500, name: "Nadir", MaxPV: 1000, MaxMP: 999, move: [Exploforce, Poison, Foudre], speed: 30, strength: 10, inteligence: 20, Exp: 100, weapon: Ragnarok, armor: Banshee }

var ennemy1 = { name: "Brice", speed: 44, strength: 20, inteligence: 20, move: [Cogne, Charge], PV: 500, Exp: 500, armor: Warmog, weapon: Masamune }
var ennemy2 = { name: "Jeremy", speed: 9, strength: 10, inteligence: 20,move: [Eclate, Charge, Cogne], PV: 500, Exp: 500, armor: Warmog, weapon: Ultima }
var ennemy3 = { name: "Hugo", speed: 22, strength: 25, inteligence: 20,move: [MitraPoing, Charge, Exploforce], PV: 500, Exp: 500, armor: Warmog, weapon: Ultima }

var options = ["Attack", "Magic", "Defend", "Item"]
var persos = [persoA, persoB, persoC]
var persosv = [persoA, persoB, persoC]
var ennemy = [ennemy1, ennemy2, ennemy3]
var ennemyAttackable = ennemy
var PersoAttackable = persos
var attack_order = persos.concat(ennemy);
var TourNumber = 0;

function EnnemyHandler() {
	for (var i = 0; i < ennemy.length; i++) {
		var movefaisable = ennemy[i].move.filter(a => (a.type == "Physical" && a.cost < ennemy[i].PV) || (a.type == "Magical" && a.cost < ennemy[i].MP))
		ennemy[i].currentmove = movefaisable[getRandomInt(movefaisable.length)]
		ennemy[i].currentTarget = PersoAttackable[getRandomInt(PersoAttackable.length)]
	}
}


function Tour() {
	TourNumber = TourNumber + 1
	console.log(TourNumber)
	console.log(Debufflist)
	Debuff();
	ennemyAttackable = ennemy.filter(a => a.PV > 0)
	PersoAttackable = persos.filter(a => a.PV > 0)
	Inventaire = Inventaire.filter(a => a.quantite > 0)
	if (PersoAttackable.length == 0) {
		var event = new CustomEvent('findecombat', { 'detail': "Win" });
		document.dispatchEvent(event)
		return;
	}
	if (ennemyAttackable.length == 0) {
		var event = new CustomEvent('findecombat', { 'detail': "Win" });
		document.dispatchEvent(event)
		return;
	}
	document.addEventListener('build', TurnHandler)
	MainPhase(0);
}
var TurnHandler = function (e) {
	console.log(e.detail)
	if (e.detail == 2) {
		document.removeEventListener('build', this)
		AttackPhase()
	} else {
		MainPhase(++e.detail);
	}
}

function MainPhase(character_id) {
	if (persos[character_id].PV == 0) {
		var event = new CustomEvent('build', { 'detail': character_id });
		document.dispatchEvent(event)
		return;
	}
	YourTurn(character_id)
	console.log(persos[character_id].name)
	createli(options, document.querySelector('.move'));
	setMenuListeners(character_id);
}

function AttackPhase() {
	EnnemyHandler();
	attack_order.sort((a, b) => (a.speed < b.speed) ? 1 : -1)
	document.addEventListener('display', displayHandler)
	Display(0)
}

function attack(i) {
	createli(persos[i].move.filter(a => a.type == "Physical").map(a => a.name + " " + a.cost), document.querySelector('.move'));
	returnMenu(i);
	move(i, "Physical");
}

function item(i) {
	createli(Inventaire.map(a => a.item.name + " " + a.quantite), document.querySelector('.move'))
	returnMenu(i);
	Consumable(i);
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
		magic(i)
	})

	document.getElementById('Defend').addEventListener('click', function (e) {

	})

	document.getElementById('Item').addEventListener('click', function (e) {
		item(i);
	})
}


function magic(i) {
	createli(persos[i].move.filter(a => a.type == "Magical").map(a => a.name + " " + a.cost), document.querySelector('.move'));
	returnMenu(i);
	move(i, "Magical");
}


function displayinfo() {
	document.querySelector('.info').innerHTML = "";
	for (var i = 0; i < persos.length; i++) {
		var item = document.createElement('li');
		item.appendChild(document.createTextNode(persos[i].name));
		document.querySelector('.info').appendChild(item);
		if (persos[i].PV == 0) {
			item.style.color="red";
		}
	}
	for (var i = 0; i < persos.length; i++) {
		var item = document.createElement('li');
		item.appendChild(document.createTextNode("PV :" + persos[i].PV + " / " + persos[i].MaxPV + " \t MP:" + persos[i].MP + " / " + persos[i].MaxMP));
		document.querySelector('.info').appendChild(item);
	}

}

function displayinfoEnnemy() {
	document.querySelector('.infoEnnemy').innerHTML = "";
	for (var i = 0; i < ennemy.length; i++) {
		var item = document.createElement('li');
		item.appendChild(document.createTextNode(ennemy[i].name));
		document.querySelector('.infoEnnemy').appendChild(item);
		if (ennemy[i].PV == 0) {
			item.style.color="red";
		}
	}
	for (var i = 0; i < ennemy.length; i++) {
		var item = document.createElement('li');
		item.appendChild(document.createTextNode("PV :" + ennemy[i].PV + " / " + ennemy[i].MaxPV));
		document.querySelector('.infoEnnemy').appendChild(item);
	}
}


function Consumable(i) {
	for (var j = 0; j < Inventaire.length; j++) {
		(function (x) {
			document.getElementById(Inventaire[x].item.name + " " + Inventaire[x].quantite).addEventListener('click', function (e) {
				console.log("vous allez utiliser " + Inventaire[x].item.name)
				choosennemy(i, Inventaire[x], "Item");


			})
		})(j)
	}
}

function move(i, MoveType) {
	var choice = persos[i].move.filter(a => a.type == MoveType);
	for (var j = 0; j < choice.length; j++) {
		(function (x) {
			if (choice[x].type == "Physical") {
				document.getElementById(choice[x].name + " " + choice[x].cost).innerText += " PV"
				if (choice[x].cost > persos[i].PV) {
					document.getElementById(choice[x].name + " " + choice[x].cost).style.color = "black"
					return;
				}
			}
			if (choice[x].type == "Magical") {
				document.getElementById(choice[x].name + " " + choice[x].cost).innerText += " MP"
				if (choice[x].cost > persos[i].MP) {
					document.getElementById(choice[x].name + " " + choice[x].cost).style.color = "black"
					return;
				}
			}
			document.getElementById(choice[x].name + " " + choice[x].cost).addEventListener('click', function (e) {
				console.log("vous allez utiliser " + choice[x].name)
				choosennemy(i, choice[x], "Attack");


			})
		})(j)
	}
}

function choosennemy(character_id, move, move_type) {
	document.querySelector('.move').innerHTML = "";
	var chosable = ennemyAttackable.concat(persos);
	for (var j = 0; j < chosable.length; j++) {
		var item = document.createElement('li');
		item.appendChild(document.createTextNode(chosable[j].name));
		document.querySelector('.move').appendChild(item);
		(function (j) {
			item.addEventListener('click', function (e) {
				if (move_type == "Item") {
					move.quantite = move.quantite - 1;
					Inventaire = Inventaire.filter(a => a.quantite > 0)
					move = move.item
				}
				console.log("Vous utilisez " + move.name + " Sur " + chosable[j].name)
				persos[character_id].currentmove = move;
				persos[character_id].currentTarget = chosable[j];
				persos[character_id].currentmoveType = move_type
				var event = new CustomEvent('build', { 'detail': character_id });
				document.dispatchEvent(event)
			})
		})(j)
	}
	returnMenu(character_id);
}

function getRandomInt(max) {
	return Math.floor(Math.random() * Math.floor(max));
}


function InflictDamage(attacker, defender) {
	if(attacker.PV - attacker.currentmove.cost<=0){
		attacker.currentmove = Charge;
	}
	defender.PV = defender.PV - DamageCalculation(attacker, attacker.currentmove, defender)
	if (defender.PV < 0) {
		defender.PV = 0
	}
	switch (attacker.currentmove.type) {
		case "Physical":
			attacker.PV = attacker.PV - attacker.currentmove.cost;
			if (defender.PV < 0) {
				defender.PV = 0
			}
			break;
		case "Magical":
			attacker.MP = attacker.MP - attacker.currentmove.cost;
			if (defender.MP < 0) {
				defender.MP = 0
			}
			break;
	}
}

function DamageCalculation(attacker, move, defender) {
	if (move.type == "Physical") {
		console.log(TypeTable[attacker.weapon.element][defender.armor.element])
		return Math.floor(attacker.strength * (1 + (move.puissance / 100)) * (TypeTable[attacker.weapon.element][defender.armor.element]))
	}
	if (move.type == "Magical") {
		console.log(TypeTable[move.element][defender.armor.element])
		return Math.floor(attacker.inteligence * (1 + (move.puissance / 100)) * (TypeTable[move.element][defender.armor.element]))
	}
}

function Display(i) {

	if (attack_order[i].PV == 0) {
		var event = new CustomEvent('display', { 'detail': i });
		document.dispatchEvent(event)
		return;
	}
	if (attack_order[i].currentmoveType == "Item") {
		Buff(attack_order[i].currentmove, attack_order[i].currentTarget);
	} else {
		if (attack_order[i].currentTarget.PV == 0) {
			if (persos.includes(attack_order[i])) {
				ennemyAttackable = ennemy.filter(a => a.PV > 0)
				if (ennemyAttackable.length == 0) {
					var event = new CustomEvent('findecombat', { 'detail': "Win" });
					document.dispatchEvent(event)
					return;
				}
				attack_order[i].currentTarget = ennemyAttackable[getRandomInt(ennemyAttackable.length)]
			}
			else {
				PersoAttackable = persos.filter(a => a.PV > 0)
				if (PersoAttackable.length == 0) {
					var event = new CustomEvent('findecombat', { 'detail': "Lost" });
					document.dispatchEvent(event)
					return;
				}
				attack_order[i].currentTarget = PersoAttackable[getRandomInt(PersoAttackable.length)]
			}
		}
		InflictDamage(attack_order[i], attack_order[i].currentTarget)
	}
	console.log(attack_order[i].name + " utilise " + attack_order[i].currentmove.name + " sur " + attack_order[i].currentTarget.name)
	console.log(attack_order[i])
	console.log(attack_order[i].currentTarget)
	displayinfo();
	displayinfoEnnemy()
	var item = document.createElement('div');
	item.appendChild(document.createTextNode(attack_order[i].name + " utilise " + attack_order[i].currentmove.name + " sur " + attack_order[i].currentTarget.name));
	document.querySelector('#menu').appendChild(item);
	item.id = 'display'
	item.addEventListener('click', function (e) {
		item.remove();
		document.removeEventListener('click', this)
		var event = new CustomEvent('display', { 'detail': i });
		document.dispatchEvent(event)
	})
}

var displayHandler = function (e) {
	if (e.detail == attack_order.length - 1) {
		document.removeEventListener('display', this)
		var findetour = new Event('findetour');
		document.dispatchEvent(findetour);
	}
	else {
		Display(++e.detail);
	}
}

function YourTurn(i) {
	document.querySelector('.info').childNodes[i].id = "current"
}


function Buff(Item, buffer) {
	switch (Item.stat) {
		case "PV":
			if (buffer.PV == 0) {
				break;
			}
			buffer.PV = buffer.PV + Item.number
			if (buffer.PV > buffer.MaxPV) {
				buffer.PV = buffer.MaxPV
			}
			break;
		case "MP":
			buffer.MP = buffer.MP + Item.number
			if (buffer.MP > buffer.MaxMP) {
				buffer.MP = buffer.MaxMP
			}
			break;
		case "Revive":
			if (buffer.PV > 0) {
				break;
			}
			buffer.PV = buffer.PV + Item.number
			break;
		case "Strength":
			buffer.strength = buffer.strength + Item.number;
			if (!(Debufflist.includes(Item))) {
				Debufflist.push({ turn: TourNumber + Item.turn, stat: "Strength", number: -Item.number, buffer: buffer })
			}
			break;
		case "Vitality":
			buffer.vitality = buffer.vitality + Item.number;
			if (!(Debufflist.includes(Item))) {
				Debufflist.push({ turn: TourNumber + Item.turn, stat: "Vitality", number: -Item.number, buffer: buffer })
			}
			break;
		case "Intelligence":
			buffer.inteligence = buffer.inteligence + Item.number;
			if (!(Debufflist.includes(Item))) {
				Debufflist.push({ turn: TourNumber + Item.turn, stat: "Intelligence", number: -Item.number, buffer: buffer })
			}
			break;
		case "Spirit":
			buffer.spirit = buffer.spirit + Item.number;
			if (!(Debufflist.includes(Item))) {
				Debufflist.push({ turn: TourNumber + Item.turn, stat: "Spirit", number: -Item.number, buffer: buffer })
			}
			break;
	}
}

function Debuff() {
	for (var i = 0; i < Debufflist.length; i++) {
		if (Debufflist[i].turn == TourNumber) {
			Buff(Debufflist[i], Debufflist[i].buffer)
			Debufflist.splice(i, 1)
		}
	}
}

function getOccurrence(array, value) {
	return array.filter((v) => (v === value)).length;
}

var Fin = function (e) {
	if (e.detail == "Win") {
		for (var i = 0; i < ennemy.length; i++) {
			for (var j = 0; j < persos.length; j++) {
				if (persos[i].PV > 0) {
					persos[i].Exp = persos[i].Exp + ennemy[i].Exp
				}
			}
			console.log(persos[i].name + " a " + persos[i].Exp)
		}
		window.alert('Win')
	}
	else if (e.detail == "Lost") {
		window.alert("Lost")
	}
}

var oReq = new XMLHttpRequest();

function reqListener() {
	console.log(persos);
	displayinfoEnnemy()
	displayinfo();
	document.addEventListener('findetour', Tour)
	Tour();
	document.addEventListener('findecombat', Fin)
}

var oReq = new XMLHttpRequest();
oReq.addEventListener("load", reqListener);
oReq.open("GET", "api.php", true);
oReq.send();

var persoanim = [
	'http://www.videogamesprites.net/FinalFantasy6/Party/GeneralLeo/General%20Leo%20-%20Battle.gif',
	'http://www.videogamesprites.net/FinalFantasy6/Party/GeneralLeo/General%20Leo%20-%20Action.gif',
	'http://www.videogamesprites.net/FinalFantasy6/Party/GeneralLeo/General%20Leo%20-%20Cast.gif',
	'http://www.videogamesprites.net/FinalFantasy6/Party/GeneralLeo/General%20Leo%20-%20Steal.gif',
	'http://www.videogamesprites.net/FinalFantasy6/Party/GeneralLeo/General%20Leo%20-%20Shock.gif',
	'http://www.videogamesprites.net/FinalFantasy6/Party/GeneralLeo/General%20Leo%20-%20Battle.gif'


]

function animation(i) {
	setTimeout(function () {
		document.querySelector('#perso1').src = persoanim[i]
		console.log(persoanim[i])
		console.log(i)
		if(i<5){
			animation(++i)
		}
		return
	},200);
}animation(0)