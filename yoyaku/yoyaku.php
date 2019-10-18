<?php
    session_start();

    $day = $_GET['day'];
    $month = $_GET['month'];
    $year = $_GET['year'];


    $aaa = $year."-".$month."-".$day;
    $aaa  = preg_replace("/( |　)/", "", $aaa );
    $date_check = date('Y/m/d',strtotime($aaa));

    $timetable = ['13:00','13:30','14:00','14:30'];
    $the_number_of_timetable = count($timetable);

     // [0]-id  [1],[2],[3],[4]-number
    $number_data=file("csv/timetable_and_number.csv");
    $number_kensu=count($number_data);
    for($i=0; $i<$number_kensu; $i++){
        $number_data[$i] = rtrim($number_data[$i]);
        $number_data[$i] = explode(",",$number_data[$i]);
    }

    
    for($i=0; $i<$number_kensu; $i++){
        if($date_check == $number_data[$i][0]){
            $date_soezi = $i;
            break;
        }
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
                    <?php echo $year; ?>年<?php echo $month; ?>月<?php echo $day ;?>日
                </div>
                <br>
                <br>

                <?php for($i=0; $i<$the_number_of_timetable; $i++): ?>
                    <form action="yoyaku_kakunin.php" method="POST">

                        <div class="timetable_frame">
                            <div class="time_head">
                                <?php echo $timetable[$i]; ?>
                                <input type="hidden" name="time" value="<?php echo $timetable[$i]; ?>">
                                <input type="hidden" name="date" value="<?php echo $date_check; ?>">
                            </div>
                            <div class="time_detail">
                                <div class="nokori_ninzu">
                                    ○
                                </div>
                                <div class="yoyaku_ninzu">
                                    <select name="ninzu" id="ninzu">
                                        <?php for($t=0; $t<$number_data[$date_soezi][$i+1]; $t++): ?>
                                            <option value="<?php echo $t + 1; ?>"><?php echo $t + 1;?></option>
                                        <?php endfor; ?>
                                    </select>人
                                </div>
                                <div class="yoyaku_button">
                                    <input type="submit" class="btn btn-primary" value="予約する">
                                </div>
                            </div><!--time_detail-->
                        </div><!--/timetable_frame-->
                            
                    </form>
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