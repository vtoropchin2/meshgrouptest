<?php declare(strict_types=1);


namespace App\Http\Controllers;


/**
 * Class SpaController
 * @package App\Http\Controllers
 */
class SpaController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function loadSpa()
    {
        return view('index');
    }
}
