// JavaScript Document
/*
   Copyright (c) 2011 Koen Ekelschot
   ---
   Version 1.0.1 - Jan. 30, 2011
   A jQuery plugin which replaces <select> elements with a fancy dropdown menu
   Usage:
   - $(selector).fancyDropdown(); //returns jQuery chainable object
   Prerequisites:
   - jQuery hasEventListener plugin by sebastien-p: https://github.com/sebastien-p/jquery.hasEventListener
*/

(function($) {
 	$.fn.fancyDropdown = function() {
		return this.each(function() {
			var el = $(this);
			var id = $(this).attr('id');
			el.hide();
			//create needed HTML
			var html = '<div class="dropdown" id="'+id+'_dropdown"></div><ul class="dropdownlist" id="'+id+'_dropdownlist">';
			$('option', el).each(function() {
				var realvalue = $(this).attr("value");
				var img = $(this).attr("data-img");
				var info = $(this).attr("data-info");

				if (info == null) {
					html += '<li data-realvalue="'+realvalue+'"><p class="no-info"><strong>'+$(this).text()+'</strong></p>';
				} else {
					html += '<li data-realvalue="'+realvalue+'"><p><strong>'+$(this).text()+'</strong><br />'+info+'</p>';
				}
			});
			
			html += '</ul>';
			el.after(html);
			//set initial values
			var initoption = $('li[data-realvalue="'+el.val()+'"]', $('#'+id+'_dropdownlist'));
			initoption.attr('class', 'active');
			$('#'+id+'_dropdown').attr('data-realvalue', initoption.attr('data-realvalue')).html(initoption.html());
			//bind click event
			if ($('body').hasEventListener("click.customdropdown").length == 0) {
				//bind the click event only once
				$('body').bind('click.customdropdown', function(e) {
					var elements = $(e.target).parents().andSelf();
					var dropdown = elements.filter('.dropdown');
					var dropdownlist = elements.filter('.dropdownlist');

					if (dropdown.length == 0 && dropdownlist.length == 0) {
						//not clicked on .dropdown or .dropdownlist, hide .dropdownlist
						$(".dropdownlist").fadeOut('fast');
						$(".dropdown").removeClass('active_dropdown');
					} else {
						if (dropdown.length != 0) {
							//clicked on .dropdown
							var dropdownid = $(dropdown[0]).attr('id');
							if ($("#"+dropdownid).hasClass('active_dropdown')) {
								//close all .dropdownlist
								$(".dropdownlist").fadeOut('fast');
								$(".dropdown").removeClass('active_dropdown');
							} else {
								//close all .dropdownlist
								$(".dropdownlist").fadeOut('fast');
								$(".dropdown").removeClass('active_dropdown');
								//and open the clicked one
								$("#"+dropdownid).addClass('active_dropdown');
								$("#"+dropdownid+"list li.active").addClass('hover').siblings().removeClass('hover');
								var pos = $(dropdown[0]).position();
								$("#"+dropdownid+"list").css({
									top: (pos.top+$(dropdown[0]).outerHeight())+'px',
									left: pos.left+'px'
								}).fadeIn('fast');
							}
						} else {
							//clicked on .dropdownlist
							var dropdownid = $(dropdownlist[0]).attr('id').slice(0, -4);
							var li = $(elements.filter('li')[0]);
							$('#'+dropdownid).removeClass('active_dropdown').attr('data-realvalue', li.attr('data-realvalue')).html(li.html());
							li.addClass('active').siblings().removeClass('active');
							$(dropdownlist[0]).fadeOut('fast');
							//reflect change to original <select> element
							$("#"+dropdownid.slice(0, -9)).val(li.attr('data-realvalue'));
						}
					}
				});
			}

			//add hover states
			$(".dropdownlist li").live('mouseover', function() {
				$(this).addClass("hover").siblings().removeClass("hover");
			});

			$(".dropdown").live('mouseover', function() {
				$(this).addClass('hover_dropdown');
			}).live('mouseout', function() {
				$(this).removeClass('hover_dropdown');
			});
		});
	};
})(jQuery);