#include <stdio.h>

int main() {
    int a = 2, b = 3, c = 4;
    float moyenne;

    moyenne = (a + b + c) / 3.0;

    printf("Moyenne de %d, %d, %d = %.2f\n", a, b, c, moyenne);

    return 0;
}   