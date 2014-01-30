// JavaScript Document
  $(document).ready(function() {


        $(".box_main").hide();
        $('#menu ul').hide();

        $('#menu li a').click(function() {

            $(this).next().slideToggle('normal');

        });

        $('#box_link').toggle(

        function() {
            $('.box_main').show( function() {
                $('.box_main').animate({
                    width: '220'
                }, 500);
            });
                $('#box_img').attr("src", "close.png");

        },

        function() {
            $('.box_main').animate({
                width: "0"
            }, 500, function() {
                $('.box_main').hide();
                $('#box_img').attr("src", "qm.png");


            });


        });




    });
