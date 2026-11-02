#include <stdio.h>

#define MAX_N 10

int main() {
    int N, i, j;
    int table[MAX_N][MAX_N];

    do {
        printf("Entrez N (1 a 10) : ");
        scanf("%d", &N);
    } while (N < 1 || N > 10);

    for (i = 0; i < N; i++)
        for (j = 0; j < N; j++)
            table[i][j] = (i+1) * (j+1);

    printf("\n");
    for (i = 0; i < N; i++) {
        for (j = 0; j < N; j++)
            printf("%4d", table[i][j]);
        printf("\n");
    }

    return 0;
}   