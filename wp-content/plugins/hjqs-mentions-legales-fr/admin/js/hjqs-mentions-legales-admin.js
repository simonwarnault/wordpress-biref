(function( $ ) {
	'use strict';

	$( window ).load(function() {
		new SettingsForm('hjqs-form-settings', 'h2', 'h3')
	});

	class SettingsForm {
		constructor(formId, titleTag, separatorTag){

			this.formId = formId
			this.form = document.getElementById(formId)
			if(this.form){
				this.titles = this.form.querySelectorAll(titleTag)
				this.formParts = this.form.querySelectorAll('.form-table')
				this.subtitles = this.form.querySelectorAll('.tabs-description')
				this.separators = this.form.querySelectorAll(separatorTag)
				this.init()
			}
		}

		init(){
			this.manageTitle()
			this.manageSeparator()
			this.tabsUI()
			this.manageChoicesOther()
		}

		tabsUI(){
			$( `#${this.formId}` ).tabs().addClass( "ui-tabs-vertical ui-helper-clearfix" );
			$( `#${this.formId} li` ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );

		}

		manageTitle(){
			let tabs = document.createElement('ul')
			this.titles.forEach((title, index) => {
				this.currentForm = this.formParts[index]
				this.currentSubtitle = this.subtitles[index]
				let key = replaceAccents(title.textContent.toLowerCase()).replace(/[^A-Z0-9]+/ig, "_");
				this.currentForm.setAttribute('id', key)
				let item = document.createElement('li')
				let link = document.createElement('a')
				let subtitleWrapper = document.createElement('tr')
				subtitleWrapper.classList.add('hjqs-wrapper-form-header')
				let subtitleHead = document.createElement('th')
				subtitleHead.textContent = title.textContent
				subtitleWrapper.appendChild(subtitleHead)
				let subtitleContainer = document.createElement('td')
				subtitleContainer.appendChild(this.currentSubtitle)
				subtitleWrapper.appendChild(subtitleContainer)
				this.currentForm.firstChild.prepend(subtitleWrapper)
				link.setAttribute('href', `#${key}`)
				link.textContent = title.textContent
				item.appendChild(link)
				tabs.appendChild(item)
				title.remove()
			})
			this.form.prepend(tabs)
		}

		manageSeparator(){
			this.separators.forEach((separator, index) => {
				let parent = separator.parentNode
				parent.parentNode.lastChild.remove()
				parent.setAttribute('colspan','2')
				parent.classList.add('hjqs-separator-row')
			})
		}

		manageChoicesOther(){
			let formChoices = this.form.querySelectorAll('.hjqs_ml-choices-other')
			formChoices.forEach((selectDiv) => {
				let selectParent = selectDiv.parentNode.querySelector('select')
				let finalInput = selectDiv.querySelector('input')
				selectParent.removeAttribute('name')
				let isSelected = false
				selectParent.querySelectorAll('option').forEach((option) => {
					if(option.getAttribute('selected') === 'selected') {
						isSelected = true;
						selectDiv.style.display = 'none'
					}
				})
				if(!isSelected) {
					selectParent.querySelector("option[value='other']").setAttribute('selected', 'selected')
				}
				selectParent.addEventListener('change', (event) => {

					if(selectParent.value === 'other'){
						selectDiv.style.display = 'block'
					} else {
						selectDiv.style.display = 'none'

						finalInput.value = selectParent.value
						finalInput.setAttribute('value', selectParent.value)
					}

				})
			})
		}

	}

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	function replaceAccents(str) {
		// Verifies if the String has accents and replace them
		if (str.search(/[\xC0-\xFF]/g) > -1) {
			str = str
				.replace(/[\xC0-\xC5]/g, "A")
				.replace(/[\xC6]/g, "AE")
				.replace(/[\xC7]/g, "C")
				.replace(/[\xC8-\xCB]/g, "E")
				.replace(/[\xCC-\xCF]/g, "I")
				.replace(/[\xD0]/g, "D")
				.replace(/[\xD1]/g, "N")
				.replace(/[\xD2-\xD6\xD8]/g, "O")
				.replace(/[\xD9-\xDC]/g, "U")
				.replace(/[\xDD]/g, "Y")
				.replace(/[\xDE]/g, "P")
				.replace(/[\xE0-\xE5]/g, "a")
				.replace(/[\xE6]/g, "ae")
				.replace(/[\xE7]/g, "c")
				.replace(/[\xE8-\xEB]/g, "e")
				.replace(/[\xEC-\xEF]/g, "i")
				.replace(/[\xF1]/g, "n")
				.replace(/[\xF2-\xF6\xF8]/g, "o")
				.replace(/[\xF9-\xFC]/g, "u")
				.replace(/[\xFE]/g, "p")
				.replace(/[\xFD\xFF]/g, "y");
		}
		return str;
	}

})( jQuery );
