$(function(){
/*
 * formats links from artist tags appropriately so they go to artist nodes, rather than taxonomy term pages
 */
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

});