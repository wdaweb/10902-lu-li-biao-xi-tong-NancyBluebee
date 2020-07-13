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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>履歷</title>
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="./css/all.css">
    <style>
    body {
        /* font-size: 1.2em; */
        line-height: 2em;
    }
    .row {
        margin: 1em;
    }
    .work, .art {
        margin-top: 0;
        margin-bottom: 0;
        margin-right: -15px;
        margin-left: -15px;
    }
    .table-reqs tr th {
        width: 30%;
    }
    .table-contact {
        word-break: break-all;
        word-wrap: break-word;
    }
    .skill-table tr th {
        border-bottom: 1px solid #dee2e6;
    }
    .skill-table tr th:nth-child(1) {
    width: 30%;
    }
    .skill-table tr th:nth-child(2) {
    width: 35%;
    }
    .skill-table tr th:nth-child(3) {
    width: 35%;
    }
    .skill-table td {
        border: none;
        word-break: break-all;
        word-wrap: break-word;
    }
    .portfolio {
        padding: 0.8rem;
    }
    pre {
        white-space: pre-wrap;
        word-wrap: break-word;
    }
</style>
</head>
<body class="bg-light text-dark">

<!-- 提示 -->
<div class="alert alert-secondary text-center" role="alert">
  產生<a href="./api/resume.php" target="_blank" class="alert-link">履歷連結</a>。
</div>

<div class="container-fluid">

