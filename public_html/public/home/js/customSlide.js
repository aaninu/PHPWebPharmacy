// JavaScript Document
jQuery(document).ready(function($){
	
	//Change the default messages	
	var msg = {
			empty_gender:'You must have to select the gender before moving to next step, this is demo string you can change the default error text from customSlide.js', //Step #1 empty gender
			empty_tos:'You must have to accept the terms of use before moving to next step, this is demo string you can change the default error text from customSlide.js', //Terms of use
			save_settings:'Would you like to store the current selections of symptom checker for later use?, this is demo string you can change the default error text from customSlide.js',
			refresh_settings:'You can change the warning message from customSlide.js, Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
			use_cookies:'The system has found your previously stored selection, would you like to reuse them.',
			};
	
	//Ajax URL path
	var ajax_url = 'symptoms_checker/checker.php';
				
	//Default body parts selection
	var xpath = {'gender':'male','side':'front','part':'head'};
	
	//Selected Items list
	var selected = {};
	
	//Selected Choices list
	var choices = {};
	
	//Step one slide container
	var step_one = $('#step_one');
	var step_one_default = $('.level_one .cntnt').html();
	
	//Step two slide container
	var step_two = $('#step_two');
	var step_two_default = $('.level_two .cntnt').html();
	
	//Step three slide contianer
	var step_three = $('#step_three');
	var step_three_default = $('.level_three .cntnt').html();
	
	//$('.custom_slides .slider_nav').hide();
	
	var use_cookies = false;
	
	$('.slider_nav a').click(function(e){
			var href = $(this).attr('href');
			if(href == '#' || href == '') e.preventDefault();
		});
	$('.slider_nav a').live('click', function(e){
			var href = $(this).attr('href');
			if(href == '#' || href == '') e.preventDefault();
		});
		
	//Initialize the symptom checker module
	$('.startHere').click(function(e){
			e.preventDefault();
			refresh_selection();
			
			$(step_one).show(200);
			
			//Image preloader
			$('.skeletonBox', step_one).prepend('<div class="loader" style="display:block"></div>');
			$('#preloading').attr('src', 'images/whole-skeleton.png').load(function() {
				$('.skeletonBox > .loader', step_one).remove();
				$('ul.skelScroll li.skeletonBox div').css('background-image', $(this).attr('src'));
			});

			$('.slide_overlay').show();
			$('.sp-slideshow label, .sp-slideshow input').css('display','none');
			//Cookies
			if($.cookie("xpath")) $(step_one).prepend(popup_box(msg.use_cookies,['yes','no'], 'information'));
		});
	
	//Step two body selection
	$('.next_step', step_one).click(function(e){
			e.preventDefault();
	        var selected = $('.skelScroll > li.active', step_one).children('div:first').attr('class');
			if(selected == undefined) return $(step_one).prepend(popup_box(msg.empty_gender, ['ok'])); //Shoot error if there is no item selected
			
			$('#termsOfUse', step_two).attr('checked', false);
			$('.next_step',step_two).addClass('inactive');
			$('.skelScroll .skeletonBox:first', step_two).addClass('active');
			$('.skelScroll .skeletonBox:first', step_two).html('<div class="'+selected+'"></div>');
			$('.skelScroll .skeletonBox:last', step_two).html('<div class="'+selected+'_back"></div>');

			$(step_one).hide();
			$(step_two).show(200);
		});
	
	//Step Two
	$('.next_step', step_two).click(function(e){
		e.preventDefault();
		refresh_selection(); //refresh previous selection
		var selected = $('.skelScroll > li.active', step_two).children('div:first').attr('class');
		if(selected == undefined || ! $('#termsOfUse').is(':checked')) return $(step_two).prepend(popup_box(msg.empty_tos, ['ok']));//Shoot error if there is no item selected
		var gender = selected.replace('Skel',''), gender_class = gender;
		
		if(gender.match('_back'))
		{
			xPath({'gender':gender.replace('_back',''),'side':'back'});
			gender_class = xpath.gender+' '+gender;
			$('.back_view').trigger('click');
		}else xPath({'gender':gender,'side':'front'});
		
		$('.skeleton > div:first', step_three).removeClass().addClass(gender_class).prepend('<div class="loader" style="display:block"></div>');
		
		//Image preloader
		$('.skeletonBox', step_one).append('<div class="loader" style="display:block"></div>');
		$('#preloading').attr('src', 'images/'+xpath.gender+'.png').load(function() {
			$('.loader', step_three).remove();
			$('.skeleton .'+gender, step_three).css('background-image', $(this).attr('src'));
		});
		
		$(step_two).hide();
		$(step_three).show(200);
	});
	
	$('li.skeletonBox').click(function(){
		$('li.skeletonBox').removeClass('active');
		$(this).addClass('active');
		
		if($(this).parent().siblings('.terms').length && $('#termsOfUse').is(':checked') == false) return;
		$('.next_step', $(this).parent()).removeClass('inactive');
	});
	
	$('#termsOfUse').click(function(e){
			if($(this).is(':checked') == false) $(this).parents('.slider_nav').find('.next_step').addClass('inactive');
			else $(this).parents('.slider_nav').find('.next_step').removeClass('inactive');
		});
	
	//change the view
	$('.back_view, .back_view_selected').click(function(e){
			e.preventDefault();
			$('.skeleton > div:first', step_three).addClass(xpath.gender+'_back');
			$('.front_view_selected').removeClass().addClass('front_view');
			$(this).removeClass().addClass('back_view_selected');
			xPath('side', 'back');
			$('ul.parts a.select').trigger('click');
		});
	
	$('.front_view, .front_view_selected').click(function(e){
			e.preventDefault();
			$('.skeleton > div:first', step_three).removeClass(xpath.gender+'_back');
			$('.back_view_selected').removeClass().addClass('back_view');
			$(this).removeClass().addClass('front_view_selected');
			xPath('side', 'front');
		});
		
	//Go back on step two
	$('.goBack', step_two).click(function(e){
			e.preventDefault();
			$(step_one).show(200);
			$(step_two).hide();
		});

	// Step Three
	$('.goBack', step_three).click(function(e){
			e.preventDefault();
			$(step_two).show(200);
			$(step_three).hide();
		});
	
	$('.startOver, .cancel_symptom_check').click(function(e){
		e.preventDefault();
		if($(step_three).css('display') == 'block') return $('#step_three').append(popup_box(msg.save_settings,['yes','no','cancel'], 'information'));
		start_over();
	});
	
	$('#alert_msg a.ok').live('click', function(){
			$('#alert_msg').remove();
		});
	
	//DELETE THE COOKIES
	$('#alert_msg a.no', step_one).live('click', function(){
			clear_cookies();
		});
		
	//USE THE COOKIES
	$('#alert_msg a.yes', step_one).live('click', function(){ //use stored settings
		use_cookies = true;
		xpath = JSON.parse($.cookie("xpath"));
		selected = JSON.parse($.cookie("selected"));
		choices = JSON.parse($.cookie("choices"));
		$(step_three).show(200);
		
		var view = (xpath.side == 'back') ? xpath.gender+'_back' : xpath.gender;
		$('.skeleton > div:first', step_three).removeClass().addClass(view);
		if(xpath.side == 'back') $('.back_view').trigger('click');
		$('ul li.'+xpath.part+' a').trigger('click');
	});
	
	$('#alert_msg a.cancel').live('click', function(){
			$('#alert_msg').remove();
		});
		
	$('#alert_msg a.no', step_three).live('click', function(){
			clear_cookies();
			start_over();
		});
		
	$('#alert_msg a.yes', step_three).live('click', function(){ //store the cookies information
			$.cookie("xpath", JSON.stringify(xpath), { path: '/' });
			$.cookie("selected", JSON.stringify(selected), { path: '/' });
			$.cookie("choices", JSON.stringify(choices), { path: '/' });
			start_over();
		});
		
	$('.restart_selection').click(function(e){
		e.preventDefault();
		$(step_three).prepend(popup_box(msg.refresh_settings, ['continue','cancel'], 'warning')); //Shoot error if there is no item selected
	});
	
	$('#alert_msg a.continue').live('click', function(){
			refresh_selection();
			$('#alert_msg').remove();
		});
		
	$('ul.parts a').click(function(){
			var clicked_on = $(this).parent().attr('class'), content = $('.level_one div.cntnt');
			if( ! use_cookies) selected = {}, choices = {};
			
			$('.popup-box').hide(); //remove the existing popup
			$('.level_one .step_title').text(ucwords(clicked_on)+' Parts');
			$('ul.parts a').removeClass('select');
			$(this).addClass('select');
			
			$('.level_two div.cntnt', step_three).html(step_two_default).css('height', $('.level_two div.cntnt').height() + 1).css('height', $('.level_two div.cntnt').height() - 1);
			$('.level_three div.cntnt', step_three).html(step_three_default).css('height', $('.level_three div.cntnt').height() + 1).css('height', $('.level_three div.cntnt').height() - 1);;
			
			$(content).html('<div class="loader" style="display:block"></div>');
			
			$.ajax({
				url:ajax_url,  
				data:xPath({'part':clicked_on,'area':'','choice':''}),
				dataType:'json',
				success:function(json){
					var html = '';
					var is_selected = false;
					$.each(json, function(k, v){
							var checked = '', counter = 0;
							
							//if( ! use_cookies) selected[k] = {};
							//else 
							selected[k] = (selected[k] != undefined) ? selected[k] : {};
							if($.isEmptyObject(selected[k]) == false)
								checked = ' checked="checked"',	counter = obj_length(selected[k]), is_selected = true;
							
							html += '<li><span class="checkBox"><input type="checkbox" class="'+k+'"'+checked+' /></span><span>'+ucwords(v)+'</span><span class="counter">('+counter+')</span></li>'
						});
					
					$(content).html('<ul class="level1">'+html+'</ul>');
					//Apply the scroller if the height is larger than parent div
					if($('.level1', step_three).height() > $(content).height()) $(content).mCustomScrollbar({scrollInertia:0});

					if(is_selected == true) update_choices();
				},
				error:function(err_msg){
						$(content).html('<div class="block1 inline_msg"> <img alt="" src="images/error.png"> <strong>ERROR</strong> - '+err_msg.responseText+'</div>');
					}
			});
		});
	
	$('ul.level1 input').live('click', function(e){
		var Class = $(this).attr('class'), parent = $(this).parents('li:first');
		choices = {}; //clear the global choices
		
		//if($.isEmptyObject(selected[Class]) == false && $(this).is(':checked') == false) $(this).attr('checked','checked');
		if($.isEmptyObject(selected[Class]) == false) e.preventDefault();
		else if($(this).is(':checked') == false && $('ul.level1 input:checked').length == 0) $('.level_two .cntnt').html(step_two_default).css('height', $('.level_two div.cntnt').height() + 1).css('height', $('.level_two div.cntnt').height() - 1);;
		
		//LAST CHECKED
		$('ul.level1 li.active input:checked').each(function(){
				if($.isEmptyObject(selected[$(this).attr('class')])) $(this).removeAttr('checked');
			});
		
		if($(parent).hasClass('active')) //stop the process if user wants to close the popup-box
		{
			$(parent).removeClass('active');
			$('.popup-box').hide();
		}else
		{
			$('ul.level1 > li').removeClass('active');
			$(parent).addClass('active');
			$('.popup-box').css('display','block').html('<div class="loader" style="display:block;"></div></div>');
			
			$.ajax({
				url:ajax_url,
				data:xPath({'area':$(this).attr('class'),'choice':''}),
				dataType:'json',
				success:function(json){
					var html = '', count = 0;
					html += '<div class="heading">You can select more than one <a class="button done" href="javascript:void(0);">Done</a></div><ul class="'+xpath.area+'">';
					$.each(json, function(k, v){
							var is_duplicate = $('.level2 input[id$="-'+Slug(v)+'"]'), id = xpath.area+'-'+k;
							if( ! is_duplicate.length || $(is_duplicate).attr('id') == id) //stop duplicate entries
							{
								var checked = (selected[Class][k] != undefined) ? ' checked="checked"' : '';
								html += '<li><span class="checkBox"><input type="checkbox" class="'+k+'"'+checked+' /></span><span>'+ucwords(v)+'<span></li>'
								if(count == 17) html = html+'</ul><ul class="hidden '+xpath.area+'" style="display:none;">';
								count++;
							}
						});
					html += '</ul><div class="bottom">';
					html += (count >= 17) ? '<a class="left view_all" href="javascript:void(0);">View All</a>' : '';
					html += '<a class="right refresh_list" href="javascript:void(0);">Clear Selection</a></div>';
					
					var mover = ($('.popup-box').offset().top - $('ul.level1 > li.active').offset().top) / 2;
					$('.popup-box').css('top', 200).html(html).show();
					dialog_box();
				},
				error:function(err_msg){
						$(content).html('<div class="block1 inline_msg"> <img alt="" src="images/error.png"> <strong>ERROR</strong> - '+err_msg.responseText+'</div>');
					}
			});
		}
	});

	$('ul.level2 input').live('click', function(){
		
		var Class = $(this).attr('class').split(' '), parent = Class[0], child = Class[1], id = parent+'-'+child, content = $('.level_three .cntnt'), is_empty = $('ul > li', content).length;
		if( ! is_empty) $(content).html('<div class="loader" style="display:block"></div>');
		
		if($(this).is(':checked'))
		{
			choices[id] = (choices[id]) ? choices[id] : {};
			$.ajax({
				url:ajax_url,
				data:xPath({'area':parent,'choice':child}),
				dataType:'json',
				success:function(json){
					var html = '';
					$.each(json, function(k, v){
							var slug = Slug(v);
							if( ! $('.level3 li.'+slug).length)
								html += '<li class="'+slug+' '+id+'"><span>'+v+'<span></li>'
						});
					
					$('.level_three .cntnt .loader').remove()
					html = ($('.level3').html()) ? $('.level3').html() + html : html;
					$(content).html('<ul class="level3">'+html+'</ul>');
					
					if($('.level3', step_three).height() > $(content).height() && ! $('.mCSB_container', content).length) $(content).mCustomScrollbar({scrollInertia:0});
					use_cookies = false;
				},
				error:function(err_msg){
						$(content).html('<div class="block1 inline_msg"> <img alt="" src="images/error.png"> <strong>ERROR</strong> - '+err_msg.responseText+'</div>');
					}
			});
		}else
		{
			delete choices[id];
			$('li.'+parent+'-'+child, content).remove();

			if($('ul > li', content).length <= 0) $(content).html(step_three_default).css('height', $('.level_three div.cntnt').height() + 1).css('height', $('.level_three div.cntnt').height() - 1);
			else if($('.level3', step_three).height() < $(content).height()) $(content).html($('.level3').clone().wrap('<div>').parent().html());//Reset scroller 
		}
	});

	$('ul.level2 span.del').live('click', function(e){
			
			e.preventDefault();
			var li = $(this).parents('li:first'), Class = $('input:first', li).attr('class').split(' '), parent = Class[0], child = Class[1], id = parent+'-'+child, content = $('.level_two .cntnt');
			$('.level3 > li.'+parent+'-'+child).remove();
			if( ! $('.level3 > li.'+parent+'-'+child).length) $('.level_three .cntnt').html(step_three_default).css('height', $('.level_three div.cntnt').height() + 1).css('height', $('.level_three div.cntnt').height() - 1);;
			if($('.level_two .cntnt li').length <= 1) $('.level_two .cntnt').html(step_two_default).css('height', $(content).height() + 1).css('height', $(content).height() - 1);
			
			var counter = $('.level_two .cntnt li.'+parent).length - 1, selector = $('.level1 > li').has('input.'+parent);
			counter = (counter < 0) ? 0 : counter;
			$('.counter', selector).html('('+counter+')');
			if( ! counter) $('input', selector).removeAttr('checked');
			
			delete selected[parent][child];
			delete choices[id];
			$(li).remove();
		});	
			
	//Popup box settings	
	$('.popup-box input').live('click', function(){
			var area = $('.popup-box ul:first').attr('class'), Class = $(this).attr('class');
			var counter = $('.popup-box input:checked').length;
			if($(this).is(':checked')) selected[area][Class] = $(this).parent().siblings('span').text();
			else delete selected[area][Class];
			
			$('ul.level1 > li.active > .counter').html('('+counter+')');
		});
		
	$('.popup-box .view_all').live('click', function(){
			$('.popup-box ul.hidden').toggle();
			if($(this).text() == 'View All')
			{
				$(this).text('Reduce list');
				//$('#menu').focus();
			}
			else $(this).text('View All');
		});
		
	$('.popup-box .done').live('click', function(){
			update_choices();
			var Class = $('ul.level1 > li.active input:first').attr('class');
			if($.isEmptyObject(selected[Class])) $('ul.level1 > li.active input').removeAttr('checked');
			
			$('.popup-box').hide();
			$('ul.level1 > li').removeClass('active');
		});
		
	$('.refresh_list').live('click', function(e){
	   e.preventDefault();
	   $('.popup-box input').removeAttr('checked');
	   var area = $('.popup-box ul:first').attr('class');
	   selected[area] = {};
	  $('ul.level1 > li.active > .counter').html('(0)');
	});
	
	//Move the popupbox
	function dialog_box(){
		//Get the main container top
		var main_container_top = $('div.level_one:first').offset().top;
		
		//Container-height
		var container_height = $('div.level_one:first').height();
		
		//Get the current li top
		//var current_li_top = $(this).parents('li:first').offset().top;
		var current_li_top = $('ul.level1 > li.active').offset().top;
		
		//calculate the current element top from 0 point
		var calculated_top = current_li_top - main_container_top;
	
		//now get the box height
		var box_height = $('.popup-box').height();

		//calculate the remianing box height
		var remaining_box_height = $('div.level_one:first').height() - calculated_top;
		
		//container half
		var container_half = container_height / 2;
		
		//box half
		var box_half = box_height / 2;
		
		//If the box height is greater than container height, than don't move the box
		if(box_height >= container_height || calculated_top < box_half)
		{
			$('.popup-box').css('top','-1px');
		}else
		{        
			if(box_half > remaining_box_height) $('.popup-box').css('top', ((calculated_top - box_height) + remaining_box_height) +'px');
			else $('.popup-box').css('top', calculated_top - box_half);
		}
	}

	function xPath(key, value, rest)
	{
		xpath = (rest) ? {} : xpath;
		
		if(typeof(key) != 'object')
		{
			var k = key;
			key = {};
			key[k] = value;
		}
		
		$.each(key, function(k, v){ xpath[k] = v});
		return xpath;
	}
	
	function update_choices()
	{
		var html = '', checked = $('ul.level1 input:checked'), content = $('.level_two .cntnt');
		$(checked).each(function(){
				var parent = $(this).attr('class'), auto_selected = {};
				if($.isEmptyObject(selected[parent]) == false)
				{
					$.each(selected[$(this).attr('class')], function(k, v){
							var is_checked = (choices[parent+'-'+k]) ? ' checked="checked"' : '';
							html += '<li class="'+parent+'"><span class="checkBox"><input type="checkbox" id="'+parent+'-'+k+'" class="'+parent+' '+k+'"'+is_checked+' /></span><span>'+ucwords(v)+'<span><span class="del"></span></li>';
						});
				}
			});
		
		if(html.length > 0) $(content).html('<ul class="level2">'+html+'</ul>');//.mCustomScrollbar({scrollInertia:0});
		else $(content).html(step_two_default).css('height', $('.level_two div.cntnt').height() + 1).css('height', $('.level_two div.cntnt').height() - 1);;
		
		//Apply the scroller if the height is larger than parent div
		if($('.level2', content).height() > $(content).height()) $(content).mCustomScrollbar({scrollInertia:0});

		$.each(choices, function(k, v){
				$('input#'+k, content).trigger('click');
				$('input#'+k, content).attr('checked','checked');
			});
	}
	
	function clear_cookies()
	{
		$.cookie("xpath", null, { path: '/' });
		$.cookie("selected", null, { path: '/' });
		$.cookie("choices", null, { path: '/' });
		$('#alert_msg').remove();
	}
	
	function start_over()
	{
		$('#alert_msg').remove();
		$('.skeletonBox').removeClass('active');
		$('.next_step').addClass('inactive');
		$('.slider_nav, .slide_overlay').hide();
		$('.sp-slideshow label, .sp-slideshow input').css('display','');
	}
	
	function refresh_selection()
	{
		selected = {}, choices = {};
		$('.level_one .step_title').html('Body Parts');
		$('.level_one .cntnt').html(step_one_default).css('height', $('.level_one .cntnt').height() + 1).css('height', $('.level_one .cntnt').height() - 1);
		$('.level_two .cntnt').html(step_two_default).css('height', $('.level_two .cntnt').height() + 1).css('height', $('.level_two .cntnt').height() - 1);
		$('.level_three .cntnt').html(step_three_default).css('height', $('.level_three .cntnt').height() + 1).css('height', $('.level_three .cntnt').height() - 1);
		$('ul a').removeClass('select');
		if(xpath.side == 'back') $('.back_view').trigger('click');
		else $('.front_view').trigger('click');
		$('#alert_msg').remove();
	}
});