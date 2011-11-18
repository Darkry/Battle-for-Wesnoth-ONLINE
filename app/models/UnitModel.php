<?php
namespace FrontModule;

class UnitModel extends \Model {
    
    public static function selectUnits($map_id, $player_id) {
        return \dibi::select('*')->from('mapunit')->where("map_id = %i AND player_id = %i", $map_id ,$player_id)->fetchAll();
    }
    
    public static function selectUnitType($unittype_id) {
        return \dibi::select('*')->from('unittype')->where("id = %i",$unittype_id)->fetch();
    }

    public static function selectUnitInfo($id) {
        return \dibi::select("x,y,movement")->from("mapunit")->where("id = %i",$id)->fetch();
    }
    
    public static function moveUnit($unitId, $x, $y) {
        $args = array("x" => $x,"y" => $y);
        return \dibi::update("mapunit", $args)->where("id = %i",$unitId)->execute();
    }
    
}

