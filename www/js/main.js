//autoFadeForm
jQuery.fn.extend({
    autoFadeForm : function( opacityOut, opacityIn, speed)
    {
	var element = this;
	var focus = 0;
	var mouseOn = 0;

	this.find("input").focusout(function() {
	    focus = false;
	    if(!mouseOn) {
		element.fadeTo(speed, opacityOut);
	    }
	}).focus(function() {focus = true;});

	this.mouseenter(function() {     
	    mouseOn = 1;
	    if(!focus) {
		element.stop();element.fadeTo(speed, opacityIn);
	    }
	}).mouseleave(function() {
	    mouseOn = false;
	    if(!focus) {
		element.stop();
		element.fadeTo(speed, opacityOut);   
	    }   
	});
    }
});

//timepicker 
focusedInp = null;
$(function(){


});
jQuery.fn.extend({
    timepicker: function(){
	$("body").append( '<div id="timepicker-box" class="rounded shadow"></div>');
	for(var h=0; h < 24; h++) {
	    for(var m=0; m < 60; m=m+30) {
	       var disH = h < 10 ? "0"+h : h;
	       var disM = m < 10 ? "0"+m : m;
	       $("#timepicker-box").append("<div class='time'><a href='#'>"+ disH +":"+ disM  +"</div></div>");
	    }
	}  
	
	elm = this;
	focusedInp = null;
	inFocus = false;
	this.focus(function(){
	    focusedInp = this; inFocus = true;
	    var pos = $(this).offset();
	    var height = $(this).outerHeight();
		$("#timepicker-box").css({
		"display" : "block",
		"top" : pos.top + height,
		"left" : pos.left
	    });
	});
	$("#timepicker-box .time a").mousedown(function(el) {
	    el.preventDefault();
	    var value = $(this).text();
	    $(focusedInp).val(value);
	    if( inFocus ) setTimeout( function(){ focusedInp.focus(); }, 100 );
	});
	 this.focusout(function (){
		$("#timepicker-box").css("display","none");
	 });
    }
});

$(function(){
    //<!-- Datepicker jquery -->
    $.datepicker.regional['cs'] = { 
		    closeText: 'Zavřít', 
		    prevText: 'Předchozí', 
		    nextText: 'Další', 
		    currentText: 'Hoy', 
		    monthNames: ['Leden','Únor','Březen','Duben','Květen','Červen', 'Červenec','Srpen','Září','Říjen','Listopad','Prosinec'],
		    monthNamesShort: ['Le','Ún','Bř','Du','Kv','Čn', 'Čc','Sr','Zá','Ří','Li','Pr'], 
		    dayNames: ['Neděle','Pondělí','Úterý','Středa','Čtvrtek','Pátek','Sobota'], 
		    dayNamesShort: ['Ne','Po','Út','St','Čt','Pá','So',], 
		    dayNamesMin: ['Ne','Po','Út','St','Čt','Pá','So'], 
		    weekHeader: 'Sm', 
		    dateFormat: 'dd.mm.yy', 
		    firstDay: 1, 
		    isRTL: false, 
		    showMonthAfterYear: false, 
		    yearSuffix: ''}; 

    $.datepicker.regional['sk'] = {
		    closeText: 'Zavrieť',
		    prevText: '<Predchádzajúci',
		    nextText: 'Nasledujúci>',
		    currentText: 'Dnes',
		    monthNames: ['Január','Február','Marec','Apríl','Máj','Jún',
		    'Júl','August','September','Október','November','December'],
		    monthNamesShort: ['Jan','Feb','Mar','Apr','Máj','Jún',
		    'Júl','Aug','Sep','Okt','Nov','Dec'],
		    dayNames: ['Nedel\'a','Pondelok','Utorok','Streda','Štvrtok','Piatok','Sobota'],
		    dayNamesShort: ['Ned','Pon','Uto','Str','Štv','Pia','Sob'],
		    dayNamesMin: ['Ne','Po','Ut','St','Št','Pia','So'],
		    weekHeader: 'Ty',
		    dateFormat: 'dd.mm.yy',
		    firstDay: 0,             
		    isRTL: false,
		    showMonthAfterYear: false,
		    yearSuffix: ''};

    $.datepicker.setDefaults($.datepicker.regional['cs']);

    $(".datepicker").datepicker();
    $(".timepicker").timepicker();
    
    $("#topStripe").attr("class","transparent").autoFadeForm(0.4, 0.85, "slow");

    $("#searchBox").autoFadeForm(0.5, 0.92, "slow");

});
