
<?php
$arlet = array("a", "c"); // 금기어

$content = "bbbbaaabbbccccc"; // 사용자 입력 내용
$str_bak = "bbbbaaabbbccccc";
//$search = strpos($str, $arlet[0]); // 금기어가 포함된 위치 확인
$count = count($arlet); // 배열 원소 개수 계산

for($i = 0; $i < $count; $i++)
{
  //금기어 배열에 있는 금기어가 사용자 입력 값에 포함되어있으면 "x" 문자로 변환
  //변경된 내용 = str_replace(찾을값, 변경할 값, 사용자 문자열)
  $content = str_replace($arlet[$i], "x", $content);
}

echo "변경 전 : {$str_bak} => 변경 후 : {$content}";



$filename = "Chrysanthemum.jpg";
$reail_filename = "Chrysanthemum.jpg";
$file_dir = "./xampp/upload/$filename";

header('Content-Type:application/x-octetstream');
header('Content-Length:'.filesize($file_dir));
header('Content-Disposition: attachment; filename='.$reail_filename);
header('Content-Transfer-Encoding:binary');

$fp = fopen($file_dir, "r");
fpassthru($fp);
fclose($fp);



?>
