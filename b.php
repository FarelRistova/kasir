<?php
session_start();

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

    public function getTotal() {
        return $this->harga * $this->jumlah;
    }

    public function getDetail() {
        return "Jenis Nasi: <strong>" . $this->jenis . "</strong><br>Harga: Rp. <strong>" 
        . number_format($this->harga, 2, ',', '.') . "</strong><br>Jumlah: <strong>" . $this->jumlah 
        . "</strong><br>No. Meja: <strong>" . $this->meja . "</strong>";
    }
}

if (isset($_GET['hapus']) && is_numeric($_GET['hapus'])) {
    $index = intval($_GET['hapus']);
    if (isset($_SESSION['orders'][$index])) {
        unset($_SESSION['orders'][$index]);
    }
    header('Location: b.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="s.css?v=1.0">
    <title>Struk Transaksi</title>
    <style>
        .struk {
            margin: 50px auto;
            width: 30%;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h4 {
            text-align: center;
        }

    </style>
</head>
<body>
    <div class="struk">
        <h4>Daftar Pesanan:</h4>
        <hr>
        <ul>
            <?php foreach ($_SESSION['orders'] as $index => $order): ?>
                <li>
                    <?= $order->getDetail() ?>
                    <a href="?hapus=<?= $index ?>" class="btn btn-danger btn-sm">Hapus</a>
                </li>
                <br>
            <?php endforeach; ?>
        </ul>
        <hr>
        <p>Total Pembayaran: <strong>Rp. <?= number_format(array_sum(array_map(function($order) {
            return $order->getTotal();
        }, $_SESSION['orders'])), 2, ',', '.') ?></strong></p>
        <a href="a1.php" class="btn btn-primary">Kembali</a>
    </div>
</body>
</html>
