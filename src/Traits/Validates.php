<?php

namespace Jaspaul\EloquentModelValidation\Traits;

use Illuminate\Validation\Factory;
use Illuminate\Container\Container;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Support\MessageProvider;

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
     * The validator.
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    private $validator;

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
        if (is_null($this->validator)) {
            $this->validator = $this->getValidationFactory()->make(
                $this->getData(),
                $this->getRules(),
                $this->getMessages()
            );
        }
        return $this->validator;
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
     * Used to validate the model.
     *
     * @throws \Illuminate\Validation\ValidationException
     *         Thrown if the model is not valid.
     *
     * @return void
     */
    public function validate()
    {
        if ($this->isInvalid()) {
            throw new ValidationException($this->getValidator());
        }
    }

    /**
     * Returns a Message Provider containing the errors for the model validation.
     *
     * @return \Illuminate\Contracts\Support\MessageProvider
     */
    public function getErrors() : MessageProvider
    {
        return $this->getValidator()->getMessageBag();
    }

    /**
     * Returns the reasons why the validator failed.
     *
     * @return array
     */
    public function getValidationFailureReasons() : array
    {
        if ($this->isInvalid()) {
            return $this->getValidator()->failed();
        }
        return [];
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
        $this->validate();
        return parent::save($options);
    }
}
