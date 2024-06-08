FROM ubuntu:24.04

RUN apt update && \
    apt install -y inetutils-ping && \
    apt clean

RUN echo "flag{realnyi_vzlom_jopbi_4ere3_inet_aton}" > flag.txt
COPY cmake-build-debug/jacofresco jacofresco
CMD /jacofresco