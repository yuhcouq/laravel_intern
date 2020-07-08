<?php

function stock($selectedcountry,$selectedservice,$smsapikey){
    $Baglanti = 'http://smspva.com/priemnik.php?metod=get_count_new&service='.$selectedservice.'&apikey='.$smsapikey.'&country='.$selectedcountry;
    $Kaynak = file_get_contents($Baglanti);
    $adet = json_decode($Kaynak,true);
    return $adet;
}
function stock2($selectedcountry,$smsapikey){
    $Baglanti = 'http://api1.5sim.net/stubs/handler_api.php?api_key='.$smsapikey.'&action=getNumbersStatus&country='.$selectedcountry;
    $Kaynak = file_get_contents($Baglanti);
    $adet = json_decode($Kaynak, true);
    return $adet;
}
function stock3($selectedcountry,$smsapikey){
    $Baglanti = 'https://sms-activate.ru/stubs/handler_api.php?api_key='.$smsapikey.'&action=getNumbersStatus&country='.$selectedcountry;
    $Kaynak = file_get_contents($Baglanti);
    $adet = json_decode($Kaynak, true);
    return $adet;
}
function getnumber($smsapikey,$serviceapi,$countrycode){
    $Baglanti = 'http://smspva.com/priemnik.php?metod=get_number&country='.$countrycode.'&service='.$serviceapi.'&apikey='.$smsapikey;
    $Kaynak = file_get_contents($Baglanti);
    $adet = json_decode($Kaynak,true);
    if($adet["response"]==1){
        if(isset($adet["id"])){         
            $result = $adet["id"].':'.$adet["number"];
        }else{
            $result = "nonumber";      
        }
        
    }else{
        $result = "nonumber";        
    } 
    return $result;
}
function getnumber2($smsapikey,$serviceapi,$countrycode){
    $Baglanti = 'http://api1.5sim.net/stubs/handler_api.php?api_key='.$smsapikey.'&action=getNumber&service='.$serviceapi.'&forward=0&country='.$countrycode;
    $Kaynak = file_get_contents($Baglanti);
    $test=explode(':', $Kaynak);
    if($test[0]=="ACCESS_NUMBER"){
        //$result = "2".":"."$Kaynak";
        $NumaraBilgisi = explode(':', str_replace('ACCESS_NUMBER:','', $Kaynak),0);
        $ID = $NumaraBilgisi[0];
        $Numara = $NumaraBilgisi[1];
        if(isset($ID)){         
            $result = $ID.":".$Numara;
        }else{
            $result = "nonumber";      
        }
        
    }else{
        $result = "nonumber";  
           
    }
    return $result;
}
function getnumber3($smsapikey,$serviceapi,$countrycode){
    $Baglanti = 'https://sms-activate.ru/stubs/handler_api.php?api_key='.$smsapikey.'&action=getNumber&service='.$serviceapi.'&forward=0&country='.$countrycode;
    $Kaynak = file_get_contents($Baglanti);
    $test=explode(':', $Kaynak);
    if($test[0]=="ACCESS_NUMBER"){
        //$result = "2".":"."$Kaynak";
        $NumaraBilgisi = explode(':', str_replace('ACCESS_NUMBER:','', $Kaynak),0);
        $ID = $NumaraBilgisi[0];
        $Numara = $NumaraBilgisi[1];
        if(isset($ID)){         
            $result = $ID.":".$Numara;
        }else{
            $result = "nonumber";      
        }
        
    }else{
        $result = "nonumber";  
           
    }
    return $result;
}
function getmessage($countrycode, $servicecode, $smsapikey,$numberid){
    $Baglanti = 'http://smspva.com/priemnik.php?metod=get_sms&country='.$countrycode.'&service='.$servicecode.'&id='.$numberid.'&apikey='.$smsapikey;
    $Kaynak = file_get_contents($Baglanti);
    $adet = json_decode($Kaynak,true);
    return $adet;
}
function getmessage2($smsapikey,$numberid){
    $Baglanti = 'http://api1.5sim.net/stubs/handler_api.php?api_key='.$smsapikey.'&action=getStatus&id='.$numberid;
    $Kaynak = file_get_contents($Baglanti);
    return $Kaynak;
}
function getmessage3($smsapikey,$numberid){
    $Baglanti = 'https://sms-activate.ru/stubs/handler_api.php?api_key='.$smsapikey.'&action=getStatus&id='.$numberid;
    $Kaynak = file_get_contents($Baglanti);
    return $Kaynak;
}
function re_getmessage3($smsapikey,$numberid){
    $Baglanti = 'https://sms-activate.ru/stubs/handler_api.php?api_key='.$smsapikey.'&action=getStatus&id='.$numberid.'&sms=sms';
    $Kaynak = file_get_contents($Baglanti);
    return $Kaynak;
}

function cancelnumber($countrycode,$servicecode,$numberid,$smsapikey){
    $Baglanti = 'http://smspva.com/priemnik.php?metod=denial&country='.$countrycode.'&service='.$servicecode.'&id='.$numberid.'&apikey='.$smsapikey;
    $Kaynak = file_get_contents($Baglanti);
    $adet = json_decode($Kaynak,true);
  if($adet["response"]==1||$adet["response"]==2){
        $status ="success";
  }
  else{
        $status = "error";
  }
  return $status;
}
function cancelnumber2($smsapikey,$numberid){
    $Baglanti = 'http://api1.5sim.net/stubs/handler_api.php?api_key='.$smsapikey.'&action=setStatus&status=-1&id='. $numberid.'&forward=0';
    $Kaynak = file_get_contents($Baglanti);

  if($Kaynak == 'ACCESS_CANCEL'){
        $status = "success";
  }
  else{
        $status = "error";
  }
  return $status;
}
function cancelnumber3($smsapikey,$numberid){
    $Baglanti = 'https://sms-activate.ru/stubs/handler_api.php?api_key='.$smsapikey.'&action=setStatus&status=-1&id='. $numberid.'&forward=0';
    $Kaynak = file_get_contents($Baglanti);
  if($Kaynak == "ACCESS_CONFIRM_GET"){
        $status ="success";
  }
  else{
        $status = "error";
  }
  return $status;
}
function getBalance($smsapikey){
        $Baglanti='http://smspva.com/priemnik.php?metod=get_balance&apikey='.$smsapikey;
        $Kaynak = file_get_contents($Baglanti);
        $adet = json_decode($Kaynak,true);
        if($adet["response"]==1)
        $sonuc = $adet["balance"];
        return $sonuc;
}
function getBalance2($smsapikey){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://api1.5sim.net/stubs/handler_api.php?api_key='.$smsapikey.'&action=getBalance');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $sonuc = curl_exec($ch);
    $sonuc = explode(":",$sonuc);
    $sonuc = $sonuc[1];
    curl_close($ch);
    return $sonuc;
}
function getBalance3($smsapikey){
    $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://sms-activate.ru/stubs/handler_api.php?api_key='.$smsapikey.'&action=getBalance');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $sonuc = curl_exec($ch);
        $sonuc = explode(":",$sonuc);
        $sonuc = $sonuc[1];
        curl_close($ch);
        return $sonuc;
}
?>