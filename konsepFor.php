<?php
function helloworld($n) {
    // Mulai tabel dengan header
    $outputDeret = "<table border='1' cellpadding='10' cellspacing='0'>";
    $outputDeret .= "<tr><th>Angka</th><th>Hasil</th></tr>";  // Header tabel dengan dua kolom: Angka dan Hasil

    for ($a = 1; $a <= $n; $a++) {
        // Kondisi untuk angka yang bisa dibagi 4 dan 5
        if ($a % 4 == 0 && $a % 5 == 0) {
            $outputDeret .= "<tr><td>$a</td><td>helloworld</td></tr>";  // Angka dan hasil "helloworld"
        }
        // Kondisi untuk angka yang bisa dibagi 4 saja
        elseif ($a % 4 == 0) {
            $outputDeret .= "<tr><td>$a</td><td>hello</td></tr>";  // Angka dan hasil "hello"
        }
        // Kondisi untuk angka yang bisa dibagi 5 saja
        elseif ($a % 5 == 0) {
            $outputDeret .= "<tr><td>$a</td><td>world</td></tr>";  // Angka dan hasil "world"
        }
        // Angka biasa yang tidak memenuhi kondisi di atas
        else {
            $outputDeret .= "<tr><td>$a</td><td></td></tr>";  // Angka saja tanpa hasil
        }
    }

    $outputDeret .= "</table>";  // Tutup tabel

    echo $outputDeret;  // Output semua hasil
}

helloworld(20);  // Panggil fungsi dengan input contoh
?>
