<?php

namespace Tests\Doubles;

use Jaspaul\EloquentModelValidation\Model;

class InvalidModel extends Model
{
    /**
     * Returns a list of rules to validate our object properties against.
     *
     * @return array
     */
    protected function getRules() : array
    {
        return [
            'email' => 'required'
        ];
    }
}
