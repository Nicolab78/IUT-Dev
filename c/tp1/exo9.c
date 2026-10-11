#include <stdio.h>

int main() {
    int nombre;
    float prix_ht, prix_ttc;
    const float TVA = 19.6;

    printf("Nombre d'articles : ");
    scanf("%d", &nombre);

    printf("Prix unitaire HT : ");
    scanf("%f", &prix_ht);

    prix_ttc = prix_ht * nombre * (1.0 + TVA / 100.0);

    printf("\n%-20s %10.2f\n", "Prix unitaire HT :", prix_ht);
    printf("%-20s %10d\n", "Nombre d'articles :", nombre);
    printf("%-20s %10.2f %%\n", "TVA :", TVA);
    printf("%-20s %10.2f\n", "Prix total TTC :", prix_ttc);

    return 0;
}   