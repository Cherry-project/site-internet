<?php 
session_start();
?>
<!doctype html>
<html>
    
    <head>
        <title>Calendar</title>
        
        <?php
        $root = '../';
        include $root.'head.php';
        include $root.'includes.php';
        require_once('date.php');
        ?>
        
        <link href= "<?php echo $root."css/style_calendar.css" ?>" rel="stylesheet" type="text/css">
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> 
        <script type='text/javascript'>
            jQuery(function($) {
                $('.month').hide();
                $('.month:first').show();
                $('.months a:first').addClass('active');
                var current = 1;
                $('.months a').click(function() {
                    var month = $(this).attr('id').replace('linkMonth', '');
                    if (month !== current) {
                        $('#month'+current).slideUp();
                        $('#month'+month).slideDown();
                        $('months a').removeClass('active');
                        $('.months a#linkMonth'+month).addClass('active');
                        current = month;
                    }
                    return false;
                });
            });
        </script>
    </head>

    <body>

        <?php include $root.'nav.php' ?>
        
        <?php
        
        $date = new Date();
        $year = date('Y');
        
        $dates = $date->getAll($year);
        
        ?>
    
        <div class ='periods'>
            <div class='year'><?php echo $year; ?></div>
            <div class ='months'>
                <ul>
                    <?php foreach ($date->months as $id=>$m): ?>
                    <li> <a href='#' id='linkMonth<?php echo $id+1; ?>'><?php echo utf8_encode(substr(utf8_decode($m), 0, 3)); ?></a> </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="clear"></div>
            <?php $dates = $dates[$year] ?>
            <?php foreach ($dates as $m=>$days): ?>
                <div class='month relative' id='month<?php echo $m; ?>'>
                    <table>
                        <thead>
                            <tr>
                                <?php foreach ($date->days as $day): ?>
                                    <th>
                                        <?php echo substr($day, 0, 3); ?>
                                    </th>
                                <?php endforeach; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php $end = end($days); foreach ($days as $d=>$w): ?>
                                    <?php if ($d == 1 && $w != 1): ?>
                                        <td colspan="<?php echo $w-1 ?>"></td>
                                    <?php endif; ?>
                                    
                                    <td>
                                        <div class="relative">
                                            <div class="day">
                                                <?php echo $d; ?>
                                            </div>
                                        </div>
                                        <ul class="events">
                                            <li></li>
                                        </ul>
                                    </td>
                                    
                                    <?php if ($w == 7): ?>
                                        </tr><tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                            
                                <?php if ($end != 7): ?>
                                    <td colspan="<?php echo 7-$end ?>"></td>
                                <?php endif; ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
            <?php endforeach; ?>
        </div>
        
        
        <pre><?php print_r($dates) ?></pre>
        
        
    </body>
        
    <?php include $root.'footer.php' ?>
    
</html>
