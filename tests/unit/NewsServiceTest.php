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
        // Mock the repository
        $repositoryMock = $this->getMockBuilder(NewsRepository::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['create'])
            ->getMock();

        $repositoryMock->expects($this->once())
            ->method('create')
            ->willReturn(false);

        // Mock auth() helper
        $authMock = $this->getMockBuilder(\CodeIgniter\Shield\Auth::class)
            ->disableOriginalConstructor()
            ->addMethods(['loggedIn'])
            ->onlyMethods(['id'])
            ->getMock();
        $authMock->method('loggedIn')->willReturn(false);
        $authMock->method('id')->willReturn(null);

        \Config\Services::injectMock('auth', $authMock);

        // Create the service without calling constructor
        $reflection = new ReflectionClass(NewsService::class);
        $newsService = $reflection->newInstanceWithoutConstructor();

        // Inject the mock repository using Reflection
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
