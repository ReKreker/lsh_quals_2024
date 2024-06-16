#!/bin/bash
chal="${CHAL:-Store Hanoi}"
docker rm -f "$chal"
docker build --tag="$chal" .
docker run -p 1338:1337 --rm --name="${chal}" "${chal}"
