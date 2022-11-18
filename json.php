<!DOCTYPE html>
<html>
<head>
<title>json資料</title>
</head>
<body>

<?php
//https://data.gov.tw/dataset/8066
$抓取的資料=file_get_contents("https://data.coa.gov.tw/Service/OpenData/FromM/FarmTransData.aspx");

$o=json_decode($抓取的資料,true);

//echo $o[0]['作物名稱'];

$link=mysqli_connect('localhost','root','','opendata');

mysqli_set_charset($link,'utf8');

foreach ($o as $v) {
    echo "作物名稱=$v[作物名稱]<br/>";

mysqli_query($link,"INSERT INTO `花花果果` (`流水號`, `日期`, `名稱`, `平均價格`, `交易量`) VALUES
 (NULL, '$v[交易日期]', '$v[作物名稱]', '$v[平均價]', '$v[交易量]');") or die(mysqli_error($link));
}

?>
</body>
</html>