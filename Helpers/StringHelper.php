<?php

class StringHelper
{
	public static function IsNullOrEmptyString($question) {
		return (!isset($question) || trim($question)==='');
	}

	public static function AreNullOrEmptyString($str1, $str2, $str3) {
	    return IsNullOrEmptyString($str1) || IsNullOrEmptyString($str2) || IsNullOrEmptyString($str3);
	}
}