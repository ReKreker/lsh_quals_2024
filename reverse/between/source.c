#include <stdio.h>
#include <string.h>

int main(int argc, char **argv) {
    if (argc != 2) return 1;
    //flag{jmp_h3ll}
    if ('f' == argv[1][0] &&
        'l' == argv[1][1] &&
        'a' == argv[1][2] &&
        'g' == argv[1][3] &&
        '{' == argv[1][4] &&
        'j' == argv[1][5] &&
        'm' == argv[1][6] &&
        'p' == argv[1][7] &&
        '_' == argv[1][8] &&
        'h' == argv[1][9] &&
        '3' == argv[1][10] &&
        'l' == argv[1][11] &&
        'l' == argv[1][12] &&
        '}' == argv[1][13])
        puts("Congratz!");
    else
        puts("Sadly...");
}

