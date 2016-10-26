# ShoppingCart
Simple Shopping Cart in PHP

# How to use

Sample index.php file

```
<?php
    // import the class
    define('__ROOT__', dirname(dirname(__FILE__)));
    require_once(__ROOT__.'/Cart.class.php');

    // instantiate a new cart and add some items
    $cart = new Cart();
    $cart->addItems(1, ['name' => 'Apple', 'price' => 150]);
    $cart->addItems(2, ['name' => 'Pochi', 'age' => 13]);
    $cart->addItems(3, ['title' => 'Amazing journey', 'quantity' => 2]);
    $cart->addItems(4, ['object' => 'box', 'width' => 150]);

    // echoing some info
    $item = $cart->getItemsData(3);
    echo $item->_itemData['title'];
```
