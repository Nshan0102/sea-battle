<?php


namespace App\Traits;


trait RoomTrait
{
    public function shoot($allShips, $index)
    {
        foreach ($allShips as $ships) {
            foreach ($ships as $ship) {
                foreach ($ship as $cell) {
                    if ($index === $cell->index) {
                        if ($cell->isBroken == "false") {
                            $cell->isBroken = "true";
                            return [
                                'ships' => $allShips,
                                'status' => 'success',
                                'ship' => $ship,
                                'isShipBroken' => $this->isShipBroken($ship),
                                'message' => 'Yeah! Once again'
                            ];
                        } else {
                            return [
                                'ships' => $allShips,
                                'status' => 'fail',
                                'message' => 'This cell was already fired'
                            ];
                        }
                    }
                }
            }
        }
        return [
            'ships' => $allShips,
            'status' => 'empty',
            'message' => 'There is nothing there'
        ];
    }

    public function isShipBroken($ship)
    {
        $healthyParts = 0;
        foreach ($ship as $cell){
            if ($cell->isBroken == 'false'){
                $healthyParts++;
            }
        }
        return $healthyParts === 0;
    }
}
