
/**
 * NetteForms - simple form validation.
 *
 * This file is part of the Nette Framework.
 * Copyright (c) 2004, 2012 David Grudl (http://davidgrudl.com)
 */

var Nette = Nette || {};

/**
 * Attaches a handler to an event for the element.
 */
Nette.addEvent = function(element, on, callback) {
	var original = element['on' + on];
	element['on' + on] = function() {
		if (typeof original === 'function' && original.apply(element, arguments) === false) {
			return false;
		}
		return callback.apply(element, arguments);
	};
};


/**
 * Returns the value of form element.
 */
Nette.getValue = function(elem) {
	var i, len;
	if (!elem) {
		return null;

	} else if (!elem.nodeName) { // radio
		for (i = 0, len = elem.length; i < len; i++) {
			if (elem[i].checked) {
				return elem[i].value;
			}
		}
		return null;

	} else if (elem.nodeName.toLowerCase() === 'select') {
		var index = elem.selectedIndex, options = elem.options;

		if (index < 0) {
			return null;

		} else if (elem.type === 'select-one') {
			return options[index].value;
		}

		for (i = 0, values = [], len = options.length; i < len; i++) {
			if (options[i].selected) {
				values.push(options[i].value);
			}
		}
		return values;

	} else if (elem.type === 'checkbox') {
		return elem.checked;

	} else if (elem.type === 'radio') {
		return Nette.getValue(elem.form.elements[elem.name].nodeName ? [elem] : elem.form.elements[elem.name]);

	} else {
		return elem.value.replace(/^\s+|\s+$/g, '');
	}
};


/**
 * Validates form element against given rules.
 */
Nette.validateControl = function(elem, rules, onlyCheck) {
	rules = rules || eval('[' + (elem.getAttribute('data-nette-rules') || '') + ']');
	for (var id = 0, len = rules.length; id < len; id++) {
		var rule = rules[id], op = rule.op.match(/(~)?([^?]+)/);
		rule.neg = op[1];
		rule.op = op[2];
		rule.condition = !!rule.rules;
		var el = rule.control ? elem.form.elements[rule.control] : elem;

		var success = Nette.validateRule(el, rule.op, rule.arg);
		if (success === null) { continue; }
		if (rule.neg) { success = !success; }

		if (rule.condition && success) {
			if (!Nette.validateControl(elem, rule.rules, onlyCheck)) {
				return false;
			}
		} else if (!rule.condition && !success) {
			if (el.disabled) { continue; }
			if (!onlyCheck) {
				Nette.addError(el, rule.msg.replace('%value', Nette.getValue(el)));
			}
			return false;
		}
	}
	return true;
};


/**
 * Validates whole form.
 */
Nette.validateForm = function(sender) {
	var form = sender.form || sender;
	if (form['nette-submittedBy'] && form['nette-submittedBy'].getAttribute('formnovalidate') !== null) {
		return true;
	}
	for (var i = 0; i < form.elements.length; i++) {
		var elem = form.elements[i];
		if (!(elem.nodeName.toLowerCase() in {input: 1, select: 1, textarea: 1}) ||
			(elem.type in {hidden: 1, submit: 1, image: 1, reset: 1}) ||
			elem.disabled || elem.readonly
		) {
			continue;
		}
		if (!Nette.validateControl(elem)) {
			return false;
		}
	}
	return true;
};


/**
 * Display error message.
 */
Nette.addError = function(elem, message) {
	if (elem.focus) {
		elem.focus();
	}
	if (message) {
		alert(message);
	}
};


/**
 * Validates single rule.
 */
Nette.validateRule = function(elem, op, arg) {
	var val = Nette.getValue(elem);

	if (elem.getAttribute) {
		if (val === elem.getAttribute('data-nette-empty-value')) { val = ''; }
	}

	if (op.charAt(0) === ':') {
		op = op.substr(1);
	}
	op = op.replace('::', '_');
	op = op.replace(/\\/g, '');

	return Nette.validators[op] ? Nette.validators[op](elem, arg, val) : null;
};


