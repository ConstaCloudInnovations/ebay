
### Installation:
```bash
$ composer require constacloud/ebay-sdk
```

### Add below line to your controller
```php
use Ebaypackage\EbayAPI;
```

### Get Ebay Orders
```php
public function getOrders(){
    $token = 'your_token';
    $id = 'your_id'; //id can be null
    $PageNumber = 'page_no'; 
    $OrdersPerPage = 'order_per_page';
    $ebay = new EbayAPI();
    return $ebay->getEbayOrders($token,$id,$PageNumber,$OrdersPerPage);
}
```

### Get Inventory Items
```php
public function getInventoryItems(){
    $token = 'your_token';
    $api_URL = "https://api.sandbox.ebay.com"; //or production
    $limit = '';
    $offset = '';
    $ebay = new EbayAPI();
    return $ebay->getEbayInventoryItems($token,$api_URL,$limit,$offset);
}
```

### Get Inventory Item
```php
public function getInventoryItem(){
    $token = 'your_token';
    $api_URL = "https://api.sandbox.ebay.com"; //or production
    $sku = 'sku'; 
    $ebay = new EbayAPI();
    return $ebay->getEbayInventoryItem($token,$api_URL,$sku);
}
```

### create or update Inventory Item
```php
public function createUpdateInventory(){
        $token = "your_token";
        $requestProductData='{
            "product": {
                "title": "Test listing - do not bid or buy - awesome Apple watch test 2",
                "aspects": {
                    "Brand": [
                      "GoPro"
                    ],
                    "Optical Zoom": [
                      "10x",
                      "8x",
                      "4x"
                    ],
                    "Type": [
                      "Helmet/Action"
                    ],
                    "Recording Definition": [
                      "High Definition"
                    ],
                    "Media Format": [
                      "Flash Drive (SSD)"
                    ],
                    "Storage Type": [
                      "Removable"
                    ]
                  },
                "description": "Test listing - do not bid or buy \n Built-in GPS. Water resistance to 50 meters.1 A new lightning-fast dual-core processor. And a display that\u2019s two times brighter than before. Full of features that help you stay active, motivated, and connected, Apple Watch Series 2 is designed for all the ways you move ",
                "upc": ["888462079525"],
                "imageUrls": [
                    "http://store.storeimages.cdn-apple.com/4973/as-images.apple.com/is/image/AppleInc/aos/published/images/S/1/S1/42/S1-42-alu-silver-sport-white-grid?wid=332&hei=392&fmt=jpeg&qlt=95&op_sharpen=0&resMode=bicub&op_usm=0.5,0.5,0,0&iccEmbed=0&layer=comp&.v=1472247758975",
                    "http://store.storeimages.cdn-apple.com/4973/as-images.apple.com/is/image/AppleInc/aos/published/images/4/2/42/stainless/42-stainless-sport-white-grid?wid=332&hei=392&fmt=jpeg&qlt=95&op_sharpen=0&resMode=bicub&op_usm=0.5,0.5,0,0&iccEmbed=0&layer=comp&.v=1472247760390",
                    "http://store.storeimages.cdn-apple.com/4973/as-images.apple.com/is/image/AppleInc/aos/published/images/4/2/42/ceramic/42-ceramic-sport-cloud-grid?wid=332&hei=392&fmt=jpeg&qlt=95&op_sharpen=0&resMode=bicub&op_usm=0.5,0.5,0,0&iccEmbed=0&layer=comp&.v=1472247758007"
                ]
            },
            "condition": "NEW",
            "packageWeightAndSize": {
                "dimensions": {
                    "height": 5,
                    "length": 10,
                    "width": 15,
                    "unit": "INCH"
                },
                "packageType": "MAILING_BOX",
                "weight": {
                    "value": 2,
                    "unit": "POUND"
                }
            },
            "availability": {
                "shipToLocationAvailability": {
                    "quantity": 20
                }
            }
        }';
        $sku = 'new-testing-sku';
        $api_URL = "https://api.sandbox.ebay.com"; //or production
        $token = 'your_token';
        $ebay = new EbayAPI();
        return $ebay->createOrUpdateInventoryItem($token,$api_URL,$sku,$requestProductData);
    }
```
### get ebay offer
```php
public function getEbayOffer(){
    $token = 'your_token';
    $api_URL = "https://api.sandbox.ebay.com"; //or production
    $sku = 'sku';
    $ebay = new EbayAPI();
    return $ebay->deleteEbayOffer($token,$api_URL,$sku);
}
```
### get ebay category
```php
public function getEbayCategory(){
    $token = 'your_token';
    $api_URL = "https://api.sandbox.ebay.com"; //or production
    $ebay = new EbayAPI();
    return $ebay->getCategory($token,$api_URL);
}
```

