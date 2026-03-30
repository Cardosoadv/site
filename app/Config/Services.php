<?php

namespace Config;

use CodeIgniter\Config\BaseService;

/**
 * Services Configuration file.
 *
 * Services are simply other classes/libraries that the system uses
 * to do its job. This is used by CodeIgniter to allow the core of the
 * framework to be swapped out easily without affecting the usage within
 * the rest of your application.
 *
 * This file holds any application-specific services, or service overrides
 * that you might need. An example has been included with the general
 * method format you should use for your service methods. For more examples,
 * see the core Services file at system/Config/Services.php.
 */
class Services extends BaseService
{
    public static function news($getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('news');
        }

        $repository = new \App\Repositories\NewsRepository(new \App\Models\NewsModel());

        return new \App\Services\NewsService($repository);
    }

    public static function crmContact($getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('crmContact');
        }

        $repository = new \App\Repositories\CrmContactRepository();

        return new \App\Services\CrmContactService($repository);
    }

    public static function sitemap($getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('sitemap');
        }

        $repository  = new \App\Repositories\SitemapRepository();
        $newsService = static::news();
        $cache       = static::cache();

        return new \App\Services\SitemapService($repository, $newsService, $cache);
    }
}
