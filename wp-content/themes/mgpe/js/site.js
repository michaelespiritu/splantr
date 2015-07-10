jQuery(document).ready(function(){
	jQuery('#menu-main-menu').addClass('nav navbar-nav');
	jQuery('#menu-item-36').addClass('dropdown');
	jQuery('#menu-item-36  a').addClass('dropdown-toggle').attr('data-toggle', 'dropdown').append('<span class="caret"></span>');
	jQuery('#menu-item-36 .sub-menu').addClass('dropdown-menu').attr('role','menu');
	jQuery('#menu-item-36 .sub-menu li a').removeClass('dropdown-toggle').removeAttr('data-toggle', 'dropdown');
	jQuery('#menu-item-36 .sub-menu a span').removeClass('caret');

	jQuery('.featured-tooltip').tooltip();
	
	jQuery('.search-submit').click(function(){
		if(jQuery('.search-input').val() == ""){
			jQuery('.search-input').addClass('error');
			return false;
		}
	});
	 
	jQuery('.prev-post-link a').attr('class', 'btn btn-info btn-xs animate');
	jQuery('.next-post-link a').attr('class', 'btn btn-danger btn-xs animate');
});