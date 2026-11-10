<?php

// Script to generate high-resolution professional book covers
$covers = [
    [
        'filename' => 'laravel.jpg',
        'bg1' => [235, 35, 75],    // Laravel red
        'bg2' => [25, 15, 45],     // Deep dark
        'accent' => [255, 180, 50],
        'badge' => 'TEKNOLOGI INFORMASI',
        'title' => "PEMROGRAMAN\nLARAVEL",
        'subtitle' => 'UNTUK PEMULA',
        'desc' => 'Panduan Praktis Belajar Web Modern',
        'author' => 'Budi Santoso',
        'publisher' => 'PENERBIT INFORMATIKA',
        'edition' => 'EDISI LENGKAP 2026',
    ],
    [
        'filename' => 'python.jpg',
        'bg1' => [30, 80, 160],    // Python blue
        'bg2' => [10, 30, 60],     // Dark blue
        'accent' => [255, 215, 0], // Python yellow
        'badge' => 'TEKNOLOGI INFORMASI',
        'title' => "BELAJAR PYTHON\nDARI NOL",
        'subtitle' => 'DASAR HINGGA MAHIR',
        'desc' => 'Logika Pemrograman & Studi Kasus Riil',
        'author' => 'Rina Wati',
        'publisher' => 'ELEX MEDIA KOMPUTINDO',
        'edition' => 'BEST SELLER',
    ],
    [
        'filename' => 'laskar-pelangi.jpg',
        'bg1' => [14, 116, 144],   // Ocean cyan
        'bg2' => [194, 65, 12],    // Sunset orange
        'accent' => [254, 240, 138],
        'badge' => 'NOVEL SASTRA & FIKSI',
        'title' => "LASKAR\nPELANGI",
        'subtitle' => 'KARYA MONUMENTAL',
        'desc' => 'Perjuangan Menggapai Impian di Tanah Belitung',
        'author' => 'Andrea Hirata',
        'publisher' => 'BENTANG PUSTAKA',
        'edition' => 'EDISI KARYA UTAMA',
    ],
    [
        'filename' => 'bumi.jpg',
        'bg1' => [49, 46, 129],    // Deep indigo
        'bg2' => [88, 28, 135],    // Dark purple
        'accent' => [56, 189, 248], // Cyan light
        'badge' => 'SERIAL DUNIA PARALEL',
        'title' => 'B U M I',
        'subtitle' => 'PETUALANGAN RAIB & ALI',
        'desc' => 'Kisah Dunia Paralel Penuh Misteri',
        'author' => 'Tere Liye',
        'publisher' => 'GRAMEDIA PUSTAKA UTAMA',
        'edition' => 'MEGA BEST SELLER',
    ],
    [
        'filename' => 'rich-dad.jpg',
        'bg1' => [88, 28, 135],    // Rich Purple
        'bg2' => [120, 20, 40],    // Burgundy
        'accent' => [245, 158, 11], // Gold
        'badge' => 'LITERASI FINANSIAL',
        'title' => "RICH DAD\nPOOR DAD",
        'subtitle' => 'APA KATA ORANG KAYA TENTANG UANG',
        'desc' => 'Investasi & Pola Pikir Menuju Kebebasan Finansial',
        'author' => 'Robert T. Kiyosaki',
        'publisher' => 'GRAMEDIA PUSTAKA UTAMA',
        'edition' => '#1 FINANCIAL BOOK',
    ],
    [
        'filename' => 'zero-to-one.jpg',
        'bg1' => [15, 23, 42],     // Slate 900
        'bg2' => [30, 41, 59],     // Slate 800
        'accent' => [59, 130, 246], // Electric Blue
        'badge' => 'BISNIS & INOVASI STARTUP',
        'title' => 'ZERO TO ONE',
        'subtitle' => 'MEMBANGUN MASA DEPAN',
        'desc' => 'Cara Menciptakan Inovasi Monopoli Baru',
        'author' => 'Peter Thiel',
        'publisher' => 'CURRENCY',
        'edition' => 'THE GLOBAL PHENOMENON',
    ],
];

$width = 450;
$height = 640;
$fontBold = 'C:/Windows/Fonts/arialbd.ttf';
$fontRegular = 'C:/Windows/Fonts/arial.ttf';

$outputDir = __DIR__.'/storage/app/public/covers';
if (! is_dir($outputDir)) {
    mkdir($outputDir, 0777, true);
}

