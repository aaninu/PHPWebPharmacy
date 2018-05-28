/* Custom Code */

/** Core Function **/
/* Windows Resize Checker */
var screen_type = screen_size();
function screen_size()
{
	var width = $(window).width();
	if(width <= 479) return 'iphone';
	else if(width <= 768) return 'tablet';
	else return 'pc';
}

function ucwords(str)
{
	return str.toLowerCase().replace(/\b[a-z]/g, function(letter) {
		return letter.toUpperCase();
	});
}

function Slug(str)
{
	return str.toLowerCase().replace(/(\s+)/g,'_').replace(/([^a-z0-9_])/g,'')
}
	
function popup_box(msg, opts, type)
{
	type = (type) ? type : 'error';
	var html = '<div id="alert_msg"><div class="message-box"><div class="block1"><p><img alt="" src="/public/home/images/'+type+'.png">'+msg+'</p><div class="bottom">';
		$.each(opts, function(k,v){
				html += '<a href="#" class="'+Slug(v)+'">'+ucwords(v)+'</a>';
			});
			
		html += '</div></div></div><div class="slide_overlay"></div></div>';
	return html;
}

function obj_length(object)
{
	var count = 0;
	for (var k in object) {
		if (object.hasOwnProperty(k)) {
		   ++count;
		}
	}
	
	return count;
}

