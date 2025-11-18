<?php
	if ($_POST['t'] == "") {
		echo "&nbsp;";
	}
	elseif ($_POST['t'] == "F") {
		echo "Biaya Kehadiran : Rp. 100,000";
	}
	elseif ($_POST['t'] == "H") {
		echo "Biaya Kehadiran : Rp. 50,000";
	}
?>