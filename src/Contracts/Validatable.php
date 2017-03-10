<?php

namespace Jaspaul\EloquentModelValidation\Contracts;

interface Validatable
{
    /**
     * Used to determine if the object is valid.
     *
     * @return bool
     *         true if the object is valid, false otherwise.
     */
    public function isValid() : bool;

    /**
     * Used to determine if the object is invalid.
     *
     * @return bool
     *         true if the object is invalid, false otherwise.
     */
    public function isInvalid() : bool;
}
