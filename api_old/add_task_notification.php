<?php
    function android($data,$to){
        //API URL of FCM
        $url = 'https://fcm.googleapis.com/fcm/send';
    
        /*api_key available in:
        Firebase Console -> Project Settings -> CLOUD MESSAGING -> Server key*/    $api_key = 'AAAA77GS90s:APA91bFaHdwPMyhXTuaqBWNrJVl0X6pai5fwUBbBqGiBltwLkGXD-F6Ml22ejpChfonv0EQhLB58Ja4UFV-M3fd7TirdkpB2ayEwKi5M5KSor_onv3hL-YbCAF-GFSTYdBFGL1L6BeBy';

        $msg = array("title"=> $data['subject'],
        "body"=>$data['msg_body'],
        "sound" => "default"
         );   
        
        $fields = array('registration_ids'=> $to,'notification'=> $msg);   
    
        //header includes Content type and api key
        $headers = array(
            'Content-Type:application/json',
            'Authorization:key='.$api_key
        );       
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('FCM Send Error: ' . curl_error($ch));
        }
        curl_close($ch);
        return true;
    }
?>