### Delete inventory offer
```php
public function deleteEbayOffer(){
    $token = 'your_token';
    $api_URL = "https://api.sandbox.ebay.com"; //or production
    $offer_id = 'your_offer_id';
    $ebay = new EbayAPI();
    return $ebay->deleteEbayOffer($token,$api_URL,$offer_id);
}
```

### Get inventory item group
```php
public function getInventoryItemGroup(){
    $token = 'your_token';
    $api_URL = "https://api.sandbox.ebay.com"; //or production
    $inventory_item_group_key = "juicy-apple-s";        
    $offer_id = 'your_offer_id';
    $ebay = new EbayAPI();
    return $ebay->getInventoryItemGroup($token,$api_URL,$inventory_item_group_key);
}
```

### Get payment policies
```php
public function getPaymentPolicies(){
    $token = "your_token";
    $api_url = "https://api.sandbox.ebay.com";
    $registrationMarketplaceId = "EBAY_US";        
    $ebay = new EbayAPI();
    return $ebay->getEbayPaymentPolicies($token,$api_url,$registrationMarketplaceId);
}
```

### Get merchant location
```php
public function getMerchantLocation(){
    $token = "your_token";
    $api_url = "https://api.sandbox.ebay.com";
    $ebay = new EbayAPI();
    return $ebay->getEbayMerchantLocationKey($token,$api_url);
}
```

### Get return policies
```php
public function getReturnPolicies(){
    $token = "your_token";
    $api_url = "https://api.sandbox.ebay.com";
    $registrationMarketplaceId = "EBAY_US";        
    $ebay = new EbayAPI();
    return $ebay->getEbayReturnPolicies($token,$api_url,$registrationMarketplaceId);
}

```

### Get fulfillment policies
```php
public function getFulfillmentPolicies(){
    $token = "your_token";
    $api_url = "https://api.sandbox.ebay.com";
    $registrationMarketplaceId = "EBAY_US";        
    $ebay = new EbayAPI();
    return $ebay->getEbayFulfillmentPolicies($token,$api_url,$registrationMarketplaceId);
}

```

### Get ebay all categories
```php
public function getCategories(){
    $token = "your_token";
    $ebay = new EbayAPI();
    return $ebay->getEbayCategories($token);
}

```

### create offer
```php
public function createOffer(){
    $token = "your_token";
    $api_url = "https://api.sandbox.ebay.com";
    $requestOfferData = '{
        "sku": "29maytest1",
        "marketplaceId": "EBAY_US",
        "format": "FIXED_PRICE",
        "listingDescription": "<ul><li><font face=\"Arial\"><span style=\"font-size: 18.6667px;\"><p class=\"p1\">Test listing - do not bid or buy&nbsp;<\/p><\/span><\/font><\/li><li><p class=\"p1\">Built-in GPS.&nbsp;<\/p><\/li><li><p class=\"p1\">Water resistance to 50 meters.<\/p><\/li><li><p class=\"p1\">&nbsp;A new lightning-fast dual-core processor.&nbsp;<\/p><\/li><li><p class=\"p1\">And a display that\u2019s two times brighter than before.&nbsp;<\/p><\/li><li><p class=\"p1\">Full of features that help you stay active, motivated, and connected, Apple Watch Series 2 is designed for all the ways you move<\/p><\/li><\/ul>",
        "availableQuantity": 100,
        "quantityLimitPerBuyer": 100,
        "pricingSummary": {
            "price": {
                "value": 10.99,
                "currency": "USD"
            }
        },
        "listingPolicies": {
            "fulfillmentPolicyId": "6116524000",
            "paymentPolicyId": "6116510000",
            "returnPolicyId": "6116518000"
        },
        "categoryId": "20184",
        "merchantLocationKey": "location2",
        "tax": {
            "vatPercentage": 10.2,
            "applyTax": false,
            "thirdPartyTaxCategory": "Electronics"
        }
    }';
    $ebay = new EbayAPI();
    return $ebay->createEbayOffer($token,$api_url,$requestOfferData);
}
```

