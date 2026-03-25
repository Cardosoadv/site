<?php

namespace Tests\Unit;

use App\Controllers\Noticias;
use App\Services\NewsService;
use CodeIgniter\Config\Services;
use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\ControllerTestTrait;
use CodeIgniter\Exceptions\PageNotFoundException;

/**
 * @internal
 */
final class NoticiasTest extends CIUnitTestCase
{
    use ControllerTestTrait;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testIndex(): void
    {
        $mockNews = [
            [
                'title'        => 'Test News 1',
                'summary'      => 'Summary 1',
                'slug'         => 'test-news-1',
                'published_at' => '2023-10-27 10:00:00',
            ],
            [
                'title'        => 'Test News 2',
                'summary'      => 'Summary 2',
                'slug'         => 'test-news-2',
                'published_at' => '2023-10-26 10:00:00',
            ],
        ];

        $serviceMock = $this->createMock(NewsService::class);
        $serviceMock->expects($this->once())
            ->method('getAll')
            ->with('*', ['status' => 'published'], 'published_at', 'desc')
            ->willReturn($mockNews);

        Services::injectMock('news', $serviceMock);

        $result = $this->controller(Noticias::class)
            ->execute('index');

        $this->assertTrue($result->isOK());
        $this->assertTrue($result->see('Test News 1', 'h3'));
        $this->assertTrue($result->see('Test News 2', 'h3'));
    }

    public function testIndexEmpty(): void
    {
        $serviceMock = $this->createMock(NewsService::class);
        $serviceMock->expects($this->once())
            ->method('getAll')
            ->willReturn([]);

        Services::injectMock('news', $serviceMock);

        $result = $this->controller(Noticias::class)
            ->execute('index');

        $this->assertTrue($result->isOK());
        $this->assertTrue($result->see('Nenhum artigo publicado ainda.', 'p'));
    }

    public function testShow(): void
    {
        $mockNews = [
            'id'           => 1,
            'title'        => 'Article 1',
            'content'      => 'Full content of article 1',
            'slug'         => 'article-1',
            'published_at' => '2023-10-27 10:00:00',
        ];

        $mockRelated = [
            [
                'id'           => 2,
                'title'        => 'Article 2',
                'slug'         => 'article-2',
                'published_at' => '2023-10-26 10:00:00',
            ],
            [
                'id'           => 1, // Current article, should be filtered out
                'title'        => 'Article 1',
                'slug'         => 'article-1',
                'published_at' => '2023-10-27 10:00:00',
            ],
        ];

        $serviceMock = $this->createMock(NewsService::class);
        $serviceMock->expects($this->once())
            ->method('getBySlug')
            ->with('article-1')
            ->willReturn($mockNews);

        $serviceMock->expects($this->once())
            ->method('getAll')
            ->willReturn($mockRelated);

        Services::injectMock('news', $serviceMock);

        $result = $this->controller(Noticias::class)
            ->execute('show', 'article-1');

        $this->assertTrue($result->isOK());
        $this->assertTrue($result->see('Article 1', 'h1'));
        $this->assertTrue($result->see('Article 2', 'h5'));
    }

    public function testShowNotFound(): void
    {
        $serviceMock = $this->createMock(NewsService::class);
        $serviceMock->expects($this->once())
            ->method('getBySlug')
            ->with('non-existent')
            ->willReturn(null);

        Services::injectMock('news', $serviceMock);

        $this->expectException(PageNotFoundException::class);

        $controller = new Noticias();
        $controller->show('non-existent');
    }
}
