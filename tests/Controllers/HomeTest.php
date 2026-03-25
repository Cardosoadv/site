<?php

namespace Tests\Controllers;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;
use App\Services\CrmContactService;
use Config\Services;

/**
 * @internal
 */
final class HomeTest extends CIUnitTestCase
{
    use FeatureTestTrait;

    protected function setUp(): void
    {
        parent::setUp();

        // Mock the security service to bypass CSRF
        $security = $this->createMock(\CodeIgniter\Security\Security::class);
        $security->method('verify')->willReturn($security);
        $security->method('getHash')->willReturn('fake-hash');
        $security->method('getTokenName')->willReturn('csrf_test_name');
        Services::injectMock('security', $security);
    }

    public function testIndexReturnsViewWithAreas(): void
    {
        // Mock the CrmContactService
        $crmContactServiceMock = $this->createMock(CrmContactService::class);
        $crmContactServiceMock->method('getAreas')
            ->willReturn([
                ['id' => 1, 'area_interesse' => 'Area 1'],
                ['id' => 2, 'area_interesse' => 'Area 2'],
            ]);

        // Register the mock in Services
        Services::injectMock('crmContact', $crmContactServiceMock);

        // Perform the request to the home page
        $result = $this->get('/');

        // Assertions
        $result->assertStatus(200);
        $result->assertSee('Area 1');
        $result->assertSee('Area 2');
    }

    public function testReceiveContactSuccess(): void
    {
        // Mock the CrmContactService
        $crmContactServiceMock = $this->createMock(CrmContactService::class);
        $crmContactServiceMock->expects($this->once())
            ->method('create')
            ->with($this->callback(function ($data) {
                return $data['name'] === 'John Doe' &&
                       $data['email'] === 'john@example.com' &&
                       $data['status'] === 'new';
            }));

        // Register the mock in Services
        Services::injectMock('crmContact', $crmContactServiceMock);

        // Perform the request
        $result = $this->post('/contact', [
            'nome' => 'John Doe',
            'email' => 'john@example.com',
            'telefone' => '123456789',
            'mensagem' => 'Hello',
            'area' => '1'
        ]);

        // Assertions
        $result->assertRedirect();
        $result->assertSessionHas('success', 'Sua mensagem foi enviada com sucesso! Entraremos em contato em breve.');
    }

    public function testReceiveContactValidationError(): void
    {
        // Mock the CrmContactService
        $crmContactServiceMock = $this->createMock(CrmContactService::class);
        $crmContactServiceMock->expects($this->never())
            ->method('create');

        // Register the mock in Services
        Services::injectMock('crmContact', $crmContactServiceMock);

        // Perform the request with missing fields
        $result = $this->post('/contact', [
            'nome' => '',
            'email' => 'invalid-email',
        ]);

        // Assertions
        $result->assertRedirect();
        $result->assertSessionHas('errors');
    }
}
