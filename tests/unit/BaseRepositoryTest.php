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
}
