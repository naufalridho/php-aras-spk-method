<?php
function normalize($matrix) {
  $rowLen = count($matrix);
  $colLen = count($matrix[0]);
  
  for ($j = 0; $j < $colLen; $j++) {
    $sumRow = 0;

    for ($i = 0; $i < $rowLen; $i++) {
      $sumRow += $matrix[$i][$j];
    }

    for ($i = 0; $i < $rowLen; $i++) {
      $matrix[$i][$j] /= $sumRow;
    }
  }
  
  return $matrix;
}

function applyWeights($matrix, $weights) {
  $rowLen = count($matrix);
  $colLen = count($matrix[0]);
  
  if ($colLen != count($weights)) {
    throw new Exception("num of weights must equal to the num of columns");
  }
  
  for ($i = 0; $i < $rowLen; $i++) {
    for ($j = 0; $j < $colLen; $j++) {
        $matrix[$i][$j] *= $weights[$j];
    }
  }
  
  return $matrix;
}

function getOptimalValues($matrix) {
  $rowLen = count($matrix);
  $colLen = count($matrix[0]);
  
  $optimalValues = array();
  
  for ($i = 0; $i < $rowLen; $i++) {
    $optimalValues[$i] = 0;
    for ($j = 0; $j < $colLen; $j++) {
        $optimalValues[$i] += $matrix[$i][$j];
    }
  }
  
  return $optimalValues;
}

function getUtilityRate($optimalValues) {
  $base = max($optimalValues);
  for ($i = 0; $i < count($optimalValues); $i++) {
    $optimalValues[$i] /= $base;
  }
  
  return $optimalValues;
}

// only for testing purpose
function printMatrix($matrix) {
  $rowLen = count($matrix);
  $colLen = count($matrix[0]);
  
  for ($i = 0; $i < $rowLen; $i++) {
    for ($j = 0; $j < $colLen; $j++) {
        echo($matrix[$i][$j] . " ");
    }
    echo PHP_EOL;
  }
  echo PHP_EOL;
}

// define data here
$matrix = array(array(4,2,3),array(3,1,2),array(1,4,2)); // <-- only for example
$weights = array(0.3, 0.3, 0.4); // <-- only for example

echo '1. initial matrix:'.PHP_EOL;
printMatrix($matrix);

// Langkah 1 & 2 normalisasi
$normalizedMatrix = normalize($matrix);
echo '2. normalized matrix:'.PHP_EOL;
printMatrix($normalizedMatrix);

// Langkah 3 mengaplikasikan bobot
echo '3. weighted matrix:'.PHP_EOL;
$weightedMatrix = applyWeights($normalizedMatrix, $weights);
printMatrix($weightedMatrix);

// Langkah 4 menentukan nilai optimasi Si
$optimalValues = getOptimalValues($weightedMatrix);
echo '4. optimal values:'.PHP_EOL;
print_r($optimalValues);

// Langkah 5 menentukan tingkat utilitas Ki
$utilityRate = getUtilityRate($optimalValues);
echo '5. utility rate:'.PHP_EOL;
print_r($utilityRate);

// Langkah 5b tingkat utilitas Ki diurutkan secara descending
echo '5b. utility rate (sorted):'.PHP_EOL;
rsort($utilityRate);
print_r($utilityRate);
?>