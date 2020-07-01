<?php

namespace Ebaypackage;

class EbayAPI
{

   
  public function getEbayOrders($token, $api_URL, $id = NULL, $PageNumber = 1, $OrdersPerPage = 100)
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
             <CreateTimeFrom>'.date("Y-m-d\TH:i:s", strtotime("-10 years")).'</CreateTimeFrom>
             <CreateTimeTo>'.date("Y-m-d\TH:i:s").'</CreateTimeTo>
            <Pagination>
            <EntriesPerPage>'.$OrdersPerPage.'</EntriesPerPage>
            <PageNumber>'.$PageNumber.'</PageNumber>
            </Pagination>
            </GetOrdersRequest>';
        }
        
        $ch = cURL_init();
        cURL_setopt($ch, CURLOPT_URL, $api_URL."/ws/api.dll");
        cURL_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        cURL_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        cURL_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        cURL_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        $response = cURL_exec($ch);
        cURL_close($ch);
        
        return json_encode(simplexml_load_string($response));
    }


    public function getEbayOrderId($token,$api_URL,$order_id)
    {
        if(!$token){
            $error_response = '{
                    "category": "REQUEST",
                    "message": "Please enter valid Token"
            }';
            return $error_response;
        }else if(!$api_URL){
            $error_response = '{
                "category": "REQUEST",
                "message": "Please enter valid URL"
            }';
            return $error_response;
        }elseif(!$order_id){
            $error_response = '{
                "category": "REQUEST",
                "message": "Please enter valid Order id"
            }';
            return $error_response;
            
            }else{
            
                $URL = "".$api_URL."/sell/fulfillment/v1/order/".$order_id;
            
            
           
        }
        
        $ch = cURL_init();
        cURL_setopt($ch, CURLOPT_URL, $URL);
        cURL_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        cURL_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        $headers = array();
        $headers[] = "Authorization: Bearer .'$token'.";
        $headers[] = "Accept: application/json";
        $headers[] = "Content-Type: application/json";
        cURL_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = cURL_exec($ch);
        if (cURL_errno($ch)) {
            echo 'Error:' . cURL_error($ch);
        }
        cURL_close ($ch);
        return $result;
    }

    public function getEbayInventoryItems($token,$api_URL,$limit,$offset)
    {
        if(!$token){
            $error_response = '{
                    "category": "REQUEST",
                    "message": "Please enter valid Token"
            }';
            return $error_response;
        }else if(!$api_URL){
            $error_response = '{
                "category": "REQUEST",
                "message": "Please enter valid URL"
            }';
            return $error_response;
        }else{
            
                $URL = "".$api_URL."/sell/inventory/v1/inventory_item?";
            if($limit){
                $URL = "$URL"."&limit="."$limit";
                if($offset){
                    $URL =  "$URL"."&offset="."$offset";
                }
            }
        }
        $ch = cURL_init();
        cURL_setopt($ch, CURLOPT_URL, $URL);
        cURL_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        cURL_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        $headers = array();
        $headers[] = "Authorization: Bearer .'$token'.";
        $headers[] = "Accept: application/json";
        $headers[] = "Content-Type: application/json";
        cURL_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = cURL_exec($ch);
        if (cURL_errno($ch)) {
            echo 'Error:' . cURL_error($ch);
        }
        cURL_close ($ch);
        return $result;
    }

    public function getEbayInventoryItem($token,$api_URL,$sku)
    {
        if(!$token){
            $error_response = '{
                    "category": "REQUEST",
                    "message": "Please enter valid Token"
            }';
            return $error_response;
        }else if(!$api_URL){
            $error_response = '{
                "category": "REQUEST",
                "message": "Please enter valid URL"
            }';
            return $error_response;
        }elseif(!$sku){
            $error_response = '{
                "category": "REQUEST",
                "message": "Please enter valid sku"
            }';
            return $error_response;
        }else{
           
                $URL = "".$api_URL."/sell/inventory/v1/inventory_item/".$sku;
        }
        $ch = cURL_init();
        cURL_setopt($ch, CURLOPT_URL, $URL);
        cURL_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        cURL_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        $headers = array();
        $headers[] = "Authorization: Bearer .'$token'.";
        $headers[] = "Accept: application/json";
        $headers[] = "Content-Type: application/json";
        cURL_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = cURL_exec($ch);
        if (cURL_errno($ch)) {
            echo 'Error:' . cURL_error($ch);
        }
        cURL_close ($ch);
        return $result;
    }



   
    public function createOrUpdateInventoryItem($token,$api_URL,$sku,$requestProductData)
    {
        if(!$token){
            $error_response = '{
                    "category": "REQUEST",
                    "message": "Please enter valid Token"
            }';
            return $error_response;
        }else if(!$sku){
            $error_response = '{
                    "category": "REQUEST",
                    "message": "Please enter valid SKU"
            }';
            return $error_response;
        }else if(!$api_URL){
            $error_response = '{
                "category": "REQUEST",
                "message": "Please enter valid URL"
            }';
            return $error_response;
        }else if(!$requestProductData){
            $error_response = '{
                "category": "REQUEST",
                "message": "Request data can not be null"
            }';
            return $error_response;
        }else{
            
            $URL = "".$api_URL."/sell/inventory/v1/inventory_item/".$sku;
        }
        $ch = cURL_init();
        cURL_setopt($ch, CURLOPT_URL, $URL);
        cURL_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        cURL_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        $headers = array();
        $headers[] = "Authorization: Bearer .'$token'.";
        $headers[] = "Content-Type: application/json";
        $headers[] = "Content-Language: en-US";
        cURL_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        cURL_setopt($ch, CURLOPT_POSTFIELDS,$requestProductData);
        $result = cURL_exec($ch);
        $response_code = cURL_getinfo($ch, CURLINFO_HTTP_CODE);
        if (cURL_errno($ch)) {
            echo 'Error:' . cURL_error($ch);
        }
        cURL_close ($ch);
        if($response_code == 204){
            $sucess_response = '{
                "code":204
            }';
            return $sucess_response;
        }else{
            return $result;

        }
    }

    public function getEbayOffer($token,$api_URL,$sku)
    {
        if(!$token){
            $error_response = '{
                    "category": "REQUEST",
                    "message": "Please enter valid Token"
            }';
            return $error_response;
        }else if(!$api_URL){
            $error_response = '{
                "category": "REQUEST",
                "message": "Please enter valid URL"
            }';
            return $error_response;
        }elseif(!$sku){
            $error_response = '{
                "category": "REQUEST",
                "message": "Please enter valid sku"
            }';
            return $error_response;
        }else{
           
                $URL = "".$api_URL."/sell/inventory/v1/offer?sku=".$sku;
        }
        $ch = cURL_init();
        cURL_setopt($ch, CURLOPT_URL, $URL);
        cURL_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        cURL_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        $headers = array();
        $headers[] = "Authorization: Bearer .'$token'.";
        $headers[] = "Accept: application/json";
        $headers[] = 'Content-Language: en-US';
        $headers[] = "Content-Type: application/json";
        cURL_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = cURL_exec($ch);
        if (cURL_errno($ch)) {
            echo 'Error:' . cURL_error($ch);
        }
        cURL_close ($ch);
        return $result;
    }

    public function createEbayOffer($token,$api_URL,$requestOfferData)
    {
        if(!$token){
            $error_response = '{
                    "category": "REQUEST",
                    "message": "Please enter valid Token"
            }';
            return $error_response;
        }else if(!$api_URL){
            $error_response = '{
                    "category": "REQUEST",
                    "message": "Please enter valid api url"
            }';
            return $error_response;
        }else if(!$requestOfferData){
            $error_response = '{
                "category": "REQUEST",
                "message": "Request data can not be null"
            }';
            return $error_response;
        }else{
            
            $URL = "".$api_URL."/sell/inventory/v1/offer";
        }
        $ch = cURL_init();
        cURL_setopt($ch, CURLOPT_URL, $URL);
        cURL_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        cURL_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        $headers = array();
        $headers[] = "Authorization: Bearer .'$token'.";
        $headers[] = "Content-Type: application/json";
        $headers[] = "Content-Language: en-US";
        cURL_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        cURL_setopt($ch, CURLOPT_POSTFIELDS,$requestOfferData);
        $result = cURL_exec($ch);
        $response_code = cURL_getinfo($ch, CURLINFO_HTTP_CODE);
        if (cURL_errno($ch)) {
            echo 'Error:' . cURL_error($ch);
        }
        cURL_close ($ch);
        if($response_code == 204){
            $sucess_response = '{
                "code":204
            }';
            return $sucess_response;
        }else{
            return $result;

        }
    }

    public function updateEbayOffer($token,$api_URL,$requestOfferData,$offerid)
    {
        if(!$token){
            $error_response = '{
                    "category": "REQUEST",
                    "message": "Please enter valid Token"
            }';
            return $error_response;
        }else if(!$api_URL){
            $error_response = '{
                    "category": "REQUEST",
                    "message": "Please enter valid api url"
            }';
            return $error_response;
        }else if(!$requestOfferData){
            $error_response = '{
                "category": "REQUEST",
                "message": "Request data can not be null"
            }';
            return $error_response;
        }else if(!$offerid){
            $error_response = '{
                "category": "REQUEST",
                "message": "offer id can not be null"
            }';
            return $error_response;
        }else{
            
            $URL = "".$api_URL."/sell/inventory/v1/offer/".$offerid;
        }
        $ch = cURL_init();
        cURL_setopt($ch, CURLOPT_URL, $URL);
        cURL_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        cURL_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        $headers = array();
        $headers[] = "Authorization: Bearer .'$token'.";
        $headers[] = "Content-Type: application/json";
        $headers[] = "Content-Language: en-US";
        cURL_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        cURL_setopt($ch, CURLOPT_POSTFIELDS,$requestOfferData);
        $result = cURL_exec($ch);
        $response_code = cURL_getinfo($ch, CURLINFO_HTTP_CODE);
        if (cURL_errno($ch)) {
            echo 'Error:' . cURL_error($ch);
        }
        cURL_close ($ch);
        if($response_code == 204){
            $sucess_response = '{
                "code":204
            }';
            return $sucess_response;
        }else{
            return $result;

        }
    }

    public function publishEbayOffer($token,$api_URL,$offerid)
    {
        if(!$token){
            $error_response = '{
                    "category": "REQUEST",
                    "message": "Please enter valid Token"
            }';
            return $error_response;
        }else if(!$api_URL){
            $error_response = '{
                    "category": "REQUEST",
                    "message": "Please enter valid api url"
            }';
            return $error_response;
        }else if(!$offerid){
            $error_response = '{
                "category": "REQUEST",
                "message": "offer id can not be null"
            }';
            return $error_response;
        }else{
            
            $URL = "".$api_URL."/sell/inventory/v1/offer/".$offerid."/publish";
        }
        $requestOfferData = "";
        $ch = cURL_init();
        cURL_setopt($ch, CURLOPT_URL, $URL);
        cURL_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        cURL_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        $headers = array();
        $headers[] = "Authorization: Bearer .'$token'.";
        $headers[] = "Content-Type: application/json";
        $headers[] = "Content-Language: en-US";
        cURL_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        cURL_setopt($ch, CURLOPT_POSTFIELDS,$requestOfferData);
        $result = cURL_exec($ch);
        $response_code = cURL_getinfo($ch, CURLINFO_HTTP_CODE);
        if (cURL_errno($ch)) {
            echo 'Error:' . cURL_error($ch);
        }
        cURL_close ($ch);
        if($response_code == 204){
            $sucess_response = '{
                "code":204
            }';
            return $sucess_response;
        }else{
            return $result;

        }
    }


    public function getCategory($token,$api_URL)
    {
        if(!$token){
            $error_response = '{
                    "category": "REQUEST",
                    "message": "Please enter valid Token"
            }';
            return $error_response;
        }else if(!$api_URL){
            $error_response = '{
                "category": "REQUEST",
                "message": "Please enter valid URL"
            }';
            return $error_response;
        }else{
           
                $URL = "".$api_URL."/commerce/taxonomy/v1_beta/category_tree/0";
        }
        $ch = cURL_init();
        cURL_setopt($ch, CURLOPT_URL, $URL);
        cURL_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        cURL_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        $headers = array();
        $headers[] = "Authorization: Bearer .'$token'.";
        $headers[] = "Accept: application/json";
        $headers[] = 'Content-Language: en-US';
        $headers[] = "Content-Type: application/json";
        cURL_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = cURL_exec($ch);
        if (cURL_errno($ch)) {
            echo 'Error:' . cURL_error($ch);
        }
        cURL_close ($ch);
        return $result;
    }

    public function deleteEbayOffer($token,$api_URL,$offer_id){
        if(!$token){
            $error_response = '{
                    "category": "REQUEST",
                    "message": "Please enter valid Token"
            }';
            return $error_response;
        }else if(!$api_URL){
            $error_response = '{
                "category": "REQUEST",
                "message": "Please enter valid URL"
            }';
            return $error_response;
        }else if(!$offer_id){
            $error_response = '{
                    "category": "REQUEST",
                    "message": "Please enter valid offer Id"
            }';
            return $error_response;
        }else{
            $URL = "".$api_URL."/sell/inventory/v1/offer/".$offer_id;
            $ch = cURL_init();
            cURL_setopt($ch, CURLOPT_URL, $URL);
            cURL_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            cURL_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
            $headers = array();
            $headers[] = "Authorization: Bearer .'$token'.";
            $headers[] = "Content-Type: application/json";
            $headers[] = "Content-Language: en-US";
            cURL_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $result = cURL_exec($ch);
            $response_code = cURL_getinfo($ch, CURLINFO_HTTP_CODE);
            if (cURL_errno($ch)) {
                echo 'Error:' . cURL_error($ch);
            }
            cURL_close ($ch);
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

    public function getInventoryItemGroup($token,$api_URL,$inventory_item_group_key){
        if(!$token){
            $error_response = '{
                    "category": "REQUEST",
                    "message": "Please enter valid Token"
            }';
            return $error_response;
        }else if(!$api_URL){
            $error_response = '{
                "category": "REQUEST",
                "message": "Please enter valid URL"
            }';
            return $error_response;
        }else if(!$inventory_item_group_key){
            $error_response = '{
                    "category": "REQUEST",
                    "message": "Please enter valid Inventory item group key"
            }';
            return $error_response;
        }else{
            $URL = "".$api_URL."/sell/inventory/v1/inventory_item_group/".$inventory_item_group_key;
            $ch = cURL_init();
            cURL_setopt($ch, CURLOPT_URL, $URL);
            cURL_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            cURL_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            $headers = array();
            $headers[] = "Authorization: Bearer .'$token'.";
            $headers[] = "Content-Type: application/json";
            $headers[] = "Content-Language: en-US";
            cURL_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $result = cURL_exec($ch);
            $response_code = cURL_getinfo($ch, CURLINFO_HTTP_CODE);
            if (cURL_errno($ch)) {
                echo 'Error:' . cURL_error($ch);
            }
            cURL_close ($ch);
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

    public function getEbayPaymentPolicies($token,$api_URL,$registrationMarketplaceId){
        if(!$token){
            $error_response = '{
                    "category": "REQUEST",
                    "message": "Please enter valid Token"
            }';
            return $error_response;
        }else if(!$api_URL){
            $error_response = '{
                "category": "REQUEST",
                "message": "Please enter valid URL"
            }';
            return $error_response;
        }else if(!$registrationMarketplaceId){
            $error_response = '{
                    "category": "REQUEST",
                    "message": "Please enter valid Marketplace Id"
            }';
            return $error_response;
        }else{
            $URL = "".$api_URL."/sell/account/v1/payment_policy?marketplace_id=".$registrationMarketplaceId;
            $ch = cURL_init();
            cURL_setopt($ch, CURLOPT_URL, $URL);
            cURL_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            cURL_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            $headers = array();
            $headers[] = "Authorization: Bearer .'$token'.";
            $headers[] = "Content-Type: application/json";
            $headers[] = "Content-Language: en-US";
            cURL_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $result = cURL_exec($ch);
            $response_code = cURL_getinfo($ch, CURLINFO_HTTP_CODE);
            if (cURL_errno($ch)) {
                echo 'Error:' . cURL_error($ch);
            }
            cURL_close ($ch);
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

    public function getEbayMerchantLocationKey($token,$api_URL){
        if(!$token){
            $error_response = '{
                    "category": "REQUEST",
                    "message": "Please enter valid Token"
            }';
            return $error_response;
        }else if(!$api_URL){
            $error_response = '{
                "category": "REQUEST",
                "message": "Please enter valid URL"
            }';
            return $error_response;
        }else{
            $URL = "".$api_URL."/sell/inventory/v1/location";
            $ch = cURL_init();
            cURL_setopt($ch, CURLOPT_URL, $URL);
            cURL_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            cURL_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            $headers = array();
            $headers[] = "Authorization: Bearer .'$token'.";
            $headers[] = "Content-Type: application/json";
            $headers[] = "Content-Language: en-US";
            cURL_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $result = cURL_exec($ch);
            $response_code = cURL_getinfo($ch, CURLINFO_HTTP_CODE);
            if (cURL_errno($ch)) {
                echo 'Error:' . cURL_error($ch);
            }
            cURL_close ($ch);
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

    public function getEbayReturnPolicies($token,$api_URL,$registrationMarketplaceId){
        if(!$token){
            $error_response = '{
                    "category": "REQUEST",
                    "message": "Please enter valid Token"
            }';
            return $error_response;
        }else if(!$api_URL){
            $error_response = '{
                "category": "REQUEST",
                "message": "Please enter valid URL"
            }';
            return $error_response;
        }else if(!$registrationMarketplaceId){
            $error_response = '{
                    "category": "REQUEST",
                    "message": "Please enter valid Marketplace Id"
            }';
            return $error_response;
        }else{
            $URL = "".$api_URL."/sell/account/v1/return_policy?marketplace_id=".$registrationMarketplaceId;
            $ch = cURL_init();
            cURL_setopt($ch, CURLOPT_URL, $URL);
            cURL_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            cURL_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            $headers = array();
            $headers[] = "Authorization: Bearer .'$token'.";
            $headers[] = "Content-Type: application/json";
            $headers[] = "Content-Language: en-US";
            cURL_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $result = cURL_exec($ch);
            $response_code = cURL_getinfo($ch, CURLINFO_HTTP_CODE);
            if (cURL_errno($ch)) {
                echo 'Error:' . cURL_error($ch);
            }
            cURL_close ($ch);
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

    public function getEbayFulfillmentPolicies($token,$api_URL,$registrationMarketplaceId){
        if(!$token){
            $error_response = '{
                    "category": "REQUEST",
                    "message": "Please enter valid Token"
            }';
            return $error_response;
        }else if(!$api_URL){
            $error_response = '{
                "category": "REQUEST",
                "message": "Please enter valid URL"
            }';
            return $error_response;
        }else if(!$registrationMarketplaceId){
            $error_response = '{
                    "category": "REQUEST",
                    "message": "Please enter valid Marketplace Id"
            }';
            return $error_response;
        }else{
            $URL = "".$api_URL."/sell/account/v1/fulfillment_policy?marketplace_id=".$registrationMarketplaceId;
            $ch = cURL_init();
            cURL_setopt($ch, CURLOPT_URL, $URL);
            cURL_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            cURL_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            $headers = array();
            $headers[] = "Authorization: Bearer .'$token'.";
            $headers[] = "Content-Type: application/json";
            $headers[] = "Content-Language: en-US";
            cURL_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $result = cURL_exec($ch);
            $response_code = cURL_getinfo($ch, CURLINFO_HTTP_CODE);
            if (cURL_errno($ch)) {
                echo 'Error:' . cURL_error($ch);
            }
            cURL_close ($ch);
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

    public function getEbayCategories($token,$api_URL)
    {
        $headers = array();
        $headers[] = "X-EBAY-API-SITEID:0";
        $headers[] = "X-EBAY-API-COMPATIBILITY-LEVEL:967";
        $headers[] = "X-EBAY-API-CALL-NAME:GetCategories";
        $headers[] = "X-EBAY-API-IAF-TOKEN:".$token;
        
        $postData = '<?xml version="1.0" encoding="utf-8"?>
        <GetCategoriesRequest xmlns="urn:ebay:apis:eBLBaseComponents">
            <RequesterCredentials>
            <eBayAuthToken>'.$token.'</eBayAuthToken>
            </RequesterCredentials>
            <ErrorLanguage>en_US</ErrorLanguage>
            <WarningLevel>High</WarningLevel>
                <!--Ensure that site ID, in the Header, is set to the site you want-->
            <DetailLevel>ReturnAll</DetailLevel>
            <ViewAllNodes>true</ViewAllNodes>
        </GetCategoriesRequest>';
        $ch = cURL_init();
        cURL_setopt($ch, CURLOPT_URL, $api_URL."/ws/api.dll");
        cURL_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        cURL_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        cURL_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        cURL_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        $response = cURL_exec($ch);
        cURL_close($ch);
        return json_encode(simplexml_load_string($response));
    }

    public function createOrReplaceInventoryItemGroup($token,$api_URL,$requestItemGroup,$inventoryItemGroupKey)
    {
        if(!$token){
            $error_response = '{
                    "category": "REQUEST",
                    "message": "Please enter valid Token"
            }';
            return $error_response;
        }else if(!$api_URL){
            $error_response = '{
                    "category": "REQUEST",
                    "message": "Please enter valid api url"
            }';
            return $error_response;
        }else if(!$requestItemGroup){
            $error_response = '{
                "category": "REQUEST",
                "message": "Request data can not be null"
            }';
            return $error_response;
        }else if(!$inventoryItemGroupKey){
            $error_response = '{
                "category": "REQUEST",
                "message": "inventory ItemGroup Key can not be null"
            }';
            return $error_response;
        }else{
            
            $URL = "".$api_URL."/sell/inventory/v1/inventory_item_group/".$inventoryItemGroupKey;
        }
        $ch = cURL_init();
        cURL_setopt($ch, CURLOPT_URL, $URL);
        cURL_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        cURL_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        $headers = array();
        $headers[] = "Authorization: Bearer .'$token'.";
        $headers[] = "Content-Type: application/json";
        $headers[] = "Content-Language: en-US";
        cURL_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        cURL_setopt($ch, CURLOPT_POSTFIELDS,$requestItemGroup);
        $result = cURL_exec($ch);
        $response_code = cURL_getinfo($ch, CURLINFO_HTTP_CODE);
        if (cURL_errno($ch)) {
            echo 'Error:' . cURL_error($ch);
        }
        cURL_close ($ch);
        if($response_code == 204){
            $sucess_response = '{
                "code":204
            }';
            return $sucess_response;
        }else{
            return $result;

        }
    }

    public function publishOfferByInventoryItemGroup($token,$api_URL,$requestData)
    {
        if(!$token){
            $error_response = '{
                    "category": "REQUEST",
                    "message": "Please enter valid Token"
            }';
            return $error_response;
        }else if(!$api_URL){
            $error_response = '{
                    "category": "REQUEST",
                    "message": "Please enter valid api url"
            }';
            return $error_response;
        }else if(!$requestData){
            $error_response = '{
                    "category": "REQUEST",
                    "message": "Please enter valid data"
            }';
            return $error_response;
        }else{
            
            $URL = "".$api_URL."/sell/inventory/v1/offer/publish_by_inventory_item_group";
        }
        $ch = cURL_init();
        cURL_setopt($ch, CURLOPT_URL, $URL);
        cURL_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        cURL_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        $headers = array();
        $headers[] = "Authorization: Bearer .'$token'.";
        $headers[] = "Content-Type: application/json";
        $headers[] = "Content-Language: en-US";
        cURL_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        cURL_setopt($ch, CURLOPT_POSTFIELDS,$requestData);
        $result = cURL_exec($ch);
        $response_code = cURL_getinfo($ch, CURLINFO_HTTP_CODE);
        if (cURL_errno($ch)) {
            echo 'Error:' . cURL_error($ch);
        }
        cURL_close ($ch);
        if($response_code == 204){
            $sucess_response = '{
                "code":204
            }';
            return $sucess_response;
        }else{
            return $result;

        }
    }


    public function getEbayRetrunOrders($token,$api_url,$creation_date_range_from,$creation_date_range_to,$limit,$offset){
        if(!$token){
            $error_response = '{
                    "category": "REQUEST",
                    "message": "Please enter valid Token"
            }';
            return $error_response;
        }else if(!$api_url){
            $error_response = '{
                    "category": "REQUEST",
                    "message": "Please enter valid api url"
            }';
            return $error_response;
        }else if(!$creation_date_range_from){
            $error_response = '{
                    "category": "REQUEST",
                    "message": "Please enter valid creation date"
            }';
            return $error_response;
        }else if(!$creation_date_range_to){
            $error_response = '{
                    "category": "REQUEST",
                    "message": "Please enter valid From creation date"
            }';
            return $error_response;
        }else if(!$limit){
            $error_response = '{
                    "category": "REQUEST",
                    "message": "Please enter valid limit"
            }';
            return $error_response;
        }else{
            if(!$offset){
                $offset = 0;
             }
            $URL = "".$api_url."/post-order/v2/return/search?creation_date_range_from="."$creation_date_range_from"."&creation_date_range_to="."$creation_date_range_to"."&limit="."$limit"."&offset="."$offset";
            $ch = cURL_init();
            cURL_setopt($ch, CURLOPT_URL, $URL);
            cURL_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            cURL_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            $headers = array();
            $headers[] = "Authorization: IAF "."$token"."";
            $headers[] = "Content-Type: application/json";
            $headers[] = "Accept: application/json";
            $headers[] = "X-EBAY-C-MARKETPLACE-ID: EBAY_US";
            cURL_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $result = cURL_exec($ch);
            $response_code = cURL_getinfo($ch, CURLINFO_HTTP_CODE);
            if (cURL_errno($ch)) {
                echo 'Error:' . cURL_error($ch);
            }
            cURL_close ($ch);
            return $result;
        }
    }

    public function getEbayOrderById($token,$api_URL,$order_id)
    {
        if(!$token){
            $error_response = '{
                    "category": "REQUEST",
                    "message": "Please enter valid Token"
            }';
            return $error_response;
        }else if(!$api_URL){
            $error_response = '{
                "category": "REQUEST",
                "message": "Please enter valid URL"
            }';
            return $error_response;
        }elseif(!$order_id){
            $error_response = '{
                "category": "REQUEST",
                "message": "Please enter valid Order ID"
            }';
            return $error_response;
        }else{
           
            $URL = "".$api_URL."/sell/fulfillment/v1/order/".$order_id;
            $ch = cURL_init();
            cURL_setopt($ch, CURLOPT_URL, $URL);
            cURL_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            cURL_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            $headers = array();
            $headers[] = "Authorization: Bearer .'$token'.";
            $headers[] = "Accept: application/json";
            $headers[] = "Content-Type: application/json";
            cURL_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $result = cURL_exec($ch);
            if (cURL_errno($ch)) {
                echo 'Error:' . cURL_error($ch);
            }
            cURL_close ($ch);
            return $result;
        }
    }
}