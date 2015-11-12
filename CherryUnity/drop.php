<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Drag n drop </title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

  </head>
  <body>

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
	    <input type="file" name="files[]" multiple="multiple">


	  </form>

          <div id="drag">
            
          </div>
	  <div>
<br/>
	    <button id="submit" class="btn btn-default">Submit</button>
	  </div>
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
    <script>
      $( document ).ready(function() {
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
					     // uploadFormData.append("files[]",file); 
					     alert(uploadFormData.file); 
					     }

					     }); 
					     $("#submit").click(function(){

					     uploadFormData.append("text","hello"); 
					     $.ajax({
					     type: 'POST',
					     url: 'handlers/fileHandler.php',
					     processData: false,
					     contentType: false,
					     data: uploadFormData,
					     success: function (data) {
					     alert(data)
					     },
					     });

					     });			 





					     });


					     
					     
					     </script>

  </body>
</html>





