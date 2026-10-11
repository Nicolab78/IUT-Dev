#include <stdio.h>

int main() {
    char c;

    printf("Tapez un caractere : ");
    scanf("%c", &c);
    printf("%c = %d / %X\n", c, c, c);

    printf("Tapez une majuscule : ");
    scanf(" %c", &c);
    printf("%c = %d / %X\n%c = %d / %X\n", c, c, c, c+32, c+32, c+32);

    return 0;
}   