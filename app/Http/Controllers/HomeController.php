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
        $tahun = date('Y');
        $bulan = date('m');

        for ($i = 1; $i <= $bulan; $i++) {
            $totalInfaq = Infaq::userMasjid()
                ->where('jenis', 'uang')
                ->whereYear('created_at', $tahun)
                ->whereMonth('created_at', $i)->sum('jumlah');

            // $dataBulan[] = Carbon::create()->month($i)->format('F');  // masukan data bulan kedalam array
            $dataBulan[] = ubahAngkaToBulan($i);  // masukan data bulan kedalam array
            $dataTotalInfaq[] = $totalInfaq;  // masukan data total infaq kedalam array
        }


        $data = [
            'title'             => 'Dashboard',
            'saldoAkhir'        => Kas::saldoAkhir(),
            'totalInfaq'        => Infaq::userMasjid()->where('jenis', 'uang')->whereDate('created_at', now()->format('Y-m-d'))->sum('jumlah'),
            'kas'               => Kas::userMasjid()->latest()->take(10)->get(),
            'chart'             => $chart->build(),
            'dataBulan'         => $dataBulan,
            'dataTotalInfaq'    => $dataTotalInfaq,
        ];
        return view('home', $data);
    }
}
