<?php
if (empty($root)) {
    $root = './';
}
?>

<footer class="footer">
    <div class="container-fluid">
        <img  height="60px" src=<?php echo $root."img/logo.jpg" ?> /> 
    </div>
</footer>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>  
<script src=<?php echo $root."js/bootstrap.min.js"; ?>></script>
<script src ="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
<script src=<?php echo $root."js/validator.js"; ?>></script>
