#include <stdio.h>

int main() {
    float poids, taille, imc, seuil;
    int age;

    printf("Poids : ");
    scanf("%f", &poids);
    printf("Taille : ");
    scanf("%f", &taille);
    printf("Age : ");
    scanf("%d", &age);

    imc = poids / (taille * taille);

    if (age <= 16) {
        seuil = 27.3;
    } else if (age <= 48) {
        seuil = 23;
    } else {
        seuil = 21.5;
    }

    printf("IMC = %.2f\n", imc);

    if (imc > seuil) {
        printf("Surpoids\n");
    } else {
        printf("Pas de surpoids\n");
    }

    return 0;
}