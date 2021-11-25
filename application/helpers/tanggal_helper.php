<?php
function formatHariTanggal($waktu) //Variable $waktu merupakan parameter untuk menyimpan data dari form inputan tanggal.
{
    $tanggal = date('j', strtotime($waktu)); //inisialisasi untuk tanggal dengan variable $tanggal
    //menampung nama-nama bulan dengan urutan dari nomor 1-12
    $nama_bulan = [
        1 => 'Januari',
        2 => 'February',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember',
    ];

    $bl = date('n', strtotime($waktu));
    $bulan = $nama_bulan[$bl]; //mendefinisikan bulan
    $tahun = date('Y', strtotime($waktu)); //mendefinisikan tahun
    //mengembalikkan value dari masing-masing variable yang sudah didefinisikan tadi dengan urutan tanggal, bulan, dan tahun
    return "$tanggal $bulan $tahun";
}
