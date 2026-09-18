<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function test_application_root_responds_successfully(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertJsonPath('application', 'NYVA');
    }
}
