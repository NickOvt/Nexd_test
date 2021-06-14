<?php 

class GalacticObject {
  public $name;
  public $x;
  public $y;
  public $moons;
  public $type;
  public $adjacent;

  function __construct($name,$x, $y, $moons = array(), $type="Planet", $adjacent=array()) {
    $this->name = $name;
    $this->x = $x;
    $this->y = $y;

    $this->moons = $moons;

    $this->type = $type;

    if($adjacent && !empty($adjacent)) {
      $this->adjacent = $adjacent;
    }
  }
}

$galaxy = array(
  "Earth solar system" => array(
    "sun" => new GalacticObject("sun",2,5, array(),"Sun", array("Earth", "Alfa Centauri sun", "Black hole")),
    "Earth" => new GalacticObject("Earth",6,10, array(
      "moon1" => new GalacticObject("moon1",6.5, 10.5, array(), "Moon", array("Earth")),
      "moon2" => new GalacticObject("moon2",7, 11, array(),"Moon", array("Earth")),
      "moon3" => new GalacticObject("moon3",8, 12, array(),"Moon", array("Earth")),
    ), "Planet", array("sun"))
  ),
  "Centauri solar system" =>array(
    "Alfa Centauri sun" => new GalacticObject("Alfa Centauri sun",40,50, array(),"Sun", array("Planet X", "Black hole", "sun")),
    "Planet X" => new GalacticObject("Planet X",50, 70, array(
      "moon1" => new GalacticObject("moon1",55, 71,array(), "Moon", array("Planet X")),
      "moon2" => new GalacticObject("moon2",56, 72, array(),"Moon", array("Planet X")),
    ), "Planet", array("Alfa Centauri sun"))
  ),
  "Black hole solar system" =>array(
    "Black hole" => new GalacticObject("Black hole",500, 1000, array(), "Sun", array("Planet Y, Alfa Centauri Sun", "sun")),
    "Planet Y" => new GalacticObject("Planet Y",600, 1100, array(
      "moon1" => new GalacticObject("moon1",601, 1101, array(),"Moon" , array("Planet Y"))
    ), "Planet", array("Black hole"))
  ),
);

function findShortestDistanceBetween($galaxy, $solarSystem, $startGalacticObject, $endGalacticObject) {
  $currentSolarSystem = $solarSystem;
  $startGalacticObjectType = $startGalacticObject->type;
  $endGalacticObjectType = $endGalacticObject->type;
  $currentKey;
  $parentKey;
  $result;

  // Base case: End is immediately adjacent to Start
  foreach ($startGalacticObject->adjacent as $value) {
    if($endGalacticObject->name == $value && $endGalacticObjectType != "Moon") {
      $result = sqrt(pow($endGalacticObject->x - $startGalacticObject->x, 2) + pow($endGalacticObject->y - $startGalacticObject->y, 2));
      return $result;
    }
  }
  if($startGalacticObjectType = "Moon") {
    // At parent Planet
    $currentKey = $startGalacticObject->adjacent[0];
    foreach($currentSolarSystem[$currentKey]->adjacent as $value) {
      if($endGalacticObject->name == $value && $endGalacticObjectType != "Moon" && $endGalacticObjectType != "Planet") {
        $result =  array("x" => $startGalacticObject->x - $endGalacticObject->x, "y" => $startGalacticObject->y - $endGalacticObject->y);
        return -1;
      }
    }

    // At current Sun
    $currentKey = array_key_first($currentSolarSystem);
    foreach ($currentSolarSystem[$currentKey]->adjacent as $value) {
      if($endGalacticObject->name == $value) {
        //$result =  array("x" => $startGalacticObject->x - $endGalacticObject->x, "y" => $startGalacticObject->y - $endGalacticObject->y);
        return -2;
      }
    }

      // Go through each solar system
      foreach ($galaxy as $solarSystemKey => $value1) {
        // Go through adjacent elements of the current sun
        foreach ($currentSolarSystem[$currentKey]->adjacent as $value2) {

          // Check if we are not back in the same solar system
          if(!array_key_exists($currentKey, $galaxy[$solarSystemKey])) {
           // $currentKey = array_key_first($galaxy[$solarSystemKey]);

           // Check if the solar system has the specified adjacent elements
           if(array_key_exists($value2, $galaxy[$solarSystemKey])) {
             #echo($galaxy[$solarSystemKey][$value2]->name);

             // Check other solar systems
            foreach($galaxy[$solarSystemKey][$value2]->adjacent as $value3) {
              // Check if we are not out of our current solar system
              if(array_key_exists($value3, $galaxy[$solarSystemKey])) {
                // If the sun has the specified ending Galactic object as adjacent element, return it;
                if($endGalacticObject->name == $value3) {
                  return -3;
                }
              }
            }
           }
          }
        }
      }
  }
}



$result = findShortestDistanceBetween($galaxy,$galaxy["Earth solar system"], $galaxy['Earth solar system']['Earth']->moons['moon1'], $galaxy['Earth solar system']['Earth']);
echo ($result);

/*foreach ($result as $key => $value) {
  echo("$key: $value\n");
}*/


//echo ($galaxy["Earth solar system"]["sun"]->type);