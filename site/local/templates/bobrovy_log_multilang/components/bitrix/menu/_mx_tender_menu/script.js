$(document).ready(function(){
	$('arrow.menu_closed').on('click', function(e){
		e.stopPropagation();
		$(this).parent().removeClass('closed').addClass('opened');
		
	})

	$('arrow.menu_opened').on('click', function(e){
		e.stopPropagation();
		$(this).parent().removeClass('opened').addClass('closed');
		
	})

});


/*
var jshover = function()
{
	var menuDiv = document.getElementById("horizontal-multilevel-menu")
	if (!menuDiv)
		return;

	var sfEls = menuDiv.getElementsByTagName("li");
	for (var i=0; i<sfEls.length; i++) 
	{
		sfEls[i].click=function()
		{
			this.className+=" jshover";
		}
		sfEls[i].onmouseout=function() 
		{
			this.className=this.className.replace(new RegExp(" jshover\\b"), "");
		}
	}
}

if (window.attachEvent) 
	window.attachEvent("onload", jshover);
*/