
$(window).load(function(){
    //config
    var slideHeight = 500;
    var maxHeight = 500;
    var maxWidth = 500;
    var duration = 500;
    var easing = "swing";
    
    //Deklarace
    var currentPos = 0;
    var currentShift = 0;

    //elements
    var slides = $('.slide');
    var numberOfSlides = slides.length;
    
    var controlLeft = $("#controlLeft");
    var controlRight = $("#controlRight");

    //preparation
    manageControls(currentPos);
    slides.wrapAll('<div id="slideInner" style="height: 2000px;"></div>').css("display","none");

    $('#slidesContainer').css('overflow', 'hidden');
    //dots
    createDots(numberOfSlides);
    $(".dot").click(function() {
        var id = $(this).attr("id");
        jumpToPos(id);
    });
    //first slide
    var element = $("#slidesContainer .slide:first");
    
    element.css("display","block");
    activeDot(0);
    resolveImageSize(element);
    $('#slidesContainer').css({
        width : element.width(),
        height : element.height()
    });
    
    //controls
    controlRight.click(function(){
        jumpToPos (currentPos +1);
    });
    controlLeft.click(function(){
        jumpToPos (currentPos -1);
    });
  //functions  
  function jumpToPos (pos) {
        $(".center").append(currentPos);
        var shifts;
        next = $("#slidesContainer .slide:eq("+pos+")");
        current = $("#slidesContainer .slide:eq("+currentPos+")");
           
        next.css("display","block");
        resolveImageSize(next);
        if (currentPos==pos) {
            
        } else if(currentPos < pos) {
            shifts = -current.height();
            shift(shifts, function() {
                current.css("display","none");
                $('#slideInner').css("margin-top",0);
            });
            
        } else {  
            $('#slideInner').css("margin-top", - next.height());
            shift(0, function() {
                current.css("display","none");
                $('#slideInner').css("margin-top",0);
            });            
        }
        resolveContainerSize(next, true);
        currentPos = pos;
        activeDot(pos);
        manageControls(pos);
  } 
  function shift(shift) {
      shift(shift, true);
  }
  function shift (shift, callback) {
        $('#slideInner').animate({
          'marginTop' : shift
        },duration,easing,callback);
  }
  function moveToSide(left) {
        if(left) {
            pos = currentPos - 1;
        } else {
            pos = currentPos + 1;
        }
        jumpToPos(pos);
  }
  function resolveImageSize(element) {   
        var width = element.width();
        var height = element.height();
        var ration = 1;
        if(height > maxHeight) {
            element.height(maxHeight);
            var ratio = height / maxHeight;
            element.width(Math.round(width / ratio));
        } 
        var width = element.width();
        var height = element.height();
        if (width > maxWidth) {
            element.width(maxWidth);  
            var ratio = width / maxWidth;
            element.height(Math.round(height / ratio));        
        }
  }
  function resolveContainerSize(element, animate) {
      if(animate) {
          $('#slidesContainer').animate({
            width : element.width(),
            height : element.height()
            });
           $('html, body').animate({
             scrollTop: ($("#slidesContainer").offset().top-40)
            });
        } else {
            $('#slidesContainer').css({
            "width" : element.width(),
            "height" : element.height()
            });
                    $('html, body').animate({
             scrollTop: ($("#slidesContainer").offset().top-40)
         },0);
        }

  }

  // manageControls: Hides and Shows controls depending on currentPos
  function manageControls(position){
    // Hide left arrow if position is first slide
	if(position==0){ controlLeft.hide() } else{ controlLeft.show() }
	// Hide right arrow if position is last slide
    if(position==numberOfSlides-1){ controlRight.hide() } else{ controlRight.show() }
  }	
  //createDots: creates dotes according to given number
  function createDots (count) {
      var text = "";
      for(i=0; i< count; i++) {
          text = "<a href='javascript:;' class='dot' id='"+i+"'></a>"+text;
      }
      $("#slideshow #dots").append(text);
  }
  function activeDot(id) {
      $("#slideshow #dots .dot").each(function(){
          dot = $(this);
          if(dot.attr("class") == "dot active") dot.attr("class","dot");
          if(dot.attr("id") == id) dot.attr("class","dot active");
      });
  }
});