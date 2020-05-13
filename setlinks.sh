#!/bin/bash
find /share/exchange -name "index.php" -type f -print -exec ln -s -f /share/scripts/index.php {} \;
echo 'done';
