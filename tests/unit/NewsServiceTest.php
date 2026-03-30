<?php

namespace Tests\Unit;

use App\Services\NewsService;
use App\Repositories\NewsRepository;
use CodeIgniter\Test\CIUnitTestCase;
use ReflectionClass;

/**
 * @internal
 */
final class NewsServiceTest extends CIUnitTestCase
{
    public function testCreateNewsThrowsExceptionOnFailure(): void
    {
        // 1. Arrange
        $newsService = new NewsService();

        // Mock the repository
        $repositoryMock = $this->createMock(NewsRepository::class);
        $repositoryMock->expects($this->once())
            ->method('create')
            ->willReturn(false);

        // Inject the mock repository using Reflection
        $reflection = new ReflectionClass(NewsService::class);
        $property = $reflection->getProperty('repository');
        $property->setAccessible(true);
        $property->setValue($newsService, $repositoryMock);

        $data = [
            'title'   => 'Test News',
            'summary' => 'This is a test summary.',
            'content' => 'This is test content.',
            'status'  => 'published'
        ];

        // 2. Assert & Act
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Erro ao criar a notícia. Verifique os dados e tente novamente.');

        $newsService->createNews($data);
    }
}
