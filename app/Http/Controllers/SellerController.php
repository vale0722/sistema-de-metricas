<?php

namespace App\Http\Controllers;

use App\Entities\Seller;
use Illuminate\View\View;

class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        return view('sellers.index', [
            'sellers' => Seller::paginate(10),
        ]);
    }
}
