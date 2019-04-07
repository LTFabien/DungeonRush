require("regenerator-runtime/runtime");
var BaseArmor = { damage: 10, element: "Normal" }
var BaseWeapon = { damage: 10, element: "Normal" }


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

var options = ["Attack", "Magic", "Defend", "Item"]
var persos;
var ennemy;
var ennemyAttackable;
var PersoAttackable;
var attack_order;
var TourNumber = 0;
var StageNumber = 0
var Team;
var Stage;
var Inventaire;
var GameInventory;


function EnnemyHandler() {
	for (var i = 0; i < ennemy.length; i++) {
		var movefaisable = ennemy[i].move.filter(a => (a.type == "Physical" && a.cost < ennemy[i].HP) || (a.type == "Magical" && a.cost < ennemy[i].MP))
		ennemy[i].currentmove = movefaisable[getRandomInt(movefaisable.length)]
		ennemy[i].currentTarget = PersoAttackable[getRandomInt(PersoAttackable.length)]
	}
}


function Tour() {
	TourNumber = TourNumber + 1
	console.log(TourNumber)
	console.log(Debufflist)
	Debuff();
	ennemyAttackable = ennemy.filter(a => a.HP > 0)
	PersoAttackable = persos.filter(a => a.HP > 0)
	GameInventory = Inventaire.filter(a => a.quantite > 0)
	if (PersoAttackable.length == 0) {
		var event = new CustomEvent('findeStage', { 'detail': "Lost" });
		document.dispatchEvent(event)
		return;
	}
	if (ennemyAttackable.length == 0) {
		var event = new CustomEvent('findeStage', { 'detail': "Win" });
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
	if (persos[character_id].HP == 0) {
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
	attack_order.sort((a, b) => (a.Speed < b.Speed) ? 1 : -1)
	document.addEventListener('display', displayHandler)
	Display(0)
}

function attack(i) {
	createli(persos[i].move.filter(a => a.type == "Physical").map(a => a.nom + " " + a.cost), document.querySelector('.move'));
	returnMenu(i);
	move(i, "Physical");
}

function item(i) {
	createli(GameInventory.map(a => a.consumables.name + " " + a.quantite), document.querySelector('.move'))
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
	createli(persos[i].move.filter(a => a.type == "Magical").map(a => a.nom + " " + a.cost), document.querySelector('.move'));
	returnMenu(i);
	move(i, "Magical");
}


function displayinfo() {
	document.querySelector('.info').innerHTML = "";
	for (var i = 0; i < persos.length; i++) {
		var item = document.createElement('li');
		item.appendChild(document.createTextNode(persos[i].name));
		document.querySelector('.info').appendChild(item);
		if (persos[i].HP == 0) {
			YourDead(i)
		}
	}
	for (var i = 0; i < persos.length; i++) {
		var item = document.createElement('li');
		item.appendChild(document.createTextNode("HP :" + persos[i].HP + " / " + persos[i].HPmax + " \t MP:" + persos[i].MP + " / " + persos[i].MPmax));
		document.querySelector('.info').appendChild(item);
	}

}

function displayinfoEnnemy() {
	document.querySelector('.infoEnnemy').innerHTML = "";
	for (var i = 0; i < ennemy.length; i++) {
		var item = document.createElement('li');
		item.appendChild(document.createTextNode(ennemy[i].name));
		document.querySelector('.infoEnnemy').appendChild(item);
	}
	for (var i = 0; i < ennemy.length; i++) {
		var item = document.createElement('li');
		item.appendChild(document.createTextNode("HP :" + ennemy[i].HP + " / " + ennemy[i].HPmax));
		document.querySelector('.infoEnnemy').appendChild(item);
	}
}


function Consumable(i) {
	for (var j = 0; j < GameInventory.length; j++) {
		(function (x) {
			document.getElementById(GameInventory[x].consumables.name + " " + GameInventory[x].quantite).addEventListener('click', function (e) {
				console.log("vous allez utiliser " + GameInventory[x].consumables.name)
				choosennemy(i, GameInventory[x], "Item");


			})
		})(j)
	}
}

function move(i, MoveType) {
	var choice = persos[i].move.filter(a => a.type == MoveType);
	for (var j = 0; j < choice.length; j++) {
		(function (x) {
			if (choice[x].type == "Physical") {
				document.getElementById(choice[x].nom + " " + choice[x].cost).innerText += " HP"
				if (choice[x].cost > persos[i].HP) {
					document.getElementById(choice[x].nom + " " + choice[x].cost).style.color = "black"
					return;
				}
			}
			if (choice[x].type == "Magical") {
				document.getElementById(choice[x].nom + " " + choice[x].cost).innerText += " MP"
				if (choice[x].cost > persos[i].MP) {
					document.getElementById(choice[x].nom + " " + choice[x].cost).style.color = "black"
					return;
				}
			}
			document.getElementById(choice[x].nom + " " + choice[x].cost).addEventListener('click', function (e) {
				console.log("vous allez utiliser " + choice[x].nom)
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
					GameInventory = Inventaire.filter(a => a.quantite > 0)
					move = move.consumables
				}
				console.log("Vous utilisez " + move.nom + " Sur " + chosable[j].name)
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


function InflictDamage(attacker, defender, move) {
	defender.HP = defender.HP - DamageCalculation(attacker, move, defender)
	if (defender.HP < 0) {
		defender.HP = 0
	}
	switch (move.type) {
		case "Physical":
			attacker.HP = attacker.HP - move.cost;
			if (defender.HP < 0) {
				defender.HP = 0
			}
			break;
		case "Magical":
			attacker.MP = attacker.MP - move.cost;
			if (defender.MP < 0) {
				defender.MP = 0
			}
			break;
	}
}

function DamageCalculation(attacker, move, defender) {
	if (attacker.weapon == null) {
		attacker.weapon = BaseWeapon;
	}
	if (defender.armor == null) {
		defender.armor = BaseArmor;
	}
	if (move.type == "Physical") {
		console.log(TypeTable[attacker.weapon.element][defender.armor.element])
		return Math.floor(attacker.Strength * (1 + (move.puissance / 100)) * (TypeTable[attacker.weapon.element][defender.armor.element]))
	}
	if (move.type == "Magical") {
		console.log(TypeTable[move.element][defender.armor.element])
		return Math.floor(attacker.Intelligence * (1 + (move.puissance / 100)) * (TypeTable[move.element][defender.armor.element]))
	}
}

function Display(i) {

	if (attack_order[i].HP == 0) {
		var event = new CustomEvent('display', { 'detail': i });
		document.dispatchEvent(event)
		return;
	}
	if (attack_order[i].currentmoveType == "Item") {
		Buff(attack_order[i].currentmove, attack_order[i].currentTarget);
	} else {
		if (attack_order[i].currentTarget.HP == 0) {
			if (persos.includes(attack_order[i])) {
				ennemyAttackable = ennemy.filter(a => a.HP > 0)
				if (ennemyAttackable.length == 0) {
					var event = new CustomEvent('findeStage', { 'detail': "Win" });
					document.dispatchEvent(event)
					return;
				}
				attack_order[i].currentTarget = ennemyAttackable[getRandomInt(ennemyAttackable.length)]
			}
			else {
				PersoAttackable = persos.filter(a => a.HP > 0)
				if (PersoAttackable.length == 0) {
					var event = new CustomEvent('findeStage', { 'detail': "Lost" });
					document.dispatchEvent(event)
					return;
				}
				attack_order[i].currentTarget = PersoAttackable[getRandomInt(PersoAttackable.length)]
			}
		}
		InflictDamage(attack_order[i], attack_order[i].currentTarget, attack_order[i].currentmove)
	}
	console.log(attack_order[i].name + " utilise " + attack_order[i].currentmove.name + " sur " + attack_order[i].currentTarget.name)
	console.log(attack_order[i])
	console.log(attack_order[i].currentTarget)
	displayinfo();
	displayinfoEnnemy()
	var item = document.createElement('div');
	item.appendChild(document.createTextNode(attack_order[i].name + " utilise " + attack_order[i].currentmove.nom + " sur " + attack_order[i].currentTarget.name));
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

function YourDead(i) {
	document.querySelector('.info').childNodes[i].id = "dead"
}


function Buff(Item, buffer) {
	switch (Item.stat) {
		case "HP":
			if (buffer.HP == 0) {
				break;
			}
			buffer.HP = buffer.HP + Item.number
			if (buffer.HP > buffer.HPmax) {
				buffer.HP = buffer.HPmax
			}
			break;
		case "MP":
			buffer.MP = buffer.MP + Item.number
			if (buffer.MP > buffer.MPmax) {
				buffer.MP = buffer.MPmax
			}
			break;
		case "Revive":
			if (buffer.HP > 0) {
				break;
			}
			buffer.HP = buffer.HP + Item.number
			break;
		case "Strength":
			buffer.Strength = buffer.Strength + Item.number;
			if (!(Debufflist.includes(Item))) {
				Debufflist.push({ turn: TourNumber + Item.turn, stat: "Strength", number: -Item.number, buffer: buffer })
			}
			break;
		case "Vitality":
			buffer.Vitality = buffer.Vitality + Item.number;
			if (!(Debufflist.includes(Item))) {
				Debufflist.push({ turn: TourNumber + Item.turn, stat: "Vitality", number: -Item.number, buffer: buffer })
			}
			break;
		case "Intelligence":
			buffer.Intelligence = buffer.Intelligence + Item.number;
			if (!(Debufflist.includes(Item))) {
				Debufflist.push({ turn: TourNumber + Item.turn, stat: "Intelligence", number: -Item.number, buffer: buffer })
			}
			break;
		case "Spirit":
			buffer.Spirit = buffer.Spirit + Item.number;
			if (!(Debufflist.includes(Item))) {
				Debufflist.push({ turn: TourNumber + Item.turn, stat: "Spirit", number: -Item.number, buffer: buffer })
			}
			break;
		case "Speed":
			buffer.Speed = buffer.Speed + Item.number;
			if (!(Debufflist.includes(Item))) {
				Debufflist.push({ turn: TourNumber + Item.turn, stat: "Speed", number: -Item.number, buffer: buffer })
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
		for (var i = 0; i < Stage.length; i++) {
			for (var j = 0; j < Stage[i].Monster.length; j++) {
				Team.Exp = Team.Exp + Stage[i].Monster[j].Exp;
				Team.Money = Team.Money + Stage[i].Monster[j].Gold;
			}
		}
		var xhr = new XMLHttpRequest();
		Result = { lvl: 1, Money: Team.Money, Exp: Team.Exp };
		xhr.open("PUT", "http://127.0.0.1:8000/api/teams/" + UserID, true);
		xhr.setRequestHeader('Content-type', 'application/json; charset=utf-8');
		xhr.onload = function () {
			var users = JSON.parse(xhr.responseText);
			if (xhr.readyState == 4 && xhr.status == "200") {
				console.table(users);
			} else {
				console.error(users);
			}
		}
		xhr.send(JSON.stringify(Result));
		InventoryResponse();
		window.alert('Win')
	}
	else if (e.detail == "Lost") {
		window.alert("Lost")
	}
}

function StagePhase() {
	ennemy = Stage[StageNumber].Monster
	ennemyAttackable = ennemy
	PersoAttackable = persos
	attack_order = persos.concat(ennemy);
	displayinfoEnnemy()
	displayinfo();
	document.addEventListener('findetour', Tour)
	Tour();
}

function TeamListener() {
	var response = JSON.parse(this.response)
	console.log(response.characters)
	Team = response;
	Inventaire = response.Inventory.consumables
	GameInventory = Inventaire;
	persos = response.characters;
	var Req = new XMLHttpRequest();
	Req.addEventListener("load", DungeonListener);
	Req.open("GET", "http://127.0.0.1:8000/api/dungeons/" + DungeonID, true);
	Req.send();
}
function DungeonListener() {
	var response = JSON.parse(this.response)
	console.log(response)
	Stage = response.Stages
	var event = new CustomEvent('LoadingEnd');
	document.dispatchEvent(event)

}
var oReq = new XMLHttpRequest();
oReq.addEventListener("load", TeamListener);
oReq.open("GET", "http://127.0.0.1:8000/api/teams/" + UserID, true);
oReq.send();

document.addEventListener('LoadingEnd', Start)
function Start() {
	document.addEventListener('findeStage', StageHandler)
	StagePhase();
	document.addEventListener('findecombat', Fin)
}

var StageHandler = function (e) {
	StageNumber = StageNumber + 1
	if (StageNumber == Stage.length) {
		document.removeEventListener('findeStage', this)
		var event = new CustomEvent('findecombat', { 'detail': e.detail });
		document.dispatchEvent(event)
	} else {
		StagePhase();
	}
}


async function  InventoryResponse() {
	for (const element of Inventaire){
		await InventoryResult(element)
	}
	console.log("Sayez")
}
async function InventoryResult(e) {
	var oReq = new XMLHttpRequest();
	var uri = "http://127.0.0.1:8000/api/inventory_consumables/consumables=" + e.consumables.id + ";inventory=" + Team.Inventory.id
	if (e.quantite == 0) {
		oReq.open("DELETE", uri, true);
		oReq.send();
	}
	else {
		Result = { quantite: e.quantite};
		oReq.open("PUT", uri, true);
		oReq.setRequestHeader('Content-type', 'application/json; charset=utf-8');
		oReq.send(JSON.stringify(Result));
	}
}