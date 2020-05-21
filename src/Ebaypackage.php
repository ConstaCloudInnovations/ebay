<?php

namespace Ebaypackage;

class Ebay
{

    public function getEbayOrders($token,$environment,$creationdate,$limit,$offset)
    {
        if(!$token){
            $error_response = '{
                    "category": "REQUEST",
                    "message": "Please enter vaild Token"
            }';
            return $error_response;
        }else if(!$environment){
            $error_response = '{
                "category": "REQUEST",
                "message": "Please enter vaild Environment"
            }';
            return $error_response;
        }else{
            if($environment != 'sandbox'){
                $environment='';
            }
            if(!$creationdate){
                $url = "https://api."."$environment".".ebay.com/sell/fulfillment/v1/order?";
            }else{
                $url = "https://api."."$environment".".ebay.com/sell/fulfillment/v1/order?filter=creationdate:"."$creationdate";
            }
            if($limit){
                $url = "$url"."&limit="."$limit";
                if($offset){
                    $url =  "$url"."&offset="."$offset";
                }
            }
           
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        $headers = array();
        $headers[] = "Authorization: Bearer .'$token'.";
        $headers[] = "Accept: application/json";
        $headers[] = "Content-Type: application/json";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close ($ch);
        return $result;
    }


    public function getEbayOrderId($token,$environment,$order_id)
    {
        if(!$token){
            $error_response = '{
                    "category": "REQUEST",
                    "message": "Please enter vaild Token"
            }';
            return $error_response;
        }else if(!$environment){
            $error_response = '{
                "category": "REQUEST",
                "message": "Please enter vaild Environment"
            }';
            return $error_response;
        }elseif(!$order_id){
            $error_response = '{
                "category": "REQUEST",
                "message": "Please enter vaild Order id"
            }';
            return $error_response;
            
            }else{
            if($environment != 'sandbox'){
                $environment='';
            }
            
                $url = "https://api."."$environment".".ebay.com/sell/fulfillment/v1/order/".$order_id;
            
            
           
        }
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        $headers = array();
        $headers[] = "Authorization: Bearer .'$token'.";
        $headers[] = "Accept: application/json";
        $headers[] = "Content-Type: application/json";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close ($ch);
        return $result;
    }

    public function getEbayInventoryItems($token,$environment,$limit,$offset)
    {
        if(!$token){
            $error_response = '{
                    "category": "REQUEST",
                    "message": "Please enter vaild Token"
            }';
            return $error_response;
        }else if(!$environment){
            $error_response = '{
                "category": "REQUEST",
                "message": "Please enter vaild Environment"
            }';
            return $error_response;
        }else{
            if($environment != 'sandbox'){
                $environment='';
            }
                $url = "https://api."."$environment".".ebay.com/sell/inventory/v1/inventory_item?";
            if($limit){
                $url = "$url"."&limit="."$limit";
                if($offset){
                    $url =  "$url"."&offset="."$offset";
                }
            }
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        $headers = array();
        $headers[] = "Authorization: Bearer .'$token'.";
        $headers[] = "Accept: application/json";
        $headers[] = "Content-Type: application/json";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close ($ch);
        return $result;
    }

    public function getEbayInventoryItem($token,$environment,$sku)
    {
        if(!$token){
            $error_response = '{
                    "category": "REQUEST",
                    "message": "Please enter vaild Token"
            }';
            return $error_response;
        }else if(!$environment){
            $error_response = '{
                "category": "REQUEST",
                "message": "Please enter vaild Environment"
            }';
            return $error_response;
        }elseif(!$sku){
            $error_response = '{
                "category": "REQUEST",
                "message": "Please enter vaild sku"
            }';
            return $error_response;
        }else{
            if($environment != 'sandbox'){
                $environment='';
            }
                $url = "https://api."."$environment".".ebay.com/sell/inventory/v1/inventory_item/".$sku;
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        $headers = array();
        $headers[] = "Authorization: Bearer .'$token'.";
        $headers[] = "Accept: application/json";
        $headers[] = "Content-Type: application/json";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close ($ch);
        return $result;
    }

    public function createOrUpdateInventoryItem($token,$environment,$sku,$requestProductData)
    {
        if(!$token){
            $error_response = '{
                    "category": "REQUEST",
                    "message": "Please enter vaild Token"
            }';
            return $error_response;
        }else if(!$sku){
            $error_response = '{
                    "category": "REQUEST",
                    "message": "Please enter vaild SKU"
            }';
            return $error_response;
        }else if(!$requestProductData){
            $error_response = '{
                "category": "REQUEST",
                "message": "Request data can not be null"
            }';
            return $error_response;
        }else{
            if($environment != 'sandbox'){
                $environment='';
            }
            $url = "https://api."."$environment".".ebay.com/sell/inventory/v1/inventory_item/".$sku;
        }
        // $url = "https://api.sandbox.ebay.com/sell/inventory/v1/inventory_item/".$sku;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        $headers = array();
        $headers[] = "Authorization: Bearer .'$token'.";
        $headers[] = "Content-Type: application/json";
        $headers[] = "Content-Language: en-US";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$requestProductData);
        $result = curl_exec($ch);
        $response_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close ($ch);
        if($response_code == 204){
            $sucess_response = '{
                "code":204
            }';
            return $sucess_response;
        }else{
            return $result;

        }
    }


}