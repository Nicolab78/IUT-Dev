#include <stdio.h>
#include <string.h>

int main() {
    char chaine[100];
    int i;

    printf("Entrez une chaine : ");
    scanf("%s", chaine);

    int len = strlen(chaine);
    printf("Chaine : %s\n", chaine);
    printf("Longueur : %d caracteres\n", len);
    printf("Occupation memoire (chaine) : %d octets (inclut le \\0)\n", len + 1);
    printf("Taille du tableau : %zu octets\n", sizeof(chaine));
    printf("Adresse memoire du tableau : %p\n", (void*)chaine);
    printf("Occupation memoire du tableau : %zu octets\n", sizeof(chaine));

    printf("Codes ASCII :\n");
    for (i = 0; i < len; i++) {
        printf("'%c' -> %d\n", chaine[i], (int)chaine[i]);
    }
    printf("'\\0' -> 0\n");

    return 0;
}   