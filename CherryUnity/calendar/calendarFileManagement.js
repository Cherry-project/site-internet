$(document).ready(function() {
   

$("#addFilesButton").click(function(){
    $("input:checked").each(function(){
        var fileName = $(this).val();
        var childEmail = $('.email').attr('email');
        var dateEnd = $(this).closest('.newFileRow').find('.datepicker').val();
        var dateStart;
          alert(fileName+ childEmail+dateEnd);
         /*$.ajax({
       method: "POST",
       url: "../ajaxHandler/updateFilesHandler.php",
       data: { file: $(this).parent().attr('file'), 
           childEmail: childEmail, 
           adultEmail:$('.adultEmail').attr('email'),
           type:$('.adultEmail').attr('type'),
           dateEnd: dateEnd,         
           dateStart: dateStart
        }
})
  .done(function(){
       alert(fileName+ childEmail+dateEnd);
  }); */
    });
    
    
    
    
    
    
     $(".ajout").html('Ajout effectué!');
});


$( 'body' ).on( "click",'button.btn-danger', function(){
    console.log($(this).parent().attr('file')+' '+$('.email').attr('email')+$('.adultEmail').attr('email')+$('.adultEmail').attr('type'));
       $button = $(this);
         function handler(msg){
              alert(msg);
    $button.closest('.fileRow').detach();
         }
    
    $.ajax({
       method: "POST",
       url: "../ajaxHandler/updateFilesHandler.php",
       data: { file: $(this).parent().attr('file'), 
           childEmail: $('.email').attr('email'), 
           adultEmail:$('.adultEmail').attr('email'),
           type:$('.adultEmail').attr('type') }
})

  .done(handler);
    
    
    }); 


            }); 




$("td").click(function(){
  var $files = $(this).find("ul.events")
          .children("li");
  
  var contentHtml = "";
  $files.each(function(){
      var file = $(this).html().trim();
      contentHtml += '<div class="fileRow row"> <div class="col-md-2">'+file+'</div><div file="'+file+'" class="col-md-offset-6 col-md-2">  <button class="btn btn-danger"> <span class="glyphicon glyphicon-remove"></span> </button></div></div>';
      //console.log(contentHtml);
      //contentHtml += '<p file='+file+'>'+file +'<button class="btn btn-danger"> <span class="glyphicon glyphicon-remove"></span> </button>'+'</p>';
      // contentHtml += '<p file='+file+'>'+file +'<button class="btn btn-danger"> <span class="glyphicon glyphicon-remove"></span> </button>'+'</p>';
      //alert($(this).html());
      
  })
   
   $(".containerFiles").hide().html(contentHtml).fadeIn(2000);
    $(".filesToAdd").fadeIn(2000);  
    
});

