#include <stdio.h>

int main() {
    long total, reste;
    int jours, heures, minutes, secondes;
    char reponse;

    do {
        printf("Secondes : ");
        scanf("%ld", &total);

        jours = total / 86400;
        reste = total % 86400;
        heures = reste / 3600;
        reste = reste % 3600;
        minutes = reste / 60;
        secondes = reste % 60;

        printf("%d j %d h %d min %d s\n", jours, heures, minutes, secondes);

        do {
            printf("Continuer ? o/n : ");
            scanf(" %c", &reponse);
        } while (reponse != 'o' && reponse != 'n');

    } while (reponse == 'o');

    return 0;
}