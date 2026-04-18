<?php

namespace Tests\Unit;

use App\Models\Project;
use App\Models\Service;
use Tests\TestCase;

class FrontendContentFallbackTest extends TestCase
{
    public function test_service_page_content_uses_config_fallbacks(): void
    {
        $service = new Service([
            'title' => 'Websites',
            'slug' => 'websites',
        ]);

        $content = $service->pageContent();

        $this->assertSame('Desenhamos websites que explicam melhor o teu valor, tornam a marca mais credível e conduzem o visitante a uma ação clara.', $content['lead']);
        $this->assertNotEmpty($content['faqs']);
    }

    public function test_project_gallery_fallback_uses_config_data(): void
    {
        $project = new Project([
            'title' => 'PopSmart',
            'slug' => 'popsmart-pt',
        ]);

        $gallery = $project->previewGalleryItems();

        $this->assertNotEmpty($gallery);
        $this->assertSame('https://popsmart.pt/wp-content/uploads/2026/01/11X-Preto.jpg', $gallery->first()['src']);
    }
}
