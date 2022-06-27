<?php

namespace App\Http\Controllers\Widget;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

/**
 * Class SubscriptionController
 */
class SubscriptionController extends Controller
{
    /**
     * SubscriptionController::index()
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        dd("SubscriptionController::index()");
//        return view('pages.user.index');
    }
}
