<?php

namespace GameDev\TradeBalance;


class TradeEdge {
    private int $from;
    private int $to;
    private int $goldCost; // сколько золота отдаёт игрок (отрицательное = получает)
    
    public function __construct(int $from, int $to, int $goldCost) {
        $this->from = $from;
        $this->to = $to;
        $this->goldCost = $goldCost;
    }
    
    public function getFrom(): int {
        return $this->from;
    }
    
    public function getTo(): int {
        return $this->to;
    }
    
    public function getGoldCost(): int {
        return $this->goldCost;
    }
}