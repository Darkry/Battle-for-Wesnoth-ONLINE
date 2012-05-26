<?php
namespace FrontModule\GameLogic;

class AStar extends \Nette\Object {
    
    /**
     * Multidimensional array ($blockedFields[x][y] = TRUE) with blocked fields on the map
     * @var array 
     */
    public $blockedFields = array();
    
    public function isFieldAccessible($x, $y) {
        if(isset($blockedFields[$x][$y]))
            return true;
        else
            return false;
    }
    
    public function getPathLength($startx, $starty, $endx, $endy) {
        
        
        
    }
    
}