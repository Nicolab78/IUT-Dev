#include <stdio.h>
#include <ctype.h>

int main() {
    char c;
    int n, shifted;

    printf("Entrez un caractere : ");
    scanf(" %c", &c);

    printf("Valeur decimale : %d\n", (int)c);

    if (isdigit(c)) {
        printf("Nature : Numerique\n");
    } else if (isalpha(c)) {
        printf("Nature : Alphabétique\n");
        printf("Entrez N (decalage) : ");
        scanf("%d", &n);
        if (isupper(c)) {
            shifted = (c - 'A' + n) % 26;
            if (shifted < 0) shifted += 26;
            printf("Caractere decale de %d : '%c'\n", n, 'A' + shifted);
        } else {
            shifted = (c - 'a' + n) % 26;
            if (shifted < 0) shifted += 26;
            printf("Caractere decale de %d : '%c'\n", n, 'a' + shifted);
        }
    } else {
        printf("Nature : Autre\n");
    }

    return 0;
}   