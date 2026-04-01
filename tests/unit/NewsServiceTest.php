<?php

namespace Tests\Unit;

use App\Services\NewsService;
use App\Repositories\NewsRepository;
use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Config\Services;

/**
 * @internal
 */
final class NewsServiceTest extends CIUnitTestCase
{
    private $repositoryMock;
    private $service;

    protected function setUp(): void
    {
        parent::setUp();

        // Mock Shield Auth
        $authenticatorMock = $this->createMock(\CodeIgniter\Shield\Authentication\Authenticators\Session::class);
        $authenticatorMock->method('loggedIn')->willReturn(false);

        $authMock = $this->getMockBuilder(\CodeIgniter\Shield\Auth::class)
            ->disableOriginalConstructor()
            ->addMethods(['loggedIn'])
            ->onlyMethods(['getAuthenticator'])
            ->getMock();
        $authMock->method('getAuthenticator')->willReturn($authenticatorMock);
        $authMock->method('loggedIn')->willReturn(false);

        Services::injectMock('auth', $authMock);

        $this->repositoryMock = $this->createMock(NewsRepository::class);

        $this->service = new NewsService($this->repositoryMock);
    }

    public function testGetBySlug(): void
    {
        $slug = 'test-slug';
        $expectedResult = ['id' => 1, 'title' => 'Test Title', 'slug' => $slug];

        $this->repositoryMock->expects($this->once())
            ->method('findBySlug')
            ->with($slug, 'news.*, news_categories.name as category_name', [['news_categories', 'news.category_id = news_categories.id', 'left']])
            ->with($slug, $this->anything(), $this->anything())
            ->willReturn($expectedResult);

        $result = $this->service->getBySlug($slug);

        $this->assertEquals($expectedResult, $result);
    }

    public function testCreateNewsGeneratesSlug(): void
    {
        $data = [
            'title' => 'Minha Notícia Incrível!',
            'content' => 'Conteúdo da notícia',
            'status' => 'published'
        ];

        $this->repositoryMock->expects($this->once())
            ->method('create')
            ->with($this->callback(function ($passedData) {
                return $passedData['slug'] === 'minha-noticia-incrivel' &&
                       isset($passedData['published_at']);
            }))
            ->willReturn(1);

        $id = $this->service->createNews($data);

        $this->assertEquals(1, $id);
    }

    public function testUpdateNewsUpdatesSlug(): void
    {
        $id = 1;
        $data = [
            'title' => 'Título Atualizado',
        ];

        $this->repositoryMock->expects($this->once())
            ->method('update')
            ->with($id, $this->callback(function ($passedData) {
                return $passedData['slug'] === 'titulo-atualizado';
            }))
            ->willReturn(true);

        $result = $this->service->updateNews($id, $data);

        $this->assertTrue($result);
    }

    public function testDeleteNews(): void
    {
        $id = 1;
        $this->repositoryMock->expects($this->once())
            ->method('delete')
            ->with($id)
            ->willReturn(true);

        $result = $this->service->deleteNews($id);

        $this->assertTrue($result);
    }

    public function testDeleteNewsThrowsExceptionOnFailure(): void
    {
        $id = 1;
        $this->repositoryMock->expects($this->once())
            ->method('delete')
            ->with($id)
            ->willReturn(false);

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Erro ao excluir a notícia.');

        $this->service->deleteNews($id);
    }

    public function testCreateNewsThrowsExceptionOnFailure(): void
    {
        $data = ['title' => 'Test'];
        $this->repositoryMock->method('create')->willReturn(false);

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Erro ao criar a notícia.');

        $this->service->createNews($data);
    }

    public function testUpdateNewsThrowsExceptionOnFailure(): void
    {
        $id = 1;
        $data = ['title' => 'Test'];
        $this->repositoryMock->method('update')->willReturn(false);

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Erro ao atualizar a notícia.');

        $this->service->updateNews($id, $data);
    }
}
