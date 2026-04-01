<?php

namespace Tests\Controllers\admin;

use App\Controllers\admin\Noticias;
use App\Services\NewsService;
use CodeIgniter\Config\Services;
use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;

/**
 * @internal
 */
final class NoticiasTest extends CIUnitTestCase
{
    use FeatureTestTrait;

    protected function setUp(): void
    {
        parent::setUp();

        // Mock the security service to bypass CSRF
        $security = $this->createMock(\CodeIgniter\Security\Security::class);
        $security->method('verify')->willReturn($security);
        $security->method('getHash')->willReturn('fake-hash');
        $security->method('getTokenName')->willReturn('csrf_test_name');
        Services::injectMock('security', $security);
    }

    private function setupMocks($serviceMock): void
    {
        Services::injectMock('news', $serviceMock);

        // Mock Shield Auth
        $authenticatorMock = $this->getMockBuilder(\CodeIgniter\Shield\Authentication\Authenticators\Session::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['loggedIn', 'recordActiveDate'])
            ->getMock();
        $authenticatorMock->method('loggedIn')->willReturn(true);

        $authMock = $this->getMockBuilder(\CodeIgniter\Shield\Auth::class)
            ->disableOriginalConstructor()
            ->addMethods(['loggedIn'])
            ->onlyMethods(['getAuthenticator', 'id', 'user'])
            ->getMock();
        $authMock->method('getAuthenticator')->willReturn($authenticatorMock);
        $authMock->method('loggedIn')->willReturn(true);
        $authMock->method('id')->willReturn(1);
        $user = new \CodeIgniter\Shield\Entities\User();
        $user->id = 1;
        $authMock->method('user')->willReturn($user);

        Services::injectMock('auth', $authMock);
    }

    public function testIndex(): void
    {
        $mockNews = [
            [
                'id'            => 1,
                'title'         => 'Admin News 1',
                'category_name' => 'Category 1',
                'status'        => 'published',
                'slug'          => 'admin-news-1',
                'published_at'  => '2023-10-27 10:00:00',
            ],
        ];

        $serviceMock = $this->createMock(NewsService::class);
        $serviceMock->expects($this->once())
            ->method('getAll')
            ->willReturn($mockNews);

        $this->setupMocks($serviceMock);

        $result = $this->withRoutes([
            ['get', 'admin/noticias', 'admin\Noticias::index']
        ])->get('admin/noticias');

        $result->assertStatus(200);
        $result->assertSee('Admin News 1');
    }

    public function testCreate(): void
    {
        $mockCategories = [
            ['id' => 1, 'name' => 'Category 1'],
        ];

        $serviceMock = $this->createMock(NewsService::class);
        $serviceMock->expects($this->once())
            ->method('getCategories')
            ->willReturn($mockCategories);

        $this->setupMocks($serviceMock);

        $result = $this->withRoutes([
            ['get', 'admin/noticias/create', 'admin\Noticias::create']
        ])->get('admin/noticias/create');

        $result->assertStatus(200);
        $result->assertSee('Criar Notícia', 'h2');
        $result->assertSee('Category 1');
    }

    public function testStoreSuccess(): void
    {
        $data = [
            'title'            => 'New Title',
            'category_id'      => '1',
            'status'           => 'published',
            'summary'          => 'Short summary',
            'content'          => 'Full content',
            'published_at'     => '2023-10-27T10:00'
        ];

        $serviceMock = $this->createMock(NewsService::class);
        $serviceMock->expects($this->once())
            ->method('createNews')
            ->with($this->callback(fn($post) => $post['title'] === $data['title']));

        $this->setupMocks($serviceMock);

        $result = $this->withRoutes([
            ['get', 'admin/noticias', 'admin\Noticias::index'],
            ['post', 'admin/noticias/store', 'admin\Noticias::store']
        ])->post('admin/noticias/store', $data);

        $result->assertRedirectTo(base_url('admin/noticias'));
        $result->assertSessionHas('success', 'Notícia criada com sucesso!');
    }

    public function testStoreValidationError(): void
    {
        $data = [
            'title' => '', // Required field empty
        ];

        $serviceMock = $this->createMock(NewsService::class);
        $serviceMock->expects($this->never())
            ->method('createNews');

        $this->setupMocks($serviceMock);

        $result = $this->withRoutes([
            ['post', 'admin/noticias/store', 'admin\Noticias::store']
        ])->post('admin/noticias/store', $data);

        $result->assertRedirect();
        $result->assertSessionHas('errors');
    }

    public function testEdit(): void
    {
        $slug = 'test-news';
        $mockNews = [
            'id'    => 1,
            'title' => 'Edit News',
            'slug'  => $slug,
        ];

        $serviceMock = $this->createMock(NewsService::class);
        $serviceMock->expects($this->once())
            ->method('getBySlug')
            ->with($slug)
            ->willReturn($mockNews);

        $this->setupMocks($serviceMock);

        $result = $this->withRoutes([
            ['get', 'admin/noticias/edit/(:segment)', 'admin\Noticias::edit/$1']
        ])->get("admin/noticias/edit/{$slug}");

        $result->assertStatus(200);
        $result->assertSee('Editar Notícia', 'h2');
    }

    public function testUpdateSuccess(): void
    {
        $id = 1;
        $data = [
            'title'            => 'Updated Title',
            'category_id'      => '1',
            'status'           => 'draft',
            'summary'          => 'Updated summary',
            'content'          => 'Updated content',
            'published_at'     => '2023-10-28T11:00'
        ];

        $serviceMock = $this->createMock(NewsService::class);
        $serviceMock->expects($this->once())
            ->method('updateNews')
            ->with($id, $this->callback(fn($post) => $post['title'] === $data['title']));

        $this->setupMocks($serviceMock);

        $result = $this->withRoutes([
            ['get', 'admin/noticias', 'admin\Noticias::index'],
            ['post', 'admin/noticias/update/(:num)', 'admin\Noticias::update/$1']
        ])->post("admin/noticias/update/{$id}", $data);

        $result->assertRedirectTo(base_url('admin/noticias'));
        $result->assertSessionHas('success', 'Notícia atualizada com sucesso!');
    }

    public function testDestroySuccess(): void
    {
        $id = 1;

        $serviceMock = $this->createMock(NewsService::class);
        $serviceMock->expects($this->once())
            ->method('deleteNews')
            ->with($id);

        $this->setupMocks($serviceMock);

        $result = $this->withRoutes([
            ['get', 'admin/noticias', 'admin\Noticias::index'],
            ['get', 'admin/noticias/destroy/(:num)', 'admin\Noticias::destroy/$1']
        ])->get("admin/noticias/destroy/{$id}");

        $result->assertRedirectTo(base_url('admin/noticias'));
        $result->assertSessionHas('success', 'Notícia excluída com sucesso!');
    }

    public function testDestroyFailure(): void
    {
        $id = 1;

        $serviceMock = $this->createMock(NewsService::class);
        $serviceMock->expects($this->once())
            ->method('deleteNews')
            ->willThrowException(new \Exception('Delete failed'));

        $this->setupMocks($serviceMock);

        $result = $this->withRoutes([
            ['get', 'admin/noticias/destroy/(:num)', 'admin\Noticias::destroy/$1']
        ])->get("admin/noticias/destroy/{$id}");

        $result->assertRedirect();
        $result->assertSessionHas('error', 'Delete failed');
    }
}
