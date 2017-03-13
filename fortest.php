<?php
function http($url, $data='', $method='GET'){   
    $curl = curl_init(); //初始化PHPCURL擴展
    curl_setopt($curl, CURLOPT_URL, $url); //設定CURL
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // 檢查證書來源
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); // 從證書中檢查SSL加密算法是否存在  
    curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // 使用用戶useragent(模擬用戶使用瀏覽器)  
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); // 放行自動跳轉
    curl_setopt($curl, CURLOPT_AUTOREFERER, 1); // 自動設置Refer  
    if($method=='POST'){  //使用POST方式
        curl_setopt($curl, CURLOPT_POST, 1); 
        if ($data != ''){  
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data); //POST提交數據包
        }  
    }  
    curl_setopt($curl, CURLOPT_TIMEOUT, 30); // 設置超時限制
    curl_setopt($curl, CURLOPT_HEADER, 0); // 顯示返回Header的區域內容
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 獲取的信息以文件流形式返回
    $tmpInfo = curl_exec($curl); // 執行！放飛！
    curl_close($curl); // 關閉CURL回話
    return $tmpInfo; // 返回數據
} 
$data = [
    "smfile" => new CURLFile(realpath('timg.jpg')),
	"ssl"=>True,
	"format"=>"json",
];
$r = http('https://sm.ms/api/upload',$data,'POST');
echo $r;
?>