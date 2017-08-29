<?php

namespace Tests;

use Tests\Doubles\ValidModel;
use Illuminate\Database\Eloquent\Model as EloquentModel;
use Jaspaul\EloquentModelValidation\Contracts\Validatable;

class ValidModelTest extends TestCase
{
    public function testItCanBeConstructed()
    {
        $model = new ValidModel();
        $this->assertInstanceOf(EloquentModel::class, $model);
        $this->assertInstanceOf(Validatable::class, $model);
    }

    public function testTheValidModelIsValid()
    {
        $model = new ValidModel();
        $this->assertTrue($model->isValid());
    }

    public function testGetErrorsReturnsAnEmptyMessageBag()
    {
        $model = new ValidModel();
        $errors = $model->getErrors();
        $this->assertTrue($errors->isEmpty());
    }

    public function testValidateDoesNotThrowAValidationException()
    {
        $model = new ValidModel();
        $this->assertVoid($model->validate());
    }

    public function testGetValidationFailureReasonsReturnsAnEmptyArray()
    {
        $model = new ValidModel();
        $this->assertEmpty($model->getValidationFailureReasons());
    }
}
