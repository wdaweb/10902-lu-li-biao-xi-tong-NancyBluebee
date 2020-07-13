<!DOCTYPE html>
<html lang="zh-tw">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>註冊畫面</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/main.css" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif, "微軟正黑體";
            margin: 0px;
            padding: 0px;
        }

        .flex {
            display: inline-flex;
            height: 60px;
            width: 100%;
            background-color: #0d1217;
        }

        .flex li {
            display: inline-flex;
            font-size: 1.2em;
            float: center;
            padding: 4px;
        }

        a {
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .reg {
            height: 100vh;
        }

        .card {
            width: 45em;
            box-sizing: border-box;
        }

        .home-btn {
            position: relative;
            right: 0;
        }

        fieldset {
            margin: 20px;
            border: 0;
            padding: 50px;
            margin-bottom: 10px;
            background: #EEE;
            border-radius: 8px;
            -moz-border-radius: 8px;
            -webkit-border-radius: 8px;
            background: -webkit-liner-gradient(top, #EEEEEE, #FFFFFF);
            background: linear-gradient(top, #EFEFEF, #FFFFFF);
            box-shadow: 3px 3px 10px #666;
            -moz-box-shadow: 3px 3px 10px #666;
            -webkit-box-shadow: 3px 3px 10px #666;
            position: relative;
        }
        legend {
            margin: 1px;
            width: 50%;
            padding: 3px 8px;
            background-color: maroon;
            color: #FFF;
            border-radius: 3px;
            -moz-border-radius: 3px;
            -webkit-border-radius: 3px;
            box-shadow: 2px 2px 4px #666;
            -moz-box-shadow: 2px 2px 4px #666;
            -webkit-box-shadow: 2px 2px 4px #666;
            position: absolute;
            left: 10px;
            top: -11px;
        }
    </style>
</head>

<body class="bg-light">
    <div class="flex">
        <?php include "./include/header2.php"; ?>
    </div>
    <form action="./api/add_user.php" id="reg" method="post">

        <!-- 註冊表單內容 -->
        <div class="reg d-flex align-items-center justify-content-center">
        <fieldset>
                <legend style="font-size:16px;">使用者基本資料（*號必填）：</legend>
            <div class="card">
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            
                                <label for="inputAcct">帳號 <small class="text-danger">*</small></label>
                                <input type="text" name="acct" id="inputAcct" aria-describedby="acctHelp" class="form-control" placeholder="請輸入英文或數學字元，20個字元內">
                                <small id="acctHelp" class="form-text text-primary">帳號設定即無法修改！</small>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword">密碼 <small class="text-danger">*</small></label>
                            <input type="password" name="psw" id="inputPassword" class="form-control" placeholder="請輸入英文或數學字元，20個字元內">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputName">姓名 <small class="text-danger">*</small></label>
                            <input type="text" name="name" id="inputName" class="form-control" placeholder="請輸入姓名">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputGender">性別</label>
                            <input type="text" name="gender" id="inputGender" class="form-control" placeholder="請輸入「男性」、「女性」或其他敘述">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputBtd">生日</label>
                            <input type="date" name="btd" id="inputBtd" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail">電子郵件<small class="text-danger">*</small></label>
                            <input type="email" name="email" id="inputEmail" class="form-control" placeholder="請輸入電郵，例如「xxx@xxmail.com」">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="phone">行動電話</label>
                            <input type="text" name="tel_cell" id="tel_cell" class="form-control" placeholder="請以連字號分隔，例如「0900-111-222」">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputHome">家中電話</label>
                            <input type="text" name="tel_home" id="inputHome" class="form-control" placeholder="請以連字號分隔，例如「(02)9999-1122」">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAddress">居住地區</label>
                        <input type="text" name="addr" id="inputAddress" class="form-control" placeholder="請輸入居住地區，例如「臺北」">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">註冊</button>
                        <button type="reset" class="btn btn-primary ml-3">清除</button>
                        <a href="./index.php" class="btn btn-outline-primary float-right">回首頁</a>
                       
                    </div>
                </div>
            </div>
            </fieldset>
        </div>

    </form>

    <script src="./js/jquery-3.4.1.min.js"></script>
    <script src="./js/jquery.validate.js"></script>
    <script>

    </script>
</body>

</html>