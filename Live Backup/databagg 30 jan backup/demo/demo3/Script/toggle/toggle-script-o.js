// JavaScript Document

$(document).ready(function() {


  $('#slidemarginleft button').click(function() {


    var $marginLefty = $(this).next();


    $marginLefty.animate({

 
      marginLeft: parseInt($marginLefty.css('marginLeft'),10) == 0 ? 


        $marginLefty.outerWidth() :
		0


    });


  });


});

