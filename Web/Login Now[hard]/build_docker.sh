#!/bin/bash
chal="${CHAL:-Login Now}"
docker rm -f "$chal"
docker build --tag="$chal" .
docker run -p 1340:1337 --rm --name="${chal}" "${chal}"