### update offer
```php
public function updateOffer(){
    $token = $this->returnToken();
    $api_url = "https://api.sandbox.ebay.com";
    $requestOfferData = '{
        "sku": "29maytest1",
        "marketplaceId": "EBAY_US",
        "format": "FIXED_PRICE",
        "listingDescription": "<ul><li><font face=\"Arial\"><span style=\"font-size: 18.6667px;\"><p class=\"p1\">Test listing - do not bid or buy&nbsp;<\/p><\/span><\/font><\/li><li><p class=\"p1\">Built-in GPS.&nbsp;<\/p><\/li><li><p class=\"p1\">Water resistance to 50 meters.<\/p><\/li><li><p class=\"p1\">&nbsp;A new lightning-fast dual-core processor.&nbsp;<\/p><\/li><li><p class=\"p1\">And a display that\u2019s two times brighter than before.&nbsp;<\/p><\/li><li><p class=\"p1\">Full of features that help you stay active, motivated, and connected, Apple Watch Series 2 is designed for all the ways you move<\/p><\/li><\/ul>",
        "availableQuantity": 90,
        "quantityLimitPerBuyer": 80,
        "pricingSummary": {
            "price": {
                "value": 10.99,
                "currency": "USD"
            }
        },
        "listingPolicies": {
            "fulfillmentPolicyId": "6116524000",
            "paymentPolicyId": "6116510000",
            "returnPolicyId": "6116518000"
        },
        "categoryId": "20184",
        "merchantLocationKey": "location2",
        "tax": {
            "vatPercentage": 10.2,
            "applyTax": false,
            "thirdPartyTaxCategory": "Electronics"
        }
    }';
    $offerid = 7485411010;
    $ebay = new EbayAPI();
    return $ebay->updateEbayOffer($token,$api_url,$requestOfferData,$offerid);
}
```
### Create or update inventory group item
```php
public function createUpdateInventoryItemGroup(){
    $token = $this->returnToken();
    $api_url = "https://api.sandbox.ebay.com";
    $requestItemGroup = '{ 
        "title": "Mens Solid Polo",
        "description": "Mens solid polo shirts in five colors (Green, Blue, Red, Black, and White), and sizes ranges from small to XL.",
        "imageUrls": [
            "http://i.ebayimg.com/images/i/152196556219-0-1/s-9005.jpg"
            ],
        
        "variantSKUs": [
            "sample-product",
            "sample-product1"
            ],
        "variesBy":
            { 
            "aspectsImageVariesBy": [
                "Color",
                "Size"
                ],
            "specifications": [
                { 
                "name": "Color",
                "values": [
                    "Green",
                    "Blue",
                    "Red",
                    "Black",
                    "White"
                    ]
                },
                { 
                "name": "Size",
                "values": [
                    "Small",
                    "Medium",
                    "Large",
                    "Extra-Large"
                ]
                }
                ]
            }
        }';
    $inventoryItemGroupKey = "apitestingkey";
    $ebay = new EbayAPI();
    return $ebay->createOrReplaceInventoryItemGroup($token,$api_url,$requestItemGroup,$inventoryItemGroupKey);
}
```

### Publish Inventory item group
```php
public function publishInventoryItemGroup(){
    $token = $this->returnToken();
    $api_url = "https://api.sandbox.ebay.com";
    $requestData = '{ 
        "inventoryItemGroupKey" : "apitestingkey",
        "marketplaceId" : "EBAY_US"
        }';
    $ebay = new EbayAPI();
    return $ebay->publishOfferByInventoryItemGroup($token,$api_url,$requestData);
}
```

### get return orders
```php
public function getRetrunOrders(){
    $token = "your_token";
    $api_url = "https://api.ebay.com";
    $creation_date_range_from ="2019-01-15T03:52:39.000Z";
    $creation_date_range_to ="2020-06-16T03:52:39.000Z";
    $limit =100;
    $offset =0;
    $ebay = new EbayAPI();
    return $ebay->getEbayRetrunOrders($token,$api_url,$creation_date_range_from,$creation_date_range_to,$limit,$offset);
}
```