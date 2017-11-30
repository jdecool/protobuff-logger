#!/bin/sh

make protoc > /dev/null 2>&1

files=`git status -s build/`
if [ -n "$files" ]
then
    echo "Build classes are not up to date"
    exit 1
fi

exit 0
