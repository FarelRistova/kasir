<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warung Nasi Berkah</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="s.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h1>Warung Nasi Berkah <i class='bx bxs-bowl-rice'></i></h1>
                <form method="POST" action="a.php" class="kolom">
                    <div class="form-group">
                        <label for="jenis">Menu Nasi:</label>
                        <select name="jenis" id="jenis" class="form-control" required>
                            <option value="" disabled selected>Silakan pilih jenis nasi!</option>
                            <option value="Nasi Goreng">Nasi Goreng - Rp. 15.000</option>
                            <option value="Nasi Liwet">Nasi Liwet - Rp. 18.000</option>
                            <option value="Nasi Ulam">Nasi Ulam - Rp. 20.000</option>
                            <option value="Nasi Jamblang">Nasi Jamblang - Rp. 25.000</option>
                            <option value="Nasi Kuning">Nasi Kuning - Rp. 12.000</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jumlah">Jumlah:</label>
                        <input type="number" name="jumlah" id="jumlah" min="1" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="meja">Nomor Meja:</label>
                        <select name="meja" id="meja" class="form-control" required>
                            <option value="" disabled selected>Pilih nomor meja</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="Di bungkus">Bungkus</option>
                        </select>
                    </div>
                    <input type="submit" value="Pesan" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</body>
</html>

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
        return "Jenis Nasi: " . $this->jenis . "<br>Harga: Rp. " . number_format($this->harga, 2, ',', '.') . "<br>Jumlah: " . $this->jumlah . "<br>No. Meja: " . $this->meja;
    }
}

if (isset($_GET['hapus']) && is_numeric($_GET['hapus'])) {
    $index = intval($_GET['hapus']);
    if (isset($_SESSION['orders'][$index])) {
        unset($_SESSION['orders'][$index]);
    }
    header('Location: a1.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pesanan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="s.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2>Pesanan:</h2>
                <?php if (!empty($_SESSION['orders'])): ?>
                    <ul>
                        <?php foreach ($_SESSION['orders'] as $index => $order): ?>
                            <li>
                                <?= $order->getDetail() ?>
                                <a href="?hapus=<?= $index ?>" class="btn btn-danger btn-sm">Hapus</a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p>Tidak ada pesanan.</p>
                <?php endif; ?>
                <a href="b.php" class="btn btn-primary">Cetak Pesanan</a>
            </div>
        </div>
    </div>
</body>
</html>
