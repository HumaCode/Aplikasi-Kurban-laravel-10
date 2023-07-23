<?php

namespace App\Http\Controllers;

use App\Charts\InfaqBulananChart;
use App\Models\Infaq;
use App\Models\Kas;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(InfaqBulananChart $chart)
    {
        $data = [
            'title'         => 'Dashboard',
            'saldoAkhir'    => Kas::saldoAkhir(),
            'totalInfaq'    => Infaq::userMasjid()->where('jenis', 'uang')->whereDate('created_at', now()->format('Y-m-d'))->sum('jumlah'),
            'kas'           => Kas::userMasjid()->latest()->take(10)->get(),
            'chart'         => $chart->build(),
        ];
        return view('home', $data);
    }
}
