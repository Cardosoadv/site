<?php

namespace Tests\Unit;

use App\Repositories\NewsRepository;
use App\Services\NewsService;
use CodeIgniter\Test\CIUnitTestCase;

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

        $this->repositoryMock = $this->createMock(NewsRepository::class);
        $this->service = new NewsService($this->repositoryMock);

        // Mock auth to avoid DB settings issues
        $authMock = $this->getMockBuilder(\CodeIgniter\Shield\Auth::class)
            ->disableOriginalConstructor()
            ->addMethods(['loggedIn'])
            ->onlyMethods(['id'])
            ->getMock();
        $authMock->method('loggedIn')->willReturn(false);
        \CodeIgniter\Config\Services::injectMock('auth', $authMock);
    }

    public function testCreateNewsGeneratesSlugFromTitle(): void
    {
        $data = ['title' => 'Test Title News'];

        $this->repositoryMock->expects($this->once())
            ->method('create')
            ->with($this->callback(function ($passedData) {
                return $passedData['slug'] === 'test-title-news';
            }))
            ->willReturn(1);

        $this->service->createNews($data);
    }

    public function testCreateNewsPreservesExistingSlug(): void
    {
        $data = [
            'title' => 'Test Title',
            'slug'  => 'custom-slug'
        ];

        $this->repositoryMock->expects($this->once())
            ->method('create')
            ->with($this->callback(function ($passedData) {
                return $passedData['slug'] === 'custom-slug';
            }))
            ->willReturn(1);

        $this->service->createNews($data);
    }

    public function testCreateNewsSetsPublishedAtWhenStatusIsPublished(): void
    {
        $data = [
            'title'  => 'Test Title',
            'status' => 'published'
        ];

        $this->repositoryMock->expects($this->once())
            ->method('create')
            ->with($this->callback(function ($passedData) {
                return isset($passedData['published_at']) && !empty($passedData['published_at']);
            }))
            ->willReturn(1);

        $this->service->createNews($data);
    }

    public function testCreateNewsThrowsExceptionOnFailure(): void
    {
        $data = ['title' => 'Test Title'];

        $this->repositoryMock->expects($this->once())
            ->method('create')
            ->willReturn(false);

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Erro ao criar a notícia. Verifique os dados e tente novamente.');

        $this->service->createNews($data);
    }

    public function testUpdateNewsUpdatesSlugWhenTitleChangedAndSlugEmpty(): void
    {
        $id = 1;
        $data = ['title' => 'New Title'];

        $this->repositoryMock->expects($this->once())
            ->method('update')
            ->with($id, $this->callback(function ($passedData) {
                return $passedData['slug'] === 'new-title';
            }))
            ->willReturn(true);

        $this->service->updateNews($id, $data);
    }

    public function testUpdateNewsThrowsExceptionOnFailure(): void
    {
        $id = 1;
        $data = ['title' => 'New Title'];

        $this->repositoryMock->expects($this->once())
            ->method('update')
            ->willReturn(false);

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Erro ao atualizar a notícia.');

        $this->service->updateNews($id, $data);
    }

    public function testDeleteNewsCallsRepositoryDelete(): void
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
            ->willReturn(false);

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Erro ao excluir a notícia.');

        $this->service->deleteNews($id);
    }

    public function testCreateNewsAutoAssignsAuthorWhenLoggedIn(): void
    {
        // Mock auth service
        $authMock = $this->getMockBuilder(\CodeIgniter\Shield\Auth::class)
            ->disableOriginalConstructor()
            ->addMethods(['loggedIn'])
            ->onlyMethods(['id'])
            ->getMock();

        $authMock->method('loggedIn')->willReturn(true);
        $authMock->method('id')->willReturn(99);

        \CodeIgniter\Config\Services::injectMock('auth', $authMock);

        $data = ['title' => 'Test Author'];

        $this->repositoryMock->expects($this->once())
            ->method('create')
            ->with($this->callback(function ($passedData) {
                return (isset($passedData['author_id']) && $passedData['author_id'] === 99);
            }))
            ->willReturn(1);

        $this->service->createNews($data);
    }
}
