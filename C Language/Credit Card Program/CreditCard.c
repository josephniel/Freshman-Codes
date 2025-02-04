/*
Joseph Niel Tuazon

August 30, 2012
11:13 PM
*/

#include<stdio.h>
#include<math.h>

/*Digits are named inversely*/

int unitdigit(int a,int b)
{
	b = a / 10000000;
	ceil(b);
	a = a - (b*10000000);
	
	return a;
}



int tensdigit(int a,int b)
{
	b = a / 1000000;
	ceil(b);
	a = a - (b*1000000);
	
	return a;
}


int hundredsdigit(int a,int b)
{
	b = a / 100000;
	ceil(b);
	a = a - (b*100000);
	
	return a;
}


int thousandsdigit(int a,int b)
{
	b = a / 10000;
	ceil(b);
	a = a - (b*10000);
	
	return a;
}


int tenthousandsdigit(int a,int b)
{
	b = a / 1000;
	ceil(b);
	a = a - (b*1000);
	
	return a;
}


int hundredthousandsdigit(int a,int b)
{
	b = a / 100;
	ceil(b);	
	a = a - (b*100);
	
	return a;
}


int millionsdigit(int a,int b)
{
	b = a / 10;
	ceil(b);
	a = a - (b*10);
	
	return a;
}


int tenmillionsdigit(int a,int b)
{	
	b = a / 1;	
	ceil(b);
	a = a - (b*1);
	
	return a;	
}




main() {

    int input,sum;
    int a,b,c,d,e,f,g,h;
    int A,B,C,D,E,F,G;
    int Bb,Dd,Ff,Hh;

	printf("Input your 8-digit credit card number (do not add any characters): ");
	scanf("%d",&input);

	if((input>99999999)||(input<10000000)) {
	    printf("Value inputted is not an 8-digit number! Try again!\n");
	}
	else {
	    unitdigit(input,a);
		    A = input - unitdigit(input,a);
		    a = A/10000000;
		
	    tensdigit(input,b);
		    B = unitdigit(input,a) - tensdigit(input,b);
		    b = B/1000000;
		    b = b * 2;
			    if(b>9){
				    Bb = b - 10;
				    b = Bb + 1;
				    }
	    hundredsdigit(input,c);
		    C = tensdigit(input,b) - hundredsdigit(input,c);
		    c = C/100000;
		
	    thousandsdigit(input,d);
		    D = hundredsdigit(input,c) - thousandsdigit(input,d);
		    d = D/10000;
		    d = d * 2;
			    if(d>9){
				    Dd = d - 10;
				    d = Dd + 1;
				    }
	    tenthousandsdigit(input,e);
		    E = thousandsdigit(input,d) - tenthousandsdigit(input,e);
		    e = E/1000;
		
	    hundredthousandsdigit(input,f);
		    F = tenthousandsdigit(input,e) - hundredthousandsdigit(input,f);
		    f = F/100;
		    f = f * 2;
			    if(f>9){
				    Ff = f - 10;
				    f = Ff + 1;
				    }
	    millionsdigit(input,g);
		    G = hundredthousandsdigit(input,f) - millionsdigit(input,g);
		    g = G/10;
		
	    tenmillionsdigit(input,h);
		    h = millionsdigit(input,g) - tenmillionsdigit(input,h);
		    h = h * 2;
			    if(h>9){
				    Hh = h - 10;
				    h = Hh + 1;
				    } 

	    sum = a + b + c + d + e + f + g + h;

	    if(sum%10){
		    printf("Invalid!\n");
		}
	    else{
		    printf("Valid!\n");
	    }
	}
}
