<?php

namespace Tests\Controllers\admin;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;
use App\Services\NewsService;
use Config\Services;

/**
 * @internal
 */
final class NoticiasTest extends CIUnitTestCase
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

    public function testUpdateErrorRedirectsBack(): void
    {
        // Define routes without filters to bypass SessionAuth and Shield
        $this->withRoutes([
            ['post', 'admin/noticias/update/(:segment)', 'admin\Noticias::update/$1']
        ]);

        // Mock the NewsService
        $newsServiceMock = $this->createMock(NewsService::class);
        $newsServiceMock->method('updateNews')
            ->willThrowException(new \Exception('Erro ao atualizar a notícia.'));

        // Register the mock in Services
        Services::injectMock('news', $newsServiceMock);

        // Perform the request with valid fields for validation
        $response = $this->post('admin/noticias/update/1', [
            'title'            => 'Updated Title',
            'category_id'      => '1',
            'status'           => 'published',
            'summary'          => 'Updated Summary',
            'content'          => 'Updated Content',
            'category_id'      => 1,
            'status'           => 'published',
            'summary'          => 'Updated Summary',
            'content'          => 'Updated Content'
        ]);

        // Assertions
        $response->assertRedirect();
        $response->assertSessionHas('error', 'Erro ao atualizar a notícia.');
        $this->assertTrue(session()->has('_ci_old_input'));
    }
}
