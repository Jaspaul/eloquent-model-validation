<?php

namespace Jaspaul\EloquentModelValidation;

use Illuminate\Validation\ValidationException;
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

    /**
     * Before saving validate our model. If it fails throw an exception.
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function($model)
        {
            if ($model->isInvalid()) {
                throw new ValidationException($model->getErrors());
            }
        });
    }
}
