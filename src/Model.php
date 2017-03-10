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
     * Save the model to the database.
     *
     * @throws \Illuminate\Validation\ValidationException
     *         Thrown with errors if the model is invalid.
     *
     * @param array $options
     *        Any additional actions you may want to perform after the save.
     *
     * @return bool
     */
    public function save(array $options = [])
    {
        if ($this->isInvalid()) {
            throw new ValidationException($this->getErrors());
        }

        return parent::save($options);
    }
}
