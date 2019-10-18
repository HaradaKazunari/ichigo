<?php
    session_start();

    $time = $_POST['time'];
    $date = $_POST['date'];
    $ninzu = $_POST['ninzu'];

    $touroku=file("csv/touroku.csv");
    $touroku_kensu=count($touroku);
    for($i=0; $i<$touroku_kensu; $i++){
        $tourokus[$i] = rtrim($touroku[$i]);
        $tourokus[$i] = explode(",",$touroku[$i]);
    }

    for($i=1; $i<$touroku_kensu; $i++){
        if($_SESSION['ichigo_gari_user_id'] == $tourokus[$i][0]){
            $name = $tourokus[$i][1];
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
                    予約完了
                </div>
                <br>
                <br>
                <div class="card_text text-center">
                    <p>
                        日時<br>
                        <?php echo $date;?><br>
                        <?php echo $time;?>~ 30分間
                    </p>
                    <p>
                        <?php echo $name;?>様<br>
                        <?php echo $ninzu; ?>名
                    </p>
                    
                </div><!--/card-text-->
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