#!/bin/bash
chal="${CHAL:-Store Hanoi 2}"
docker rm -f "$chal"
docker build --tag="$chal" .
docker run -p 1339:1337 --rm --name="${chal}" "${chal}"