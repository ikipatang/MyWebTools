function chassotron() {

	var a_sujet = new Array(
		//        qui           'pluriel'
		new Array('Un chasseur',             0),
		new Array('Un chasseur',             0),
		new Array('Un chasseur',             0),
		new Array('Un groupe de chasseurs',  1),
		new Array('Un groupe de chasseurs',  1),
		new Array('Un groupe de chasseurs',  1),
		new Array('Des chasseurs',           1),
		new Array('Des chasseurs',           1),
		new Array('Des chasseurs',           1),
		new Array('Des chasseurs végans',    1)
	);

	var a_verbe = new Array(
		new Array('tue',                 'tuent'),
		new Array('tue mortellement',    'tuent mortellement'),
		new Array('blesse',              'blessent'),
		new Array('blesse mortellement', 'blessent mortellement'),
		new Array('tire sur',            'tirent sur'),
		new Array('mitraille',           'mitraillent'),
		new Array('perfore',             'perforent'),
		new Array('vise',                'visent'),
		new Array('cribble de balles',   'cribblent de balles'),
		new Array('descend',             'descendent'),
		new Array('ôte la vie chez',     'ôtent la vie chez')
	);

	var a_cod = new Array(
		'un homme',
		'un enfant',
		'un bébé phoque',
		'un chaton',
		'une quincagénaire',
		'un papy et une mamie',
		'un gros papillon',
		'un randonneur',
		'un randonneur et son chien',
		'un autre chasseur',
		'un automobiliste',
		'un cycliste',
		'un chien',
		'un groupe de 41 touristes japonais',
		'une classe de CM2 en sortie scolaire',
		'une fillette de 6 ans',
		'un hélicoptère de l’armée',
		'2 nains de jardin',
		'un extra-terrestre',
		'Phillipe de Villiers',
		'Donald Trump',
		'un Pikachu sauvage'
	);

	var a_actpas = new Array(
		'en pensant viser',
		'en courant après',
		'en poursuivant',
		'en tirant sur',
		'en visant',
		'après avoir vu',
		'en voulant tuer'
	);

	var a_actpas2 = new Array(
		'un sanglier',
		'un canard',
		'une oie',
		'un cerf',
		'un groupe de marcassins',
		'un ours isolé',
		'le loup',
		'un cycliste',
		'12 lapins',
		'97 migrants',
		'un militant végan',
		'un éléphant rose',
		'3 biches',
		'Bambi'
	);

	var a_date = new Array(
		'dimanche dernier',
		'lors de l’ouverture de la chasse',
		'jeudi 12 octobre',
		'en 2001',
		'à 18h12',
		'samedi matin',
		'le soir d’halloween',
		'pendant la messe',
		'lors du repas',
		'après les cours',
		'pendant l’apéro'
	);



	choose = function(tableau) {
		var len = tableau.length;
		var i = Math.floor(Math.random()*len);
		return tableau[i];
	}

	var a1 = choose(a_sujet);
	var a2 = choose(a_verbe);
    a2 = (a1[1] == 1) ? a2[1] : a2[0];
    a1 = a1[0];
	var a3 = choose(a_cod);
	var a4 = choose(a_actpas);
	var a5 = choose(a_actpas2);
	var a6 = choose(a_date);

	output.innerHTML = a1+' '+a2+' '+a3+' '+a4+' '+a5+', '+a6+'.';
}
