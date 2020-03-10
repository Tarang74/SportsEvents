$(".alpha-only").on("input", function () {
	var regexp = /[^a-zA-Z ]*$/gm;
	if ($(this).val().match(regexp)) {
		$(this).val($(this).val().replace(regexp, ''));
	}
});