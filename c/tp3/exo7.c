#include <stdio.h>
#include <string.h>

int main() {
    char chaine[100];
    char originale[100];
    char tronquee[100];
    int pos, len, i;
    char c1, c2;

    printf("Entrez une chaine : ");
    scanf("%99s", chaine);

    len = strlen(chaine);
    strcpy(originale, chaine);

    printf("Position de troncature : ");
    scanf("%d", &pos);

    if (pos < 0 || pos > len) {
        printf("Position invalide.\n");
        return 1;
    }

    /* Version 1 : on modifie chaine */
    chaine[pos] = '\0';
    printf("V1 - Chaine tronquee : %s\n", chaine);

    /* Version 2 : originale est conservee, resultat dans tronquee */
    strcpy(tronquee, originale);
    tronquee[pos] = '\0';
    printf("V2 - Chaine tronquee : %s\n", tronquee);

    /* Couper : supprimer les caracteres avant la position */
    printf("Position de coupe : ");
    scanf("%d", &pos);

    if (pos < 0 || pos > len) {
        printf("Position invalide.\n");
        return 1;
    }

    for (i = 0; i < len - pos; i++) {
        chaine[i] = originale[pos + i];
    }
    chaine[len - pos] = '\0';
    printf("Chaine coupee : %s\n", chaine);

    /* Remplacer un caractere dans la chaine d'origine */
    printf("Caractere a remplacer : ");
    scanf(" %c", &c1);
    printf("Caractere de remplacement : ");
    scanf(" %c", &c2);

    strcpy(chaine, originale);
    for (i = 0; i < len; i++) {
        if (chaine[i] == c1) {
            chaine[i] = c2;
        }
    }
    printf("Chaine apres remplacement : %s\n", chaine);

    return 0;
}