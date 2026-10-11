#include <stdio.h>

int main() {
    int annee;

    printf("Annee : ");
    scanf("%d", &annee);

    if ((annee % 4 == 0 && annee % 100 != 0) || annee % 400 == 0) {
        printf("Bissextile\n");
    } else {
        printf("Pas bissextile\n");
    }

    return 0;
}