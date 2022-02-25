<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KlasemenController extends Controller
{
    public $team;
    public $file;
	
	public function __construct(array $team = ['Liverpool', 'Chelsea', 'Arsenal'])
    {
        $this->team = $team;
        $this->file = './json_catat_permainan.json';
    }

    public function index()
    {
        $klasmen = new KlasemenController(['Liverpool', 'Chelsea', 'Arsenal']);
        //$this->team = ['Liverpool', 'Chelsea', 'Arsenal'];
        $klasmen->catatPermainan('Arsenal', 'Liverpool', '2:1');
        $klasmen->catatPermainan('Arsenal', 'Chelsea', '1:1');
        $klasmen->catatPermainan('Chelsea', 'Arsenal', '0:3');
        $klasmen->catatPermainan('Chelsea', 'Liverpool', '3:2');
        $klasmen->catatPermainan('Liverpool', 'Arsenal', '2:2');
        $klasmen->catatPermainan('Liverpool', 'Chelsea', '0:0');

        $klasmen->cetakKlasmen();
        $klasmen->ambilPeringkat(2);
    }
    
    public function catatPermainan(string $home, string $away, string $score)
    {
    	if(! in_array($home, $this->team) && ! in_array($away, $this->team)) {
    		exit("Team not in list");
    	}
    	if(count(explode(":", $score)) <= 1) {
    		exit("Score value not matching");
    	}
    	
    	$scores = explode(":", $score);
        $match = "{$home}-vs-{$away}";
    	$hasil = [
            "{$match}" => 
                [
                    "{$home}" => $scores[0],
                    "{$away}" => $scores[1],
                ]
    	];

        // First touch file
        if(!is_file($this->file)) {
            $ligafile = fopen($this->file, "w");
            $fileContents = json_encode($hasil);
            fwrite($ligafile, $fileContents);
            fclose($ligafile);
        } else {
            //Retrieve the data
            $fileContents = file_get_contents($this->file);
            $search_array = json_decode($fileContents, true);
            if (!empty($search_array) && array_key_exists($match, $search_array) === false) {
                $encodedString = json_encode(array_merge_recursive($hasil, $search_array));
                $ligafile = fopen($this->file, "w");
                fwrite($ligafile, $encodedString);
                fclose($ligafile);
            }
        }
    }

    public function cetakKlasmen() 
    {
        if(!is_file($this->file)) {
            return null;
        }
        //Retrieve the data
        $fileContents = file_get_contents($this->file);
        $search_array = json_decode($fileContents, true);

        $team = [];
        foreach($search_array as $key => $pertandingan) {
            
            $expTeam = explode("-vs-", $key);
            $team1 = $expTeam[0];
            $team2 = $expTeam[1];

            // Set default
            if(!isset($team[$team1]) || !isset($team[$team2])) {
                $team[$team1] = 0;
                $team[$team2] = 0;
            }

            // Hitung Poin Klasmen
            if($pertandingan[$team1][0] == $pertandingan[$team2][0]) {
                $team[$team1] += 1;
                $team[$team2] += 1;
            }
            elseif($pertandingan[$team1][0] > $pertandingan[$team2][0]) {
                $team[$team1] += 3;
                $team[$team2] += 0;
            }
            elseif($pertandingan[$team1][0] < $pertandingan[$team2][0]) {
                $team[$team1] += 0;
                $team[$team2] += 3;
            }
            else {
                $team[$team1] += 0;
                $team[$team2] += 0;
            }
        }

        ksort($team);

        //print_r($team);
        return $team;
    }

    public function ambilPeringkat(int $peringkat)
    {
        $klasmen = $this->cetakKlasmen();

        if(!is_numeric($peringkat) || $peringkat <= 0 || $peringkat > count($klasmen))
            exit("Peringkat tidak ditemukan");

        $keys = array_keys($klasmen);
        echo $keys[($peringkat - 1)];
    }
}
