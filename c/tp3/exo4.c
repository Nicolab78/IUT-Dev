#include <stdio.h>

int main() {
    int a[] = {1, 3, 5, 7, 9};
    int b[] = {2, 4, 6, 8, 10};
    int c[10];
    int na = 5, nb = 5, i, j, k;
    int sorted = 1;

    for (i = 1; i < na; i++) if (a[i-1] > a[i]) sorted = 0;
    for (i = 1; i < nb; i++) if (b[i-1] > b[i]) sorted = 0;

    if (!sorted) {
        printf("Les tableaux ne sont pas tries par ordre croissant.\n");
        return 1;
    }

    i = j = k = 0;
    while (i < na && j < nb) {
        if (a[i] <= b[j]) c[k++] = a[i++];
        else c[k++] = b[j++];
    }
    while (i < na) c[k++] = a[i++];
    while (j < nb) c[k++] = b[j++];

    printf("Tableau A : ");
    for (i = 0; i < na; i++) printf("%d ", a[i]);
    printf("\nTableau B : ");
    for (i = 0; i < nb; i++) printf("%d ", b[i]);
    printf("\nFusion triee : ");
    for (i = 0; i < k; i++) printf("%d ", c[i]);
    printf("\n");

    return 0;
}   