<?php

namespace Tests\Controllers\admin;

use App\Controllers\admin\Contatos;
use App\Services\CrmContactService;
use App\Repositories\CrmContactRepository;
use CodeIgniter\Config\Services;
use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;

/**
 * @internal
 */
final class ContatosTest extends CIUnitTestCase
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
        Services::injectMock('crmContact', $serviceMock);

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
        $mockContacts = [
            [
                'id'         => 1,
                'name'       => 'John Doe',
                'email'      => 'john@example.com',
                'phone'      => '123456789',
                'status'     => 'new',
                'area_name'  => 'Area 1',
                'created_at' => '2023-10-27 10:00:00',
            ],
        ];

        $serviceMock = $this->createMock(CrmContactService::class);
        $serviceMock->expects($this->once())
            ->method('getAll')
            ->willReturn($mockContacts);

        $this->setupMocks($serviceMock);

        $result = $this->withRoutes([
            ['get', 'admin/contatos', 'admin\Contatos::index']
        ])->get('admin/contatos');

        $result->assertStatus(200);
        $result->assertSee('John Doe');
    }

    public function testShowSuccess(): void
    {
        $id = 1;
        $mockContacts = [
            [
                'id'        => $id,
                'name'      => 'John Doe',
                'email'     => 'john@example.com',
                'phone'     => '123456789',
                'status'    => 'new',
                'area_name' => 'Area 1',
                'message'   => 'Hello',
                'created_at' => '2023-10-27 10:00:00',
            ],
        ];

        $serviceMock = $this->createMock(CrmContactService::class);
        $serviceMock->method('getAll')
            ->willReturn($mockContacts);

        $this->setupMocks($serviceMock);

        $result = $this->withRoutes([
            ['get', 'admin/contatos', 'admin\Contatos::index'],
            ['get', 'admin/contatos/show/(:num)', 'admin\Contatos::show/$1']
        ])->get("admin/contatos/show/{$id}");

        $result->assertStatus(200);
        $result->assertSee('John Doe');
        $result->assertSee('john@example.com');
    }

    public function testShowNotFound(): void
    {
        $id = 999;

        $serviceMock = $this->createMock(CrmContactService::class);
        $serviceMock->method('getAll')
            ->willReturn([]);

        $this->setupMocks($serviceMock);

        try {
            $result = $this->withRoutes([
                ['get', 'admin/contatos', 'admin\Contatos::index'],
                ['get', 'admin/contatos/show/(:num)', 'admin\Contatos::show/$1']
            ])->get("admin/contatos/show/{$id}");
            $this->assertEquals(404, $result->response()->getStatusCode());
        } catch (\CodeIgniter\Exceptions\PageNotFoundException $e) {
            $this->assertEquals('Contato não encontrado', $e->getMessage());
        }
    }

    public function testUpdateStatusSuccess(): void
    {
        $id = 1;
        $status = 'contacted';

        $serviceMock = $this->createMock(CrmContactService::class);
        $serviceMock->expects($this->once())
            ->method('update')
            ->with($id, ['status' => $status])
            ->willReturn(true);

        $this->setupMocks($serviceMock);

        $result = $this->withRoutes([
            ['get', 'admin/contatos', 'admin\Contatos::index'],
            ['post', 'admin/contatos/updateStatus/(:num)', 'admin\Contatos::updateStatus/$1']
        ])->post("admin/contatos/updateStatus/{$id}", ['status' => $status]);

        $result->assertRedirectTo(base_url('admin/contatos'));
        $result->assertSessionHas('success', 'Status do contato atualizado com sucesso!');
    }

    public function testUpdateStatusInvalid(): void
    {
        $id = 1;

        $serviceMock = $this->createMock(CrmContactService::class);
        $serviceMock->expects($this->never())
            ->method('update');

        $this->setupMocks($serviceMock);

        $result = $this->withRoutes([
            ['post', 'admin/contatos/updateStatus/(:num)', 'admin\Contatos::updateStatus/$1']
        ])->post("admin/contatos/updateStatus/{$id}", ['status' => '']);

        $result->assertRedirect();
        $result->assertSessionHas('error', 'Status inválido.');
    }

    public function testDestroySuccess(): void
    {
        $id = 1;

        $serviceMock = $this->createMock(CrmContactService::class);
        $serviceMock->expects($this->once())
            ->method('delete')
            ->with($id)
            ->willReturn(true);

        $this->setupMocks($serviceMock);

        $result = $this->withRoutes([
            ['get', 'admin/contatos', 'admin\Contatos::index'],
            ['get', 'admin/contatos/destroy/(:num)', 'admin\Contatos::destroy/$1']
        ])->get("admin/contatos/destroy/{$id}");

        $result->assertRedirectTo(base_url('admin/contatos'));
        $result->assertSessionHas('success', 'Contato excluído com sucesso!');
    }

    public function testDestroyFailure(): void
    {
        $id = 1;

        $serviceMock = $this->createMock(CrmContactService::class);
        $serviceMock->expects($this->once())
            ->method('delete')
            ->with($id)
            ->willThrowException(new \Exception('Erro ao excluir o contato.'));

        $this->setupMocks($serviceMock);

        $result = $this->withRoutes([
            ['get', 'admin/contatos', 'admin\Contatos::index'],
            ['get', 'admin/contatos/destroy/(:num)', 'admin\Contatos::destroy/$1']
        ])->get("admin/contatos/destroy/{$id}");

        $result->assertRedirect();
        $result->assertSessionHas('error', 'Erro ao excluir o contato.');
    }
}
