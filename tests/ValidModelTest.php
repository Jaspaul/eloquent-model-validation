<?php

namespace Tests;

use Tests\Doubles\ValidModel;
use Illuminate\Database\Eloquent\Model as EloquentModel;
use Jaspaul\EloquentModelValidation\Contracts\Validatable;

class ModelTest extends TestCase
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
}
