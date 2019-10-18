<?php
    session_start();

    $day = $_POST['day'];
    $month = $_POST['month'];
    $year = $_POST['year'];

    $time = $_POST['time'];

    $timetable = ['13:00','13:30','14:00','14:30'];
    $the_number_of_timetable = count($timetable);
    for($i=0;$i<$the_number_of_timetable;$i++){
        if($time == $timetable[$i]){
            $time_time = $timetable[$i];
            break;
        }
    }


    $aaa = $year."-".$month."-".$day;
    $aaa  = preg_replace("/( |　)/", "", $aaa );
    $date_check = date('Y/m/d',strtotime($aaa));


     // [0]-id  [1],[2],[3],[4]-number
    $yoyaku_data=file("../yoyaku/csv/yoyaku.csv");
    $yoyaku_kensu=count($yoyaku_data);
    for($i=0; $i<$yoyaku_kensu; $i++){
        $yoyaku_data[$i] = rtrim($yoyaku_data[$i]);
        $yoyaku_data[$i] = explode(",",$yoyaku_data[$i]);
    }
    $user_data=file("../yoyaku/csv/touroku.csv");
    $user_kensu=count($user_data);
    for($i=0; $i<$user_kensu; $i++){
        $user_data[$i] = rtrim($user_data[$i]);
        $user_data[$i] = explode(",",$user_data[$i]);
    }


?> 
<!doctype html>
<html lang="ja">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

    <link rel="stylesheet" href="style.css">
    <title>イチゴ狩り</title>
</head>
<body>



<div class="card">
    <div class="bg-color">
        <div class="about">
            <h2>イチゴ狩り予約</h2>
        </div>
        <div class="card-body">
            <h3 class="card-title text-center"></h3>
            <div class="form_line">
                
                <div class="table_head text-center">
                    <?php echo $year; ?>年<?php echo $month; ?>月<?php echo $day ;?>日<br><?php echo $time_time; ?>
                </div>
                <br>
                <br>

                <?php for($i=0; $i<$yoyaku_kensu; $i++): ?>
                <?php if($time_time == $yoyaku_data[$i][3]):?>
                    <form action="yoyaku_kakunin.php" method="POST">

                        <div class="timetable_frame">
                            <div class="time_head text-center">
                                <?php 
                                    for($t=0;$t<$user_kensu;$t++){
                                        if($yoyaku_data[$i][1] == $user_data[$t][0]){
                                            echo $user_data[$t][1];
                                            echo $user_data[$t][2];
                                            echo $user_data[$t][3];
                                        }
                                    }
                                ?>
                                <input type="hidden" name="time" value="<?php echo $yoyaku_data[$i][0]; ?>">
                            </div>
                            <div class="yoyaku_button text-center">
                                <input type="submit" class="btn btn-primary" value="削除">
                            </div>
                        </div><!--/timetable_frame-->
                            
                    </form>
                <?php endif;?>
                <?php endfor; ?>


                

            </div><!-- form_line -->
        </div> <!-- /card-body -->
    </div><!--- /bg-color-->
</div><!-- /card -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  </body>
</html>