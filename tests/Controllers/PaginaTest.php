<?php

namespace Tests\Controllers;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;

/**
 * @internal
 */
final class PaginaTest extends CIUnitTestCase
{
    use FeatureTestTrait;

    public function testIndexWithValidSlugReturns200(): void
    {
        $result = $this->get('pagina/direito-civil');

        $result->assertStatus(200);
        $result->assertSee('direito-civil');
    }

    public function testIndexWithInvalidSlugRedirectsToHome(): void
    {
        $result = $this->get('pagina/invalid-slug');

        $result->assertRedirectTo(base_url());
    }

    public function testIndexWithAllAllowedPages(): void
    {
        $allowedPages = [
            'direito-civil',
            'direito-administrativo',
            'contratos-negocios',
            'advocacia-colaborativa',
        ];

        foreach ($allowedPages as $slug) {
            $result = $this->get('pagina/' . $slug);
            $result->assertStatus(200);
            $result->assertSee($slug);
        }
    }
}
