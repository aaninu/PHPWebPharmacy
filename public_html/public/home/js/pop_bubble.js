$(document).ready(function(){
//1.Find the Left spacing of the element
var parent = $('#more-galleries');
var child = $('.galleries li');

//a.Find the parent left space
//b.Find the child container left space
//c.var padding = Parent left – child left;
var padding = $(':eq(0)',child).offset().left - $(parent).offset().left;
var popup = $('#popup');

$(child).mouseover(function(){
    if(screen_type != 'pc') return;
	
	//1. Check and get if we've subcategories information    
    var subcategories = $('.categorypics', this);
    if( ! subcategories.length) return;
    
    //2. replace the popup html
    $(popup).html('<div class="categorypics" style="display:block">'+$(subcategories).html()+'<span class="poparr"></span></div>');
    
    //3. Move the box
        //Get the width of data box
        //Get the width of element
        //Get the Left space of Element
        //Get the Half Width of databox
    
    var subcat = $('.categorypics', popup);
    var subcat_width = $(subcat).width();
    var subcat_half = subcat_width / 2;
    var el_width = $(this).width();
    var el_left = $(this).offset().left;
    var el_start = (el_left - $(parent).offset().left) - padding;
    //If the half width of databox is lesser than the left space of element than move the box according to the left side space + 2 px spacing else: use the half width    
    if(subcat_half > el_start)
    {   
        if(el_start < 0)
        {
            el_width = el_start + el_width;
            if(el_width < 20) $('.poparr', popup).css('margin-left', '0px');
            el_start = 0;
        }
        
        $(popup).css('left', el_start);
        $('.poparr', popup).css('left', el_width / 2);
    }else if((el_start + subcat_width) > $(parent).width())
    {
        var position = ((el_start + el_width) - (subcat_width)) - padding - 5;
        
        if(el_start + el_width > $(parent).width())
        {
            position = position - ((el_start + el_width) - $(parent).width());
            var width = (el_start + el_width) - $(parent).width() - padding;
            el_width = el_width - width;
            $('.poparr', popup).css('margin-left', '-16px');
        }
        //console.log(position);
        $(popup).css('left', position);
        $('.poparr', popup).css('left', (el_start + (el_width / 2)) - position);
    }else
    {
        $(popup).css('left', (el_start - subcat_half) + (el_width / 2) - padding);
    }
}).mouseout(function(){
	
    $(popup).html('');
});



});