<?php
    session_start();

    // ランダムに文字列生成
    function random($length = 8){
        return base_convert(mt_rand(pow(36, $length - 1), pow(36, $length) - 1), 10, 36);
    }


    $page_flag = 0; // 入力画面
    $errorMessage = "";
    $email_check = 0;
    $email_used_check = 0;
    $pass_len = 8;

       // 登録情報読み込み
    $touroku=file("csv/touroku.csv");
    $touroku_kensu=count($touroku);
    for($i=0; $i<$touroku_kensu; $i++){
        $tourokus[$i] = rtrim($touroku[$i]);
        $tourokus[$i] = explode(",",$touroku[$i]);
    }

    if(isset($_POST['sgin_up'])){

        for($i=0;$i<$touroku_kensu;$i++){
            if($tourokus[$i][4] == $_POST['email']){
                $email_used_check = 1;
            }
        }

        // エラー表示
        if(empty($_POST['name']) or empty($_POST['address']) or empty($_POST['tel']) or empty($_POST['email'])){
            $errorMessage = "空欄があります";
        }elseif($_POST['email'] != $_POST['email_check']){
            $errorMessage = "メールアドレスが一致しません";
            $email_check = 1;
        }elseif (!preg_match('/^[0-9a-z_.\/?-]+@([0-9a-z-]+\.)+[0-9a-z-]+$/', $_POST['email'])) {
            $errorMessage = 'メールアドレスは正しい形式で入力してください';
        }elseif (!preg_match('/^[0-9a-z_.\/?-]+@([0-9a-z-]+\.)+[0-9a-z-]+$/', $_POST['email_check'])) {
            $errorMessage = 'メールアドレスは正しい形式で入力してください';
        }elseif (strpos($_POST['tel'],'-') !== false) {
            $errorMessage = '電話番号にハイフン(-)が含まれています。';
        }elseif($email_used_check == 1){
            $errorMessage = 'このメールアドレスは既に使用されています。';
        }else{
            $name = $_POST['name'];
            $address = $_POST['address'];
            $tel = $_POST['tel'];
            $email = $_POST['email'];

            // メール送信
            $from = 'From: s217ck20h@std.mii.kurume-u.ac.jp';
            $passward = random($pass_len);
            $mail_body = "登録完了しました。以下のURLからログインしてください。パスワードは".$passward."です。 ";
            mb_language("Japanese");
            mb_internal_encoding("UTF-8");
            mail($address,"イチゴ狩り予約","予約しました。".$passward,$from);

            // toroku.csvのデータ数取得、書き込み
            $touroku_data=file("csv/touroku.csv");
            $touroku_kensu=count($touroku_data);
            $fp = fopen('csv/touroku.csv','a');
            fputs($fp,$touroku_kensu.",".$name.",".$address.",".$tel.",".$email.",".$passward."\n");
            fclose($fp);

            $page_flag = 1; //入力完了画面
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
            <h3 class="card-title text-center">アカウント作成 </h3>
            <div class="form_line">
                <!-- 入力画面 -->
                <?php if ($page_flag === 0) : ?>
                    <form action="" method="POST">
                        氏名：<input type="text" name="name" <?php if(!empty($_POST['name'])) echo'value="'.$_POST['name'].'"';?> ><br>
                        住所：<input type="text" name="address" <?php if(!empty($_POST['address'])) echo'value="'.$_POST['address'].'"';?> ><br>
                        電話番号：<input type="tel" name="tel" <?php if(!empty($_POST['tel'])) echo'value="'.$_POST['tel'].'"';?> ><br>
                        <div class="errorMessage text-center">
                            <p>
                                ハイフン(-)なしの<span class="hidden"><br></span>入力をお願いします。
                            </p>
                        </div>
                        メールアドレス：<input oncopy="return false" onpaste="return false" oncontextmenu="return false" type="text" name="email" <?php if(!empty($_POST['email']) && $email_check == 0) echo'value="'.$_POST['email'].'"';?> ><br>
                        メールアドレス 確認：<input oncopy="return false" onpaste="return false" oncontextmenu="return false" type="text" name="email_check" <?php if(!empty($_POST['email_check']) && $email_check == 0) echo'value="'.$_POST['email_check'].'"';?>  >
                        <div class="errorMessage text-center">
                            <?php
                                echo $errorMessage;
                            ?>
                        </div>
                        <div class="btn_window text-center">
                            <input type="submit" class="btn btn-primary" value="アカウント作成" name="sgin_up">
                        </div>
                    </form>
                <!-- 完了画面 -->
                <?php elseif ($page_flag === 1) :?>
                    <p class="text-center">
                        アカウントを作成しました。<br>
                        パスワードは自動で設定されます。<br>
                        メールをご確認ください。<br>
                        この画面は閉じて閉じていただいて構いません。
                    </p>

                    <div class="bg-img" style="background-image:url('img/gbjpg.jpg')"></div>
                    <div class="bg-img" style="display:hidden"></div>


                <?php endif;?>
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