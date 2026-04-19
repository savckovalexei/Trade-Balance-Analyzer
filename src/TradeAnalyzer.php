<?php

namespace GameDev\TradeBalance;


class TradeAnalyzer {
    private TradeGraph $graph;
    
    public function __construct(TradeGraph $graph) {
        $this->graph = $graph;
    }
    
    public function hasGoldExploit(): array {
        $detector = new CycleDetector($this->graph);
        $cycle = $detector->findPositiveCycle();
        
        if ($cycle !== null) {
            return ['hasExploit' => true, 'cycle' => $cycle];
        }
        
        return ['hasExploit' => false, 'cycle' => null];
    }
}