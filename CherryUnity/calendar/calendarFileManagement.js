$(document).ready(function() {
   

$("#addFilesButton").click(function(){
    $("input:checked").each(function(){
        var fileName = $(this).val();
        var childEmail = $('.email').attr('email');
        var dateFin = $('.datepicker').val();
        
       alert(fileName+ childEmail+dateFin); 
    });
     $(".ajout").html('Ajout effectué!');
});


$( 'body' ).on( "click",'button.btn-danger', function(){
    console.log($(this).parent().attr('file')+' '+$('.email').attr('email'));
     $(this).closest('.fileRow').detach();
    
    }); 


            }); 




$("td").click(function(){
  var $files = $(this).find("ul.events")
          .children("li");
  
  var contentHtml = "";
  $files.each(function(){
      var file = $(this).html().trim();
      contentHtml += '<div class="fileRow row"> <div class="col-md-2"> file</div><div file="'+file+'" class="col-md-offset-6 col-md-2">  <button class="btn btn-danger"> <span class="glyphicon glyphicon-remove"></span> </button></div></div>';
      //console.log(contentHtml);
      //contentHtml += '<p file='+file+'>'+file +'<button class="btn btn-danger"> <span class="glyphicon glyphicon-remove"></span> </button>'+'</p>';
      // contentHtml += '<p file='+file+'>'+file +'<button class="btn btn-danger"> <span class="glyphicon glyphicon-remove"></span> </button>'+'</p>';
      //alert($(this).html());
      
  })
   
   $(".containerFiles").hide().html(contentHtml).fadeIn(2000);
    $(".filesToAdd").fadeIn(2000);  
    
});

