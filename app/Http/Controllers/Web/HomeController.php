<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\ViewModels\HomeViewModel;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(HomeViewModel $viewModel): View
    {
        return view('web.home', $viewModel->toArray());
    }
}
