window.addEvent('domready', function(){
    //list of target elements
    var list = $$('.div');
    //list elements to be clicked on
    var headings = $$('.link');
    //array to store all of the collapsibles
    var collapsibles = new Array();
    
    var h1 = null;
    
    headings.each( function(heading, i) {
        //for each element create a slide effect
        //xd(list[i], list[i].offsetHeight);
        var c = list[i].getParent("#menu");
        if (c && c.hasClass('coupons')) return;

        var collapsible = new Fx.Slide(list[i], {
            duration: 500,
            transition: Fx.Transitions.linear
        });
          
        
        //and store it in the array
        collapsibles[i] = collapsible.show();
        
        //add event listener
        heading.onclick = function(){
          ///xd(collapsible);
          collapsible.toggle();
          if (collapsible.open) 
             this.getFirst().src= this.getAttribute('data-openimage');
            else 
             this.getFirst().src= this.getAttribute('data-closedimage');
          return false;
        }
          
        if (!h1) { 
             heading.onclick();
              collapsible.hide();
             h1 = heading;
          }
    }); 
});
