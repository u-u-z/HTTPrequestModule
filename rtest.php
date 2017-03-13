<?php
/*！
 * A test for hrm to POST a picture to sm.ms imgbed!
 * Thanks for sm.ms imgbed api
 * Please use "php -S localhost:8080" to test!
 * Miao~ Miao~ Miao~ i@linux.dog
 */
require_once "hrm.php"

use Hrm\Hrm

$data_arr = [
    "smfile" => new CURLFile(realpath('timg.jpg')),
    "ssl"=>True,
    "format"=>"json"
];


$pushPic = new Hrm();
$pushPic->setURL("https://sm.ms/api/upload");
$pushPic->setMode("POST");
$pushPic->setPostData($data_arr);
$result = $pushPic->sendRequest();
var_dump($result);



?>