<?php
include_once "./api/db_info.php";

// 取單筆資料
function search($table,...$arg){
    global $pdo;
    $sql="SELECT * FROM $table WHERE ";
    if(is_array($arg[0])){
      foreach($arg[0] as $key => $value){
        $tmp[]=sprintf("`%s`='%s'",$key,$value);
      }
      $sql=$sql . implode(" && ",$tmp);
    }else{
      $sql=$sql . " `id`='".$arg[0]."'";
    }
    //echo $sql;
    return $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
}
// 取全部資料
function searchAll($table,...$arg){
    global $pdo;
    $sql="SELECT * FROM $table";
      if(!empty($arg[0])){
        foreach($arg[0] as $key => $value){
          $tmp[]=sprintf("`%s`='%s'",$key,$value);
        }
        $sql=$sql . " WHERE " . implode(" && ",$tmp);
      }    
      if(!empty($arg[1])){
        $sql=$sql . $arg[1];
      }
    //echo $sql;
    return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="zh-tw">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>求職條件</title>
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

        .button {
            background-color: royalblue;
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

        .table-reqs tr th {
            width: 80%;
        }

        a {
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="flex">
        <?php include "./include/header.php"; ?>
    </div>
    <div class="page-wrap">

        <!-- Nav -->
        <nav id="nav">
            <ul>
                <li><a href="index.php"><span class="icon fa-home"></span></a></li>
                <li><a href="gallery.php"><span class="icon fa-camera-retro"></span></a></li>
                <li><a href="generic.php" class="active"><span class="icon fa-file-text-o"></span></a></li>
            </ul>
        </nav>

        <!-- Main -->
        <section id="main">

            <!-- Header -->
            <header id="header">
                <div>DESIGN <span>by BLUEBEE</span></div>
            </header>

            <!-- Section -->
            <section>
                <div class="inner">
                    <header>
                        <h1>求職條件</h1>
                    </header>
                    <div class="container-fluid">

                        <?php
                        // 找出使用者帳號
                        $data = search("user", $_SESSION['id']);
                        $acct = $data['acct'];
                        // 撈出求職條件
                        $reqs = searchAll("reqs", ["acct" => "$acct", "see" => "1"]);
                        foreach ($reqs as $value) {
                        ?>
                            <!-- 求職條件 -->
                            <div class="reqs row justify-content-center">
                                <div class="col-12 col-sm-10 col-md-12 col-lg-8">
                                    <div class="card border-secondary">
                                        <div class="card-header text-white bg-secondary">
                                            求職條件
                                        </div>
                                        <div class="card-body">
                                            <table class="table-reqs table table-borderless table-sm">
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">期望職務</th>
                                                        <td><?= $value['reqs_posit']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">工作描述</th>
                                                        <td><?= $value['reqs_jd']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">可上班時間</th>
                                                        <td><?= $value['reqs_time']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">期望工作地點</th>
                                                        <td><?= $value['reqs_place']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">期望工作性質</th>
                                                        <td><?= $value['reqs_type']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">期望薪資</th>
                                                        <td><?= $value['reqs_pay']; ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- 分隔線 -->
                            <div class="reqs row justify-content-center">
                                <div class="col-12 col-sm-10 col-md-12 col-lg-8">
                                    <hr>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
            </section>

            <!-- Contact -->
            <section id="contact">
                <!-- Social -->
                <div class="social column">
                    <div class="drop-shadow">
                        <h3 id="bluebee">Blubee 陳璵皙</h3>
                    </div>
                    <!-- 插入自傳 -->
                    <p>一位從小喜歡看各式各樣書籍、對自己不設框架的資深編輯人員！在國家教育研究院工作14.7年，熟悉學術期刊出版、學者專業領域、歷史沿革與各項細節。數位時代，稱職的編輯更要大量閱讀本科內外的書籍，時刻訓練自己的邏輯思考。面對未來出版數位化，編輯要有敏銳的網路與電子知識，以應付未來電子書、有聲書的發展。</p>
                    <p>2020年，很幸運有機會全心全力到泰山職訓中心增權賦能半年，學習專業網頁設計相關技術，正準備報考網頁設計乙級證照。目前正加強PHP撰寫網站能力＋MySQL建立資料庫，同時了解HTML、CSS、jquery相關語法，做出讓使用者驚喜的畫面；希望能結合傳統與科技，。</p>
                    <!-- 求職條件 -->
                    <div class="drop-shadow">
                        <h3 id="degree">學歷</h3>
                    </div>
                    <ul>
                        <li>興國高級中學 畢業年份：1992年</li>
                        <li>中正大學企業管理學系 畢業年份：1997年</li>
                        <li>長榮大學經營管理學系 畢業年份：2004年</li>
                    </ul>
                    <div class="drop-shadow">
                        <h3 id="experience">經歷</h3>
                    </div>
                    <ul>
                        <li>國立故宮博物院研究助理 　時間：2004年3月至2005年5月</li>
                        <li>國家教育研究院《教育研究與發展期刊》專任編輯 　時間：2005年6月至2019年12月</li>
                    </ul>
                    <div class="drop-shadow">
                        <h3>Follow Me</h3>
                    </div>
                    <ul class="icons">
                        <li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
                        <li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
                        <li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
                    </ul>
                </div>

                <!-- Form -->

                <div class="column">
                    <div class="drop-shadow">
                        <h3 id="license">專業證照：</h3>
                    </div>
                    <ul>
                        <li>電腦軟體應用丙級技術士 取得年份：1997年</li>
                        <li>網頁設計丙級技技術士　　取得年份：2020年</li>
                    </ul>
                    <div class="drop-shadow">
                        <h3 id="skill">技能</h3>
                    </div>
                    <p>llustrator、photoshop、PHP網頁資料庫、專案管理、Bootstrap 4、CSS+ Flexbox、JavaScript / ES6 / jQuery</p>
                    <div class="drop-shadow">
                        <h3>和我聯繫</h3>
                    </div>
                    <input name="name" id="name" type="text" placeholder="Name">

                    <form action="#" method="post">
                        <div class="field half first">
                            <label for="name">姓名</label>
                            <input name="name" id="name" type="text" placeholder="Name">
                        </div>
                        <div class="field half">
                            <label for="email">電子郵件</label>
                            <input name="email" id="email" type="email" placeholder="Email">
                        </div>
                        <div class="field">
                            <label for="message">留言訊息</label>
                            <textarea name="message" id="message" rows="6" placeholder="Message"></textarea>
                        </div>
                        <ul class="actions">
                            <li><input value="Send Message" class="button" type="submit"></li>
                        </ul>
                    </form>
                </div>

            </section>

            <!-- Footer -->
            <footer id="footer">
                <div class="copyright">
                    &copy; Bluebee Design: <a href="http://220.128.133.15/s1090209/">2020年7月</a>. Images: <a href="./images/logo3.png"></a>.
                </div>
            </footer>
        </section>
    </div>
    </div>

    <!-- Scripts -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/jquery.poptrox.min.js"></script>
    <script src="assets/js/jquery.scrolly.min.js"></script>
    <script src="assets/js/skel.min.js"></script>
    <script src="assets/js/util.js"></script>
    <script src="assets/js/main.js"></script>
    </div>
</body>

</html>