<?php

namespace App\Http\Controllers\Widget;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

/**
 * Class WidgetController
 */
class WidgetController extends Controller
{
    /**
     * WidgetController::index()
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        dd("WidgetController::index()");
//        return view('pages.user.index');
    }
}
