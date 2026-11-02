#include <stdio.h>

int main() {
    int n;
    int tab[10];
    int x, i, count;

    do {
        printf("Entrez n (entre 2 et 10) : ");
        scanf("%d", &n);
    } while (n < 2 || n > 10);

    printf("Entrez %d valeurs entieres :\n", n);
    for (i = 0; i < n; i++) {
        scanf("%d", &tab[i]);
    }

    printf("Entrez la valeur x a chercher : ");
    scanf("%d", &x);

    count = 0;
    for (i = 0; i < n; i++) {
        if (tab[i] == x) count++;
    }

    printf("Le nombre d'occurrences de %d est : %d\n", x, count);
    return 0;
}   