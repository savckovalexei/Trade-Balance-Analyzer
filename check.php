<?php
echo "Текущая директория: " . __DIR__ . "\n";
echo "Файл trade_analyzer.php существует: " . (file_exists(__DIR__ . '/trade_analyzer.php') ? 'Да' : 'Нет') . "\n";
echo "Файл examples/example1.txt существует: " . (file_exists(__DIR__ . '/examples/example1.txt') ? 'Да' : 'Нет') . "\n";
echo "Папка src существует: " . (is_dir(__DIR__ . '/src') ? 'Да' : 'Нет') . "\n";
echo "Файл vendor/autoload.php существует: " . (file_exists(__DIR__ . '/vendor/autoload.php') ? 'Да' : 'Нет') . "\n";