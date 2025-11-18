    <html>
    <head><title>Daftar test(Demo Baca File CSV)</title></head>
    <body>
    <h1>Daftar test</h1>
    <pre> 
    <table width="100%" border="1">
    <tr>
    <th>NO</th>
    <th>NIM</th>
    <th>NAMA</th>
    <th>NILAI</th>
    </tr>
     
    <?php
    ini_set("display_errors", 0);
	ini_set("auto_detect_line_endings", 1);
	if (($handle = fopen("jamsostek20130317.csv", "r")) !== FALSE) {
    $row = 1;
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
	echo "<tr>";
    echo "<td>".$row++."</td>";
    echo "<td>".$data[9]."</td>";
    echo "<td>".$data[10]."</td>";
    echo "<td>".$data[8]."</td>";
    echo "</tr>";
    } //end while
    fclose($handle);
    } //end if
     
    ?>
    </table>
	</pre>
    </body>
    </html>