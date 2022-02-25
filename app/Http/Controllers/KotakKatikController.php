<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KotakKatikController extends Controller
{
    /**
     * Papan permainan
     * Koordinat [0,0] dan [5, 5] akan selalu berisikan nilai 0
     * sebagai titik awal dan titik akhir.
     */
    private array $papan = [
        [0, 1, 1, 7, 6, 4],
        [4, 6, 2, 8, 6, 1],
        [2, 1, 1, 1, 8, 4],
        [8, 7, 4, 9, 1, 1],
        [8, 8, 6, 7, 9, 2],
        [8, 8, 5, 2, 6, 0],
    ];

    private array $solusiJalan = [];

    public function temukanJalan(): array
    {
        // Tolong implementasikan saya
        $jalan = [];
        $energi = [];

        $countRow = count($this->papan);
        foreach($this->papan as $key => $item) {
            $next = ($key + 1) < 6 ? $this->papan[($key + 1)] : [];

            for($i=$key; $i < 5; $i++) {
                if($item[$i] <= $item[$i+1]) {
                    $jalan[] = [$key, $i];
                    $energi[] = $item[$i];
                } else {
                     if(!empty($next) && $next[$i] <= $item[$i+1]) {
                        $jalan[] = [$key, $i];
                        $energi[] = $next[$i];
                        //continue;
                    }
                }
            }
        }

        print('DATA : <small><pre>'.print_r($jalan, TRUE).'</pre></small>');
        print('DATA : <small><pre>'.print_r($energi, TRUE).'</pre></small>');
        $this->solusiJalan = $energi;
        return $jalan;
    }

    public function totalEnergi(): int
    {
        // Tolong implementasikan saya
        $total = 0;
        
        $total = array_sum($this->solusiJalan);
        
        print('DATA Total: <small><pre>'.print_r($total, TRUE).'</pre></small>');
        return $total;
    }

    public function index()
    {
        $permainan = new KotakKatikController();

        // mengembalikan hasil [[0,0], [1,0], [2,0], [2,1], [2,2], [3,2], [4,2], [4,3], [5,3], [5,4], [5,5]]
        $permainan->temukanJalan();

        // mengembalikan hasil 18
        $permainan->totalEnergi();
    }
}
