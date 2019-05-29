(function() {
	'use strict'

	/* reproduces the PHP « date(#, 'c') » output format */
	Date.prototype.dateToISO8601String  = function() {
		var padDigits = function padDigits(number, digits) {
			return Array(Math.max(digits - String(number).length + 1, 0)).join(0) + number;
		}

		var offsetMinutes = - this.getTimezoneOffset();
		var offsetHours = offsetMinutes / 60;
		var offset= "Z";
		if (offsetHours < 0)
			offset = "-" + padDigits((offsetHours.toString()).replace("-","") + ":00", 5);
		else if (offsetHours > 0)
			offset = "+" + padDigits(offsetHours  + ":00", 5);

		return this.getFullYear()
			+ "-" + padDigits((this.getMonth()+1),2)
			+ "-" + padDigits(this.getDate(),2)
			+ "T"
			+ padDigits(this.getHours(),2)
			+ ":" + padDigits(this.getMinutes(),2)
			+ ":" + padDigits(this.getSeconds(),2)
			//+ "." + padDigits(this.getMilliseconds(),2)
			+ offset;
	}

	/* date from YYYYMMDDHHIISS format */
	Date.dateFromYMDHIS = function(d) {
		var d = new Date(d.substr(0, 4), d.substr(4, 2) - 1, d.substr(6, 2), d.substr(8, 2), d.substr(10, 2), d.substr(12, 2));
		//var d = d.substr(0, 4) + '' + d.substr(4, 2) - 1 + d.substr(6, 2) + d.substr(8, 2) + d.substr(10, 2) + d.substr(12, 2);
		return d;
	}

	function NoteBlock() {
		var _this = this;

		/***********************************
		** Some properties & misc actions
		*/
		// init data Object
		this.notesList = JSON.parse(localStorage.getItem('tvn-local-notes-v2-1')) || [];

		// init to "false" a flag aimed to determine if changed have yet to be saved to server
		this.hasUpdated = false;

		// get some DOM elements
		this.noteContainer = document.getElementById('list-notes');
		this.domPage = document.querySelector('.main-form');

		// add click event for "new note"
		document.getElementById('post-new-note').addEventListener('click', function(e) { _this.addNewNote(); });

		// Save button
		document.getElementById('enregistrer').addEventListener('click', function() { _this.saveNotesLocal(); } );

		// prevents user to close without saving.
		window.addEventListener("beforeunload", function (e) {
			// From https://developer.mozilla.org/en-US/docs/Web/Reference/Events/beforeunload
			var confirmationMessage = 'Vous n’avez pas sauvegardé. Quitter tout de même ?';
			if(!_this.hasUpdated) { return true; };
			(e || window.event).returnValue = confirmationMessage || '' ;	//Gecko + IE
			return confirmationMessage;												// Webkit : ignore this.
		});


		/***********************************
		** The HTML tree builder :
		** Builts the whole list of noteq.
		*/
		this.rebuiltNotesWall = function(NotesData) {
			if (0 === NotesData.length) return false;

			// populates the new list
			for (var i = 0, len = NotesData.length ; i < len ; i++) {
				var item = NotesData[i];

				// note block
				var divNote = document.createElement('div');
				divNote.id = 'i_' + item.id;
				divNote.classList.add('notebloc');
				divNote.style.backgroundColor = item.color;
				divNote.dataset.indexId = i;
				divNote.addEventListener('click',
				function(e) {
					_this.showNotePopup(NotesData[this.dataset.indexId]);
				} );

				// note title
				var title = document.createElement('div');
				title.classList.add('title');
				var h2 = document.createElement('h2');
				h2.appendChild(document.createTextNode(item.title));
				title.appendChild(h2);
				divNote.appendChild(title);

				// note main content
				var divContent = document.createElement('div');
				divContent.classList.add('content');
				divContent.appendChild(document.createTextNode(item.content));
				divContent.dataset.id = item.id;
				divNote.appendChild(divContent);

				// add to page
				this.noteContainer.appendChild(divNote);

			}

			return false;
		}
		// init the whole DOM list
		this.rebuiltNotesWall(this.notesList);

		/**************************************
		 * Init a new note, and add it to page
		*/
		this.addNewNote = function() {
			var date = new Date();
			var newNote = {
				"id": date.toISOString().substr(0,19).replace(/[:T-]/g, ''),
				"title": 'Note',
				"content": '',
				"color": '#ffffff',
			};

			this.showNotePopup(newNote);
		}


		this.showNotePopup = function(item) {
			if (document.getElementById('i_' + item.id) ) {
				var noteNode = document.getElementById('i_' + item.id);
				noteNode.style.opacity = 0;
			}
			var popupWrapper = document.createElement('div');
			popupWrapper.id = 'popup-wrapper';

			// TODO : make this a "form" and put this.markAsEdit() on the "onsubmit" action.
			var popup = document.createElement('div');
			popup.id = 'popup';
			popup.classList.add('popup-note');
			popup.style.backgroundColor = item.color;

			popupWrapper.appendChild(popup);
			popupWrapper.addEventListener('click',
				function(e) {
					// clic is outside popup: closes popup
					if (e.target == this) {
						popupWrapper.parentNode.removeChild(popupWrapper);
						if (noteNode) noteNode.style.opacity = null;
					}
				} );


			// note title
			var title = document.createElement('div');
			title.classList.add('title');
			// h2 title
			var h2 = document.createElement('h2');
			h2.contentEditable = true;
			h2.dataset.id = item.id;
			h2.appendChild(document.createTextNode(item.title));
			title.appendChild(h2);
			popup.appendChild(title);

			// note main content
			var textarea = document.createElement('textarea');
			textarea.classList.add('content');
			textarea.appendChild(document.createTextNode(item.content));
			textarea.cols = 30;
			textarea.rows = 8;
			textarea.dataset.id = item.id;
			textarea.placeholder = 'Content';
			popup.appendChild(textarea);


			// date
			var noteDate = document.createElement('div');
			noteDate.classList.add('date');
			noteDate.appendChild(document.createTextNode('Crée le' + ' ' + Date.dateFromYMDHIS(item.id).toLocaleDateString('fr', {weekday: "long", month: "long", day: "numeric"}) ));
			popup.appendChild(noteDate);

			// note buttons
			var ctrls = document.createElement('div');
			ctrls.classList.add('noteCtrls');
			// color button
			var colorBtn = document.createElement('button');
			colorBtn.type = 'button';

			colorBtn.classList.add('colorIcon');
			ctrls.appendChild(colorBtn);
			var colorLst = document.createElement('ul');
			colorLst.dataset.id = item.id;
			colorLst.addEventListener('click',
				function(e) {
					if (e.target.tagName == 'LI') {
						_this.changeColor(item, e);
					}
				});
			colorLst.classList.add('colors');
			var colorsSet = ['#ffffff', '#FF8A80', '#FFD180', '#FFFF8D', '#CCFF90',
							'#A7FFEB', '#80D8FF', '#82B1FF', '#F8BBD0', '#CFD8DC'];
			for (var ili=0; ili<9; ili++) {
				var li = document.createElement('li');
				li.style.backgroundColor = colorsSet[ili];
				colorLst.appendChild(li);
			}
			ctrls.appendChild(colorLst);
			// suppr button
			var supprBtn = document.createElement('button');
			supprBtn.type = 'button';
			supprBtn.classList.add('supprIcon');
			supprBtn.dataset.id = item.id;
			supprBtn.addEventListener('click',
				function() {
					_this.markAsDeleted(item);
				});
			ctrls.appendChild(supprBtn);

			// save button
			var span = document.createElement('span');
			span.classList.add('submit-bttns');

			var button = document.createElement('button');
			button.classList.add('submit', 'button-cancel');
			button.type = "button";
			button.addEventListener('click',
				function() {
					// closes popup
					popupWrapper.parentNode.removeChild(popupWrapper);
					if (noteNode) noteNode.style.opacity = null;
				})
			button.appendChild(document.createTextNode('Annuler'));
			span.appendChild(button);

			var button = document.createElement('button');
			button.classList.add('submit', 'button-submit');
			button.dataset.id = item.id;
			button.type = "button";
			button.name = "editer";
			button.addEventListener('click',
				function() {
					// mark as edited
					_this.markAsEdited(item);
					// closes popup
					popupWrapper.parentNode.removeChild(popupWrapper);
					if (noteNode) noteNode.style.opacity = null;

				})
			button.appendChild(document.createTextNode('Valider'));
			span.appendChild(button);

			ctrls.appendChild(span);
			popup.appendChild(ctrls);

			// add to page
			this.domPage.appendChild(popupWrapper);

			textarea.focus();
		}



		/**************************************
		 * Edit a note (or a new note)
		*/
		this.markAsEdited = function(item) {
			var popup = document.getElementById('popup');
			// is Edit ?
			// search item in notesList to know
			var isEdit = false;
			for (var i = 0, len = this.notesList.length ; i < len ; i++) {
				if (item.id == this.notesList[i].id) {
					var isEdit = true;
					break;
				}
			}

			// update $item from user input
			item.content = popup.querySelector('.content').value;
			item.title = popup.querySelector('h2').firstChild.nodeValue;
			item.color = window.getComputedStyle(popup).backgroundColor;

			// note is new:
			if (!isEdit) {
				this.rebuiltNotesWall([item]); // append it to #notes-list
				this.notesList.push(item);     // append it to the main List
			}

			// note is not new : update note data on screen
			else {
				var theNote = document.getElementById('i_'+item.id);
				theNote.style.backgroundColor = item.color;
				theNote.querySelector('.content').firstChild.nodeValue = item.content;
				theNote.querySelector('h2').firstChild.nodeValue = item.title;
			}

			// raises global "updated" flag.
			this.raiseUpdateFlag(true);
		}


		/**************************************
		 * delete a not
		*/
		this.markAsDeleted = function(item) {
			if (!window.confirm('Supprimer cette note définitivement ?')) { return false; }

			// search element in list and remove is
			for (var i=0, len=this.notesList.length; i<len ; i++) {
				if (this.notesList[i].id == item.id) {
					this.notesList.splice(i, 1);
					break;
				}
			}

			// remove it from page too
			var theNote = document.getElementById('i_'+item.id);
			theNote.parentNode.removeChild(theNote);

			// close popup
			document.getElementById('popup-wrapper').parentNode.removeChild(document.getElementById('popup-wrapper'));

			// raises global "updated" flag.
			this.raiseUpdateFlag(true);
		}


		/**************************************
		 * Change the color of a note
		*/
		this.changeColor = function(item, e) {
			var newColor = window.getComputedStyle(e.target).backgroundColor;
			document.getElementById('popup').style.backgroundColor = newColor;
			e.preventDefault();
		}


		/**************************************
		 * Each change triggers a flag. If (flag), the save button displays
		*/
		this.raiseUpdateFlag = function(flagRaised) {
			if (flagRaised) {
				document.getElementById('enregistrer').disabled = false;
				this.hasUpdated = true;
			} else {
				document.getElementById('enregistrer').disabled = true;
				this.hasUpdated = false;
			}
		}


		/**************************************
		 * Save notes to HTML5 storage
		*/
		this.saveNotesLocal = function() {
			// make a string out of it
			var notesDataText = JSON.stringify(this.notesList);

			localStorage.setItem("tvn-local-notes-v2-1", notesDataText);
			this.raiseUpdateFlag(false);
		}
	}


	window.addEventListener("load", function() {
			var NotesWall = new NoteBlock();
	 });


	// Register service worker
	if ('serviceWorker' in navigator) {
		navigator.serviceWorker
			 .register('./service-worker.js')
			 .then(function() { console.log('Service Worker Registered'); });
	}
})();