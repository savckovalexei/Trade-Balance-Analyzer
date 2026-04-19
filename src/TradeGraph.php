<?php

namespace GameDev\TradeBalance;


class TradeGraph {
    private int $verticesCount;
    /** @var TradeEdge[][] */
    private array $adjacencyList = [];
    
    public function __construct(int $verticesCount) {
        $this->verticesCount = $verticesCount;
        for ($i = 1; $i <= $verticesCount; $i++) {
            $this->adjacencyList[$i] = [];
        }
    }
    
    public function addEdge(TradeEdge $edge): void {
        $this->adjacencyList[$edge->getFrom()][] = $edge;
    }
    
    public function getEdgesFrom(int $vertex): array {
        return $this->adjacencyList[$vertex] ?? [];
    }
    
    public function getVerticesCount(): int {
        return $this->verticesCount;
    }
}