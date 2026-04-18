<?php

namespace Tests\Feature\Web;

use Tests\TestCase;

class HomeSeoTest extends TestCase
{
    public function test_home_page_contains_organization_schema(): void
    {
        $response = $this->get(route('home'));

        $response->assertOk();
        $response->assertSee('application/ld+json', false);
        $response->assertSee('Organization', false);
        $response->assertSee('WebSite', false);
    }
}
