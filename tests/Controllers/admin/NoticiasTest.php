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

        // Bypass CSRF and session filters during testing
        $this->withFilters([]);
    }

    public function testUpdateErrorRedirectsBack(): void
    {
        // Mock the NewsService
        $newsServiceMock = $this->createMock(NewsService::class);
        $newsServiceMock->method('updateNews')
            ->willThrowException(new \Exception('Erro ao atualizar a notícia.'));

        // Register the mock in Services
        Services::injectMock('news', $newsServiceMock);

        // Perform the request
        $response = $this->post('admin/noticias/update/1', [
            'title' => 'Updated Title',
            'content' => 'Updated Content'
        ]);

        // Assertions
        $response->assertRedirect();
        $response->assertSessionHas('error', 'Erro ao atualizar a notícia.');

        // Check if it has old input (withInput())
        // In CI4 FeatureTest, we can check the session for '_ci_old_input'
        $this->assertTrue(session()->has('_ci_old_input'));
    }
}
