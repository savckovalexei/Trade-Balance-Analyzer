#!/usr/bin/env php
<?php

namespace GameDev\TradeBalance;


class InputReader {
    public static function readFromStdin(): TradeGraph {
        $stdin = fopen('php://stdin', 'r');
        
        // Читаем первую строку с n и m
        $firstLine = trim(fgets($stdin));
        list($n, $m) = explode(' ', $firstLine);
        $n = (int)$n;
        $m = (int)$m;
        
        $graph = new TradeGraph($n);
        
        // Читаем m рёбер
        for ($i = 0; $i < $m; $i++) {
            $line = trim(fgets($stdin));
            if (empty($line)) {
                continue;
            }
            list($from, $to, $cost) = explode(' ', $line);
            $edge = new TradeEdge((int)$from, (int)$to, (int)$cost);
            $graph->addEdge($edge);
        }
        
        fclose($stdin);
        return $graph;
    }
}