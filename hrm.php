<?php
/*!
 * Hrm framework
 * https://linux.dog
 * Version 0.1.0
 *
 * Copyright 2017, HaradaShino - Misaka10031
 * Released under the MIT license
 */
class Hrm{

    /**
    * @var string url地址
    * @access protected
    */
    protected $_url;

    /**
    * @var string HTTP請求方式
    * @access protected
    */
    protected $_mode;

    /**
    * @var array POST請求數據 - 數組！
    * @access protected
    */
    protected $_postdata;

    /**
    * 設置URL
    * @access public
    * @param string $url URL 支持HTTPS
    * @return boolean
    */
    public function setURL($url){
        $this->_url = $url;
        //var_dump($this->_url);
        return true;
    }

    /**
    * 設置請求方式
    * @access public
    * @param string $mode 請求方式 GET|POST
    * @return boolean
    */
    public function setMode($mode){
        $mode = strtoupper($mode); //轉換為大寫形式
        $this->_mode = $mode;
        //var_dump($this->_mode);
        return true;
    }

    /**
    * 設置POST請求數據
    * @access public
    * @param array $data 請求數據
    * @return boolean
    */
    public function setPostData($data){
        if(is_array($data)){
            $this->_postdata = $data;
            //var_dump($this->_postdata);
            return true;
        }else{
            throw new Exception("[!] setPostData(): the parameter must be array! - 請傳入數組作為參數");
            return false;
        }
    }

    /**
    * 發送請求！放飛！
    * @access public
    * @param NULL
    * @return string
    */
    public function sendRequest(){
        $curl = curl_init();
        //var_dump($curl);
        curl_setopt($curl, CURLOPT_URL, $this->_url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_AUTOREFERER, 1);
        if($this->_mode=='POST'){
            curl_setopt($curl, CURLOPT_POST, 1); 
            if ($this->_postdata != ''){  
                curl_setopt($curl, CURLOPT_POSTFIELDS, $this->_postdata);
            }  
        }
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        $tmpInfo = curl_exec($curl);
        curl_close($curl);
        return $tmpInfo;
    }

}

$data = [
    "smfile"=>new CURLFile(realpath('w.jpg')),
    "ssl"=> True,
    "format"=>"json"
];


$pushPic = new Hrm();
$result = $pushPic->setURL("https://sm.ms/api/upload");

$result = $pushPic->setMode("POST");

$result = $pushPic->setPostData($data);

$result = $pushPic->sendRequest();
echo $result;

?>