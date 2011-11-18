<?php
namespace FrontModule;

class PlayerModel extends \Model {
    
    public static function getPlayersFromMap($map_id) {
        return \dibi::select('*')->from("player")->where("map_id = %i",$map_id)->fetchAll();
    }
    
}

