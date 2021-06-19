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
    echo "num of weights must equal with the num of columns";
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
  for ($i = 0; $i < count($optimalValues); $i++) {
    $optimalValues[$i] = $optimalValues[0];
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
$matrix = array(array(1,2,3),array(1,2,3),array(1,2,3)); // <-- only for example
echo '1. initial matrix:'.PHP_EOL;
printMatrix($matrix);

// Langkah 1 & 2 normalisasi
$normalizedMatrix = normalize($matrix);
echo '2. normalized matrix:'.PHP_EOL;
printMatrix($normalizedMatrix);

// Langkah 3 mengaplikasikan bobot
$weights = array(0.03, 0.02, 0.1); // <-- only for example
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
?>