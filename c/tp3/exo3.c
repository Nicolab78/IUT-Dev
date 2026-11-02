#include <stdio.h>

#define MAX 50

int main() {
    int n = 0, i;
    float val;
    float tab[MAX];
    float pos[MAX], neg[MAX];
    int nbPos = 0, nbNeg = 0;
    float sommePos = 0, sommeNeg = 0;

    printf("Saisissez des valeurs (max %d). Entrez un nombre non entier pour arreter.\n", MAX);
    while (n < MAX) {
        printf("Valeur %d : ", n + 1);
        scanf("%f", &val);
        if (val != (int)val) break;
        tab[n] = val;
        n++;
    }

    for (i = 0; i < n; i++) {
        if (tab[i] > 0) {
            pos[nbPos++] = tab[i];
            sommePos += tab[i];
        } else if (tab[i] < 0) {
            neg[nbNeg++] = tab[i];
            sommeNeg += tab[i];
        }
    }

    printf("Positives : %d (somme = %.2f)\n", nbPos, sommePos);
    printf("Negatives : %d (somme = %.2f)\n", nbNeg, sommeNeg);

    printf("Tableau des positives : ");
    for (i = 0; i < nbPos; i++) printf("%.0f ", pos[i]);
    printf("\nTableau des negatives : ");
    for (i = 0; i < nbNeg; i++) printf("%.0f ", neg[i]);
    printf("\n");

    return 0;
}   