<?php

namespace Tests\Unit;

use App\Models\ContactMessage;
use App\Models\Project;
use App\Models\Quote;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\User;
use App\Policies\ContactMessagePolicy;
use App\Policies\ProjectPolicy;
use App\Policies\QuotePolicy;
use App\Policies\ServicePolicy;
use App\Policies\TestimonialPolicy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class AdminPoliciesTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_resource_policies_allow_admin_and_deny_non_admin(): void
    {
        Role::findOrCreate('admin');
        Role::findOrCreate('editor');

        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $editor = User::factory()->create();
        $editor->assignRole('editor');

        $projectPolicy = new ProjectPolicy;
        $servicePolicy = new ServicePolicy;
        $quotePolicy = new QuotePolicy;
        $testimonialPolicy = new TestimonialPolicy;
        $messagePolicy = new ContactMessagePolicy;

        $project = new Project;
        $service = new Service;
        $quote = new Quote;
        $testimonial = new Testimonial;
        $message = new ContactMessage;

        $this->assertTrue($projectPolicy->update($admin, $project));
        $this->assertFalse($projectPolicy->update($editor, $project));

        $this->assertTrue($servicePolicy->create($admin));
        $this->assertFalse($servicePolicy->create($editor));

        $this->assertTrue($quotePolicy->delete($admin, $quote));
        $this->assertFalse($quotePolicy->delete($editor, $quote));

        $this->assertTrue($testimonialPolicy->update($admin, $testimonial));
        $this->assertFalse($testimonialPolicy->update($editor, $testimonial));

        $this->assertTrue($messagePolicy->view($admin, $message));
        $this->assertFalse($messagePolicy->view($editor, $message));
    }
}
