# ptraing Custom Order Number Module for Adobe Commerce (Magento 2)

## How to install

### 1. Install via composer & update

We recommend you to install Ptraing_CustomOrderNumber module via composer. It is easy to install, update and maintaince.

Run the following command in Adobe Commerce root folder.

#### 1.1 Install

```
composer require ptraing/module-custom-order-number
php bin/magento setup:upgrade
php bin/magento setup:static-content:deploy
```

#### 1.2 Update

```
composer update ptraing/module-custom-order-number
php bin/magento setup:upgrade
php bin/magento setup:static-content:deploy
```

Run compile if your store in Production mode:

```
php bin/magento setup:di:compile
```
