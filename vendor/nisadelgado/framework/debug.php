<?php

/**
 * Show object/array as table
 *
 * @param $query object|array
 * @return view
 */
function table($query)
{
  $query = json($query);
  
  echo '<style>table { margin-top: 5px } table,tr,th,td { border: 1px solid black; } </style>';
  
  echo '<table>';
  
  $i = 1;

  foreach (json($query) as $item) {
    $keys = get_object_vars($item);
    
    echo '<tr>';
    
    foreach ($keys as $key => $value) {
      if ($i == 1) {
       echo '<th>' . $key . '</th>'; 
      }
    }
    
    $i = $i + 1;
    
    echo '</tr>';
    
    echo '<tr>';
    
    foreach ($keys as $key => $value) {
      echo '<td>' . $value . '</td>';
    }
    
    echo '</tr>';
  }
  
  echo '<table>';
}


/**

 * Dump the passed variables and end the script.

 *

 * @param  mixed

 * @return void

 */

function d($object)

{

    echo '<pre>';

    print_r($object);

    echo '</pre>';

    exit;

}



/**

 * Verify if the environment is local.

 *

 * @return boolean

 */

function localhost()

{

    if (strpos($_SERVER['HTTP_HOST'], 'localhost')) {

        return true;

    }

    return false;

}

