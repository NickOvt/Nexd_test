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

/*function findShortestDistanceBetween($galaxy, $solarSystem, $startGalacticObject, $endGalacticObject) {
  $currentSolarSystem = $solarSystem;
  $startGalacticObjectType = $startGalacticObject->type;
  $endGalacticObjectType = $endGalacticObject->type;

  foreach ($startGalacticObject->adjacent as $value) {
    if($endGalacticObject->name == $value && $endGalacticObjectType != "Moon") {
      return array("x" => $startGalacticObject->x - $endGalacticObject->x, "y" => $startGalacticObject->y - $endGalacticObject->y);
    }
    else if($startGalacticObjectType == "Moon" && $endGalacticObjectType != "Moon") {
      $currentKey = $startGalacticObject->name;
      $parentKey = $startGalacticObject->adjacent[0];

      /*while($currentSolarSystem[$key]->adjacent[0] != $endGalacticObject->name) {
        $key = array_search($currentSolarSystem[$key]->adjacent[0], $currentSolarSystem);
      }

      return $key;*/

      /*if($currentSolarSystem[$parentKey]->adjacent[0] == $endGalacticObject->name )  return -1;
      else {
        $currentKey = $parentKey;
        $parentKey = $currentSolarSystem[$currentKey]->adjacent[0];

        /*foreach ($galaxy as $key1 => $value1) {
          foreach ($currentSolarSystem[$parentKey]->adjacent as $value2) {
            echo("$key1: $value2\n");
            if($galaxy[$key1][$value2]->type == "Sun") return -2;
            /*foreach ($galaxy[$key1][$value2]->adjacent as $value3) {
              echo($value3);
              if($value3 == $endGalacticObject->name) return -3;
            }*/
        /*  }
        }*/

        /*foreach ($galaxy as $key1 => $value1) {
          foreach ($currentSolarSystem[$parentKey]->adjacent as $value2) {
          
        }
      }*/
      /*else {
        $key = array_search($currentSolarSystem[$key]->adjacent[0], $currentSolarSystem);
        if($currentSolarSystem[$key]->adjacent[0] == $endGalacticObject->name )  return -1;
      }*/
      #$currentSolarSystem[$key];
    //}
   // }
  //}
//}

function findShortestDistanceBetween($galaxy, $solarSystem, $startGalacticObject, $endGalacticObject) {
  $currentSolarSystem = $solarSystem;
  $startGalacticObjectType = $startGalacticObject->type;
  $endGalacticObjectType = $endGalacticObject->type;
  $currentKey;
  $parentKey;
  $result;

  foreach ($startGalacticObject->adjacent as $value) {
    if($endGalacticObject->name == $value && $endGalacticObjectType != "Moon") {
      $result = array("x" => $startGalacticObject->x - $endGalacticObject->x, "y" => $startGalacticObject->y - $endGalacticObject->y);
      return $result;
    }
  }
  if($startGalacticObjectType = "Moon") {
    $currentKey = $startGalacticObject->adjacent[0];
    foreach($currentSolarSystem[$currentKey]->adjacent as $value) {
      if($endGalacticObject->name == $value && $endGalacticObjectType != "Moon" && $endGalacticObjectType != "Planet") {
        $result =  array("x" => $startGalacticObject->x - $endGalacticObject->x, "y" => $startGalacticObject->y - $endGalacticObject->y);
        return $result;
      }
    $currentKey = array_key_first($currentSolarSystem);
    }
  }
}



$result = findShortestDistanceBetween($galaxy,$galaxy["Earth solar system"], $galaxy['Earth solar system']['Earth']->moons['moon1'], $galaxy['Centauri solar system']['Planet X']);
echo ($result);

/*foreach ($result as $key => $value) {
  echo("$key: $value\n");
}*/


//echo ($galaxy["Earth solar system"]["sun"]->type);