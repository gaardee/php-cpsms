# php-cpsms

This package can be used to send packages via cpsms API v2. https://api.cpsms.dk/documentation/index.html

Read more about cpsms here: http://www.cpsms.dk

## Example

```php
$sms = new sms('myUsername', 'apiKey');
$sms->recipient = '12345678';
$sms->sender = 'Sender';
$sms->message = 'Test message';
$sms->send();
```

or
