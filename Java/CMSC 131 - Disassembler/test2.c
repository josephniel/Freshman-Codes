#include <stdio.h>

int main()
{
    int x = 9, y = 1;
    int z = x + y; // Support other operations
    if (z > 0)
    {
        printf("%d", x);
    }
    else if(z < 0)
        printf("%d", z);
    else
        printf("%d", y);
    return 0;
}