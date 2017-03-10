<?php

namespace Tests;

use Tests\Doubles\Model;
use Illuminate\Database\Eloquent\Model as EloquentModel;
use Jaspaul\EloquentModelValidation\Contracts\Validatable;

class ModelTest extends TestCase
{
    public function testItCanBeConstructed()
    {
        $model = new Model();
        $this->assertInstanceOf(EloquentModel::class, $model);
        $this->assertInstanceOf(Validatable::class, $model);
    }
}
