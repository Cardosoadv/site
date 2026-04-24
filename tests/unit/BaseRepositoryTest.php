<?php

namespace Tests\Unit;

use App\Repositories\BaseRepository;
use CodeIgniter\Cache\CacheInterface;
use CodeIgniter\Config\Services;
use CodeIgniter\Model;
use CodeIgniter\Test\CIUnitTestCase;

class TestModel extends Model
{
    protected $table = 'test_table';
}

/**
 * Concrete class for testing the abstract BaseRepository.
 */
class TestRepository extends BaseRepository
{
    public function setCacheEnabled(bool $enabled): void
    {
        $this->cacheEnabled = $enabled;
    }
}

/**
 * @internal
 */
final class BaseRepositoryTest extends CIUnitTestCase
{
    private $cacheMock;

    protected function setUp(): void
    {
        parent::setUp();

        // We need a mock that has the deleteMatching method.
        // CacheInterface doesn't have it, but handlers do.
        $this->cacheMock = $this->getMockBuilder(\CodeIgniter\Cache\Handlers\BaseHandler::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['deleteMatching', 'get', 'save', 'delete', 'increment', 'decrement', 'clean', 'getCacheInfo', 'isSupported', 'initialize', 'getMetaData'])
            ->getMock();

        Services::injectMock('cache', $this->cacheMock);
    }

    public function testClearCacheCallsDeleteMatchingWhenEnabled(): void
    {
        $model = new TestModel();
        $repository = new TestRepository($model);

        $this->cacheMock->expects($this->once())
            ->method('deleteMatching')
            ->with('test_table*');

        $repository->clearCache();
    }

    public function testClearCacheDoesNotCallDeleteMatchingWhenDisabled(): void
    {
        $model = new TestModel();
        $repository = new TestRepository($model);
        $repository->setCacheEnabled(false);

        $this->cacheMock->expects($this->never())
            ->method('deleteMatching');

        $repository->clearCache();
    }

    public function testFirstCachesResult(): void
    {
        // Setup mock model
        $modelMock = $this->getMockBuilder(TestModel::class)
            ->addMethods(['select', 'where', 'join'])
            ->onlyMethods(['first'])
            ->getMock();

        $modelMock->method('select')->willReturnSelf();
        $modelMock->method('where')->willReturnSelf();
        $modelMock->method('join')->willReturnSelf();
        $modelMock->expects($this->once())
            ->method('first')
            ->willReturn(['id' => 1, 'name' => 'test']);

        // Setup repository
        $repository = new TestRepository($modelMock);

        // First call - should hit model
        $this->cacheMock->method('get')->willReturn(null);
        $this->cacheMock->expects($this->once())
            ->method('save');

        $result = $repository->first('*', ['id' => 1]);
        $this->assertEquals(['id' => 1, 'name' => 'test'], $result);
    }

    public function testFindAllCachesResult(): void
    {
        $modelMock = $this->getMockBuilder(TestModel::class)
            ->addMethods(['select', 'where', 'orderBy', 'limit', 'join'])
            ->onlyMethods(['findAll'])
            ->getMock();

        $modelMock->method('select')->willReturnSelf();
        $modelMock->method('where')->willReturnSelf();
        $modelMock->method('orderBy')->willReturnSelf();
        $modelMock->method('limit')->willReturnSelf();
        $modelMock->method('join')->willReturnSelf();

        $expected = [['id' => 1], ['id' => 2]];
        $modelMock->expects($this->once())->method('findAll')->willReturn($expected);

        $repository = new TestRepository($modelMock);

        $this->cacheMock->method('get')->willReturn(null);
        $this->cacheMock->expects($this->once())->method('save');

        $result = $repository->findAll();
        $this->assertEquals($expected, $result);
    }

    public function testFindByIdCachesResult(): void
    {
        $modelMock = $this->getMockBuilder(TestModel::class)
            ->addMethods(['select'])
            ->onlyMethods(['find'])
            ->getMock();

        $modelMock->method('select')->willReturnSelf();

        $expected = ['id' => 1];
        $modelMock->expects($this->once())->method('find')->with(1)->willReturn($expected);

        $repository = new TestRepository($modelMock);

        $this->cacheMock->method('get')->willReturn(null);
        $this->cacheMock->expects($this->once())->method('save');

        $result = $repository->findById(1);
        $this->assertEquals($expected, $result);
    }

    public function testCreateClearsCache(): void
    {
        $modelMock = $this->getMockBuilder(TestModel::class)
            ->onlyMethods(['insert'])
            ->getMock();
        $modelMock->method('insert')->willReturn(1);

        $repository = new TestRepository($modelMock);

        $this->cacheMock->expects($this->once())->method('deleteMatching')->with('test_table*');

        $repository->create(['name' => 'new']);
    }

    public function testUpdateClearsCache(): void
    {
        $modelMock = $this->getMockBuilder(TestModel::class)
            ->onlyMethods(['update'])
            ->getMock();
        $modelMock->method('update')->willReturn(true);

        $repository = new TestRepository($modelMock);

        $this->cacheMock->expects($this->once())->method('deleteMatching')->with('test_table*');

        $repository->update(1, ['name' => 'updated']);
    }

    public function testDeleteClearsCache(): void
    {
        $modelMock = $this->getMockBuilder(TestModel::class)
            ->onlyMethods(['delete'])
            ->getMock();
        $modelMock->method('delete')->willReturn(true);

        $repository = new TestRepository($modelMock);

        $this->cacheMock->expects($this->once())->method('deleteMatching')->with('test_table*');

        $repository->delete(1);
    }

    public function testCreateBatchClearsCache(): void
    {
        $modelMock = $this->getMockBuilder(TestModel::class)
            ->onlyMethods(['insertBatch'])
            ->getMock();
        $modelMock->method('insertBatch')->willReturn(2);

        $repository = new TestRepository($modelMock);

        $this->cacheMock->expects($this->once())->method('deleteMatching')->with('test_table*');

        $repository->createBatch([['name' => 'a'], ['name' => 'b']]);
    }
}
