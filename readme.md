# Omnivore Facade 🍹

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads] 
[![php](https://img.shields.io/badge/php-~7.3.12-777BB4.svg?logo=php&logoColor=white&style=for-the-badge)](http://php.net/) [ ![Laravel](https://img.shields.io/badge/Laravel-~6.6.1-E74430.svg?logo=laravel&logoColor=white&style=for-the-badge)](https://laravel.com/)

## Installation

Via Composer

``` bash
$ composer require lfrichter/omnivore
```

If you do not run Laravel 5.5 (or higher), then add in config/app.php:
1. service provider:
```
lfrichter\omnivore\omnivoreServiceProvider::class,
```
2. facade to aliases:
```
'Omnivore' => lfrichter\omnivore\Facades\omnivore::class,
```

## Usage

Place these values into your `.ENV`
```
OMNIVORE_API_URL=
OMNIVORE_API_KEY=
OMNIVORE_LOCATION_ID=
ES_FROM=
ES_SIZE=
```


### Tickets functions

Interact with tickets of claimed locations from the POS.

#### List tickets for location

```php
$ticketList = Omnivore::tickets()->ticketList($locationId);
```

#### Open a new ticket

```php
$ticketOpen = Omnivore::tickets()->ticketOpen($locationId, $content);
```

#####  Omnivore documentation

To open a new ticket you'll need the following:

- a valid employee id for the Location — we'll use EMPLOYEEID
- a valid order type id for the Location — we'll use ORDERTYPEID
- a valid revenue center id for the Location — we'll use REVENUECENTERID
- a valid table id for the Location — we'll use TABLEID

###### Sample JSON object to be send

```
{
    "employee": "EMPLOYEEID",
    "order_type": "ORDERTYPEID",
    "revenue_center": "REVENUECENTERID",
    "table": "TABLEID",
    "guest_count": 1,
    "name": "New Ticket",
    "auto_send": true
}
```
You should get a **201** CREATED HTTP response to let you know your ticket has been added. You'll also get the ticket id field in the response which you need to add menu items or make payments.

###### Don't Send Items to the Kitchen

Did you notice the auto_send field we used when we opened the ticket? It determines whether new menu items are sent to the kitchen immediately, or if they're held until the ticket is paid. By default it's true which means as soon as you add a menu item to the ticket it will be made by the restaurant. If you set it to false nothing will be made until the ticket is paid in full and closed.


#### Retrieve data for a specific ticket

```php
$ticketRetrieve = Omnivore::tickets()->ticketRetrieve($locationId, $ticketId);
```

#### Void a locations ticket

```php
$ticketVoid = Omnivore::tickets()->ticketVoid($locationId, $ticketId);
```

#### List discounts for a ticket

```php
$ticketDiscountList = Omnivore::tickets()->ticketDiscountList($locationId, $ticketId);
```

#### Apply a discount to a ticket

```php
$ticketDiscountApply = Omnivore::tickets()->ticketDiscountApply($locationId, $ticketId, $discount, $value);
```

#### Retrieve a discount that was applied to a ticket

```php
$ticketDiscountRetrieve = Omnivore::tickets()->ticketDiscountRetrieve($locationId, $ticketId, $ticketDiscountId);
```
#### List items on a ticket

```php
$ticketItemList = Omnivore::tickets()->ticketItemList($locationId, $ticketId);
```
You'll get a list of menu items each with two important pieces of information:

- the menu item `id`
- the list of acceptable `price_levels` for the item

#### Add an item to a ticket

```php
$ticketItemAdd = Omnivore::tickets()->ticketItemAdd($locationId, $ticketId, $content);
```

#####  Omnivore documentation

For this example pick an item that looks tasty and note its `id` then choose an arbitrary `price_levels` element and note its `id` as well. We'll refer to them as **MENUITEMID** and **PRICELEVELID** respectively. Now, let's place an order on the ticket from earlier. 

###### Sample JSON object to be send

```
{
    "menu_item": "MENUITEMID",
    "quantity": 1,
    "price_level": "PRICELEVELID",
    "comment": "Get in my belly!",
    "modifiers": []
}
```

###### Making an Order with Modifiers

Let's say you've picked out a menu item, looked up its modifier groups, and figured out which modifiers you want to apply. You've noted all the modifier id values and the id for the appropriate price_level on each one. That's a lot, but now you're ready to place a personalized order.

###### Sample JSON object to be send

```
{
    "menu_item": "MENUITEMID",
    "quantity": 1,
    "price_level": "PRICELEVELID",
    "comment": "Get in my belly!",
    "modifiers": [
        {
            "modifier": "MODIFIERID",
            "quantity": 1,
            "price_level": "PRICELEVELID",
            "comment": "on the side"
        },
        {
            "modifier": "MODIFIERID",
            "quantity": 1,
            "price_level": "PRICELEVELID",
            "comment": "extra"
        }
    ]
}
```

#### Retrieve an item from a ticket

```php
$ticketItemRetrieve = Omnivore::tickets()->ticketItemRetrieve($locationId, $ticketId, $ticketItemId);
```

#### Void an item from a ticket

```php
$ticketItemVoid = Omnivore::tickets()->ticketItemVoid($locationId, $ticketId, $ticketItemId)
```

#### List modifiers form a ticket

```php
$ticketItemModifierList = Omnivore::tickets()->ticketItemModifierList($locationId, $ticketId, $ticketItemId)
```

#### Retrieve a modifier form a ticket

```php
$ticketItemModifierRetrieve = Omnivore::tickets()->ticketItemModifierRetrieve($locationId, $ticketId, $ticketItemId, $ticketItemModifierId)
```

#### List dicounts on a ticket

```php
$ticketItemDiscountList = Omnivore::tickets()->ticketItemDiscountList($locationId, $ticketId, $ticketItemId)
```

#### Retrieve a discount from a ticket

```php
$ticketItemDiscountRetrieve = Omnivore::tickets()->ticketItemDiscountRetrieve($locationId, $ticketId, $ticketItemId, $ticketItemDiscountId)
```

#### List payments

```php
$paymentList = Omnivore::tickets()->paymentList($locationId, $ticketId)
```

#### Retrieve a payment

```php
$paymentRetrieve = Omnivore::tickets()->paymentRetrieve($locationId, $ticketId, $paymentId)
```

#### Make a payment where a card is not present

```php
$paymentCardNotPresent = Omnivore::tickets()->paymentCardNotPresent($locationId, $ticketId, $content)
```
##### Sample JSON object to be send

```
{
    "type": "card_not_present",
    "amount": 500,
    "tip": 100,
    "card_info": {
        "exp_month": 1,
        "exp_year": 2025,
        "cvc2": 123,
        "number": "4111111111111111"
    }
}
```

#### Make a payment where a card is present

```php
$paymentCardPresent = Omnivore::tickets()->paymentCardPresent($locationId, $ticketId, $content)
```

##### Sample JSON object to be send

```
{
    "type": "card_present",
    "amount": 500,
    "tip": 100,
    "card_info": {
        "data": "%B4111111111111111^SCHMOE /JOE^180710100695000000?"
    }
}
```

#### Make a payment with a 3rd party

```php
$payment3rdParty = Omnivore::tickets()->payment3rdParty($locationId, $ticketId, $content)
```

##### Sample JSON object to be send

```
{
    "type": "3rd_party",
    "amount": 500,
    "tip": 100,
    "tender_type": TENDERTYPEID,
    "payment_source": "put your transaction reference here"
}
```

#### Make a payment with a card

```php
$paymentGiftCard = Omnivore::tickets()->paymentGiftCard($locationId, $ticketId, $content)
```

##### Sample JSON object to be send

```
{
    "type": "gift_card",
    "amount": 500,
    "tip": 100,
    "card_info": {
        "number": "1111111111111111"
    }
}
```

#### Make a payment with cash

```php
$paymentCash = Omnivore::tickets()->paymentCash($locationId, $ticketId, $content)
```


---
### Tables functions

Interact with tables of claimed locations from the POS.


#### List tables of claimed locations

```php
$tableList = Omnivore::tables()->tableList($locationId)
```

#### Retrieve data for a specific table

```php
$tableRetrieve = Omnivore::tables()->tableRetrieve($locationId, $tableId)
```


---
### General functions

Interact with general labeled actions of claimed locations from the POS.


#### List all locations claimed.

```php
$locations = Omnivore::general()->locationList();
```

#### Retrieve information about a location

```php
$locationRetrieve = Omnivore::general()->locationRetrieve($locationId)
```

#### List employees of a location

```php
$employeeList = Omnivore::general()->employeeList($locationId)
```

#### Retrieve data of a specific location

```php
$employeeRetrieve = Omnivore::general()->employeeRetrieve($locationId, $employeeId)
```

#### List location types (Order Types)

```php
$orderTypeList = Omnivore::general()->orderTypeList($locationId)
```

#### Retrieve a locations type

```php
$orderTypeRetrieve = Omnivore::general()->orderTypeRetrieve($locationId, $orderTypeId)
```

#### List the types of tender the location accepts

```php
$tenderTypeList = Omnivore::general()->tenderTypeList($locationId)
```

#### Retrive the tender type

```php
$tenderTypeRetrieve = Omnivore::general()->tenderTypeRetrieve($locationId, $tenderTypeId)
```

#### List a locations revenue centers

```php
$revenueCenterList = Omnivore::general()->revenueCenterList($locationId)
```

#### Retrieve information of a payment center

```php
$revenueCenterRetrieve = Omnivore::general()->revenueCenterRetrieve($locationId, $revenueCenterId)
```

#### List the discounts of a location

```php
$discountList = Omnivore::general()->discountList($locationId)
```

#### Retrieve the discount

```php
$discountRetrieve = Omnivore::general()->discountRetrieve($locationId, $discountId)
```

#### Grab the menu from POS

```php
$menu = Omnivore::general()->menu($locationId)
```

#### List the menu categories

```php
$categoryList = Omnivore::general()->categoryList($locationId)
```

#### Retrieve a category

```php
$categoryRetrieve = Omnivore::general()->categoryRetrieve($locationId, $categoryId)
```

#### List items in a menu

```php
$menuItemList = Omnivore::general()->menuItemList($locationId)
```

#### Retrieve a menu item

```php
$menuItemRetrieve = Omnivore::general()->menuItemRetrieve($locationId, $menuItemId)
```

#### List location modifiers 

```php
$modifierList = Omnivore::general()->modifierList($locationId)
```

#### Retrieve a modifier

```php
$modifierRetrieve = Omnivore::general()->modifierRetrieve($locationId, $modifierId)
```

#### List modifier groups

```php
$modifierGroupList = Omnivore::general()->modifierGroupList($locationId, $menuItemId)
```

#### Retrieve a modifier group

```php
$modifierGroupRetrieve = Omnivore::general()->modifierGroupRetrieve($locationId, $menuItemId, $modifierGroupId)
```



## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Security

If you discover any security related issues, please email author email instead of using the issue tracker.

## Credits

- [Luis Fernando Richter](https://github.com/lfrichter)
- This package was based in [Onivore](https://github.com/SapioBeasley/omnivore) from [Andreas Beasley](https://github.com/SapioBeasley)

## License

license. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/lfrichter/omnivore.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/lfrichter/omnivore.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/lfrichter/omnivore/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/12345678/shield

[link-packagist]: https://packagist.org/packages/lfrichter/omnivore
[link-downloads]: https://packagist.org/packages/lfrichter/omnivore
[link-travis]: https://travis-ci.org/lfrichter/omnivore
[link-styleci]: https://styleci.io/repos/12345678
[link-author]: https://github.com/lfrichter
[link-contributors]: ../../contributors

