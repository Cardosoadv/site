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

        // Mock security to skip CSRF
        $securityMock = $this->getMockBuilder('CodeIgniter\Security\Security')
            ->setConstructorArgs([config('Security')])
            ->onlyMethods(['verify'])
            ->getMock();
        $securityMock->method('verify')->willReturn($securityMock);
        Services::injectMock('security', $securityMock);

        // Perform the request with full data to pass validation
        $response = $this->withRoutes([
            ['POST', 'admin/noticias/update/(.*)', 'admin\Noticias::update/$1']
        ])->post('admin/noticias/update/1', [
            'title'            => 'Updated Title',
            'category_id'      => 1,
            'status'           => 'published',
            'summary'          => 'Updated Summary',
            'content'          => 'Updated Content',
            'meta_title'       => 'Updated Meta Title',
            'meta_description' => 'Updated Meta Description',
            'published_at'     => '2023-10-27T10:00'
        ]);

        // Assertions
        $response->assertRedirect();
        $response->assertSessionHas('error', 'Erro ao atualizar a notícia.');

        // Check if it has old input (withInput())
        // In CI4 FeatureTest, we can check the session for '_ci_old_input'
        $this->assertTrue(session()->has('_ci_old_input'));
    }
}
