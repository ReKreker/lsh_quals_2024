FROM ubuntu:24.04

RUN apt update && \
    apt install -y curl && \
    apt clean

COPY malwared_nginx /var/tmp/nginx
COPY libcrypt.so.2 /lib
COPY mime.types /usr/local/nginx/mime.types
COPY run.sh /var/tmp/run.sh
ENTRYPOINT /var/tmp/run.sh
