function domainChecking() {
	let query = jQuery('input[name="s_input"]').val();
	window.location.replace("./search-domain?query=" + query);
}