<?php
// 找出使用者帳號
$data=search("user",$_SESSION['id']);
$acct=$data['acct'];
// 撈出求職條件
$reqs=searchAll("reqs",["acct"=>"$acct", "see"=>"1"]);
foreach($reqs as $value){
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
                        <td><?=$value['reqs_posit'];?></td>
                        </tr>
                        <tr>
                        <th scope="row">工作描述</th>
                        <td><?=$value['reqs_jd'];?></td>
                        </tr>
                        <tr>
                        <th scope="row">可上班時間</th>
                        <td><?=$value['reqs_time'];?></td>
                        </tr>
                        <tr>
                        <th scope="row">期望工作地點</th>
                        <td><?=$value['reqs_place'];?></td>
                        </tr>
                        <tr>
                        <th scope="row">期望工作性質</th>
                        <td><?=$value['reqs_type'];?></td>
                        </tr>
                        <tr>
                        <th scope="row">期望薪資</th>
                        <td><?=$value['reqs_pay'];?></td>
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

<?php
// 撈出頭像圖片
$img=searchAll("img",["acct"=>"$acct", "see"=>"1"]);
// 撈出自我介紹和自傳
$s_intro=searchAll("s_intro",["acct"=>"$acct", "see"=>"1"]);
// 撈出社群資料
$social_m=searchAll("social_m",["acct"=>"$acct", "see"=>"1"]);
// 撈出學歷資料
$edu=searchAll("edu",["acct"=>"$acct", "see"=>"1"]," ORDER BY id DESC");
?>
    <div class="resume row justify-content-center">
        <!-- 履歷左欄 -->
        <div class="col-12 col-sm-10 col-md-5 col-lg-3">
            <!-- 頭像+姓名 -->
            <div class="name card border-secondary mb-4 text-center">
            <?php
            foreach($img as $value){
            ?>
            <img src="./img/<?=$value['filename'];?>" class="card-img-top" alt="<?=$value['alt'];?>" >
            <?php
            }
            ?>
                <div class="card-body">
                    <h5 class="card-title h2"><?=$data['name'];?></h5>
                    <?php
                    foreach($s_intro as $value){
                        if(!empty($value['s_intro'])) {
                    ?>
                    <p class="card-text"><?=$value['s_intro'];?></p>
                    <?php
                        }
                    }
                    if(!empty($data['addr'])) {
                    ?>
                    <p class="card-text"><small class="text-muted"><?=$data['addr'];?></small></p>
                    <?php
                    }
                    ?>
                </div>
            </div>

            <!-- 聯絡資訊和社群資料 -->
            <?php
                foreach($social_m as $value) {
            ?>
            <div class="contact card border-secondary mb-4">
                <div class="card-header">
                聯絡資訊
                </div>
                <div class="card-body">
                    <table class="table-contact table table-borderless table-sm">
                    <tbody>
                <?php
                    if(!empty($data['email'])) {
                ?>
                    <tr>
                    <td><i class="far fa-envelope fa-lg"></i></th>
                    <td><a href="mailto:<?=$data['email'];?>"><?=$data['email'];?></td>
                    </tr>
                <?php
                }
                    if(!empty($value['fb'])) {
                ?>
                    <tr>
                    <td><i class="fab fa-facebook-f fa-lg"></i></td>
                    <td><a href="<?=$value['fb'];?>" target="_blank"><?=$value['fb'];?></a></td>
                    </tr>
                <?php
                    }
                    if(!empty($value['ig'])) {
                ?>
                    <tr>
                    <td><i class="fab fa-instagram fa-lg"></i></td>
                    <td><a href="<?=$value['ig'];?>" target="_blank"><?=$value['ig'];?></a></td>
                    </tr>
                <?php
                }
                if(!empty($value['linkedin'])) {
                ?>
                    <tr>
                    <td><i class="fab fa-linkedin-in fa-lg"></td>
                    <td><a href="<?=$value['linkedin'];?>" target="_blank"><?=$value['linkedin'];?></a></td>
                    </tr>
                <?php
                }
                if(!empty($value['github'])) {
                ?>
                    <tr>
                    <td><i class="fab fa-github fa-lg"></i></td>
                    <td><a href="<?=$value['github'];?>" target="_blank"><?=$value['github'];?></a></td>
                    </tr>
                <?php
                }
                if(!empty($value['youtube'])) {
                ?>
                    <tr>
                    <td><i class="fab fa-youtube fa-lg"></i></td>
                    <td><a href="<?=$value['youtube'];?>" target="_blank"><?=$value['youtube'];?></a></td>
                    </tr>
                <?php
                }
                if(!empty($value['twitter'])) {
                ?>
                    <tr>
                    <td><i class="fab fa-twitter fa-lg"></i></td>
                    <td><a href="<?=$value['twitter'];?>" target="_blank"><?=$value['twitter'];?></a></td>
                    </tr>
                <?php
                    }
                ?>
                    </tbody>
                    </table>
                </div>
            </div>
            <?php
            }
            ?>
            <!-- 學歷資料 -->
            <div class="edu card border-secondary mb-4">
                <div class="card-header">
                學歷
                </div>
                <div class="card-body">
                <?php
                foreach($edu as $value) {
                ?>
                    <p>
                <?php
                if(!empty($value['grad_t'])) {
                ?>
                    <?=$value['grad_t'];?>
                <?php
                }
                if(!empty($value['sch'])) {
                ?>
                    <br><?=$value['sch'];?>
                <?php
                }
                if(!empty($value['dept'])) {
                ?>
                    <br><?=$value['dept'];?>
                <?php
                }
                if(!empty($value['grad_st'])) {
                    ?>
                    （<?=$value['grad_st'];?>）
                    <?php
                }
                ?>
                    </p>
                <?php
                }
                ?>
                </div>
            </div>
        </div>
        <!-- 履歷右欄 -->
        <div class="col-12 col-sm-10 col-md-7 col-lg-5">
            <!-- 自傳 -->
            <?php
            foreach($s_intro as $v) {
            ?>
            <div class="s_intro card border-secondary mb-4">
                <div class="card-header">
                自傳
                </div>
                <div class="card-body">
                <pre><?=$v['bio'];?></pre>
                </div>
            </div>
            <?php
            }
            ?>
            <!-- 工作技能 -->
            <div class="skill card border-secondary mb-4">
                <div class="card-header">
                工作技能
                </div>
                <div class="card-body">

                <?php
                // 撈出技能資料
                $skill=searchAll("skill",["acct"=>"$acct", "see"=>"1"]);
                // 刪除重複的技能分類
                $cat=array_column($skill,"cat");
                $cat_unique=array_unique($cat);
                foreach($cat_unique as $category){
                ?>
                <table class="skill-table table table-sm">
                <thead>
                    <tr>
                    <th scope="col"><?=$category;?></th>
                    <th scope="col">程度</th>
                    <th scope="col">說明</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                foreach($skill as $value) {
                    if($value['cat']==$category){
                ?>
                <tr>
                <td><?=$value['skill'];?></td>
                <td style="padding-top: 0.7em; padding-right: 1.5em;">
                    <div class="progress" style="height: 2em;">
                        <div class="progress-bar bg-secondary" role="progressbar" style="width: <?=$value['level'];?>;" aria-valuenow="<?=$value['level'];?>" aria-valuemin="0" aria-valuemax="100"><?=$value['level'];?></div>
                    </div>
                </td>
                <td><?=$value['des'];?></td>
                </tr>
                <?php
                    }
                }
                ?>
                </tbody>
                </table>
                <?php
                }
                ?>
                </div>
            </div>

            <!-- 工作經歷 -->
            <div class="exp card border-secondary">
                <div class="card-header">
                工作經歷&相關經驗
                </div>
                <div class="card-body">
                <ul class="list-group list-group-flush">
                    <?php
                    $exp=searchAll("exp",["acct"=>"$acct", "see"=>"1"]," ORDER BY id DESC");
                    foreach($exp as $value) {
                    ?>
                    <li class="list-group-item">
                    <?php
                    if(!empty($value['posit'])) {
                        ?>
                        <span class="font-weight-bold"><?=$value['posit'];?></span>
                        <?php
                    }
                    if(!empty($value['corp'])) {
                        ?>
                            — <?=$value['corp'];?>
                        <?php
                        }
                    if(!empty($value['dur'])) {
                    ?>
                        <br><span class="text-muted"><?=$value['dur'];?></span>
                    <?php
                    }
                    if(!empty($value['jd'])) {
                    ?>
                        <br><i class="fas fa-caret-right fa-lg"></i> 說明：<?=$value['jd'];?>
                    <?php
                    }
                    ?>
                    </li>
                    <?php
                    }
                    ?>
                </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- 分隔線 -->
    <?php
    $count=$pdo->query("SELECT COUNT(*) FROM `work` WHERE `acct`='$acct' && `see`='1'")->fetch();
    if($count[0][0]!=0){
    ?>
    <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-12 col-lg-8">
            <hr>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-12 col-lg-8">
            <div class="card text-white bg-secondary mb-2">
                <div class="portfolio card-body text-center">
                作品集
                </div>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
    <!-- 作品集 -->
    <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-12 col-lg-8">
            <div class="work row">
            <?php
            $work=searchAll("work",["acct"=>"$acct", "see"=>"1"]);
            foreach($work as $value) {
            ?>
                <div class="col-12 col-sm-10 col-md-6 col-lg-4 mb-4">
                    <div class="card border-secondary">
                        <img src="./img/<?=$value['filename'];?>" class="card-img-top" alt="<?=$value['filename'];?>">
                        <div class="card-body">
                            <h6 class="card-title"><?=$value['name'];?></h6>
                            <p class="card-text"><?=$value['des'];?></p>
                            <a href="<?=$value['url'];?>" class="btn btn-outline-secondary" target="_blank">前往網站</a>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
            </div>
        </div>
    </div>
    <!-- 設計作品 -->
    <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-12 col-lg-8">
            <div class="card text-white bg-secondary mb-2">
                <div class="portfolio card-body text-center">
                設計作品
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-12 col-lg-8">
            <div class="art row">
            <?php
            $art=searchAll("art",["acct"=>"$acct", "see"=>"1"]);
            foreach($art as $value) {
            ?>
                <div class="col-12 col-sm-10 col-md-6 col-lg-4 mb-4">
                    <div class="card border-secondary">
                        <img src="./img/<?=$value['filename'];?>" class="card-img-top" alt="<?=$value['filename'];?>">
                        <div class="card-body">
                            <h6 class="card-title"><?=$value['name'];?></h6>
                            <a href="<?=$value['url'];?>" class="btn btn-outline-secondary" target="_blank">前往網站</a>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
            </div>
        </div>
    </div>
    
    
</div>
</body>
</html>