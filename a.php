<?php
session_start();

if (!isset($_SESSION['orders'])) {
    $_SESSION['orders'] = array();
}

class Nasi {
    protected $harga;
    protected $jenis;
    protected $jumlah;
    protected $meja;

    public function __construct($jenis, $harga, $jumlah, $meja) {
        $this->jenis = $jenis;
        $this->harga = $harga;
        $this->jumlah = $jumlah;
        $this->meja = $meja;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['jenis']) && isset($_POST['jumlah']) && $_POST['jumlah'] > 0 && !empty($_POST['meja'])) {
        $jenis = $_POST['jenis'];
        $jumlah = $_POST['jumlah'];
        $meja = $_POST['meja'];

        $harga_nasi = array(
            "Nasi Goreng" => 15000,
            "Nasi Liwet" => 18000,
            "Nasi Ulam" => 20000,
            "Nasi Jamblang" => 25000,
            "Nasi Kuning" => 12000
        );

        if (isset($harga_nasi[$jenis])) {
            $harga = $harga_nasi[$jenis];
            $nasi = new Nasi($jenis, $harga, $jumlah, $meja);
            $_SESSION['orders'][] = $nasi;
            header('Location: a1.php');
            exit;
        }
    }
}
?>
