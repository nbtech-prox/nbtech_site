<?php

namespace Tests\Feature\Admin;

use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class AdminTestimonialManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_manage_testimonial_lifecycle(): void
    {
        Role::findOrCreate('admin');

        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $storePayload = [
            'name' => 'Joao Silva',
            'company' => 'Acme Lda',
            'company_url' => 'https://acme.example',
            'quote' => 'Excelente suporte tecnico e entrega muito rapida.',
            'rating' => 5,
            'status' => 'pending',
        ];

        $createResponse = $this->actingAs($admin)->post(route('admin.testimonials.store'), $storePayload);

        $testimonial = Testimonial::query()->where('name', 'Joao Silva')->first();

        $this->assertNotNull($testimonial);
        $createResponse->assertRedirect(route('admin.testimonials.edit', $testimonial));

        $approveResponse = $this->actingAs($admin)
            ->patch(route('admin.testimonials.approve', $testimonial));

        $approveResponse->assertSessionHas('status');
        $this->assertDatabaseHas('testimonials', [
            'id' => $testimonial->id,
            'status' => 'approved',
        ]);

        $pendingResponse = $this->actingAs($admin)
            ->patch(route('admin.testimonials.pending', $testimonial));

        $pendingResponse->assertSessionHas('status');
        $this->assertDatabaseHas('testimonials', [
            'id' => $testimonial->id,
            'status' => 'pending',
        ]);

        $updateResponse = $this->actingAs($admin)
            ->put(route('admin.testimonials.update', $testimonial), [
                ...$storePayload,
                'quote' => 'Atualizacao: qualidade consistente e comunicacao clara.',
                'rating' => 4,
                'status' => 'approved',
            ]);

        $updateResponse->assertSessionHas('status');
        $this->assertDatabaseHas('testimonials', [
            'id' => $testimonial->id,
            'rating' => 4,
            'status' => 'approved',
        ]);

        $deleteResponse = $this->actingAs($admin)
            ->delete(route('admin.testimonials.destroy', $testimonial));

        $deleteResponse->assertRedirect(route('admin.testimonials.index'));
        $this->assertDatabaseMissing('testimonials', ['id' => $testimonial->id]);
    }
}
