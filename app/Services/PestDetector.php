<?php
namespace App\Services;

class PestDetector
{
    public static function analyze($temp, $humid)
    {
        if ($temp > 30 && $humid > 70) {
            return "Risiko tinggi: kondisi ideal bagi jamur & serangga.";
        } elseif ($temp > 28 && $humid > 60) {
            return "Risiko sedang: potensi hama meningkat.";
        } else {
            return "Risiko rendah: kondisi aman.";
        }
    }
}

