#include <stdio.h>

int main() {
    float celsius, fahrenheit;

    printf("Temperature en degres Celsius : ");
    scanf("%f", &celsius);

    fahrenheit = (9.0 / 5.0) * celsius + 32;

    printf("%.2f C = %.2f F\n", celsius, fahrenheit);

    return 0;
}   