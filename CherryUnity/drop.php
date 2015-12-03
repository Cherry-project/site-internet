<?php 
session_start();
?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Drag n drop </title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    
    <?php 
    include 'includes.php'; 
    ?>
  </head>
  <body>
      
      <a href="./adultShowContents.php">Liste des fichiers</a>
      
      <?php
      $email = $_SESSION['email'];
      //$email = 'nicolas@enseirb.fr';
      $childDao = new ChildDAO(DynamoDbClientBuilder::get());
      $children = $childDao->getChildren($email);
      ?>
      

    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Projet Cherry</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="#">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Contact</a></li>
            
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="#">Log in
		<span class="glyphicon glyphicon-log-in"></span></a></li>
            
            <li ><a href="Authentication.html">Sign up <span class="glyphicon glyphicon-user"></a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div><!--/.container-fluid -->
    </nav>


    <div class="container">
      <div class="row">
        <div class="col-md-3">
          Faites glisser les documents à ajouter
	  <form enctype="multipart/form-data" id="yourregularuploadformId" method="post" action="handlers/fileHandler.php">
	    <input type="file" name="files[]" multiple="multiple" class="hidden">


	  </form>

          <div id="drag">
              <ul> </ul>
          </div>
	  <div>
<br/>
	    <button id="submit" class="btn btn-default">Submit</button>
	  </div>
        </div>
     
    <div class="col-md-offset-3 col-md-3">
        Enfants <br/>
        <?php
        foreach($children as $child){
        echo ' <p> <input type="checkbox" name="child" value="' . $child->getEmail() .  '">'. 
                $child->getFirstname()  . 'Date: <input type="text" class="datepicker"> </p>' ;
        }
        ?>
    </div>
          
    </div>
      
    </div>
  


    <footer class="footer">
      <div class="container-fluid">
	<img  height="60px" src="img/logo.jpg"/> 
      </div>
    </footer>





    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>  
    <script src="js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script>
      $( document ).ready(function() {
      $(".datepicker" ).datepicker();
  });    
      var uploadFormData = new FormData($("#yourregularuploadformId")[0]); 
      var dropper = document.querySelector('#drag');

      $("#drag").on('dragover',function(e){
      e.preventDefault();
      })
      .on('drop',function(e){
      e.preventDefault();
      var files = e.originalEvent.dataTransfer.files,
      filesLen = files.length,
      filenames = "";
      var file = files[0];
      for(var i = 0 ; i < filesLen ; i++) {
			  filenames += '\n' + files[i].name;
			  }

			  
			  // alert(uploadFormData);
			  //uploadFormData.append("text","hello");  
			  for(var f = 0; f < files.length; f++) { 		 
					     uploadFormData.append("files[]",files[f]);
                                              $("#drag ul").append("<li>"+files[f].name+"</li>"); 
					   
					     
					     }

					     }); 
					     $("#submit").click(function(){
                                               $("input:checked").each(function() {
  						  uploadFormData.append("children[]",[$(this).val(),$(this).next(".datepicker").val()]); 
					     $.ajax({
					     type: 'POST',
					     url: 'handlers/fileHandler.php',
					     processData: false,
					     contentType: false,
					     data: uploadFormData,
					     success: filesUpdated,
                                             error: function (exception) {
                                                alert("Exception : " + JSON.stringify(exception));
                                             }
					     });

					     });			 





					     });

function filesUpdated(){
    $("#drag ul").empty();
     $("#drag ul").after("<p>Les fichiers ont correctement été ajoutés</p>");
}
					     
					     
					     </script>

  </body>
</html>





