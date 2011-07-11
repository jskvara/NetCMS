#!/opt/lampp/bin/php -q
<?php
error_reporting(E_ALL);

$salt = "zb1g7IHt1I";

if ($argc < 2) {
	echo "Usage: $argv[0] password\n";
	exit(1);
}

$sha1 = sha1($argv[1] . $salt);

echo $sha1 ."\n";

exit(0);

#!/bin/bash
#
#salt="zb1g7IHt1I"
#
#if [ $# -eq 0 ]; then
#	echo "Usage: $0 password" 1>&2
#	exit 1
#fi
#
#echo `sha1 "$1 $salt"`
#
#exit 0
