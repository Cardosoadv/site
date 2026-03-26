<?php

namespace Tests\Controllers;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;
use App\Services\SitemapService;
use Config\Services;

/**
 * @internal
 */
final class SitemapTest extends CIUnitTestCase
{
    use FeatureTestTrait;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testIndex(): void
    {
        // Mock the SitemapService
        $sitemapData = [
            [
                'url' => 'http://localhost/',
                'last_modified' => '2023-10-27',
                'priority' => '1',
                'changefreq' => 'daily'
            ]
        ];

        $sitemapServiceMock = $this->createMock(SitemapService::class);
        $sitemapServiceMock->method('getSitemapLinks')
            ->willReturn($sitemapData);

        // Register the mock in Services
        Services::injectMock('sitemap', $sitemapServiceMock);

        // Perform the request
        $response = $this->get('sitemap.xml');

        // Assertions
        $response->assertStatus(200);
        $response->assertSee('http://localhost/');
        $response->assertSee('2023-10-27');
        $response->assertSee('daily');
        $response->assertSee('1');
    }

    public function testGenerate(): void
    {
        // Mock the SitemapService
        $sitemapServiceMock = $this->createMock(SitemapService::class);
        $sitemapServiceMock->expects($this->once())
            ->method('generateSitemap');

        // Register the mock in Services
        Services::injectMock('sitemap', $sitemapServiceMock);

        // Perform the request
        $response = $this->get('sitemap/generate');

        // Assertions
        $response->assertRedirect();
        $response->assertSessionHas('success', 'Sitemap gerado com sucesso!');
    }
}
