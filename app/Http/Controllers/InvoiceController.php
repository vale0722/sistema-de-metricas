<?php

namespace App\Http\Controllers;

use App\Entities\Invoice;
use Illuminate\View\View;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        return view('invoices.index', [
            'invoices' => Invoice::with('seller')->paginate(10),
        ]);
    }
}
