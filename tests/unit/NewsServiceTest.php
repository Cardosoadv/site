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

        // NewsService uses constructor injection for NewsRepository via parent BaseService
        // But NewsService::__construct() hardcodes the creation of NewsRepository.
        // We need to handle this.

        $this->service = new class($this->repositoryMock) extends NewsService {
            public function __construct($repository) {
                $this->repository = $repository;
            }
        };
    }

    public function testGetBySlug(): void
    {
        $slug = 'test-slug';
        $expectedResult = ['id' => 1, 'title' => 'Test Title', 'slug' => $slug];

        $this->repositoryMock->expects($this->once())
            ->method('findBySlug')
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
}
