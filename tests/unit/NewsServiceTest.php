<?php

namespace Tests\Unit;

use App\Repositories\NewsRepository;
use App\Services\NewsService;
use CodeIgniter\Config\Services;
use CodeIgniter\Test\CIUnitTestCase;
use PHPUnit\Framework\MockObject\MockObject;
use ReflectionClass;

/**
 * @internal
 */
final class NewsServiceTest extends CIUnitTestCase
{
    private NewsService $service;
    private MockObject $repositoryMock;

    protected function setUp(): void
    {
        parent::setUp();

        $this->service = new NewsService();
        $this->repositoryMock = $this->createMock(NewsRepository::class);

        // Inject the mock repository into the service using reflection
        $reflection = new ReflectionClass(NewsService::class);
        $property = $reflection->getParentClass()->getProperty('repository');
        $property->setAccessible(true);
        $property->setValue($this->service, $this->repositoryMock);

        // Mock the auth service globally to avoid database calls in createNews
        $authMock = $this->getMockBuilder('CodeIgniter\Shield\Auth')
            ->disableOriginalConstructor()
            ->addMethods(['loggedIn'])
            ->onlyMethods(['id'])
            ->getMock();
        $authMock->method('loggedIn')->willReturn(false);
        $authMock->method('id')->willReturn(null);

        Services::injectMock('auth', $authMock);
    }

    public function testGetBySlugSuccess(): void
    {
        $slug = 'test-news';
        $mockData = [
            [
                'id' => 1,
                'title' => 'Test News',
                'slug' => $slug,
                'category_name' => 'General'
            ]
        ];

        $this->repositoryMock->expects($this->once())
            ->method('findAll')
            ->with(
                'news.*, news_categories.name as category_name',
                ['news.slug' => $slug],
                null,
                null,
                [['news_categories', 'news.category_id = news_categories.id', 'left']]
            )
            ->willReturn($mockData);

        $result = $this->service->getBySlug($slug);

        $this->assertIsArray($result);
        $this->assertEquals($slug, $result['slug']);
    }

    public function testGetBySlugNotFound(): void
    {
        $slug = 'non-existent';

        $this->repositoryMock->expects($this->once())
            ->method('findAll')
            ->willReturn([]);

        $result = $this->service->getBySlug($slug);

        $this->assertNull($result);
    }

    public function testGetCategories(): void
    {
        $mockCategories = [['id' => 1, 'name' => 'Tech']];
        $this->repositoryMock->expects($this->once())
            ->method('getCategories')
            ->willReturn($mockCategories);

        $result = $this->service->getCategories();
        $this->assertEquals($mockCategories, $result);
    }

    public function testCreateNewsGeneratesSlugFromTitle(): void
    {
        $data = ['title' => 'News Title With Accents - ÁÉÍÓÚãõ'];

        $this->repositoryMock->expects($this->once())
            ->method('create')
            ->with($this->callback(function ($passedData) {
                return isset($passedData['slug']) && $passedData['slug'] === 'news-title-with-accents-aeiouao';
            }))
            ->willReturn(123);

        $id = $this->service->createNews($data);

        $this->assertEquals(123, $id);
    }

    public function testCreateNewsUsesProvidedSlug(): void
    {
        $data = [
            'title' => 'Title',
            'slug' => 'custom-slug'
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
            'title' => 'Title',
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

    public function testCreateNewsAutoAssignsAuthor(): void
    {
        $data = ['title' => 'Title'];

        // Mock auth service for this test
        $authMock = $this->getMockBuilder('CodeIgniter\Shield\Auth')
            ->disableOriginalConstructor()
            ->addMethods(['loggedIn'])
            ->onlyMethods(['id'])
            ->getMock();
        $authMock->method('loggedIn')->willReturn(true);
        $authMock->method('id')->willReturn(99);

        Services::injectMock('auth', $authMock);

        $this->repositoryMock->expects($this->once())
            ->method('create')
            ->with($this->callback(function ($passedData) {
                return isset($passedData['author_id']) && $passedData['author_id'] === 99;
            }))
            ->willReturn(1);

        $this->service->createNews($data);
    }

    public function testCreateNewsThrowsExceptionOnFailure(): void
    {
        $data = ['title' => 'Title'];

        $this->repositoryMock->expects($this->once())
            ->method('create')
            ->willReturn(false);

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Erro ao criar a notícia.');

        $this->service->createNews($data);
    }

    public function testUpdateNewsUpdatesSlugIfTitleChangedAndNoSlugProvided(): void
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
        $data = ['title' => 'Title'];

        $this->repositoryMock->expects($this->once())
            ->method('update')
            ->willReturn(false);

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Erro ao atualizar a notícia.');

        $this->service->updateNews($id, $data);
    }

    public function testDeleteNewsSuccess(): void
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
