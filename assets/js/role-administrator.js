// select2 init
jQuery(document).ready(function ($) {
	// Get all elements with class="tablinks"
	let tablinks = document.getElementsByClassName("tablink");

	// Add event listener to each tab
	for (let i = 0; i < tablinks.length; i++) {
		tablinks[i].addEventListener("click", function () {
			var tabName = this.getAttribute("data-tab");

			// Get all elements with class="tabcontent" and hide them
			let tabcontent = document.getElementsByClassName("tabcontent");
			for (let j = 0; j < tabcontent.length; j++) {
				// tabcontent[j].style.display = "none";
				// with jsquery animatons
				$(tabcontent[j]).slideUp(300);
			}

			// Remove the class "active" from all tabs
			for (let j = 0; j < tablinks.length; j++) {
				tablinks[j].className = tablinks[j].className.replace(" active", "");
			}

			// Show the current tab, and add an "active" class to the button that opened the tab
			$(`#${tabName}`).slideDown(300);
			this.className += " active";
		});
	}
});
