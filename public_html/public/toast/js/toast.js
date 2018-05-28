 $(document).ready(function () {
     "use strict";
     // toat popup js
	if (t_title && t_text && t_icon){
     $.toast({
         heading: t_title,
         text: t_text,
         position: 'top-center',
         loaderBg: '#fff',
         icon: t_icon,
         hideAfter: 3500,
         stack: 6
     })
	}
 });

 