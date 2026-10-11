#include <stdio.h>

int main() {
    int nombre;
    char reponse;

    do {
        printf("Nombre : ");
        scanf("%d", &nombre);

        if (nombre % 2 == 0) {
            printf("Pair\n");
        } else {
            printf("Impair\n");
        }

        printf("Continuer ? o/n : ");
        scanf(" %c", &reponse);
    } while (reponse == 'o');

    return 0;
}