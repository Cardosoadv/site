<?php

namespace Tests\Unit;

use App\Controllers\Noticias;
use App\Services\NewsService;
use CodeIgniter\Config\Services;
use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\ControllerTestTrait;

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
}
