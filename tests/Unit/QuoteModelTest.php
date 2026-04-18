<?php

namespace Tests\Unit;

use App\Models\Quote;
use App\Support\QuoteStatuses;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QuoteModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_quote_knows_when_it_can_transition_status(): void
    {
        $draft = new Quote(['status' => QuoteStatuses::DRAFT]);
        $emitted = new Quote(['status' => QuoteStatuses::EMITTED]);

        $this->assertTrue($draft->canMarkInvoiced());
        $this->assertFalse($draft->canMarkPaid());

        $this->assertFalse($emitted->canMarkInvoiced());
        $this->assertTrue($emitted->canMarkPaid());
    }
}
