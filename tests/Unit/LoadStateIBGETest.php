<?php

namespace Tests\Unit;

use App\Services\LoadStatesIBGEService;
use Tests\TestCase;

class LoadStateIBGETest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testLoadDataFromIbgeApi()
    {
        $repository = app(LoadStatesIBGEService::class);

        $result = $repository->loadStates();

        $this->assertTrue($result);

    }
}
