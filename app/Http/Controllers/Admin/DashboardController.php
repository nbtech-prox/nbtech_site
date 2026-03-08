<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ViewModels\AdminDashboardViewModel;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(AdminDashboardViewModel $viewModel): View
    {
        return view('admin.dashboard', $viewModel->toArray());
    }
}
