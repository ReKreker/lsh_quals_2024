#include <stdio.h>
#include <sys/socket.h>
#include <string.h>
#include <errno.h>
#include <netinet/in.h>
#include <pthread.h>
#include <arpa/inet.h>
#include <stdlib.h>
#include <unistd.h>

void *challenge(void *fd_ptr) {
    int fd = *(int *)fd_ptr;
    ssize_t amount;
    struct in_addr inp;
    char buf[0x100] = {};

    send(fd, "Give me ip address to ping: ", 28, 0);
    amount = recv(fd, buf, 0x100-1, 0);
    strchr(buf, '\n')[0] = 0;
    if (amount < 8) {
        send(fd, "A small length for ip\n", 22, 0);
        goto deinit;
    }
    if (inet_aton(buf, &inp) == 0) {
        send(fd, "Invalid addr!\n", 14, 0);
        goto deinit;
    }
    if (ntohl(inp.s_addr) != INADDR_LOOPBACK) {
        send(fd, "You can ping only 127.0.0.1\n", 28, 0);
        goto deinit;
    }

    send(fd, "Ping...\n", 8, 0);
    char cmd[16+0x100] = "ping -c 4 ";
    strncat(cmd, buf, 0x100-1);
    system(cmd);
    send(fd, "Successfully pinged\n", 20, 0);

    deinit:
    close(fd);
    return NULL;
}

int main() {
    int rc;
    int fd;
    struct sockaddr_in clnt_addr, serv_addr = {
            .sin_family = AF_INET,
            .sin_addr = htonl(INADDR_ANY),
            .sin_port = htons(30002)
    };
    socklen_t addr_len = sizeof(clnt_addr);

    setbuf(stdout, NULL);
    setbuf(stdin, NULL);

    fd = socket(AF_INET, SOCK_STREAM, 0);
    if (fd == -1) {
        printf("Create socket failed: %s \n", strerror(errno));
        return 1;
    }

    int reuse = 1;
    if (setsockopt(fd, SOL_SOCKET, SO_REUSEPORT, &reuse, sizeof(reuse)) < 0) {
        printf("SO_REUSEPORT failed: %s \n", strerror(errno));
        return 1;
    }

    if (bind(fd, (struct sockaddr *) &serv_addr, sizeof(serv_addr)) != 0) {
        printf("Bind failed: %s \n", strerror(errno));
        return 1;
    }

    rc = listen(fd, 1024);
    if (rc) {
        printf("Listen failed: %s \n", strerror(errno));
        return 1;
    }

    while (1) {
        rc = accept(fd, (struct sockaddr *) &clnt_addr, &addr_len);
        if (rc == -1) {
            printf("Accept failed: %s \n", strerror(errno));
            continue;
        }
        printf("Connected from: %s\n", inet_ntoa(clnt_addr.sin_addr));
        pthread_t thread;
        pthread_create(&thread, NULL, challenge, (void *) &rc);
    }
}