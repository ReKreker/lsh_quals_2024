#!/bin/sh

FLAG=`cat /flag.txt`

echo "" > /flag.txt

sed -i "s/FLAG/$FLAG/g" /www/flag.php

exec "$@"