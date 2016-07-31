#include <stdio.h>

int main()
{
    int z;
    int a = 10, b = 5;
    for (z = 0; z < 10; z++)
    {
        a += b;
        printf("%d\n", a);
    }
    return 0;
}