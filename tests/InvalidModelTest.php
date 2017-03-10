<?php

namespace Tests;

use Tests\Doubles\InvalidModel;
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
}
