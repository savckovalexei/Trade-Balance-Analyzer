<?php

namespace GameDev\TradeBalance;

class CycleDetector {
    private TradeGraph $graph;
    private array $dist;
    private array $parent;
    private array $state;
    private ?array $foundCycle = null;
    
    private const STATE_UNVISITED = 0;
    private const STATE_IN_STACK = 1;
    private const STATE_PROCESSED = 2;
    
    public function __construct(TradeGraph $graph) {
        $this->graph = $graph;
    }
    
    public function findPositiveCycle(): ?array {
        $n = $this->graph->getVerticesCount();
        
        for ($start = 1; $start <= $n; $start++) {
            if ($this->foundCycle !== null) {
                break;
            }
            
            $this->initializeSearch($start);
            $this->dfs($start);
        }
        
        return $this->foundCycle;
    }
    
    private function initializeSearch(int $start): void {
        $n = $this->graph->getVerticesCount();
        $this->dist = array_fill(1, $n, null);
        $this->parent = array_fill(1, $n, null);
        $this->state = array_fill(1, $n, self::STATE_UNVISITED);
        $this->dist[$start] = 0;
    }
    
    private function dfs(int $vertex): void {
        if ($this->foundCycle !== null) {
            return;
        }
        
        $this->state[$vertex] = self::STATE_IN_STACK;
        
        $edges = $this->graph->getEdgesFrom($vertex);
        foreach ($edges as $edge) {
            $to = $edge->getTo();
            $weight = $edge->getGoldCost();
            $newDist = $this->dist[$vertex] + $weight;
            
            if ($this->state[$to] === self::STATE_UNVISITED) {
                $this->parent[$to] = $vertex;
                $this->dist[$to] = $newDist;
                $this->dfs($to);
            } 
            elseif ($this->state[$to] === self::STATE_IN_STACK) {
                // Нашли цикл, проверяем, положительный ли он
                // Для получения золота нужна ОТРИЦАТЕЛЬНАЯ сумма весов
                // (потому что отрицательный вес = получение золота)
                $cycleSum = $newDist - $this->dist[$to];
                if ($cycleSum < 0) {  // < 0, а не > 0!
                    $this->foundCycle = $this->reconstructCycle($vertex, $to);
                    return;
                }
            }
        }
        
        $this->state[$vertex] = self::STATE_PROCESSED;
    }
    
    private function reconstructCycle(int $endVertex, int $startVertex): array {
        // Собираем путь от startVertex до endVertex
        $path = [];
        $current = $endVertex;
        
        while ($current !== $startVertex) {
            array_unshift($path, $current);
            $current = $this->parent[$current];
        }
        array_unshift($path, $startVertex);
        $path[] = $startVertex; // замыкаем цикл
        
        // Находим минимальный номер вершины в цикле
        $minVertex = min($path);
        $minIndex = array_search($minVertex, $path);
        
        // Поворачиваем цикл так, чтобы он начинался с минимальной вершины
        $rotatedCycle = array_merge(
            array_slice($path, $minIndex),
            array_slice($path, 1, $minIndex - 1)
        );
        
        return $rotatedCycle;
    }
}