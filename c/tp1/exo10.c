#include <stdio.h>

int main() {
    unsigned char u_char = 128;
    int _int = 256;

    printf("1) (int)u_char       = %d\n", (int)u_char);
    printf("2) (char)u_char      = %d\n", (char)u_char);
    printf("3) (char)_int        = %d\n", (char)_int);
    printf("4) (unsigned char)_int = %d\n", (unsigned char)_int);

    _int = 384;
    printf("5) (char)u_char      = %d\n", (char)u_char);
    printf("6) (char)_int        = %d\n", (char)_int);
    printf("7) (unsigned char)_int = %d\n", (unsigned char)_int);

    return 0;
}   