#!/bin/bash
count=1
ls -tr $@ | while read file; do
    if [ $count -lt 10 ]; then
        mv -v $file '00'$count'_'$file
    elif [ $count -lt 100 ]; then
        mv -v $file '0'$count'_'$file
    else
        mv -v $file '0'$count'_'$file
    fi
    count=$(($count+1))
done
