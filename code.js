1.lấy value radio checked
  var selValue = $('input[name=insurrance]:checked').val(); 

  /*  [ Back To Top ]
  - - - - - - - - - - - - - - - - - - - - */
  $('.backtotop').on( 'click' , function(){ 
    $("html, body").animate({ scrollTop: 0 }, 600); 
    return false; 
  });
  /*  [ Go to Comments ]
  - - - - - - - - - - - - - - - - - - - - */
  $('.reply-comment').on('click' , function(e) {
    e.preventDefault();
    $('html, body').animate({
      scrollTop: $(".leave-a-comment").offset().top - 120
    }, 1000);
  });
    /* [ Menu Mobile ]
    --------------------------------------*/
    $('.menu-mobile').on( 'click' , function(){
      $(this).toggleClass('open');
      $( '.main-menu' ).slideToggle();
    });

    
location.reload();  //reload
window.location = document.referrer; // back page url


//Scroll when I click
 $('.menu-main li a').on( 'click', function(){
            $('.menu-main li a').not(this).parent().removeClass('active');
            $(this).parent().addClass('active');
            var targetSec = $(this).attr('href');
            $('html, body').animate({
                scrollTop: $(targetSec).offset().top
            }, 1000);
        });
Click to div
$( '.backtotop' ).on( 'click' , function( e ) {
            e.preventDefault();
            $('html,body').animate({
                scrollTop: 0
            }, 1000);
        } );

Fixed header when I scroll
$(window).on( 'scroll', function() {
            if ($(window).scrollTop() >= 350) {
                $('.site-header').addClass('fixed');
            } else {
                $('.site-header').removeClass('fixed');
            }
        });




$(function() {
var header = $('header');
var menu = $('#menu');
var hieghtThreshold = $(".content").offset().top;
var hieghtThreshold_end  = $(".content").offset().top +$(".content").height() ;
$(window).scroll(function() {
    var scroll = $(window).scrollTop();
if (scroll >= hieghtThreshold && scroll <=  hieghtThreshold_end ) {
        header.addClass('dark');
        menu.addClass('dark');
    } else {
        header.removeClass('dark');
        menu.removeClass('dark');
    }
});


var header = $('header');
var menu = $('#menu');
$(window).scroll(function() {
    var scroll = $('.element').offset().top; // look at this
if (scroll >= 500) {
        header.addClass('dark');
        menu.addClass('dark');
    } else {
        header.removeClass('dark');
        menu.removeClass('dark');
    }
});





  var object = $('.sticky-fixed');
  var hieghtThreshold = $(".sticky-fixed").offset().top;
  var hieghtThreshold_end  = $(".sticky-fixed").offset().top +$(".sticky-fixed").height() ;
  $(window).scroll(function() {
    var scroll = $(window).scrollTop();
    if (scroll >= hieghtThreshold && scroll <=  hieghtThreshold_end ) {
      object.addClass('position-sticky position-top');
    } else {
      object.removeClass('position-sticky position-top');
    }
  });


    /*  [ Change Quantity ]
    - - - - - - - - - - - - - - - - - - - - */
    $( '.quantity .icon-action' ).on( 'click' , function () {
      var input = $( this ).parents( '.quantity' ).find( '.qty' );
      var count = input.val();
      var action = $( this ).attr( 'data-action' );
      if( action == 'plus' ) {
        count++;
        input.val( count );
      } else {
        count--;
        if( count >= 1 ) {
          input.val( count );
        }
        return false;
      }
    } );
