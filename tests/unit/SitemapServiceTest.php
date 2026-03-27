<?php

namespace Tests\Unit;

use App\Services\SitemapService;
use App\Repositories\SitemapRepository;
use App\Services\NewsService;
use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Config\Services;
use CodeIgniter\Cache\CacheInterface;

/**
 * @internal
 */
final class SitemapServiceTest extends CIUnitTestCase
{
    private $repositoryMock;
    private $newsServiceMock;
    private $cacheMock;
    private $service;

    protected function setUp(): void
    {
        parent::setUp();

        $this->repositoryMock = $this->getMockBuilder(SitemapRepository::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['findAll', 'truncate', 'createBatch'])
            ->getMock();

        $this->newsServiceMock = $this->createMock(NewsService::class);
        $this->cacheMock = $this->createMock(CacheInterface::class);

        Services::injectMock('cache', $this->cacheMock);

        $this->service = new class($this->repositoryMock, $this->newsServiceMock, $this->cacheMock) extends SitemapService {
            public function __construct($repository, $newsService, $cache) {
                $this->repository = $repository;
                $this->newsService = $newsService;
                $this->cron = $cache;
            }
        };
    }

    public function testGetSitemapLinksFromCache(): void
    {
        $cachedData = [['url' => 'http://example.com/cached']];
        $this->cacheMock->expects($this->once())
            ->method('get')
            ->with('sitemap')
            ->willReturn($cachedData);

        $this->repositoryMock->expects($this->never())->method('findAll');

        $result = $this->service->getSitemapLinks();
        $this->assertEquals($cachedData, $result);
    }

    public function testGetSitemapLinksGeneratesWhenNoCache(): void
    {
        $this->cacheMock->expects($this->once())
            ->method('get')
            ->with('sitemap')
            ->willReturn(null);

        $this->newsServiceMock->method('getAll')->willReturn([]);
        $this->repositoryMock->expects($this->once())->method('findAll')->willReturn([['url' => 'http://example.com/generated']]);

        $result = $this->service->getSitemapLinks();
        $this->assertCount(1, $result);
    }

    public function testGenerateSitemap(): void
    {
        $this->repositoryMock->expects($this->once())->method('truncate');

        $mockNews = [
            ['slug' => 'noticia-1', 'updated_at' => '2023-10-27']
        ];
        $this->newsServiceMock->expects($this->once())
            ->method('getAll')
            ->willReturn($mockNews);

        $this->repositoryMock->expects($this->once())
            ->method('createBatch')
            ->with($this->callback(function ($links) {
                return count($links) > 1 && $links[0]['url'] === base_url();
            }));

        $this->service->generateSitemap();
    }
}
