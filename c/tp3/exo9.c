#include <stdio.h>
#include <string.h>

#define MAX_CHARS 128

int main() {
    char chaine[200];
    int len, i, j;
    int maxSuite[MAX_CHARS] = {0}; /* index = code ASCII */
    int present[MAX_CHARS] = {0};
    int globalMax = 0;

    printf("Entrez une chaine : ");
    scanf("%s", chaine);
    len = strlen(chaine);

    /* Marquer les caracteres presents */
    for (i = 0; i < len; i++) present[(unsigned char)chaine[i]] = 1;

    /* Pour chaque caractere present, trouver sa plus longue suite contigue */
    for (i = 0; i < len; i++) {
        char c = chaine[i];
        int current = 1;
        for (j = i + 1; j < len && chaine[j] == c; j++) current++;
        if (current > maxSuite[(unsigned char)c])
            maxSuite[(unsigned char)c] = current;
    }

    printf("\nPlus longues suites par caractere :\n");
    for (i = 0; i < MAX_CHARS; i++) {
        if (present[i]) {
            printf("  '%c' : %d\n", (char)i, maxSuite[i]);
            if (maxSuite[i] > globalMax) globalMax = maxSuite[i];
        }
    }

    printf("\nLongueur de la plus grande suite globale : %d\n", globalMax);
    return 0;
}   