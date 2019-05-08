<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PropertyTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */

    public function testAddProperty()
    {
        $p = \App\Property::findOrFail(1);
        dd($p);
        $this->assertNotNull($p);
    }
}
