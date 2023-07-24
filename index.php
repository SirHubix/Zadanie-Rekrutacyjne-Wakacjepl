
<?php

$csvFile = fopen('php_internship_data.csv', 'r');
$data = [];
while (($row = fgetcsv($csvFile)) !== false) {
    $name = ucfirst(strtolower($row[0])); 
    $dateOfBirth = $row[1];
    $data[] = ['name' => $name, 'date_of_birth' => $dateOfBirth];
}
fclose($csvFile);

$nameCounts = array_count_values(array_column($data, 'name'));
arsort($nameCounts);


echo "TOP 10 najczęściej występujących imion:\n";
$counter = 1;
foreach ($nameCounts as $name => $count) {
    if ($counter > 10) {
        break;
    }
    echo $name . " -> " . $count ;
    $counter++;
}

// Zadanie dodatkowe: 
$dateCount = array_count_values(array_filter(array_column($data, 'date_of_birth'), function ($date) {
    return strtotime($date) >= strtotime('2000-01-01');
}));
arsort($dateCount);
echo "\nTOP 10 najczęściej występujących dat urodzenia od 1 stycznia 2000:\n";
$counter = 1;
foreach ($dateCount as $date => $count) {
    if ($counter > 10) {
        break;
    }
    echo date('d.m.Y', strtotime($date)) . " -> " . $count ;
    $counter++;
}
?>
