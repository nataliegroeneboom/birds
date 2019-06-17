<?php
namespace File;

use Natalie\DatabaseTable;

class GoogleMap
{
    private $coords;
    private $sightingTable;
    private $userTable;

    public function __construct(DatabaseTable $sightingTable, DatabaseTable $userTable){
        $this->sightingTable = $sightingTable;
        $this->userTable = $userTable;
    }
    public function setCoordArray($arr){
        $this->coords = $arr;
    }

    public function getCoordArray($id){
        $sightings = $this->sightingTable->getMarkers($id);
        $sightingsJson = json_encode($sightings);
        return $sightingsJson;
    }
}
		

	
?>