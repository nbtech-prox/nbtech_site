<?php

namespace Tests\Feature\Web;

use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ServiceDetailPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_service_detail_page_is_available_by_slug(): void
    {
        $service = Service::factory()->create([
            'title' => 'Websites Premium',
            'slug' => 'websites-premium',
            'meta_title' => 'Websites Premium para Empresas',
            'meta_description' => 'Serviço NBTech para websites premium com foco em clareza, performance e conversão.',
        ]);

        $response = $this->get(route('services.show', $service));

        $response->assertOk();
        $response->assertSee('Websites Premium');
        $response->assertSee('Serviço NBTech para websites premium', false);
        $response->assertSee(route('budget.index'), false);
        $response->assertSee('Ideal para', false);
        $response->assertSee('O que normalmente entregamos', false);
        $response->assertSee('application/ld+json', false);
        $response->assertSee('Service', false);
    }
}
