<?php declare(strict_types=1);

namespace Tests\Application\Actions;

use Tests\TestCase;

class ActionCartTest extends TestCase
{
    public function testAction()
    {
        $app = $this->getAppInstance();
        $request = $this->createRequest('GET', '/cart');
        $response = $app->handle($request);

        $this->assertEquals(200, $response->getStatusCode());
    }
}
