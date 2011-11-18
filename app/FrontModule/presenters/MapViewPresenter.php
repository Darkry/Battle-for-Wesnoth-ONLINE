<?php
namespace FrontModule;

class MapViewPresenter extends \BasePresenter {
    
    private $player;

    public function renderDefault($id) {
        $map = MapModel::selectMapById($id);   
        
        $this->renderMap($id);
        $players = $this->getPlayers($id);
        
        $this->template->units = array();
        foreach($players as $player) {
            $this->template->units[$player["color"]] = $this->getUnits($id, $player["id"], $player["hero_id"]);
        }
    }
    
    public function getUnits($map_id, $player_id, $hero_id=NULL) {
        $units = UnitModel::selectUnits($map_id, $player_id);
        if($hero_id === NULL) {
            return $units;
        }
        else {
            $result = array();
            $result["units"] = array();
            foreach($units as $unit) {
                $coor = $this->getCoor($unit["x"], $unit["y"]);
                $unit["left"] = $coor["x"];
                $unit["top"] = $coor["y"];

                if($unit["id"] == $hero_id) {
                    $result["hero"] = $unit;
                    $result["hero"]["unittype"] = UnitModel::selectUnitType($unit["unittype_id"]);
                }
                else {
                    $key = count($result["units"]);
                    $result["units"][$key] = $unit;
                    $result["units"][$key]["unittype"] = UnitModel::selectUnitType($unit["unittype_id"]);
                }
            }
            return $result;
        }
    }
    
    public function getPlayers($map_id) {
        return PlayerModel::getPlayersFromMap($map_id);
    }
    
    public function getCoor($x, $y) {
        $i = (($x%2)==0 ? 36 : 0 );
        $result = array();
        $result["x"] = ($x-1) * 54;
        $result["y"] = (($y -1) * 72)+$i;
        return $result;
    }
    
    public function renderMap($id) {
  
        $mapgrounds = MapModel::selectAllGroundsFromMap($id);  
            
        $this->template->mapgrounds = array();
        foreach ($mapgrounds as $mapground) {
                
           $groundtype = MapModel::selectGroundTypeById($mapground["groundtype_id"]);    
           $grounds = array();
           foreach(MapModel::selectGroundByGroundtype($groundtype["id"]) as $ground) {
                $grounds[] = $ground["datName"];
            }
                
            $coor = $this->getCoor($mapground["x"], $mapground["y"]);
     
            $this->template->mapgrounds[] = array(
                 "id" => $mapground["id"],
                 "name" => $groundtype["name"],
                 "datName" => $grounds[array_rand($grounds)],
                 "top" => $coor["y"],
                 "left" => $coor["x"],
                 "x" => $mapground["x"],
                "y" => $mapground["y"]
            );
        }
    }

    public function handleMove($unitId, $tox, $toy) {
        $unitId = str_replace("unit","",$unitId);
        $unitInfo = UnitModel::selectUnitInfo($unitId);
        
        $toVisit = array(
            0 => array(
            "x" => $unitInfo["x"],
            "y" => $unitInfo["y"],
            "dist" => 0
                )
        );
        $need = $tox."a".$toy;
        $movement = $unitInfo["movement"];
        if($this->markVisit(Array(), $toVisit, $movement, $need) == true) {
            UnitModel::moveUnit($unitId, $tox, $toy);
            $this->invalidateControl("units");
        }
        else {
            die("Nastala chyba! Asi se snažíš cheatovat!");
        }
    }
    
    public function getNeighbour($x,$y) {
        $returnVal = Array();
        if($x%2 == 1) {
            $returnVal[1] = Array($x,$y-1);
            $returnVal[2] = Array($x+1,$y-1);
            $returnVal[3] = Array($x+1,$y);
            $returnVal[4] = Array($x,$y+1);
            $returnVal[5] = Array($x-1,$y);
            $returnVal[6] = Array($x-1,$y-1);
        }
        else if($x%2 == 0) {
            $returnVal[1] = Array($x,$y-1);
            $returnVal[2] = Array($x+1,$y*1);
            $returnVal[3] = Array($x+1,$y+1);
            $returnVal[4] = Array($x,$y+1);
            $returnVal[5] = Array($x-1,$y+1);
            $returnVal[6] = Array($x-1,$y*1);
        }
        return $returnVal;
    }
    
    public function markVisit($visited, $toVisit, $movement, $need) {
         if(count($toVisit) == 0) {
             return false; 
         }
         $visit = array_shift($toVisit);
         $index = count($visited);
         $visited[$index] = $visit["x"]."a".$visit["y"];
         if($visited[$index] == $need) {
             return true;
         }
         if($visit["dist"] > $movement) {
             die("mov!");
             return false;
         }
         
         if($visit["dist"] < $movement) {
         $neighbours = $this->getNeighbour($visit["x"], $visit["y"]);
         $visitedString = implode(",", $visited);
         
         for($i = 1; $i <= count($neighbours); $i++) {
             $index = count($toVisit);
             $needle = $neighbours[$i][0]."a".$neighbours[$i][1];
             if(strpos($visitedString, $needle) == FALSE) {
                $toVisit[$index] = Array();
                $toVisit[$index]["x"] = $neighbours[$i][0];
                $toVisit[$index]["y"] = $neighbours[$i][1];
                $toVisit[$index]["dist"] = $visit["dist"] + 1;
             }
         }
         }
        return $this->markVisit($visited, $toVisit, $movement, $need);
    }

}
