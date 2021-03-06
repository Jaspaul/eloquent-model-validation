<?php

namespace Jaspaul\EloquentModelValidation\Contracts;

use Illuminate\Contracts\Support\MessageProvider;

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

    /**
     * Returns a Message Provider containing the errors for the model validation.
     *
     * @return \Illuminate\Contracts\Support\MessageProvider
     */
    public function getErrors() : MessageProvider;

    /**
     * Returns the reasons why the validator failed.
     *
     * @return array
     */
    public function getValidationFailureReasons() : array;
}
