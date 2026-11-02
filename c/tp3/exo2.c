#include <stdio.h>

#define MAX 20

int main() {
    int n, i;
    float val;
    float tab[MAX];
    float min;

    do {
        printf("Entrez n (entre 1 et %d) : ", MAX);
        scanf("%d", &n);
    } while (n < 1 || n > MAX);

    for (i = 0; i < n; i++) {
        do {
            printf("Entrez la valeur %d (entier) : ", i + 1);
            scanf("%f", &val);
            if (val != (int)val) {
                printf("Valeur non entiere, reessayez.\n");
            }
        } while (val != (int)val);
        tab[i] = val;
    }

    min = tab[0];
    for (i = 1; i < n; i++) {
        if (tab[i] < min) min = tab[i];
    }

    printf("Le minimum est : %.0f\n", min);
    return 0;
}   