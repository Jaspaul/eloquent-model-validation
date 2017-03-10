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
