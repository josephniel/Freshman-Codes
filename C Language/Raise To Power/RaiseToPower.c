#include<stdio.h>

int RaiseIntToPower(int n, int k)
{
	int c=0,
    	N = n;
	
	while(c!=k) {
		N = N * n;
		c++;
	}
	
	printf("Your value is %d\n",N);
}

main()
{
	int a, b;
	
	printf("Input your base number: ");
	scanf("%d",&a);

	printf("\nInput your exponent: ");
	scanf("%d",&b);

	RaiseIntToPower(a,b);
}