Nette.validators = {
	filled: function(elem, arg, val) {
		return val !== '' && val !== false && val !== null;
	},

	valid: function(elem, arg, val) {
		return Nette.validateControl(elem, null, true);
	},

	equal: function(elem, arg, val) {
		if (arg === undefined) {
			return null;
		}
		arg = Nette.isArray(arg) ? arg : [arg];
		for (var i = 0, len = arg.length; i < len; i++) {
			if (val == (arg[i].control ? Nette.getValue(elem.form.elements[arg[i].control]) : arg[i])) {
				return true;
			}
		}
		return false;
	},

	minLength: function(elem, arg, val) {
		return val.length >= arg;
	},

	maxLength: function(elem, arg, val) {
		return val.length <= arg;
	},

	length: function(elem, arg, val) {
		arg = Nette.isArray(arg) ? arg : [arg, arg];
		return (arg[0] === null || val.length >= arg[0]) && (arg[1] === null || val.length <= arg[1]);
	},

	email: function(elem, arg, val) {
		return (/^("([ !\x23-\x5B\x5D-\x7E]*|\\[ -~])+"|[-a-z0-9!#$%&'*+/=?^_`{|}~]+(\.[-a-z0-9!#$%&'*+/=?^_`{|}~]+)*)@([0-9a-z\u00C0-\u02FF\u0370-\u1EFF]([-0-9a-z\u00C0-\u02FF\u0370-\u1EFF]{0,61}[0-9a-z\u00C0-\u02FF\u0370-\u1EFF])?\.)+[a-z\u00C0-\u02FF\u0370-\u1EFF][-0-9a-z\u00C0-\u02FF\u0370-\u1EFF]{0,17}[a-z\u00C0-\u02FF\u0370-\u1EFF]$/i).test(val);
	},

	url: function(elem, arg, val) {
		return (/^(https?:\/\/|(?=.*\.))([0-9a-z\u00C0-\u02FF\u0370-\u1EFF](([-0-9a-z\u00C0-\u02FF\u0370-\u1EFF]{0,61}[0-9a-z\u00C0-\u02FF\u0370-\u1EFF])?\.)*[a-z\u00C0-\u02FF\u0370-\u1EFF][-0-9a-z\u00C0-\u02FF\u0370-\u1EFF]{0,17}[a-z\u00C0-\u02FF\u0370-\u1EFF]|\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3})(:\d{1,5})?(\/\S*)?$/i).test(val);
	},

	regexp: function(elem, arg, val) {
		var parts = typeof arg === 'string' ? arg.match(/^\/(.*)\/([imu]*)$/) : false;
		if (parts) { try {
			return (new RegExp(parts[1], parts[2].replace('u', ''))).test(val);
		} catch (e) {} }
	},

	pattern: function(elem, arg, val) {
		try {
			return typeof arg === 'string' ? (new RegExp('^(' + arg + ')$')).test(val) : null;
		} catch (e) {}
	},

	integer: function(elem, arg, val) {
		return (/^-?[0-9]+$/).test(val);
	},

	'float': function(elem, arg, val) {
		return (/^-?[0-9]*[.,]?[0-9]+$/).test(val);
	},

	range: function(elem, arg, val) {
		return Nette.isArray(arg) ?
			((arg[0] === null || parseFloat(val) >= arg[0]) && (arg[1] === null || parseFloat(val) <= arg[1])) : null;
	},

	submitted: function(elem, arg, val) {
		return elem.form['nette-submittedBy'] === elem;
	}
};


/**
 * Process all toggles in form.
 */
Nette.toggleForm = function(form) {
	for (var i = 0; i < form.elements.length; i++) {
		if (form.elements[i].nodeName.toLowerCase() in {input: 1, select: 1, textarea: 1, button: 1}) {
			Nette.toggleControl(form.elements[i]);
		}
	}
};


/**
 * Process toggles on form element.
 */
Nette.toggleControl = function(elem, rules, firsttime) {
	rules = rules || eval('[' + (elem.getAttribute('data-nette-rules') || '') + ']');
	var has = false, __hasProp = Object.prototype.hasOwnProperty, handler = function() { Nette.toggleForm(elem.form); };

	for (var id = 0, len = rules.length; id < len; id++) {
		var rule = rules[id], op = rule.op.match(/(~)?([^?]+)/);
		rule.neg = op[1];
		rule.op = op[2];
		rule.condition = !!rule.rules;
		if (!rule.condition) { continue; }

		var el = rule.control ? elem.form.elements[rule.control] : elem;
		var success = Nette.validateRule(el, rule.op, rule.arg);
		if (success === null) { continue; }
		if (rule.neg) { success = !success; }

		if (Nette.toggleControl(elem, rule.rules, firsttime) || rule.toggle) {
			has = true;
			if (firsttime) {
				if (!el.nodeName) { // radio
					for (var i = 0; i < el.length; i++) {
						Nette.addEvent(el[i], 'click', handler);
					}
				} else if (el.nodeName.toLowerCase() === 'select') {
					Nette.addEvent(el, 'change', handler);
				} else {
					Nette.addEvent(el, 'click', handler);
				}
			}
			for (var id2 in rule.toggle || []) {
				if (__hasProp.call(rule.toggle, id2)) { Nette.toggle(id2, success ? rule.toggle[id2] : !rule.toggle[id2]); }
			}
		}
	}
	return has;
};


/**
 * Displays or hides HTML element.
 */
Nette.toggle = function(id, visible) {
	var elem = document.getElementById(id);
	if (elem) {
		elem.style.display = visible ? '' : 'none';
	}
};


/**
 * Setup handlers.
 */
Nette.initForm = function(form) {
	form.noValidate = 'novalidate';

	Nette.addEvent(form, 'submit', function() {
		return Nette.validateForm(form);
	});

	Nette.addEvent(form, 'click', function(e) {
		e = e || event;
		var target = e.target || e.srcElement;
		form['nette-submittedBy'] = (target.type in {submit: 1, image: 1}) ? target : null;
	});

	for (var i = 0; i < form.elements.length; i++) {
		Nette.toggleControl(form.elements[i], null, true);
	}

	if (/MSIE/.exec(navigator.userAgent)) {
		var labels = {},
			wheelHandler = function() { return false; },
			clickHandler = function() { document.getElementById(this.htmlFor).focus(); return false; };

		for (i = 0, elms = form.getElementsByTagName('label'); i < elms.length; i++) {
			labels[elms[i].htmlFor] = elms[i];
		}

		for (i = 0, elms = form.getElementsByTagName('select'); i < elms.length; i++) {
			Nette.addEvent(elms[i], 'mousewheel', wheelHandler); // prevents accidental change in IE
			if (labels[elms[i].htmlId]) {
				Nette.addEvent(labels[elms[i].htmlId], 'click', clickHandler); // prevents deselect in IE 5 - 6
			}
		}
	}
};


/**
 * Determines whether the argument is an array.
 */
Nette.isArray = function(arg) {
	return Object.prototype.toString.call(arg) === '[object Array]';
};


Nette.addEvent(window, 'load', function() {
	for (var i = 0; i < document.forms.length; i++) {
		Nette.initForm(document.forms[i]);
	}
});

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