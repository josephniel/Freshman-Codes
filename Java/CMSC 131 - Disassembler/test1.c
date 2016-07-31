#include <stdio.h>

int main() {
    int x = 5;
    int y, z; //this is a comment
    y=2,z=10; //another comment
    if (y == 2) {
        while (z != 0) {
            printf("I'm inside wile!\n");
            z--;
        }
    }
    else if (y == 3) {
        do {
            printf("Hello, I said.\n");
            y++;
        } while (y < 10);
    }
    else {
        for (z = 10; z < 20; z++) {
            printf("Hi");
        }
    }
    return 0;
}
