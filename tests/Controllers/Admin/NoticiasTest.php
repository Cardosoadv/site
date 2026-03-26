<?php

namespace Tests\Controllers\Admin;

use App\Controllers\admin\Noticias;
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

    public function testDestroySuccess(): void
    {
        $id = 123;

        /** @var NewsService|\PHPUnit\Framework\MockObject\MockObject $mock */
        $mock = $this->createMock(NewsService::class);
        $mock->expects($this->once())
            ->method('deleteNews')
            ->with($id)
            ->willReturn(true);

        Services::injectMock('news', $mock);

        $result = $this->withUri(base_url("admin/noticias/destroy/{$id}"))
            ->controller(Noticias::class)
            ->execute('destroy', $id);

        $result->assertRedirectTo(base_url('admin/noticias'));
        $result->assertSessionHas('success', 'Notícia excluída com sucesso!');
    }

    public function testDestroyError(): void
    {
        $id = 123;
        $errorMessage = 'Erro ao excluir a notícia.';

        /** @var NewsService|\PHPUnit\Framework\MockObject\MockObject $mock */
        $mock = $this->createMock(NewsService::class);
        $mock->expects($this->once())
            ->method('deleteNews')
            ->with($id)
            ->willThrowException(new \Exception($errorMessage));

        Services::injectMock('news', $mock);

        $result = $this->withUri(base_url("admin/noticias/destroy/{$id}"))
            ->controller(Noticias::class)
            ->execute('destroy', $id);

        $result->assertSessionHas('error', $errorMessage);
    }
}
