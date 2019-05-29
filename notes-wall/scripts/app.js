(function() {
	// the note Wall element
	var n = document.getElementById('notes');
	// the delete-All button
	var rm = document.getElementById('reset');

	function noteBlurEvent(e) {
		if (this.textContent == '') {
			this.parentNode.removeChild(this);
		}
		saveNotes();
	}

	/* Using HTML5-webstorage */
	function saveNotes() {
		var notes = n.childNodes;
		var notesDataToSave = new Array();

		for (var note of notes) {
			if (note.innerHTML !== "") {
				notesDataToSave.push({'coords': {'x': note.style.left, 'y': note.style.top}, 'content': note.innerHTML });
			}
		}
		localStorage.setItem("notes-notesWall", JSON.stringify(notesDataToSave));
	}

	function loadNotes() {
		var notesDataSaved = JSON.parse(localStorage.getItem('notes-notesWall'));
		if (null === notesDataSaved) return;

		for (var note of notesDataSaved) {
			var newText = document.createElement('pre');
			newText.contentEditable = true;
			newText.addEventListener('blur', noteBlurEvent);
			newText.style.left = note.coords.x;
			newText.style.top = note.coords.y;
			newText.innerHTML = note.content;
			n.appendChild(newText);
		}
	}

	function deleteAllNotes() {
		if (!window.confirm('Supprimer toutes les notes définitivement ?')) { return false; }

		while (n.firstChild) {
			n.removeChild(n.firstChild);
		}
		var notesDataToSave = new Array();
		localStorage.setItem("notes-notesWall", JSON.stringify(new Array()));
	}


	rm.addEventListener('click', deleteAllNotes);

	// click on wall
	n.addEventListener('click', function(e) {
		// if click in an already existing note, discard
		if (e.target !== n) { return;}

		// detect click coords
		coords = new Object();
		var coords = {
			// “-15” is to counter the innerpadding
			x: e.clientX - n.getBoundingClientRect().left - 15,
			y: e.clientY - n.getBoundingClientRect().top - 15
		};
		// init new <pre>.
		// We use <pre> (and not div) to allow \n to be saved and restored.
		var newPre = document.createElement('pre');
		newPre.contentEditable = true;
		newPre.style.left = coords.x + 'px';
		newPre.style.top = coords.y + 'px';

		// if <div> is blured while empty, remove it.
		newPre.addEventListener('blur', noteBlurEvent);

		n.appendChild(newPre);
		newPre.focus();

	});


	loadNotes();

	// add service worker code here
	if ('serviceWorker' in navigator) {
		navigator.serviceWorker
						 .register('./service-worker.js')
						 .then(function() { console.log('Service Worker Registered'); });
	}
})();