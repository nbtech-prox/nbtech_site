<?php

use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\QuoteController as AdminQuoteController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\TestimonialController as AdminTestimonialController;
use App\Http\Controllers\Web\AboutController;
use App\Http\Controllers\Web\ContactController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\PortfolioController;
use App\Http\Controllers\Web\ServiceController;
use App\Http\Controllers\Web\TestimonialSubmissionController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::get('/servicos', ServiceController::class)->name('services.index');
Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio.index');
Route::get('/portfolio/{project:slug}', [PortfolioController::class, 'show'])->name('portfolio.show');
Route::get('/sobre', AboutController::class)->name('about');
Route::post('/testemunhos', [TestimonialSubmissionController::class, 'store'])->name('testimonials.store');
Route::get('/contacto', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contacto', [ContactController::class, 'store'])->name('contact.store');

Route::middleware(['auth', 'admin.role'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard');
    Route::resource('projects', AdminProjectController::class)->except('show');
    Route::resource('quotes', AdminQuoteController::class);
    Route::get('quotes/{quote}/pdf/{type}', [AdminQuoteController::class, 'downloadDocument'])->name('quotes.pdf');
    Route::patch('quotes/{quote}/mark-invoiced', [AdminQuoteController::class, 'markInvoiced'])->name('quotes.mark-invoiced');
    Route::patch('quotes/{quote}/mark-paid', [AdminQuoteController::class, 'markPaid'])->name('quotes.mark-paid');
    Route::resource('services', AdminServiceController::class)->except('show');
    Route::resource('testimonials', AdminTestimonialController::class)->except('show');
    Route::patch('testimonials/{testimonial}/approve', [AdminTestimonialController::class, 'approve'])->name('testimonials.approve');
    Route::patch('testimonials/{testimonial}/pending', [AdminTestimonialController::class, 'markPending'])->name('testimonials.pending');
    Route::get('/messages', [ContactMessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{message}', [ContactMessageController::class, 'show'])->name('messages.show');
    Route::delete('/messages/{message}', [ContactMessageController::class, 'destroy'])->name('messages.destroy');
});
