#include <stdio.h>
#include <math.h>

int main() {
    float a, b, c, delta, x1, x2;
    char reponse;

    do {
        printf("a : ");
        scanf("%f", &a);
        printf("b : ");
        scanf("%f", &b);
        printf("c : ");
        scanf("%f", &c);

        delta = b * b - 4 * a * c;
        printf("delta = %.2f\n", delta);

        if (delta > 0) {
            x1 = (-b + sqrt(delta)) / (2 * a);
            x2 = (-b - sqrt(delta)) / (2 * a);
            printf("2 solutions : %.2f et %.2f\n", x1, x2);
        } else if (delta == 0) {
            x1 = -b / (2 * a);
            printf("1 solution : %.2f\n", x1);
        } else {
            printf("Pas de solution\n");
        }

        printf("Continuer ? y/n : ");
        scanf(" %c", &reponse);
    } while (reponse == 'y');

    return 0;
}