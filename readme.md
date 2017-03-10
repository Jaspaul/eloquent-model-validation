# Eloquent Model Validation

This package is an experiment in introducing the concept of [active record validations](http://guides.rubyonrails.org/active_record_validations.html) to Laravel.

## Install

Via Composer

``` bash
$ composer require jaspaul/eloquent-model-validation
```

## Requirements

The following versions of PHP are supported by this version.

* PHP 7.0
* PHP 7.1

## Configuration

#### Option 1

Extend the validation model instead of Eloquent\Model.

```php
<?php

use Jaspaul\EloquentModelValidation\Model;

class Foo extends Model
{
    ...
}
```

#### Option 2

Override `Eloquent` in `config/app.php`

```php
'Eloquent' => Jaspaul\EloquentModelValidation\Model::class,
```

Now you can just do the following:


```php
<?php

class Foo extends Eloquent
{
    ...
}
```

#### Option 3

Update your classes to implement Validatable using the Validates trait provided. You can use this option if extending the provided model isn't an option in your project.

```php
<?php

namespace Jaspaul\EloquentModelValidation;

use Illuminate\Database\Eloquent\Model as Base;
use Jaspaul\EloquentModelValidation\Traits\Validates;
use Jaspaul\EloquentModelValidation\Contracts\Validatable;

abstract class Model extends Base implements Validatable
{
    use Validates;

    /**
     * Returns the data to validate.
     *
     * @return array
     */
    protected function getData() : array
    {
        return $this->getAttributes();
    }
}
```

## Usage

```php
<?php

use Jaspaul\EloquentModelValidation\Model;

class User extends Model
{
    protected function getRules() : array
    {
        return [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ];
    }
}

```

Now if you were storing your model:

```php
public function store()
{
    $user = new User(Input::all());

    try {
        $user->save();
        return $user;
    } catch (\Illuminate\Validation\ValidationException $exception) {
        // You can handle exception, access the errors $exception->getErrors(),
        // or let it bubble up and let the Laravel Exception handler deal with it.

        throw $exception;
    }
}
```
