/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var ATTR = {
   'scolled': 0
};

function displayEventList( list, length ) {
    var wrapper = $('#events');
    if ( ! wrapper.size() || ! list || ! list.length ) { return; }
    
    var option = getURLoption(), output = [], i = 0;
    if ( ! length ) { length = 2; }

    if ( length > list.length ) { length = list.length; }
    for ( i; i<length; i++ ) {
       output.push( list[i] );
    }   
    
    wrapper.html( output.join('') );
    if ( (i+1) < list.length ) {
       $('<a role="button" class="eventlist-expander btn btn-primary" href="#">Vis mer</a>')
        .appendTo( wrapper ).on('click', function(e) {
           e.preventDefault();
           displayEventList( list, (length+2));
        });
    }
}

function displayEventLightboxMap( e, id ) {
   if ( e ) { e.preventDefault(); }
   
   var section = $(e.target).closest('.arrangement-section');
    if ( ! section || ! section.size() ) { return; }
   
   var cloned = section.find('.location-map').clone().removeAttr('id');
   showLightbox( '<div class="map-view">'+cloned.get(0).outerHTML+'</div>');   
}

function getLightbox() {
   var box = $('#lightbox');
   if ( ! box.size() ) {
       box = $(
        '<div id="lightbox">'+
            '<div id="box-wrapper">'+
                '<div id="box-cnt"></div>'+
                '<a id="box-closer" href="#">Lukk dialog boksen</a>' +
            '</div>'+
        '</div>'
       ).appendTo('body');
       
       $('#box-closer').on('click', function(e){
           e.preventDefault();
           hideLightbox();
       });
   }
   return box;
}

function showLightbox( content ) {
   var box = getLightbox();
   if( content ) {      
      var cnt = $('#box-cnt').html( content );
   }
   ATTR.scrolled = getBodyScrollTop();
   $('body').addClass('show-lightbox');
   scrollBodyTop(0);
}

function hideLightbox() {
    $('body').removeClass('show-lightbox');
    scrollBodyTop( ATTR.scrolled || 0 );
}


function addFilter(e) {
   console.log('== ADD FILTER ===');
   var list = [$('#tag-filter-option'),$('#date-filter-option'), $('#price-filter-option')];
   var out = [];
   for ( var i =0; i<list.length; i++ ) {
      
       if ( ! list[i].size() ) { next; }
       var name = list[i].attr('name'), value = list[i].val();
       if ( ! name || ! value ) { continue; }
       
       out.push(name + '=' + value);
   }

   var href = window.location.href.replace( /\?.*/i, '');
   var url = href  + ( out.length ? ('?' + out.join('&')) : '');   
   window.location.href = url;
}

function initFilter() {
    var option = getURLoption();
    for ( var key in option ) {
        var slc = $('#'+key+'-filter-option');
        if ( ! slc.size() ) { continue; }
        slc.val( option[key] );
    }
}

/******************************************************************************/
function getURLoption(){
  var opt = {}, url = window.location.href;
  var matched = url.replace(/#+/g, '#').match(/^([\w\.\-\s_%\/:]+)#(.*)/)
    || url.replace(/\?+/g, '?').match(/^([\w\.\-\s_#%\/:]+)\?(.*)/);

  if (matched) {
    var splited = (decodeURIComponent(matched[2]) || '')
      .replace(/#\?/g, '&').split('&');
    for (var i = 0; i < splited.length; i++) {
      var m = splited[i].match(/(\w+)=(.*)/);
      if (m) { opt[m[1]] = m[2].replace(/#$/, ''); }
    }
  }
  return opt;
};

function getBodyScrollTop() {
    return document.body.scrollTop || document.documentElement.scrollTop || 0;
}

function scrollBodyTop( where ) {
    document.body.scrollTop = document.documentElement.scrollTop = 
            where && (! isNaN(where) ) && where > 0 ? where : 0;
}