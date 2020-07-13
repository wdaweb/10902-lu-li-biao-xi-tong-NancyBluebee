<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>後端登入頁</title>
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
            background-image: url("./images/logo1.jpg");
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
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

        .button {
            background-color: navy;
            /* royal blue */
            border: none;
            color: white;
            padding: 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }

        .drop-shadow {
            -webkit-filter: drop-shadow(12px 12px 7px rgba(0, 0, 0, 0.7));
            filter: drop-shadow(12px 12px 7px rgba(0, 0, 0, 0.7))
        }

        a {
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .container {
            height: 100vh;
        }

        .card {
            width: 300px;
            box-sizing: border-box;
        }
    </style>
</head>

<body>
    <div class="flex">
        <?php include "./include/header.php"; ?>
    </div>
    <!-- 吐司提示 -->
    <div class="position-absolute w-100 d-flex flex-column p-4">
        <div class="toast ml-auto" role="alert" data-delay="700" data-autohide="false">
            <div class="toast-header">
                <strong class="mr-auto text-primary">歡迎使用線上履歷登入系統</strong>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="toast-body">這是線上履歷系統，請在下方登入或註冊！</div>
        </div>
    </div>

    <!-- 登入區域 -->
    <form action="./api/login.php" method="post">
        <div class="container d-flex align-items-center">
            <div class="row justify-content-center">
                <div class="col-12 mb-5">
                    <img src="./images/per.jpg" class="img-fluid" alt="banner">
                </div>
                <div class="col-12">
                    <div class="card mx-auto">
                        <div class="card-body text-center">
                            <br>
                            <p>帳號：<input type="text" name="acct" id="acct"></p>
                            <p>密碼：<input type="password" name="psw" id="psw"></p>
                            <input type="submit" value="登入">
                            <input type="reset" value="清除">
                            <br>
                            <br>
                            <a href="./register.php">註冊</a>
                            <!-- <a href="#">忘記密碼</a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
        $(function() {
            $('.toast').toast('show')
        })
    </script>
</body>

</html>