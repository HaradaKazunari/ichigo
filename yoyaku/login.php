<?php
session_start();
$errorMessage = "";
$email_check = 0;
$pass_check = 0;

if(isset($_POST['sgin-in'])){
    $touroku=file("csv/touroku.csv");
    $touroku_kensu=count($touroku);
    for($i=0; $i<$touroku_kensu; $i++){
        $tourokus[$i] = rtrim($touroku[$i]);
        $tourokus[$i] = explode(",",$touroku[$i]);
    }
    // パスワードとメアドが同じならページ変遷
    for($i=1; $i<$touroku_kensu; $i++){
        if($_POST['email'] == $tourokus[$i][4] ){
            $email = $tourokus[$i][4];
            if(($_POST['pass']."\n") == $tourokus[$i][5]){
                $_SESSION['ichigo_gari_user_id'] = $tourokus[$i][0];
                print("ログイン");
                header("Location: calender.php");
                break;
            }
            $errorMessage = "パスワードが一致しません。";
            $pass_check = 1;
            break; 
        }
        if($pass_check != 1){
            $errorMessage = "メールアドレスが一致しません。";
            $email_check = 1;
        }
        
    }
    // エラー表示
    if(empty($_POST['email']) or empty($_POST['pass'])){
        $errorMessage = "空欄があります";
    }elseif (!preg_match('/^[0-9a-z_.\/?-]+@([0-9a-z-]+\.)+[0-9a-z-]+$/', $_POST['email'])) {
        $errorMessage = 'メールアドレスは正しい形式で入力してください';
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
            <h3 class="card-title text-center">ログイン </h3>
            <div class="form_line">

                    <form action="login.php" method="POST">
                        メールアドレス：<input type="text" name="email" <?php if(!empty($_POST['email']) && $email_check == 0) echo'value="'.$_POST['email'].'"';?> ><br>
                        パスワード：<input type="text" name="pass" <?php if(!empty($_POST['pass']) && $pass_check == 0)   echo'value="'.$_POST['pass'].'"';?> >
                        <div class="errorMessage text-center">
                            <?php
                                echo $errorMessage;
                            ?>
                        </div>
                        <div class="btn_window text-center">
                            <input type="submit" class="btn btn-primary" value="ログイン" name="sgin-in">
                        </div>
                    </form>
                
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