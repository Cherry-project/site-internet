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
                        $('.months a').removeClass('active');
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
        
        $doy = new DaysOfYear();
        $year = date('Y');
        $calendar = $doy->getAll($year);
        
        $access_rights = Rights::$NONE;
        
        $child_email = $_GET['email'];
        $adult_email = $_SESSION['email'];
        if (!empty($child_email) && !empty($adult_email)) {
            $childDao = new ChildDAO(DynamoDbClientBuilder::get());
            $child = $childDao->get($child_email);
            $usrDao = new UserDAO(DynamoDbClientBuilder::get());
            $user = $usrDao->get($adult_email);
            if ($child->isFather($user->getEmail())) {
                $access_rights = Rights::$FULL_ACCESS;  // pour l'instant en dur, plus tard dans la base
            }
        }
        ?>
    
        <div class ='periods'>
            <div class='year'><?php echo $year; ?></div>
            <div class ='months'>
                <ul>
                    <!-- print all months, three letters per month -->
                    <?php foreach ($doy->months as $id=>$m): ?>
                    <li> <a href='#' id='linkMonth<?php echo $id+1; ?>'><?php echo utf8_encode(substr(utf8_decode($m), 0, 3)); ?></a> </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="clear"></div>
            <?php $dates = $calendar[$year] ?>
            <!-- Do that for each month -->
            <?php foreach ($dates as $m=>$days): ?>
                <div class='month relative' id='month<?php echo $m; ?>'>
                    <table>
                        <thead>
                            <tr>
                                <!-- print all days of a week (monday, tuesday..) -->
                                <?php foreach ($doy->days as $day): ?>
                                    <th>
                                        <?php echo substr($day, 0, 3); ?>
                                    </th>
                                <?php endforeach; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <!-- Do that for each day of a month -->
                                <?php $end = end($days); foreach ($days as $d=>$w): ?>
                                    <?php if ($d == 1 && $w != 1): ?>
                                        <td colspan="<?php echo $w-1 ?>" class="padding"></td>
                                    <?php endif; ?>
                                    
                                    <td>
                                        <div class="relative">
                                            <div class="day">
                                                <?php echo $d; ?>
                                            </div>
                                        </div>
                                        <div class="daytitle">
                                            <?php echo $doy->days[$w-1].' '.$d.' '.$doy->months[$m-1]; ?>
                                        </div>
                                        
                                        
                                        <?php
                                        $date_obj = new Date($year, $m, $d);
                                        $in = $date_obj->toString("in");
                                        if ($access_rights == Rights::$LIMITED_ACCESS) {
                                            $my_contents = $child->getContentsByStartingDate($in, $user->getType());
                                        } else if ($access_rights == Rights::$FULL_ACCESS) {
                                            $medical = $child->getContentsByStartingDate($in, "doctor");
                                            $teaching = $child->getContentsByStartingDate($in, "teacher");
                                            $family = $child->getContentsByStartingDate($in, "family");
                                        }
                                        ?>
                                        
                                        
                                        <?php if ($access_rights == Rights::$LIMITED_ACCESS): ?>
                                        <ul class="events_bullets">
                                            <?php foreach ($my_contents as $content): ?>
                                            <li></li>
                                            <?php endforeach; ?>
                                        </ul>
                                        <ul class="events">
                                            <?php foreach ($my_contents as $content): ?>
                                            <li> <?php echo $content['M']['name']['S'] ?> </li>
                                            <?php endforeach; ?>
                                        </ul>
                                        <?php endif; ?>
                                        
                                         <?php if ($access_rights == Rights::$FULL_ACCESS): ?>
                                        <ul class="events_bullets">
                                            <?php foreach ($medical as $content): ?>
                                            <li class="item_medical"></li>
                                            <?php endforeach; ?>
                                            
                                            <?php foreach ($family as $content): ?>
                                            <li class="item_family"></li>
                                            <?php endforeach; ?>
                                            
                                            <?php foreach ($teaching as $content): ?>
                                            <li class="item_teaching"></li>
                                            <?php endforeach; ?>
                                        </ul>
                                        <ul class="events">
                                            <?php foreach ($medical as $content): ?>
                                            <li class="item_medical"> <?php echo $content['M']['name']['S'] ?> </li>
                                            <?php endforeach; ?>
                                            
                                            <?php foreach ($family as $content): ?>
                                            <li class="item_family"> <?php echo $content['M']['name']['S'] ?> </li>
                                            <?php endforeach; ?>
                                            
                                            <?php foreach ($teaching as $content): ?>
                                            <li class="item_teaching"> <?php echo $content['M']['name']['S'] ?> </li>
                                            <?php endforeach; ?>
                                        </ul>
                                        <?php endif; ?>
                                        
                                        
                                        
                                    </td>
                                        
                                    <?php if ($w == 7): ?>
                                        </tr><tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                            
                                <?php if ($end != 7): ?>
                                            <td colspan="<?php echo 7-$end ?>" class="padding"></td>
                                <?php endif; ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
            <?php endforeach; ?>
        </div>
        
        <!--
        <pre><?php print_r($dates) ?></pre>
        -->
        
    </body>
        
    <?php include $root.'footer.php' ?>
    
</html>
