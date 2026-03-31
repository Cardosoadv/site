<?php

namespace Tests\Unit;

use CodeIgniter\Test\CIUnitTestCase;

class SecurityHelperTest extends CIUnitTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        helper('security');
    }

    public function testSanitizeHtmlRemovesScriptTags()
    {
        $dirty = '<p>Hello</p><script>alert("XSS")</script>';
        $clean = sanitize_html($dirty);

        $this->assertEquals('<p>Hello</p>', $clean);
        $this->assertStringNotContainsString('<script>', $clean);
    }

    public function testSanitizeHtmlRemovesOnAttributes()
    {
        $dirty = '<img src="x" onerror="alert(1)">';
        $clean = sanitize_html($dirty);

        $this->assertStringNotContainsString('onerror', $clean);
        // HTMLPurifier might fix attributes like alt or close tags differently
        $this->assertStringContainsString('<img src="x"', $clean);
    }

    public function testSanitizeHtmlAllowsSafeTags()
    {
        $dirty = '<h1>Title</h1><p>Paragraph with <b>bold</b> and <i>italic</i>.</p><ul><li>List</li></ul>';
        $clean = sanitize_html($dirty);

        $this->assertStringContainsString('<h1>Title</h1>', $clean);
        $this->assertStringContainsString('<p>Paragraph with <b>bold</b> and <i>italic</i>.</p>', $clean);
        $this->assertStringContainsString('<ul><li>List</li></ul>', $clean);
    }

    public function testSanitizeHtmlHandlesBase64Images()
    {
        $base64 = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mP8z8BfAQIWAn76z767AAAAAElFTkSuQmCC';
        $dirty = '<img src="' . $base64 . '">';
        $clean = sanitize_html($dirty);

        $this->assertStringContainsString($base64, $clean);
    }
}
