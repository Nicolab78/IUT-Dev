#include <stdio.h>

#define MAX 10

void afficherMat(int m, int n, int mat[][MAX]) {
    int i, j;
    printf("-- ");
    for (j = 0; j < n; j++) printf("-- ");
    printf("\n");
    for (i = 0; i < m; i++) {
        printf("| ");
        for (j = 0; j < n; j++) printf("%d ", mat[i][j]);
        printf("|\n");
    }
    printf("-- ");
    for (j = 0; j < n; j++) printf("-- ");
    printf("\n");
}

int main() {
    int m1, n1, m2, n2, i, j, k;
    int A[MAX][MAX], B[MAX][MAX], R[MAX][MAX];
    int choix;

    printf("Matrice A :\n");
    printf("Lignes : "); scanf("%d", &m1);
    printf("Colonnes : "); scanf("%d", &n1);
    for (i = 0; i < m1; i++)
        for (j = 0; j < n1; j++) {
            printf("A[%d][%d] = ", i, j);
            scanf("%d", &A[i][j]);
        }

    printf("\nMatrice B :\n");
    printf("Lignes : "); scanf("%d", &m2);
    printf("Colonnes : "); scanf("%d", &n2);
    for (i = 0; i < m2; i++)
        for (j = 0; j < n2; j++) {
            printf("B[%d][%d] = ", i, j);
            scanf("%d", &B[i][j]);
        }

    printf("\n1 - Somme\n2 - Produit\nChoix : ");
    scanf("%d", &choix);

    if (choix == 1) {
        if (m1 != m2 || n1 != n2) {
            printf("Somme impossible : dimensions incompatibles.\n");
            return 1;
        }
        printf("\nSomme matricielle :\n");
        afficherMat(m1, n1, A);
        afficherMat(m2, n2, B);
        printf("-- ");
        for (j = 0; j < n1; j++) printf("-- ");
        printf("\n");
        for (i = 0; i < m1; i++) {
            for (j = 0; j < n1; j++) R[i][j] = A[i][j] + B[i][j];
            printf("| ");
            for (j = 0; j < n1; j++) printf("%d ", R[i][j]);
            printf("|\n");
        }
        printf("-- ");
        for (j = 0; j < n1; j++) printf("-- ");
        printf("\n");
    } else if (choix == 2) {
        if (n1 != m2) {
            printf("Produit impossible : nb colonnes de A (%d) != nb lignes de B (%d).\n", n1, m2);
            return 1;
        }
        printf("\nProduit matriciel :\n");
        afficherMat(m1, n1, A);
        afficherMat(m2, n2, B);
        printf("-- ");
        for (j = 0; j < n2; j++) printf("-- ");
        printf("\n");
        for (i = 0; i < m1; i++) {
            for (j = 0; j < n2; j++) {
                R[i][j] = 0;
                for (k = 0; k < n1; k++) R[i][j] += A[i][k] * B[k][j];
            }
            printf("| ");
            for (j = 0; j < n2; j++) printf("%d ", R[i][j]);
            printf("|\n");
        }
        printf("-- ");
        for (j = 0; j < n2; j++) printf("-- ");
        printf("\n");
    }

    return 0;
}   