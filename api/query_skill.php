<?php
include_once "db_info.php";

$id=$_SESSION['id'];

$sql="SELECT * FROM `user` WHERE `id`='$id'";

$data=$pdo->query($sql)->fetch();

$acct=$data['acct'];

$sql="SELECT * FROM `skill` WHERE `acct`='$acct'";

$ability=$pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

$num=0;
foreach($ability as $value){
$skill_id=$value['id'];
$checked=($value['see']==1)?"checked":"";
$cat=$value['cat'];
$skill=$value['skill'];
$level=$value['level'];
$des=$value['des'];
$num++;
?>

<div class="card m-1">
<div class="card-body text-left">

<!-- 第一列 -->
<div class="form-row">
    <div class="form-group col-md-12">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="see<?=$num;?>" <?=$checked;?>>
            <label class="form-check-label" for="see<?=$num;?>">在履歷中顯示</label>
        </div>
    </div>
</div>

<!-- 第二列 -->
<div class="form-row">
    <div class="form-group col-md-12">
        <label for="inputCat">類別</label>
        <select id="inputCat" class="form-control">
            <option <?=($cat=="財務會計")?"selected":"";?>>財務會計</option>
            <option <?=($cat=="人事/行政/法務")?"selected":"";?>>人事/行政/法務</option>
            <option <?=($cat=="管理類")?"selected":"";?>>管理類</option>
            <option <?=($cat=="金融保險")?"selected":"";?>>金融保險</option>
            <option <?=($cat=="行銷/企劃")?"selected":"";?>>行銷/企劃</option>
            <option <?=($cat=="客服/門市/業務/貿易")?"selected":"";?>>客服/門市/業務/貿易</option>
            <option <?=($cat=="美容美髮")?"selected":"";?>>美容美髮</option>
            <option <?=($cat=="餐飲旅遊")?"selected":"";?>>餐飲旅遊</option>
            <option <?=($cat=="前端網頁設計")?"selected":"";?>>前端網頁設計</option>
            <option <?=($cat=="後端程式設計")?"selected":"";?>>後端程式設計</option>
            <option <?=($cat=="電子電機")?"selected":"";?>>電子電機</option>
            <option <?=($cat=="化學/化工/醫藥")?"selected":"";?>>化學/化工/醫藥</option>
            <option <?=($cat=="交通運輸")?"selected":"";?>>交通運輸</option>
            <option <?=($cat=="生產/製程")?"selected":"";?>>生產/製程</option>
            <option <?=($cat=="設計/美工")?"selected":"";?>>設計/美工</option>
            <option <?=($cat=="語言")?"selected":"";?>>語言</option>
        </select>
    </div>
</div>

<!-- 第三列 -->
<div class="form-row">
    <div class="form-group col-md-12">
        <label for="inputSkill">技能</label>
        <input type="text" class="form-control" value="<?=$skill;?>">
    </div>
</div>

<!-- 第四列 -->
<div class="form-row">
    <div class="form-group col-md-12">
        <label for="customRange0<?=$num;?>">程度</label>
        <input type="range" class="custom-range" id="customRange0<?=$num;?>" min="0" max="100" step="1" value="<?=str_replace("%","",$level);?>">
        <input type="text" name="level" class="level form-control" value="<?=$level;?>">
        <small class="form-text text-primary">請使用滑桿調整，或直接輸入百分比數值。</small>
    </div>
</div>

<!-- 第五列 -->
<div class="form-row">
    <div class="form-group col-md-12">
        <label for="inputDes">說明</label>
        <input type="text" name="des" class="form-control" value="<?=$des;?>">
    </div>
</div>

<!-- 按鈕列 -->
    <input type="button" value="更新" class="upt-btn btn btn-primary" id="<?=$skill_id;?>">
    <input type="button" value="刪除" class="del-btn btn btn-primary">

<!-- 收尾標籤 -->
</div>
</div>
<?php
}
?>