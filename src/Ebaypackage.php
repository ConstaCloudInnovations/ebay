<?php

namespace Ebaypackage;

class Ebay
{

   
  public function getEbayOrders($token, $id = NULL, $PageNumber = 1, $OrdersPerPage = 100)
    {
        $headers = array();
        $headers[] = "X-EBAY-API-SITEID:0";
        $headers[] = "X-EBAY-API-COMPATIBILITY-LEVEL:967";
        $headers[] = "X-EBAY-API-CALL-NAME:GetOrders";
        $headers[] = "X-EBAY-API-IAF-TOKEN:".$token;
        
        if($id)
        {
            $postData = '<?xml version="1.0" encoding="utf-8"?>
            <GetOrdersRequest xmlns="urn:ebay:apis:eBLBaseComponents">    
            <ErrorLanguage>en_US</ErrorLanguage>
            <WarningLevel>High</WarningLevel>
            <OrderIDArray>
            <OrderID>'.$id.'</OrderID>
            </OrderIDArray>
            </GetOrdersRequest>';
        }
        else
        {
            $postData = '<?xml version="1.0" encoding="utf-8"?>
            <GetOrdersRequest xmlns="urn:ebay:apis:eBLBaseComponents">    
            <ErrorLanguage>en_US</ErrorLanguage>
            <WarningLevel>High</WarningLevel>
             <CreateTimeFrom>'.date("Y-m-d\TH:i:s", strtotime("-1 months")).'</CreateTimeFrom>
             <CreateTimeTo>'.date("Y-m-d\TH:i:s").'</CreateTimeTo>
            <Pagination>
            <EntriesPerPage>'.$OrdersPerPage.'</EntriesPerPage>
            <PageNumber>'.$PageNumber.'</PageNumber>
            </Pagination>
            </GetOrdersRequest>';
        }
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.sandbox.ebay.com/ws/api.dll");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        $response = curl_exec($ch);
        curl_close($ch);
        
        return json_encode(simplexml_load_string($response));
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