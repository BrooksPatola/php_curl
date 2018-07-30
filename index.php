<html>
<head>
<title>LBC IT Solutions, Inc.</title>
<style>

 table th,table td{
 text-align:center;
 border-bottom: 1px dotted #c03;
 width:400px;
} 
</style>

<body>
 <?php
// Create curl resource
$ch = curl_init();

// Set url
curl_setopt($ch, CURLOPT_URL, "https://www.lbcit.ca/demo/api/?key=d9658b9d-4f86-491f-bd67-86af0c547a5c");

// Return the transfer as a string
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// $output contains the output string
$output = curl_exec($ch);

// Close curl resource to free up system resources 
curl_close($ch);

//lets see array output
//var_dump(json_decode($output, true));

//store array in $data
$data = json_decode($output, true);

print_r ($data);

echo("<br>");
echo("<br>");

//Month as column heading with all months beloe
//month (jan)
echo $data['categories'][0]; echo("<br>");

//each city as own column heading 
//city (tokyo)
echo $data['series'][0]['name']; echo("<br>");

//each cities data for that month displayed in row
//tokyo jan data
echo $data['series'][0]['data'][0];

echo("<br>");echo("<br>");

//foreach loop to cycle through the months
foreach ($data['categories'] as $value) {
    echo "$value <br>";
}

//loop through cities
//foreach ($data['series'] as $value) {
  //  echo "$value[name] <br>";
//}

//loop through cities
for ($i = 0; $i < 4; $i++) {
    echo $data['series'][$i]['name']; 
    echo(""); 
}

echo("<br>");

//loop through data
for ($i = 0; $i < 12; $i++) {
    echo $data['series'][0]['data'][$i];
    echo("<br>");
}

//start table

/* echo '<table>';

echo '<tr>';
echo '<th> Month </th>';
//table headers
for ($i = 0; $i < 4; $i++) {
    echo  '<th>' .$data['series'][$i]['name']; 
    '</th>'; 

    //data
    echo '<td>';
    for ($x = 0; $x < 12; $x++){
        echo $data['series'][$i]['data'][$x];

        //echo("<br>");
    }
    echo '</td>';
}
echo '</tr>';

echo '<td>';
//column of months
foreach ($data['categories'] as $value) {
    echo "$value <br>";
    
}
echo '</td>';

echo '</table>'; */


//start table
echo '<table><tr><th> Month </th>';
//table headers
for ($i = 0; $i < 4; $i++)
{
    echo  '<th>' . $data['series'][$i]['name'] . '</th>';
}
echo '</tr>';

//column of months
$number = 0;
foreach ($data['categories'] as $value) 
{
    foreach($data['series'] as $inst)
    {
        $month_data = $month_data . "<td>" . $inst['data'][$number] . "</td>";
    };
    echo "<tr><td>$value</td>" . $month_data . "</tr>";
    $number++;

    unset($month_data);
};
echo '</table>';
 
?>
</body>
</html>