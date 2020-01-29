# php-cpsms

This package can be used to send packages via cpsms API v2. https://api.cpsms.dk/documentation/index.html

Read more about cpsms here: http://www.cpsms.dk

## Send sms

```php
$sms = new sms('apiKey');
$sms->recipient = '12345678';
$sms->sender = 'Sender';
$sms->message = 'Test message';
$sms->send();
```

## Check credits

```php
$sms = new SMS('apiKey');
$sms->credits();
```
