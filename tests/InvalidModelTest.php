<?php

namespace Tests;

use PDO;
use Mockery;
use PDOStatement;
use Tests\Doubles\InvalidModel;
use Illuminate\Database\SQLiteConnection;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\ConnectionResolverInterface;
use Illuminate\Database\Eloquent\Model as EloquentModel;
use Jaspaul\EloquentModelValidation\Contracts\Validatable;

class InvalidModelTest extends TestCase
{
    public function testItCanBeConstructed()
    {
        $model = new InvalidModel();
        $this->assertInstanceOf(EloquentModel::class, $model);
        $this->assertInstanceOf(Validatable::class, $model);
    }

    public function testTheInvalidModelIsInvalid()
    {
        $model = new InvalidModel();
        $this->assertTrue($model->isInvalid());
    }

    public function testGetErrorsReturnsAMessageBagWithTheEmailKey()
    {
        $model = new InvalidModel();
        $errors = $model->getErrors();

        $this->assertFalse($errors->isEmpty());
        $this->assertTrue($errors->has('email'));
    }

    public function testSaveThrowsAValidationException()
    {
    	$this->expectException(ValidationException::class);

        $model = new InvalidModel();
        $model->save();
    }

    public function testValidateThrowsAValidationException()
    {
    	$this->expectException(ValidationException::class);

        $model = new InvalidModel();
        $model->validate();
    }

    public function testGetValidationFailureReasonsReturnsTheReasonsWhyTheValidationFailed()
    {
        $model = new InvalidModel();
        $reasons = $model->getValidationFailureReasons();

        $this->assertTrue(array_key_exists('email', $reasons));
        $this->assertTrue(array_key_exists('Required', $reasons['email']));
    }
}
