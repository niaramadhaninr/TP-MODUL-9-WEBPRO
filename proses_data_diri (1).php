<?php
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: form_data_diri.html");
    exit;
}

$bulan = [
    1  => "Januari",
    2  => "Februari",
    3  => "Maret",
    4  => "April",
    5  => "Mei",
    6  => "Juni",
    7  => "Juli",
    8  => "Agustus",
    9  => "September",
    10 => "Oktober",
    11 => "November",
    12 => "Desember",
];

function formatTanggalIndonesia($tanggal, $bulan)
{
    $bagian = explode("-", $tanggal);
    if (count($bagian) !== 3) {
        return "-";
    }

    $tahun = (int) $bagian[0];
    $bln   = (int) $bagian[1];
    $hari  = (int) $bagian[2];

    if (!checkdate($bln, $hari, $tahun)) {
        return "-";
    }

    return $hari . " " . $bulan[$bln] . " " . $tahun;
}

$nama          = isset($_POST["nama"]) ? trim($_POST["nama"]) : "";
$tanggal_lahir = isset($_POST["tanggal_lahir"]) ? $_POST["tanggal_lahir"] : "";

$hobi_dipilih = (isset($_POST["hobi"]) && is_array($_POST["hobi"])) ? $_POST["hobi"] : [];

if (count($hobi_dipilih) > 0) {
    $hobi = implode(", ", $hobi_dipilih);
} else {
    $hobi = "Tidak ada hobi yang dipilih";
}

$tanggal_tampil = formatTanggalIndonesia($tanggal_lahir, $bulan);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tampilan Data Anda</title>
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 40px 16px;
        }
        .card {
            background: #ffffff;
            max-width: 600px;
            margin: 0 auto;
            padding: 26px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        }
        h1 {
            font-size: 32px;
            margin: 10px 0 0;
            padding-bottom: 16px;
            border-bottom: 1px solid #e5e5e5;
        }
        table {
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            text-align: left;
            vertical-align: middle;
            padding: 14px 0;
            font-size: 22px;
        }
        th {
            padding-right: 14px;
            white-space: nowrap;
        }
        a {
            display: inline-block;
            margin-top: 22px;
            font-size: 20px;
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="card">
        <h1>Tampilan Data Anda</h1>

        <table>
            <tr>
                <th>Nama Lengkap:</th>
                <td><?php echo htmlspecialchars($nama, ENT_QUOTES, "UTF-8"); ?></td>
            </tr>
            <tr>
                <th>Tanggal Lahir:</th>
                <td><?php echo htmlspecialchars($tanggal_tampil, ENT_QUOTES, "UTF-8"); ?></td>
            </tr>
            <tr>
                <th>Hobi:</th>
                <td><?php echo htmlspecialchars($hobi, ENT_QUOTES, "UTF-8"); ?></td>
            </tr>
        </table>

        <a href="form_data_diri.html">&laquo; Kembali ke Form</a>
    </div>
</body>
</html>
