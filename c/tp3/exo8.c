#include <stdio.h>
#include <string.h>

int main() {
    char chaine[200];
    int len, i, max = 1, current = 1;

    printf("Entrez une chaine : ");
    scanf("%s", chaine);
    len = strlen(chaine);

    if (len == 0) { printf("Chaine vide.\n"); return 0; }

    for (i = 1; i < len; i++) {
        if (chaine[i] == chaine[i-1]) {
            current++;
        } else {
            current = 1;
        }
        if (current > max) max = current;
    }

    printf("La plus longue suite contigue de caracteres identiques a pour longueur : %d\n", max);
    return 0;
}   