function malouotron() {

var malou1 = new Array("Chapitre abstrait 3 du conpendium :","C’est à dire ici, c’est le contraire, au lieu de panacée,","Au nom de toute la communauté des savants,","Lorsqu’on parle de tous ces points de vues,","C’est à dire quand on parle de ces rollers,","Quand on parle de relaxation,","Nous n’allons pas seulement danser ou jouer au football,","D'une manière ou d'une autre,","Quand on prend les triangles rectangles,","Se consolidant dans le système de insiding et outsiding,","Lorsque l'on parle des végétaliens, du végétalisme,","Contre la morosité du peuple,","Tandis que la politique est encadrée par des scientifiques issus de Sciences Po et Administratives,","On ne peut pas parler de politique administrative scientifique,","Pour emphysiquer l'animalculisme,","Comme la coumbacérie ou le script de Aze,","Vous avez le système de check-up vers les anti-valeurs, vous avez le curuna, or","La convergence n’est pas la divergence,","L’émergence ici c’est l’émulsion, c’est pas l’immersion donc","Imbiber, porter","Une semaine passée sans parler du peuple c’est errer sans abri, autrement dit","Actuellement,","Parallèlement,","Mesdames et messieurs fidèles,");

var malou2 = new Array("la cosmogonisation","l'activisme","le système","le rédynamisme","l'ensemble des 5 sens","la société civile","la politique","la compétence","le colloque","la contextualisation","la congolexicomatisation","la congolexicomatisation","la congolexicomatisation","la congolexicomatisation","la prédestination","la force","la systématique","l'ittérativisme","le savoir","l'imbroglio","la concertation politique","la délégation","la pédagogie","la réflexologie");

var malou3 = new Array("vers la compromettance pour des saint-bioules","vers ce qu’on appelle la dynamique des sports","de la technicité informatisée","de la Théorie Générale des Organisations","autour de la Géo Physique Spatiale","purement technique","des lois du marché","de l'orthodoxisation","inter-continentaliste","à l'égard de la complexité","éventualiste sous cet angle là","de toute la République Démocratique du Congo","à l'incognito","autour de l'ergonométrie","indispensable(s) en science et culture","autour de phylogomènes généralisés","à forciori,","par rapport aux diplomaties");

var malou4 = new Array("tend à ","nous pousse à ","fait allusion à ","va ","doit ","consiste à ","nous incite à","vise à","semble","est censé(e)","paraît","peut","s'applique à","consent à","continue à","invite à","oblige à","parvient à","pousse à","se résume à","suffit à","se résoud à","sert à","tarde à");

var malou5 = new Array("incristaliser","imposer","intentionner ","mettre un accent sur ","tourner ","informatiser ","aider ","défendre ","gérer ","prévaloir ","vanter ","rabibocher","booster","porter d'avis sur ce qu'on appelle","cadrer","se baser sur","effaceter","réglementer","régler","faceter","partager","uniformiser","défendre","soutenir","propulser","catapulter","établir");

var malou6 = new Array("les interchanges","mes frères propres","les revenus","cette climatologie","une discipline","la nucléarité","l'upensmie","les sens dynamitiels","la renaissance africaine","l'estime du savoir","une kermesse","une certaine compétitivité","cet environnement de 2 345 410 km²","le kilométrage","le conpemdium","la quatripartie","les encadrés","le point adjacent","la bijectivité","le panafricanisme","ce système phénoménal","le système de Guipoti : 1/B+1/B’=1/D","une position axisienne","les grabuses lastiques","le chicouangue","le trabajo, le travail, la machinale, la robotisation","les quatre carrés fous du fromage");

var malou7 = new Array("autour des dialogues intercommunautaires","provenant d'une dynamique syncronique","vers le monde entier","propre(s) aux congolais","vers Lovanium","vers l'humanisme","comparé(e)(s) la rénaque","autour des gens qui connaissent beaucoup de choses","possédant la francophonie","dans ces prestances","off-shore","dans Kinshasa","dans la sous-régionalité","dans le prémice","belvédère","avec la formule 1+(2x5)","axé(e)(s) sur la réalité du terrain","dans les camps militaires non-voyants","avéré(e)(s)","comme pour le lancement de Troposphère V");

var malou8 = new Array(", tu sais ça",", c’est clair",", je vous en prie",", merci",", mais oui",", Bonne Année",", bonnes fêtes");


choose = function(tableau) {
	var len = tableau.length;
	var i = Math.floor(Math.random()*len);
	return tableau[i];
}

	output.innerHTML = '<p>'+choose(malou1)+' '+choose(malou2)+' '+choose(malou3)+' '+choose(malou4)+' '+choose(malou5)+' '+choose(malou6)+' '+choose(malou7)+''+choose(malou8)+'.</p>';
}
