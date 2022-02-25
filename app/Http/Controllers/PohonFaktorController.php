<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PohonFaktorController extends Controller
{
    //

    public function index()
    {
        $this->hitungPohonFaktor(24);
        $this->faktorisasi(24);
        //echo $this->faktorialial(6);


        //$this->hitungPohonFaktor(6);
        //$this->hitungPohonFaktor(12);
        //$this->hitungPohonFaktor(16);
        //$this->hitungPohonFaktor(18);
        //$this->hitungPohonFaktor(36);
        //$this->hitungPohonFaktor(48);
        //$this->hitungPohonFaktor(64);
    }

    function bilPrima($bilangan, $status=false)
    {
        $hasil = true;
        for ($i = 2; $i < $bilangan; $i++)
        {
            if ($bilangan % $i == 0)
                $hasil = false;
        }

        if($status)
            return $hasil;

        if($hasil)
            return $bilangan;
        else
            return 0;
    }

    function faktorisasi($bilangan)
    {
        $faktor = [];
        $n = $bilangan;

        while ($bilangan > 1) {
            for ($i = 2; $i <= $bilangan; $i++) {
                if ($bilangan % $i == 0) {
                    array_push($faktor, $i);
                    $bilangan = $bilangan / $i;
                    break;
                }
            }
        }

        /*$y = 0;
        for ($i = 2; $i <= $bilangan; $i++)
        {
            if($this->bilPrima($i, true)) {
                $faktor[] = $bilangan / $i;
                

                $y++;
            }
        }*/

        //arsort($faktor);
        print('DATA - '.$n.' :  <small><pre>'.print_r($faktor, TRUE).'</pre></small>');
        print('DATA - '.$n.' :  <small><pre>'.print_r(array_sum($faktor), TRUE).'</pre></small>');
        return $faktor;
    }

    public function hitungPohonFaktor(int $bilangan)
    {
        $faktor1 = [];
        $faktor2 = [];
        $prima = 2;
        $recFaktor = 0;

        while ($bilangan > 1){
            if($bilangan % $prima == 0){
                $faktor1[$recFaktor] = $prima;
                $faktor2[$recFaktor] = 0;
                while ($bilangan % $prima == 0){
                    $faktor2[$recFaktor]++;
                    $bilangan = ($bilangan / $prima);
                }

                $recFaktor++;
            }

            $prima =  ($prima == 2) ? 3 : ($prima + 2);
        }

        /*for($i=0; $i<$bilangan; $i++) {
            print($faktor1[$i] ." ^ ". $faktor2[$i]);
            if ($i + 1 < $bilangan) print(" x ");
        }*/

        //arsort($faktor);

        print('DATA - faktor1 :  <small><pre>'.print_r($faktor1, TRUE).'</pre></small>');
        print('DATA - faktor2 :  <small><pre>'.print_r($faktor2, TRUE).'</pre></small>');
        //echo array_sum($faktor)."<br>";
        return;
    }


    function faktorialial($x){
        $angka = 1;
        $faktorial = 1;
         while($angka <= $x){
             $faktorial = $faktorial * $angka;
             $angka = $angka + 1;
         }
          
        return $faktorial;
    }

}
