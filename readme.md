# RegExpressions

Just For Fun And Learning Proposes

## Instlation
```bash
$ composer require ''
```
## Use The Expression Class
RegExpressions Has Api For Testing The RegEx And Can Convert Easily To String


```php
<?php

use RegExpressions\Expression;

class MyClass
{
    public function someMethods()
    {
        $regex = Expression::make()->find('www');

        if (preg_match((string) $regex, 'www')) {
            # code...
        }

        $regex = Expression::make()->then('google');

        if (preg_match((string) $regex, 'google')) {
            # code...
        }
    }
}

```

RegExpressions Has Api For Testing And Returning **Boolean** Result


```php
<?php

use RegExpressions\Expression;

class MyClass
{
    public function someMethoods()
    {
        $regex = Expression::make()->anything();
        if ($regex->test('foo')) {
            # code...
        }
    }
}
```

## APis

For Find A String Use

```php 
// then() is aliase for find()
$regex->find('foo')->then('bar');
```

For Find Anything Use

```php 
$regex->anything();
```

For Find Anything But Not The Given String Use 

```php 
$regex->anythingBut('baz');
```

For Maybe Find Anything Use 

```php 
// optional() is an alias for maybe() 
$regex->maybe('baz')->optional('');
```

For Logging Your Expressions In Run Time Use 

```php 
$regex->find('foo')->anythingBut('bar')->maybe('baz');
var_dumb($regex->log());
```