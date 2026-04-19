<?php

require_once __DIR__ . '/vendor/autoload.php';

use GameDev\TradeBalance\InputReader;
use GameDev\TradeBalance\TradeAnalyzer;
use GameDev\TradeBalance\OutputWriter;
use GameDev\TradeBalance\TradeEdge;
use GameDev\TradeBalance\TradeGraph;


try {
    $graph = InputReader::readFromStdin();
    $analyzer = new TradeAnalyzer($graph);
    $result = $analyzer->hasGoldExploit();
    OutputWriter::writeResult($result);
} catch (Exception $e) {
    fwrite(STDERR, "Ошибка: " . $e->getMessage() . "\n");
    exit(1);
}