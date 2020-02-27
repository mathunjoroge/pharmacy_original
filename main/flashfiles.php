<?php
 // get all file names
$files = glob('../expiries*.php');
// loop through files
foreach($files as $file){
  if(is_file($file)) {
    // delete file
    unlink($file);
  }
}
// A better alternative is to use the array_map function in conjunction with the glob function
array_map('unlink', glob("../expiries/*.php")); //end of folder
////////////////////////////////////////////////////////////////////////////////////////////////
 // get all file names
$files = glob('../main*.php');
// loop through files
foreach($files as $file){
  if(is_file($file)) {
    // delete file
    unlink($file);
  }
}
// A better alternative is to use the array_map function in conjunction with the glob function
array_map('unlink', glob("../main/*.php")); //end of folder
////////////////////////////////////////////////////////////////////////////////////////////////
 // get all file names
$files = glob('../purchases*.php');
// loop through files
foreach($files as $file){
  if(is_file($file)) {
    // delete file
    unlink($file);
  }
}
// A better alternative is to use the array_map function in conjunction with the glob function
array_map('unlink', glob("../purchases/*.php")); //end of folder
////////////////////////////////////////////////////////////////////////////////////////////////
 // get all file names
$files = glob('../stocktake*.php');
// loop through files
foreach($files as $file){
  if(is_file($file)) {
    // delete file
    unlink($file);
  }
}
// A better alternative is to use the array_map function in conjunction with the glob function
array_map('unlink', glob("../stocktake/*.php")); //end of folder
////////////////////////////////////////////////////////////////////////////////////////////////
 // get all file names
$files = glob('../wholesale*.php');
// loop through files
foreach($files as $file){
  if(is_file($file)) {
    // delete file
    unlink($file);
  }
}
// A better alternative is to use the array_map function in conjunction with the glob function
array_map('unlink', glob("../wholesale/*.php")); //end of folder
////////////////////////////////////////////////////////////////////////////////////////////////
header("location:../rename.php");
 ?>