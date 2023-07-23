<?php

namespace App\Charts;

use App\Models\Infaq;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;

class InfaqBulananChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
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

        // dd($dataTotalInfaq);

        return $this->chart->lineChart()
            ->setTitle('Data Infaq Bulanan')
            ->setSubtitle('Total Penerimaan Infaq Setiap Bulan')
            ->addData('Total Infaq', $dataTotalInfaq)
            ->setHeight(285)
            ->setXAxis($dataBulan);
    }
}
