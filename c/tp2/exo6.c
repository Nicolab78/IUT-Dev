#include <stdio.h>

int main() {
    char caractere;
    int hauteur, ligne, espaces, i;

    printf("Caractere : ");
    scanf(" %c", &caractere);
    printf("Hauteur : ");
    scanf("%d", &hauteur);

    for (ligne = 1; ligne <= hauteur; ligne++) {
        for (espaces = 0; espaces < hauteur - ligne; espaces++) {
            printf(" ");
        }
        for (i = 0; i < 2 * ligne - 1; i++) {
            printf("%c", caractere);
        }
        printf("\n");
    }

    return 0;
}