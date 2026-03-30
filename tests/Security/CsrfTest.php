<?php

namespace Tests\Security;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;
use Config\Services;

/**
 * @internal
 */
final class CsrfTest extends CIUnitTestCase
{
    use FeatureTestTrait;

    protected function setUp(): void
    {
        parent::setUp();
        // Do NOT mock security here, we want to test the real thing
    }

    public function testPostRequestFailsWithoutCsrfToken(): void
    {
        // This should fail (403 Forbidden) if CSRF is enabled and token is missing
        $result = $this->post('/contact', [
            'nome' => 'John Doe',
            'email' => 'john@example.com',
            'telefone' => '123456789',
            'mensagem' => 'Hello',
            'area' => '1'
        ]);

        $result->assertStatus(403);
    }
}
