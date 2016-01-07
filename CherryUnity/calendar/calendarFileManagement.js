$(document).ready(function() {
   
 /* function notify() {
  alert( "clicked" );
}*/
$( 'body' ).on( "click",'button', function(){
    console.log($(this).parent().attr('file')+' '+$('.email').attr('email'));
    
    }); 


            }); 




$("td").click(function(){
  var $files = $(this).find("ul.events")
          .children("li");
  
  var contentHtml = "";
  $files.each(function(){
      var file = $(this).html().trim();
      contentHtml += '<p file='+file+'>'+file +'<button class="btn btn-danger"> <span class="glyphicon glyphicon-remove"></span> </button>'+'</p>';
      //alert($(this).html());
      
  })
   
   $(".containerFiles").hide().html(contentHtml).fadeIn(2000);
    $(".filesToAdd").fadeIn(2000);  
    
});

