# HTTPrequestModule
使用PHP的curl擴展通過HTTP協議實現多用途請求模塊

避開繁瑣的curl操作！[

$data = [

    "smfile"=>new CURLFile(realpath('w.jpg')),
    
    "ssl"=> True,
    
    "format"=>"json"
    
];

$pushPic = new Hrm();

$pushPic->setURL("https://sm.ms/api/upload");

$pushPic->setMode("POST");

$pushPic->setPostData($data);

$r = $pushPic->sendRequest();

echo $r;

]
