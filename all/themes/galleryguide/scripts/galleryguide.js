$(document).ready(function(){
  // formats links from artist tags appropriately so they go to artist nodes, rather than taxonomy term pages
  $('.view-artists-this a').each(function(){
    var thisLink = $(this).attr('href');
    thisLink = thisLink.toLowerCase();
    thisLink = thisLink.replace('%20','-');
    $(this).attr('href',thisLink);
  });

  $('.block-tagadelic .tagadelic, .wrapper .tagadelic').each(function(){
    var thisLink = $(this).attr('href');
    thisLink = thisLink.replace('tagsterms','tags');
    $(this).attr('href',thisLink);
  });
   
  // stop the header being the reason the wrapper is so wide
  $('.tag-items-wrapper h3').each(function(){
    var tablewidth = $(this).siblings('table').width();
    $(this).width(tablewidth - 24);
    });
    
    // make each row of tag items the same height
    $('.tag-items-wrapper').each(function(el){
      var topPos = this.offsetTop;
      var prevWrap = $(this).prev();
      if(prevWrap.length) {
        
        // are we on the same row?
        if(prevWrap[0].offsetTop == topPos) {
          if(prevWrap[0].scrollHeight > this.scrollHeight) {
            this.scrollHeight = prevWrap[0].scrollHeight;
          }
          else if(this.scrollHeight > prevWrap[0].scrollHeight) {
            prevWrap.scrollHeight = this.scrollHeight();
          }
        }
        

      }
      
      

      
    });
})