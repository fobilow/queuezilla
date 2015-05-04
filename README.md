QueueZilla
=======
QueueZilla is a simple framework that enables you to write MySQL queue consumers quickly and neatly. It enforces key methods via an interface
so you can right clean code

### Installation
Run `composer require fobilow/queuezilla 1.*` or add `"fobilow/queuezilla" :"1.*"` to your `composer.json`.

### Usage
You will need to create a consumer class that extends the `MySQLQueueConsumer` e.g `MyConsumer` and implement the following methods
 - getLockedJob();
 - getNewJob();
 - doJob();
 - completeJob();
 - takeABreak()

Then in your CLI script or calling script you call it like this

```PHP
use QueueZilla\Framework\Queue\MySQLQueueConsumer;

$queueConsumer = new MyConsumer();
$queueConsumer->setProcessId('someId'); //maybe a combination of hostname
$queueConsumer->consume();
```

### Contributing
If you find a bug or want to improve the code in any way, please submit a pull request

Failing that, just create an issue with the bug you have found, and I'll take it from there :)

