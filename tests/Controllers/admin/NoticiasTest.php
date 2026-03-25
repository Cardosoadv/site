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
    }

    public function testUpdateErrorRedirectsBack(): void
    {
        // Mock the NewsService
        $newsServiceMock = $this->createMock(NewsService::class);
        $newsServiceMock->method('updateNews')
            ->willThrowException(new \Exception('Erro ao atualizar a notícia.'));

        // Register the mock in Services
        Services::injectMock('news', $newsServiceMock);

        // Define withFilters as it was likely a custom method or from a previous CI version
        // Actually, we can just use $this->withRoutes to define a route without filters
        $this->withRoutes([
            ['POST', 'admin/noticias/update/1', 'admin\Noticias::update/1']
        ]);

        // Perform the request
        $response = $this->withSession([])
            ->post('admin/noticias/update/1', [
            'title' => 'Updated Title',
            'category_id' => '1',
            'status' => 'published',
            'summary' => 'Updated Summary',
            'content' => 'Updated Content',
            csrf_token() => csrf_hash()
        ]);

        // Assertions
        $response->assertRedirect();
        $response->assertSessionHas('error', 'Erro ao atualizar a notícia.');
        $this->assertTrue(session()->has('_ci_old_input'));
    }
}
