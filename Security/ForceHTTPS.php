<?php
	if ( $_SERVER['HTTP_HOST'] == 'webdev.cs.kent.edu' && $_SERVER['HTTPS'] != 'on') {
		header('Location: https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
	}
