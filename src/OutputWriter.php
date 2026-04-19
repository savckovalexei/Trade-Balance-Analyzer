<?php

namespace GameDev\TradeBalance;

class OutputWriter {
    public static function writeResult(array $result): void {
        if ($result['hasExploit']) {
            echo "YES\n";
            // Добавляем первый элемент в конец для замыкания цикла
            $cycle = $result['cycle'];
            if (!empty($cycle)) {
                $cycle[] = $cycle[0]; // дублируем первый элемент
            }
            echo implode(' ', $cycle) . "\n";
        } else {
            echo "NO\n";
        }
    }
}