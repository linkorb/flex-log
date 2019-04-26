# flex-log
FlexLog: flexible configurable logging for your applications

Allows reconfiguring the handlers, processor and formatters of your application's loggers through environment variables and config files.

FlexLog is a very thin wrapper around the awesome [monolog-cascade](https://github.com/theorchard/monolog-cascade) library.

It adds:

* simple initialization based on the config file specified by the `FLEX_LOG` environment variable
* ensures that all loggers your application expects are always added to Monolog's Registry, even if no cascade config file is used, or it misses a definition for that logger name.

## Configuration

```
## Specify a cascade config file (yaml):
FLEX_LOG=/path/to/my/cascade.yaml
```

## Usage

At the earliest entry point in your application (index.php, bootstap.php, etc), add the following line to initialize FlexLog:

```php
use FlexLog\FlexLog;

FlexLog::initFromEnv()
FlexLog::ensureLoggers(['app', 'db', 'caching']); // ensures that loggers with these names exist and are registered
```

Then, from anywhere in your app, log to monolog as usual. For example by using Monolog's registry:

```php
$username = 'joe';
\Monolog\Registry::app()->info("User {username} logged in", ['username' => $username]);
```

A fully working example can be found in the test cases in `tests/`

## Tests
```
./vendor/bin/phpunit --bootstrap vendor/autoload.php tests/
```

## Links

* [Monolog Cascade](https://github.com/theorchard/monolog-cascade)
* [Monolog](https://github.com/Seldaek/monolog)
