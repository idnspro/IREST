	var tmenus = [ 2938, 3190 ];
		var tab0 = 0 || 2938;
		var adr_req = false;
		var dtype = '';
		waiter = null;
		
		window.addEvent('domready', function(){
		hidetimeout=0;
		var elem = $("sidemenu");
		if (!elem) return arguments.callee.delay(500);
		if (!Browser.Engine.trident4 && elem){
		  var cart_fx = new Fx.Tween(elem, {property:'margin-top', transition: Fx.Transitions.Quad.easeInOut, duration: 1000, link: 'cancel'});
		  var old_scroll = 0;
		  var top=0;
		  window.addEvent('scroll', function(){
			var el = $("sidemenu");
			var ws = {size: window.getSize(), scroll:window.getScroll()};
			var cart_pos = el.getPosition();
			if (!top) top= cart_pos.y;
			var cart = el.getCoordinates();
			  if (ws.size.y<cart.height){
				if (old_scroll> ws.scroll.y){ //up SCROLL
				cart_fx.start((ws.scroll.y-top+10).limit(0, 10000000));
				} else { // DOWN
				cart_fx.start(((ws.scroll.y+ws.size.y)-(top+cart.height)-10).limit(0, 10000000));
				}
			  } else {
				cart_fx.start((ws.scroll.y-top+10).limit(0, 10000000));
			  }
			old_scroll=ws.scroll.y;
		  });
		}
		
		$('sidebox').injectInside(document.body);
		$('sidebox').addEvent('mouseleave', function(e){
		$('sidebox').hide();
		});
		
		$('sidebutton').addEvent('mouseover', function(e){
		 $('sidebox').position({relativeTo: 'sidebutton', position: 'topRight', offset:{y:-2, x:-6}})
		   .setStyle('z-index', 2000).show();
		});
		
		$$('#sidebox li').addEvent('mouseover', function(e){
		 clearTimeout(hidetimeout);
		 hidetimeout = setTimeout(function(){$('sidebox').hide()}, 200000);
		})
		})
/*xd js*/