/** End core function */
jQuery(document).ready(function($) {
	
	$(window).resize(function(){screen_type = screen_size();}); 
	//Demo version documenation alert
	if(screen_type != 'iphone')
	{
		if($.cookie("demo_msg") != 'false')
		{
			$('body').prepend(popup_box('Bine ai venit! <br>Acest website este o platforma de prezentare. Toate datele existente sunt folosite pentru prezentarea platformei. Mai multe detalii pe GitHub: <a href="https://github.com/aaninu/PHPWebPharmacy" target="_blank">https://github.com/aaninu/PHPWebPharmacy</a>',['ok'], 'information'));
			$("html,body").css("overflow","hidden");
		}
		
		$('body > #alert_msg a.ok').live('click', function(){
				$('#alert_msg').remove();
				$.cookie("demo_msg", false, { path: '/' });
				$("html,body").css("overflow","auto");
			});
	}
		
    //Change the behaviour of main-menu in different versions
	if(screen_type == 'pc')
	{
		$('#menu > li').hover(function(){
			$(this).addClass('active');
			$('div.dropdown_full_columns', this).fadeIn();
			$('div.dropdown_columns', this).fadeIn();
			if($('div.dropdown_full_columns', this).length > 0) 
				{
					$('.overlay').fadeIn();
				}		
		},function(){
			$(this).removeClass('active');
			 $('.overlay').fadeOut();
			 $('div.dropdown_full_columns', this).fadeOut();
			$('div.dropdown_columns', this).fadeOut();
			 
		});
	}
	
	$(window).scroll(function(){
	
		if($('#main-container').width() >= 900)
		{
			if ($(this).scrollTop() > 100) {
				$('.pageup').fadeIn();
			} else {
				$('.pageup').fadeOut();
			}
		}
		
	});




	$('.pageup').click(function(e){
		e.preventDefault();
		$('html, body').animate({scrollTop:0}, 'slow');
	});
	
    if($('#companieslist').length>0){
        var $carlist = $('#companieslist').carousel({
            group:1,
            start:1
        });
        $('#scrollleft').on('click', function(ev) {
            ev.preventDefault();
            $carlist.carousel('prev');
        });
        $('#scrollright').on('click', function(ev) {
            ev.preventDefault();
            $carlist.carousel('next');
        });
    }
    
	/* Sing Box Script Starts */
    $("#signin").click(function(e) {          
        e.preventDefault();
        //$("#signinbox").toggle();
		$("#signinbox").animate({height: 'show', opacity: '0', filter: 'alpha(opacity=0)'}, {duration: 0}).animate({opacity: '.5', filter: 'alpha(opacity=50)', top: 58}, {duration: 300, easing: 'easeInBack'}).animate({opacity: '1', filter: 'alpha(opacity=100)', top: 24}, {duration: 200, easing: 'easeOutBack'});
    });

    $("#signinbox").mouseup(function() {
        return false
    });
	
    $(document).mouseup(function(e) {
        if($(e.target).parent("a.signin").length==0) {
            $(".signin").removeClass("menu-open");
            $("#signinbox").hide();
        }
    });
	
	$("#fadeouta").click(function(e) {          
        e.preventDefault();
		$('#signinbox').fadeOut(250);
    });
	
	/* Contact Box Script Starts */	
	$("#contact").click(function(e) {          
		e.preventDefault();
		//$('#contactbox').toggle();
		$('#contactbox').animate({height: 'show', opacity: '0', filter: 'alpha(opacity=0)'}, {duration: 0}).animate({opacity: '.5', filter: 'alpha(opacity=50)', top: 58}, {duration: 300, easing: 'easeInBack'}).animate({opacity: '1', filter: 'alpha(opacity=100)', top: 24}, {duration: 200, easing: 'easeOutBack'});
	});
	
	 $("#fadeout").click(function(e) {          
        e.preventDefault();
		$('#contactbox').fadeOut(250);
    });
	$("#contactbox").mouseup(function() {
		return false
	});
	
    $(document).mouseup(function(e) {
        if($(e.target).parent("a.contact").length==0) {
            $("#contactbox").hide();
        }
    });

    /* Quick Search Box Script Starts */
    $("#searchico").click(function(e) {
        e.preventDefault();
        //$("#quicksearchbox").toggle();
		$("#quicksearchbox").animate({height: 'show', opacity: '0', filter: 'alpha(opacity=0)'}, {duration: 0}).animate({opacity: '.5', filter: 'alpha(opacity=50)', top: 70}, {duration: 300, easing: 'easeInBack'}).animate({opacity: '1', filter: 'alpha(opacity=100)', top: 41}, {duration: 200, easing: 'easeOutBack'});
    });
	
	$('#signin_menu2 input[type="text"]').focus( function(){
		//alert('inside');
		$(this).animate({width: '260px'});
		$('#quicksearchbox').animate({width: '380px'});
		$('#signin_menu2').animate({width: '385px'});
		$('#quicksearchbox .quickSearchField').animate({width: '335px'});
	}); // searchico resize function ends 

	$('#signin_menu2 input[type="text"]').blur( function(){
		//alert('inside');
		$(this).animate({width: '120px'});
		$('#quicksearchbox').animate({width: '235px'});
		$('#signin_menu2').animate({width: '245px'});
		$('#quicksearchbox .quickSearchField').animate({width: '195px'});
	}); // searchico resize function ends 


    $(document).mouseup(function(e) {
        if($(e.target).parent("#searchico").length==0) {
            $("#quicksearchbox").hide();
        }
    });

	$("#quicksearchbox").mouseup(function() {
		return false
	});
	$("#quicksearchbox").click(function() {
		return false
	});
	$("#signin_submit2").click(function() {
		$('#find_products').submit();
	});

    $(document).bind('keydown', function(e) {
      if (e.keyCode == 27) {
		  $("#contactbox").hide();
		  $("#quicksearchbox").hide();
		  $("#signinbox").hide();
		  $(".dropdownlist").hide();
	  }
    })
	
    $(document).mouseup(function(e) {
            $(".dropdownlist").hide();
    });
	
    
    $('.blood_scale_0ne').each(function(){
        var perc = $('.percentage_div', this).html();
        $('.left', this).css('width',perc);
    });
    
    /* Calculate Target Values */
    if($('#targetperc').length>0){
        var div_height = 115;
        var targetperc = $('#targetperc').html();
        targetperc = targetperc.replace('%', '');
        var margin = div_height - parseInt((div_height*parseInt(targetperc)/100));
        $('.progess_main_div').css('margin-top',margin+'px');
    }
        
    
    /* Fancy Drop Downs*/
    //$("#select-iam").add($("#paperOrientation")).fancyDropdown();

    $("#select-iam").fancyDropdown();
    $("#select-helpme").fancyDropdown();
    $('.dropbox').fancyDropdown();
	
    
    /* Dictirs Profile*/
    /* post expand/hide */
    $('.expandpost a').click(function(e){
        e.preventDefault();
        $(this).parents('.blogpost').find('.biodata-text-more').slideToggle(800);
        if($(this).html()=='[ + ]'){
           $(this).html('[ - ]');
        } else {
            $(this).html('[ + ]');
        }
    });
    
    if($('.gallery-pic').length>0) {
        $('.gallery-pic').hover(function(){
            var bg_type = 'image';
            var views = '';
            var duration = '';
            var append = '';
            var rating_value = '';
            if($(this).hasClass('video')) {
                duration = $(this).find('.duration').html();
                views = $(this).find('.views').html();
                bg_type = 'video';
                append = '<div class="galleryhover '+bg_type+'"><div class="text">&nbsp;</div><div class="content views-duration"><span>'+views+'</span><span class="video-duration">'+duration+'</span></div></div>';
            } else {
                rating_value = views = $(this).find('.rating').html();
                append = '<div class="galleryhover '+bg_type+'"><div class="text">&nbsp;</div></div><div class="content rating-review"><form><input name="rating" class="heart" type="radio" value="1" /><input name="rating" class="heart" type="radio" value="2" /><input name="rating" class="heart" type="radio" value="3" /><input name="rating" class="heart" type="radio" value="4" checked="checked" /><input name="rating" class="heart" type="radio" value="5" /></form></div>';
//                $('input.heart', this).rating('select',rating_value);
//                $('input.heart', this).rating('readOnly',true);
                
            }
            if($('.galleryhover', this).length==0) {
                $('.snapshot', this).append(append);
            }
            $('input.heart').rating();
            //$('input.heart', this).rating('select',rating_value);
            $('input.heart', this).rating('readOnly',true);
            $('.galleryhover, .content', this).fadeIn(200);
        },function(){
            $('.galleryhover, .content', this).fadeOut(500, function(){$(this).remove();});
        });
    }
    
    $(".scroll-pane").scrollbar();
    $(".ui-slider-handle").append('<span class="rightarrow">&nbsp;</span>');
        
	/* Gallery Page 
	///////////////////////////////// */
	$('.pic_details, .pic_stats').hide();
    /* Gallery hover images */
    if($('.gallery-pic').length>0){
        $('.gallery-pic').hover(function(){
           //$('.categorypics', this).show();
        },function(){
           //$('.categorypics', this).hide();
        });
    }
	
	/* Listing Page Script */
	$('.expand').click(function(){
		var parent = $(this).parents('.block');
		//alert($(this).text());
		
		if($(this).text() == 'collapse information')
			{
				
				$(this).fadeOut(0).text('read more').fadeIn(1000);
			}
		else if ($(this).text() == 'read more')
		{
			$(this).fadeOut(0).text('collapse information').fadeIn(1000);
		}
		else {
			$(this).text('');
		}
		
		
		$('.biodata-text-more', parent).slideToggle('slow');
		return false;
	}); // Expand Function for More Details on Listing Page ends
	

	/* Image Gallery Page Script 
	////////////////////////////////*/
	
	
	$('ul.gallery .image').hover(function() {
		$('.pic_info', this).fadeIn(250);
		}, function() {
			$('.pic_info', this).fadeOut(250);
	});// Image Hover Function ends on Gallery Page


	$('.list').click(function() {
		$('ul.gallery').addClass('list_style').fadeOut(0).fadeIn(750);
		return false
	});// Image Gallery List View Function ends on Gallery Page

	$('.grid').click(function() {
		$('ul.gallery').removeClass('list_style').fadeOut(0).fadeIn(750);
		return false
	});// Image Gallery Grid View Function ends on Gallery Page


	$("#tabpanel").tabs();


	$('#tc_panel .tc_edit').click( function(){
		$('#tc_panel .tc_edit').animate({left: '-41px'}, 800);
		$('#tc_panel .cp_cont_solid').animate({left: '10px'}, 960);
		$('#tc_panel #cp_content').animate({left: '0px'}, 1000);
	}); /* Theme Control Panel funtion */

	$('#tc_panel .cp_cont_solid a').click( function(){
		$('#tc_panel .cp_cont_solid').animate({left: '-306px'}, 1090);
		$('#tc_panel #cp_content').animate({left: '-306px'}, 1000);
		$('#tc_panel .tc_edit').animate({left: '0px'}, 800);
		return false;
	}); /* Theme Control Panel funtion */
	

	/* Conttrol Panel Accordian Script */
//	$('.heading').click(function(){
//		var parent = $(this).parents('.accordian');
//		$('.cp_contnt', parent).slideToggle(300);
//	}); // Expand Function for More Details on Listing Page ends
	
	
	

/* Home Page Mobile version Menu Script iphone fix*/

	var is_clicked = false;
	$('.main-menu a').click(function(e){
		is_clicked = true;
		var child = $('ul:first', $(this).parent());
		if(child.length)
		{
			if($('#main-container').width() < 750)
			{
                if($(this).parents('div.main-menu li').length < 2) e.preventDefault();
                else window.location = $(this).attr('href');
			}
			else e.preventDefault();
   			$(child).toggle();
		}
	});
	
	$('.main-menu').click(function(e){
	
		if(is_clicked == false)
		{
			e.preventDefault();
			$('ul:first', this).toggle();
		}else is_clicked = false;
	});    

	/* Tabs to accordion*/
	$('#tabMenu > li[id^="tab_"]').click(function(){
		//search for the content
		if($('#main-container').width() <= 600)
		{
			$('#temp_id').remove(); //Remove existing info
			//if($('#temp_id', $(this).parent()).length) return; //Close if it's already opened
			var id = $(this).attr('href');
			var content = '<div id="temp_id" class="tab-contents" style="background-image:; background-position:97% 50%">'+$(id).html()+'</div>';
			$(this).parent().append(content); 
			$('#temp_id').css('display','block');
		}
	});
	
	$(window).resize(function(){
		if($('#main-container').width() <= 600)
			$('.tab-contents').css('display','none');
		else
		{
			$('#temp_id').remove(); //Remove existing info
			$('.tab-contents').css('display','block');
		}
	});


	/* Typography page block1 script 
	///////////////////////////////////// */
	$('.blocking .block1:odd').css('margin-right','0px');
	$(window).trigger('resize');







  //Get all the LI from the #tabMenu UL
  $('#tabMenu li').click(function(){
    
    //perform the actions when it's not selected
    if (!$(this).hasClass('selected')) {    
           
	    //remove the selected class from all LI    
	    $('#tabMenu li').removeClass('selected');
	    
	    //Reassign the LI
	    $(this).addClass('selected');
	    
	    //Hide all the DIV in .boxBody
	    $('.boxBody div.parent').slideUp(0);
	    
	    //Look for the right DIV in boxBody according to the Navigation UL index, therefore, the arrangement is very important.
	    $('.boxBody div.parent:eq(' + $('#tabMenu > li').index(this) + ')').slideDown(0);
	    
	 }
    
  }).mouseover(function() {

    //Add and remove class, Personally I dont think this is the right way to do it, anyone please suggest    
    $(this).addClass('mouseover');
    $(this).removeClass('mouseout');   
    
  }).mouseout(function() {
    
    //Add and remove class
    $(this).addClass('mouseout');
    $(this).removeClass('mouseover');    
    
  });
  
	$('.image').hover ( function()
	{  
		$('.image_hover', this).stop().animate({bottom:'0%'}, 'fast');
	}, function() 
	{
		$('.image_hover', this).stop().animate({bottom: '-100%'}, 'fast');
	});


	if(screen_type == 'pc')
	{
		$('.dpt').hover ( function()
			{	
				$('.dpt_info',this).stop().animate({bottom: '0px'},{queue:false, duration:'fast', easing:'linear'});
		
			}, function()
			{
				$('.dpt_info',this).stop().animate({bottom: '-65px'},{queue:false, duration:'fast', easing:'linear'});
			});
	}
	else if(screen_type == 'tablet')
	{
		$('.dpt').hover ( function()
			{	
				$('.dpt_info',this).stop().animate({bottom: '0px'},{queue:false, duration:'fast', easing:'linear'});
		
			}, function()
			{
				$('.dpt_info',this).stop().animate({bottom: '-45px'},{queue:false, duration:'fast', easing:'linear'});
			});
	}
	else if(screen_type == 'iphone')
	{
		$('.dpt').click ( function()
			{	
				if ( $('.dpt_info',this).css('bottom') == "-65px"){
				$('.dpt_info',this).stop().animate({bottom: '0px'},{queue:false, duration:'fast', easing:'linear'});
				}
				else
				{
					$('.dpt_info',this).stop().animate({bottom: '-65px'},{queue:false, duration:'fast', easing:'linear'});
				}
			});
	}
	
	
	
}); /* Main Document Function ends */