Protobuff Logger
================

*Experimental project*

A minimal PSR-3 compliant logger using [Protocol Buffers](https://developers.google.com/protocol-buffers/).

## Usage

```php
use JDecool\ProtoLogger\Logger;
use JDecool\ProtoLogger\Handler\StreamHandler;

$logger = new Logger(StreamHandler::createFromUrl('/tmp/prod.log'));
$logger->debug('This is a test');
```
