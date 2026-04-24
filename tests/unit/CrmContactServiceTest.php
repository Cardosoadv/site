<?php

namespace Tests\Unit;

use App\Services\CrmContactService;
use App\Repositories\CrmContactRepository;
use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Config\Services;

/**
 * @internal
 */
final class CrmContactServiceTest extends CIUnitTestCase
{
    private $repositoryMock;
    private $service;

    protected function setUp(): void
    {
        parent::setUp();

        $this->repositoryMock = $this->getMockBuilder(CrmContactRepository::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['create', 'getAreaById', 'getAreas'])
            ->getMock();

        $this->service = new CrmContactService($this->repositoryMock);
    }

    public function testCreateSendsEmail(): void
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'message' => 'Hello',
            'area_interesse' => 1
        ];

        $this->repositoryMock->expects($this->once())
            ->method('create')
            ->willReturn(123);

        $this->repositoryMock->expects($this->once())
            ->method('getAreaById')
            ->with(1)
            ->willReturn(['title' => 'Área de Teste']);

        // Mock Email Service
        $emailMock = $this->createMock(\CodeIgniter\Email\Email::class);
        $emailMock->expects($this->once())->method('send')->willReturn(true);
        $emailMock->method('setFrom')->willReturn($emailMock);
        $emailMock->method('setTo')->willReturn($emailMock);
        $emailMock->method('setSubject')->willReturn($emailMock);
        $emailMock->method('setMessage')->willReturn($emailMock);
        $emailMock->method('setMailType')->willReturn($emailMock);

        Services::injectMock('email', $emailMock);

        $id = $this->service->create($data);

        $this->assertEquals(123, $id);
    }

    public function testGetAreas(): void
    {
        $expected = [['id' => 1, 'area_interesse' => 'Teste']];
        $this->repositoryMock->expects($this->once())
            ->method('getAreas')
            ->willReturn($expected);

        $result = $this->service->getAreas();
        $this->assertEquals($expected, $result);
    }
}
