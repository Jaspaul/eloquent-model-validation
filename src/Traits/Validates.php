<?php

namespace Jaspaul\EloquentModelValidation\Traits;

use Illuminate\Validation\Factory;
use Illuminate\Container\Container;
use Illuminate\Contracts\Support\MessageBag;
use Illuminate\Contracts\Validation\Validator;

trait Validates
{
    /**
     * Returns a list of rules to validate our object properties against.
     *
     * @return array
     */
    abstract protected function getRules() : array;

    /**
     * Returns the data to validate.
     *
     * @return array
     */
    abstract protected function getData() : array;

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
    private function getValidationFactory() : Factory
    {
        $container = Container::getInstance();
        return $container->make('validator');
    }

    /**
     * Returns a validator pre-populated with our attributes, rules, and custom messages.
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    private function getValidator() : Validator
    {
        return $this->getValidationFactory()->make(
            $this->getData(),
            $this->getRules(),
            $this->getMessages()
        );
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
        return $this->getValidator()->fails();
    }

    /**
     * Returns a Message Bag containing the errors for the model validation.
     *
     * @return \Illuminate\Contracts\Support\MessageBag
     */
    public function getErrors() : MessageBag
    {
        return $this->getValidator()->getMessageBag();
    }
}
