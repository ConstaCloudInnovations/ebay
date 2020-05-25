
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
    $environment = 'sandbox'; //or production
    $creationdate = ''; //creationdate = %5B{yyyy-mm-dd}T08:25:43.511Z..%5D
    $limit = '';
    $offset = '';
    $ebay = new EbayAPI();
    return $ebay->getEbayOrders($token,$environment,$creationdate,$limit,$offset);
}
```
### Get Inventory Items
```php
public function getInventoryItems(){
    $token = 'your_token';
    $environment = 'sandbox'; //or production
    $limit = '';
    $offset = '';
    $ebay = new EbayAPI();
    return $ebay->getEbayInventoryItems($token,$environment,$limit,$offset);
}
```

### Get Inventory Item
```php
public function getInventoryItem(){
    $token = 'your_token';
    $environment = 'sandbox'; //or production
    $ebay = new EbayAPI();
    return $ebay->getEbayInventoryItem($token,$environment,$sku);
}
```

### create or update Inventory Item
```php
public function createUpdateInventory(){
        $token = $this->returnToken();
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
        $environment = 'sandbox'; //or production
        $token = 'your_token';
        $ebay = new EbayAPI();
        return $ebay->createOrUpdateInventoryItem($token,$environment,$sku,$requestProductData);
    }
```

### Delete inventory
```php
public function getInventoryItem(){
    $token = 'your_token';
    $api_URL = "https://api.sandbox.ebay.com"; //or production
    $offer_id = 'your_offer_id';
    $ebay = new EbayAPI();
    return $ebay->deleteEbayOffer($token,$api_URL,$offer_id);
}
```