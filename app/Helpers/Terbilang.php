<?php
namespace App\Helpers;

class Terbilang{

    public static function terbilang($x) {
        $_this = new self;
        $x = abs($x);
        $angka = array("", "Satu", "Dua", "Tiga", "Empat", "Lima",
            "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
        $temp = "";
        if ($x <12) {
            $temp = " ". $angka[$x];
        } else if ($x <20) {
            $temp = $_this->terbilang($x - 10). " Belas";
        } else if ($x <100) {
            $temp = $_this->terbilang($x/10)." Puluh". $_this->terbilang($x % 10);
        } else if ($x <200) {
            $temp = " seratus" . $_this->terbilang($x - 100);
        } else if ($x <1000) {
            $temp = $_this->terbilang($x/100) . " Ratus" . $_this->terbilang($x % 100);
        } else if ($x <2000) {
            $temp = " seribu" . $_this->terbilang($x - 1000);
        } else if ($x <1000000) {
            $temp = $_this->terbilang($x/1000) . " Ribu" . $_this->terbilang($x % 1000);
        } else if ($x <1000000000) {
            $temp = $_this->terbilang($x/1000000) . " Juta" . $_this->terbilang($x % 1000000);
        } else if ($x <1000000000000) {
            $temp = $_this->terbilang($x/1000000000) . " Milyar" . $_this->terbilang(fmod($x,1000000000));
        } else if ($x <1000000000000000) {
            $temp = $_this->terbilang($x/1000000000000) . " Trilyun" . $_this->terbilang(fmod($x,1000000000000));
        }
        return $temp;
    }
}