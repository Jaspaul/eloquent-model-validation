<?php

namespace Jaspaul\EloquentModelValidation\Traits;

use Illuminate\Validation\Factory;
use Illuminate\Container\Container;

trait Validates
{
    /**
     * Returns a list of rules to validate our object properties against.
     *
     * @return array
     */
    abstract protected function getRules() : array;

    /**
     * Returns a list of attributes to validate.
     *
     * @return array
     */
    abstract protected function getAttributes();

    /**
     * Returns a list of validation message overrides.
     *
     * @return array
     */
    protected function getMessages() : array
    {
        return [];
    }

    /**
     * Returns an instance of the validator from our container.
     *
     * @return \Illuminate\Validation\Factory
     */
    protected function getValidationFactory() : Factory
    {
        $container = Container::getInstance();
        return $container->make('validator');
    }

    /**
     * Used to determine if the object is valid.
     *
     * @return bool
     *         true if the object is valid, false otherwise.
     */
    public function isValid() : bool
    {
        return ! $this->isInvalid();
    }

    /**
     * Used to determine if the object is invalid.
     *
     * @return bool
     *         true if the object is invalid, false otherwise.
     */
    public function isInvalid() : bool
    {
        $validator = $this->getValidationFactory()->make(
            $this->getAttributes(),
            $this->getRules(),
            $this->getMessages()
        );
        return $validator->fails();
    }
}
