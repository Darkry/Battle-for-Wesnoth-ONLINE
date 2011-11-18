<?php
namespace FrontModule;

class MapModel extends \Model {
    
    //!!!!!!!!!!!!MAP!!!!!!!!!!!!!!!
  
    public static function selectMapById($id) {
        return \dibi::select('*')->from('map')->where('id = %i',$id)->fetch();
    }
    
    //!!!!!!!!!!!!!!!!!!MAPGROUND!!!!!!!!!!!!!!!
    
    public static function selectAllGroundsFromMap($map_id) {
        return \dibi::select('*')->from('mapground')->where('map_id = %i', $map_id)->fetchAll();
    }
    
    //!!!!!!!!!!!!!!GROUNDTYPE!!!!!!!!!!!!!!!!!!!!!
    public static function selectGroundTypeById($id) {
        return \dibi::select('*')->from('groundtype')->where('id = %i',$id)->fetch();
    }
    
    //!!!!!!!!!!!!!GROUND!!!!!!!!!!!!!!
    
    public static function selectGroundByGroundtype($groundtype_id) {
        return \dibi::select('*')->from('ground')->where('groundtype_id = %i',$groundtype_id)->fetchAll();
    }
    
}