foreach ($covers as $item) {
    $img = imagecreatetruecolor($width, $height);

    // Draw vertical gradient
    for ($y = 0; $y < $height; $y++) {
        $factor = $y / $height;
        $r = (int) ($item['bg1'][0] * (1 - $factor) + $item['bg2'][0] * $factor);
        $g = (int) ($item['bg1'][1] * (1 - $factor) + $item['bg2'][1] * $factor);
        $b = (int) ($item['bg1'][2] * (1 - $factor) + $item['bg2'][2] * $factor);
        $color = imagecolorallocate($img, $r, $g, $b);
        imageline($img, 0, $y, $width, $y, $color);
    }

    // Colors
    $white = imagecolorallocate($img, 255, 255, 255);
    $accentColor = imagecolorallocate($img, $item['accent'][0], $item['accent'][1], $item['accent'][2]);
    $gray = imagecolorallocate($img, 200, 210, 225);
    $darkOverlay = imagecolorallocatealpha($img, 0, 0, 0, 75);
    $cardBg = imagecolorallocatealpha($img, 255, 255, 255, 115);
    $gold = imagecolorallocate($img, 255, 215, 0);

    // Decorative Borders
    imagesetthickness($img, 3);
    imagerectangle($img, 18, 18, $width - 18, $height - 18, $cardBg);
    imagesetthickness($img, 1);
    imagerectangle($img, 24, 24, $width - 24, $height - 24, $darkOverlay);

    // Spine effect (left shadow)
    for ($x = 0; $x < 15; $x++) {
        $alpha = (int) (110 - ($x * 6));
        $spineColor = imagecolorallocatealpha($img, 0, 0, 0, $alpha);
        imageline($img, $x, 0, $x, $height, $spineColor);
    }

    // Top Edition Badge (Ribbon)
    imagefilledrectangle($img, 35, 38, $width - 35, 66, $darkOverlay);
    imagerectangle($img, 35, 38, $width - 35, 66, $accentColor);
    $bbox = imagettfbbox(10, 0, $fontBold, $item['edition']);
    $badgeW = $bbox[2] - $bbox[0];
    imagettftext($img, 10, 0, (int) (($width - $badgeW) / 2), 55, $accentColor, $fontBold, $item['edition']);

    // Category Tag
    $bboxCat = imagettfbbox(9, 0, $fontBold, $item['badge']);
    $catW = $bboxCat[2] - $bboxCat[0];
    imagettftext($img, 9, 0, (int) (($width - $catW) / 2), 115, $gray, $fontBold, $item['badge']);

    // Decorative Line
    imagefilledrectangle($img, (int) ($width / 2) - 40, 130, (int) ($width / 2) + 40, 132, $accentColor);

    // Main Book Title (Multilined)
    $titleLines = explode("\n", $item['title']);
    $titleY = 220;
    foreach ($titleLines as $line) {
        $bboxT = imagettfbbox(24, 0, $fontBold, $line);
        $tW = $bboxT[2] - $bboxT[0];
        // Shadow
        imagettftext($img, 24, 0, (int) (($width - $tW) / 2) + 2, $titleY + 2, $darkOverlay, $fontBold, $line);
        // Text
        imagettftext($img, 24, 0, (int) (($width - $tW) / 2), $titleY, $white, $fontBold, $line);
        $titleY += 42;
    }

    // Subtitle
    $titleY += 10;
    $bboxSub = imagettfbbox(11, 0, $fontBold, $item['subtitle']);
    $subW = $bboxSub[2] - $bboxSub[0];
    imagettftext($img, 11, 0, (int) (($width - $subW) / 2), $titleY, $accentColor, $fontBold, $item['subtitle']);

    // Short Description Box
    $titleY += 45;
    $bboxDesc = imagettfbbox(9, 0, $fontRegular, $item['desc']);
    $descW = $bboxDesc[2] - $bboxDesc[0];
    imagettftext($img, 9, 0, (int) (($width - $descW) / 2), $titleY, $gray, $fontRegular, $item['desc']);

    // Bottom Decorative Divider
    imagefilledrectangle($img, 45, $height - 130, $width - 45, $height - 128, $cardBg);

    // Author
    $authorText = 'KARYA: '.strtoupper($item['author']);
    $bboxAuth = imagettfbbox(12, 0, $fontBold, $authorText);
    $authW = $bboxAuth[2] - $bboxAuth[0];
    imagettftext($img, 12, 0, (int) (($width - $authW) / 2), $height - 90, $white, $fontBold, $authorText);

    // Publisher
    $bboxPub = imagettfbbox(9, 0, $fontRegular, $item['publisher']);
    $pubW = $bboxPub[2] - $bboxPub[0];
    imagettftext($img, 9, 0, (int) (($width - $pubW) / 2), $height - 60, $accentColor, $fontRegular, $item['publisher']);

    // Save as JPEG with high quality
    $targetPath = $outputDir.'/'.$item['filename'];
    imagejpeg($img, $targetPath, 92);
    imagedestroy($img);
    echo 'Generated: '.$item['filename']."\n";
}

echo "All 6 book covers generated successfully!\n";
