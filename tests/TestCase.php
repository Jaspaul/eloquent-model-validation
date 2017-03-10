<?php

namespace Tests;

use Mockery;
use Illuminate\Validation\Factory;
use Illuminate\Container\Container;
use Illuminate\Translation\Translator;
use PHPUnit\Framework\TestCase as Base;
use Illuminate\Translation\ArrayLoader;

abstract class TestCase extends Base
{
    /**
     * @before
     */
    protected function setUpMockery()
    {
        Mockery::getConfiguration()->allowMockingNonExistentMethods(false);
        Mockery::getConfiguration()->allowMockingMethodsUnnecessarily(false);
    }

    /**
     * @before
     */
    protected function setUpContainer()
    {
        $container = Container::getInstance();

        $container->singleton('translator', function ($container) {
            $loader = new ArrayLoader();
            $locale = 'en';

            $trans = new Translator($loader, $locale);

            return $trans;
        });

        $container->singleton('validator', function($container) {
            $validator = new Factory($container['translator'], $container);
            return $validator;
        });
    }
}
