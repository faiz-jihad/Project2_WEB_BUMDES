<?php
$target = '/home/bumdesma/bumdesmadusari/storage/app/public';
$link = '/home/bumdesma/bumdesmadusari/public/storage';

if (file_exists($link)) {
    echo "Link sudah ada: $link";
} else {
    if (symlink($target, $link)) {
        echo "Symlink berhasil dibuat dari $target ke $link";
    } else {
        echo "Gagal membuat symlink. Pastikan permission benar.";
    }
}
