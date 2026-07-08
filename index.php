<?php

$jsonData = file_get_contents('ogrenciler.json');
$ogrenciler = json_decode($jsonData, true); 

$sonuclar = [];

function notHesapla($ortalama) {
    if ($ortalama >= 90) return ["AA", "4.00", "Başarılı"];
    if ($ortalama >= 85) return ["BA", "3.50", "Başarılı"];
    if ($ortalama >= 80) return ["BB", "3.00", "Başarılı"];
    if ($ortalama >= 75) return ["CB", "2.50", "Başarılı"];
    if ($ortalama >= 70) return ["CC", "2.00", "Başarılı"];
    if ($ortalama >= 60) return ["DC", "1.50", "Geçer"];
    if ($ortalama >= 50) return ["DD", "1.00", "Geçer"];
    return ["FF", "0.00", "Kaldı"];
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Ödev-5 Not Hesaplama</title>
    <style>
        table { width: 100%; border-collapse: collapse; font-family: Arial, sans-serif; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: center; }
        th { background-color: #f2f2f2; }
        .gecer { background-color: #d4edda; color: #155724; } 
        .kaldi { background-color: #f8d7da; color: #721c24; } 
    </style>
</head>
<body>

<h2>Öğrenci Not Listesi</h2>
<table>
    <thead>
        <tr>
            <th>Okul No</th>
            <th>Ad Soyad</th>
            <th>Ders Adı</th>
            <th>Vize</th>
            <th>Ödev</th>
            <th>Proje</th>
            <th>Final</th>
            <th>Ortalama</th>
            <th>Harf Notu</th>
            <th>Katsayı</th>
            <th>Statü</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($ogrenciler as $o): 

            $ortalama = ($o['vize'] * 0.25) + ($o['odev'] * 0.25) + ($o['proje'] * 0.05) + ($o['final'] * 0.45);
            
            list($harf, $katsayi, $statu) = notHesapla($ortalama);

            $satirStili = ($ortalama >= 50) ? "gecer" : "kaldi";

            $sonuclar[] = [
                "okul_no" => $o['okul_no'],
                "ad_soyad" => $o['ad_soyad'],
                "ders_adi" => $o['ders_adi'],
                "donem_sonu_notu" => $ortalama,
                "harf_notu" => $harf,
                "katsayi" => $katsayi,
                "statu" => $statu
            ];
        ?>
        <tr class="<?= $satirStili ?>">
            <td><?= $o['okul_no'] ?></td>
            <td><?= $o['ad_soyad'] ?></td>
            <td><?= $o['ders_adi'] ?></td>
            <td><?= $o['vize'] ?></td>
            <td><?= $o['odev'] ?></td>
            <td><?= $o['proje'] ?></td>
            <td><?= $o['final'] ?></td>
            <td><?= number_format($ortalama, 2) ?></td>
            <td><?= $harf ?></td>
            <td><?= $katsayi ?></td>
            <td><?= $statu ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php
$finalJson = json_encode($sonuclar, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
file_put_contents('sonuclar.json', $finalJson);
?>

</body>
</html>