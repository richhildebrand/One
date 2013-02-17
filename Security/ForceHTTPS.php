<?php
	if ( $_SERVER["HTTPS"] != "on" && $_SERVER['HTTP_HOST'] == 'webdev.cs.kent.edu') {
		header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
	}
