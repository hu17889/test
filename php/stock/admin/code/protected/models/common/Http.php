<?php
class Http
{

    public static function post($url, array $data){
        $curlHandle = curl_init();
        curl_setopt($curlHandle, CURLOPT_URL, $url);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curlHandle, CURLOPT_HTTPHEADER, array('Expect:'));
        curl_setopt($curlHandle, CURLOPT_POST, true);
        curl_setopt($curlHandle, CURLOPT_POSTFIELDS, http_build_query($data));
        $result = curl_exec($curlHandle);
        curl_close($curlHandle);
        return $result;
    }
    public static function request($url, $mode,$params='', $needHeader = false, $timeout = 10){
        $curlHandle = curl_init();
        curl_setopt($curlHandle, CURLOPT_TIMEOUT,  $timeout);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
        if($needHeader){
            curl_setopt($curlHandle, CURLOPT_HEADER, true);
        }

        if($mode=='POST'){
            curl_setopt($curlHandle, CURLOPT_HTTPHEADER, array('Expect:'));
            curl_setopt($curlHandle, CURLOPT_POST, true);
            if(is_array($params)){
                curl_setopt($curlHandle, CURLOPT_POSTFIELDS, http_build_query($params));
            }else{
                curl_setopt($curlHandle, CURLOPT_POSTFIELDS,$params);
            }
        }else{
            if(is_array($params)){
                $url .= (strpos($url, '?') === false ? '?' : '&') . http_build_query($params);
            }else{
                $url .= (strpos($url, '?') === false ? '?' : '&') . $params;
            }
        }
        curl_setopt($curlHandle, CURLOPT_URL, $url);
        if(substr($url, 0, 5) == 'https'){
            curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, false);
        }
        
        $result = curl_exec($curlHandle);

        if($needHeader){
            $tmp = $result;
            $result = array();
            $info = curl_getinfo($curlHandle);
            $result['header'] = substr($tmp, 0, $info['header_size']);
            $result['body']   = trim(substr($tmp, $info['header_size']));  //直接从header之后开始截取，因为 1.body可能为空   2.下载可能不全   
            //$info['download_content_length'] > 0 ? substr($tmp, -$info['download_content_length']) : '';
        }
        $errno = curl_errno($curlHandle);
        $errinfo = curl_error($curlHandle);
        if($errno){
            $record = array('url'=>$url,'request_data'=>$params,'errno'=>$errno,'errinfo'=>$errinfo,'server'=>$_SERVER,'request'=>$_REQUEST);
            echo "<pre>";var_dump($record);exit;
        }
        curl_close($curlHandle);
        return $result;
    }
}
