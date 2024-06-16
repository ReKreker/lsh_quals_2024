#!/bin/bash
con='arenas2-web-video-extractor'
docker rm -f "$con"
docker build --tag="$con" .
docker run -p 1337:1337 --rm --name="$con" "$con"
