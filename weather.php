<?php



/*$ch = curl_init();
$timeout = 5;
curl_setopt ($ch, CURLOPT_URL,'http://wthrcdn.etouch.cn/weather_mini?city=%E5%B9%BF%E5%B7%9E');
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
$file_contents = curl_exec($ch);
curl_close($ch);
echo $file_contents;
*/

header("content-type:text/html;charset=utf-8");
$str = file_get_contents("http://www.weather.com.cn/data/sk/101110101.html");

// $str = json_encode($arr);//将数据类型转化成json
// $res = json_decode($str,true);将json转化成数据类型 object array (第二个参数true)
//$str = iconv("gbk", "utf-8", $str);

$res = json_decode($str);

var_dump($res);exit;

$result = $res['results'][0];

$city = $result['currentCity'];
$weather_data = $result['weather_data'][0];


?>

城市：<?php echo $city;?><br />
日期：<?php echo $weather_data['date'];?><br />
白天：<img src="<?php echo $weather_data['dayPictureUrl'];?>" /><br />
夜晚：<img src="<?php echo $weather_data['nightPictureUrl'];?>" /><br />
天气情况：<?php echo $weather_data['weather'];?><br />
风力：<?php echo $weather_data['wind'];?><br />
温度区间：<?php echo $weather_data['temperature'];?><br />