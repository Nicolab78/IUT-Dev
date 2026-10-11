#include <stdio.h>

int main() {
    int a = 10, b = 20;
    int temp;

    printf("Avant echange : a = %d, b = %d\n", a, b);

    temp = a;
    a = b;
    b = temp;

    printf("Apres echange : a = %d, b = %d\n", a, b);

    return 0;
}   