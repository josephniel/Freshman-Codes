/*
Joseph Niel Tuazon
2012-66085
finished at 2:55 AM (modified - 3:35 AM)
*/

#include<stdio.h>

	char string[100];
	int count=0,invcount=100,in,in2,in3,comma,comma2,commacounter,stringcounter=0;

	int a=0,b=0,c=0,d=0,e=0,f=0,g=0,h=0,i=0,j=0,k=0,l=0,m=0,n=0,o=0,p=0,q=0,r=0,s=0,t=0,u=0,v=0,w=0,x=0,y=0,z=0;
	int A=0,B=0,C=0,D=0,E=0,F=0,G=0,H=0,I=0,J=0,K=0,L=0,M=0,N=0,O=0,P=0,Q=0,R=0,S=0,T=0,U=0,V=0,W=0,X=0,Y=0,Z=0;

void alpha(void){

	for(in=0;in<100;in++){
		switch(string[in]){
			case 'a': a++;break; case 'A': A++;break;
			case 'b': b++;break; case 'B': B++;break;
			case 'c': c++;break; case 'C': C++;break;
			case 'd': d++;break; case 'D': D++;break;
			case 'e': e++;break; case 'E': E++;break;
			case 'f': f++;break; case 'F': F++;break;
			case 'g': g++;break; case 'G': G++;break;
			case 'h': h++;break; case 'H': H++;break;
			case 'i': i++;break; case 'I': I++;break;
			case 'j': j++;break; case 'J': J++;break;
			case 'k': k++;break; case 'K': K++;break; 
			case 'l': l++;break; case 'L': L++;break; 
			case 'm': m++;break; case 'M': M++;break; 
			case 'n': n++;break; case 'N': N++;break; 
			case 'o': o++;break; case 'O': O++;break; 
			case 'p': p++;break; case 'P': P++;break; 
			case 'q': q++;break; case 'Q': Q++;break; 
			case 'r': r++;break; case 'R': R++;break; 
			case 's': s++;break; case 'S': S++;break;  
			case 't': t++;break; case 'T': T++;break; 
			case 'u': u++;break; case 'U': U++;break; 
			case 'v': v++;break; case 'V': V++;break; 
			case 'w': w++;break; case 'W': W++;break;  
			case 'x': x++;break; case 'X': X++;break; 
			case 'y': y++;break; case 'Y': Y++;break; 
			case 'z': z++;break; case 'Z': Z++;break; 
			default:	break; 
		}
	}
}
void aintersect(void){
	
	printf("(");
	if(a>1){printf("a,");++stringcounter;} if(A>1){printf("A,");++stringcounter;}
	if(b>1){printf("b,");++stringcounter;} if(B>1){printf("B,");++stringcounter;}
	if(c>1){printf("c,");++stringcounter;} if(C>1){printf("C,");++stringcounter;}
	if(d>1){printf("d,");++stringcounter;} if(D>1){printf("D,");++stringcounter;}
	if(e>1){printf("e,");++stringcounter;} if(E>1){printf("E,");++stringcounter;}
	if(f>1){printf("f,");++stringcounter;} if(F>1){printf("F,");++stringcounter;}
	if(g>1){printf("g,");++stringcounter;} if(G>1){printf("G,");++stringcounter;}
	if(h>1){printf("h,");++stringcounter;} if(H>1){printf("H,");++stringcounter;}
	if(i>1){printf("i,");++stringcounter;} if(I>1){printf("I,");++stringcounter;}
	if(j>1){printf("j,");++stringcounter;} if(J>1){printf("J,");++stringcounter;}
	if(k>1){printf("k,");++stringcounter;} if(K>1){printf("K,");++stringcounter;}
	if(l>1){printf("l,");++stringcounter;} if(L>1){printf("L,");++stringcounter;}
	if(m>1){printf("m,");++stringcounter;} if(M>1){printf("M,");++stringcounter;}
	if(n>1){printf("n,");++stringcounter;} if(N>1){printf("N,");++stringcounter;}
	if(o>1){printf("o,");++stringcounter;} if(O>1){printf("O,");++stringcounter;}
	if(p>1){printf("p,");++stringcounter;} if(P>1){printf("P,");++stringcounter;}
	if(q>1){printf("q,");++stringcounter;} if(Q>1){printf("Q,");++stringcounter;}
	if(r>1){printf("r,");++stringcounter;} if(R>1){printf("R,");++stringcounter;}
	if(s>1){printf("s,");++stringcounter;} if(S>1){printf("S,");++stringcounter;}
	if(t>1){printf("t,");++stringcounter;} if(T>1){printf("T,");++stringcounter;}
	if(u>1){printf("u,");++stringcounter;} if(U>1){printf("U,");++stringcounter;}
	if(v>1){printf("v,");++stringcounter;} if(V>1){printf("V,");++stringcounter;}
	if(w>1){printf("w,");++stringcounter;} if(W>1){printf("W,");++stringcounter;}
	if(x>1){printf("x,");++stringcounter;} if(X>2){printf("X,");++stringcounter;}
	if(y>1){printf("y,");++stringcounter;} if(Y>1){printf("Y,");++stringcounter;}
	if(z>1){printf("z,");++stringcounter;} if(Z>1){printf("Z,");++stringcounter;}
	if(stringcounter>0){
	printf("\b");
	}
	printf(")\n");
}
void aunion(void){

	printf("(");
	if(a>0) printf("a,"); if(A>0) printf("A,");
	if(b>0) printf("b,"); if(B>0) printf("B,");
	if(c>0) printf("c,"); if(C>0) printf("C,");
	if(d>0) printf("d,"); if(D>0) printf("D,");
	if(e>0) printf("e,"); if(E>0) printf("E,");
	if(f>0) printf("f,"); if(F>0) printf("F,");
	if(g>0) printf("g,"); if(G>0) printf("G,");
	if(h>0) printf("h,"); if(H>0) printf("H,");
	if(i>0) printf("i,"); if(I>0) printf("I,");
	if(j>0) printf("j,"); if(J>0) printf("J,");
	if(k>0) printf("k,"); if(K>0) printf("K,");
	if(l>0) printf("l,"); if(L>0) printf("L,");
	if(m>0) printf("m,"); if(M>0) printf("M,");
	if(n>0) printf("n,"); if(N>0) printf("N,");
	if(o>0) printf("o,"); if(O>0) printf("O,");
	if(p>0) printf("p,"); if(P>0) printf("P,");
	if(q>0) printf("q,"); if(Q>0) printf("Q,");
	if(r>0) printf("r,"); if(R>0) printf("R,");
	if(s>0) printf("s,"); if(S>0) printf("S,");
	if(t>0) printf("t,"); if(T>0) printf("T,");
	if(u>0) printf("u,"); if(U>1) printf("U,");
	if(v>0) printf("v,"); if(V>0) printf("V,");
	if(w>0) printf("w,"); if(W>0) printf("W,");
	if(x>0) printf("x,"); if(X>0) printf("X,");
	if(y>0) printf("y,"); if(Y>0) printf("Y,");
	if(z>0) printf("z,"); if(Z>0) printf("Z,");
	printf("\b");
	printf(")\n");
}
void adifference(void){

	for(in2=count;in2!=0;in2--){
		switch(string[in2]){
			case 'a': a=1;break; case 'A': A=1;break;
			case 'b': b=1;break; case 'B': B=1;break;
			case 'c': c=1;break; case 'C': C=1;break;
			case 'd': d=1;break; case 'D': D=1;break;
			case 'e': e=1;break; case 'E': E=1;break;
			case 'f': f=1;break; case 'F': F=1;break;
			case 'g': g=1;break; case 'G': G=1;break;
			case 'h': h=1;break; case 'H': H=1;break;
			case 'i': i=1;break; case 'I': I=1;break;
			case 'j': j=1;break; case 'J': J=1;break;
			case 'k': k=1;break; case 'K': K=1;break; 
			case 'l': l=1;break; case 'L': L=1;break; 
			case 'm': m=1;break; case 'M': M=1;break; 
			case 'n': n=1;break; case 'N': N=1;break; 
			case 'o': o=1;break; case 'O': O=1;break; 
			case 'p': p=1;break; case 'P': P=1;break; 
			case 'q': q=1;break; case 'Q': Q=1;break; 
			case 'r': r=1;break; case 'R': R=1;break; 
			case 's': s=1;break; case 'S': S=1;break;  
			case 't': t=1;break; case 'T': T=1;break; 
			case 'u': u=1;break; case 'U': U=1;break; 
			case 'v': v=1;break; case 'V': V=1;break; 
			case 'w': w=1;break; case 'W': W=1;break;  
			case 'x': x=1;break; case 'X': X=1;break; 
			case 'y': y=1;break; case 'Y': Y=1;break; 
			case 'z': z=1;break; case 'Z': Z=1;break; 
			default:	break; 
		}
	}
	for(in3=count;in3!=99;in3++){
		switch(string[in3]){
			case 'a': a--;break; case 'A': A--;break;
			case 'b': b--;break; case 'B': B--;break;
			case 'c': c--;break; case 'C': C--;break;
			case 'd': d--;break; case 'D': D--;break;
			case 'e': e--;break; case 'E': E--;break;
			case 'f': f--;break; case 'F': F--;break;
			case 'g': g--;break; case 'G': G--;break;
			case 'h': h--;break; case 'H': H--;break;
			case 'i': i--;break; case 'I': I--;break;
			case 'j': j--;break; case 'J': J--;break;
			case 'k': k--;break; case 'K': K--;break; 
			case 'l': l--;break; case 'L': L--;break; 
			case 'm': m--;break; case 'M': M--;break; 
			case 'n': n--;break; case 'N': N--;break; 
			case 'o': o--;break; case 'O': O--;break; 
			case 'p': p--;break; case 'P': P--;break; 
			case 'q': q--;break; case 'Q': Q--;break; 
			case 'r': r--;break; case 'R': R--;break; 
			case 's': s--;break; case 'S': S--;break;  
			case 't': t--;break; case 'T': T--;break; 
			case 'u': u--;break; case 'U': U--;break; 
			case 'v': v--;break; case 'V': V--;break; 
			case 'w': w--;break; case 'W': W--;break;  
			case 'x': x--;break; case 'X': X--;break; 
			case 'y': y--;break; case 'Y': Y--;break; 
			case 'z': z--;break; case 'Z': Z--;break; 
			default:	break; 
		}
	}

	printf("(");
	if(a>0){printf("a,");++stringcounter;} if(A>0){printf("A,");++stringcounter;}
	if(b>0){printf("b,");++stringcounter;} if(B>0){printf("B,");++stringcounter;}
	if(c>0){printf("c,");++stringcounter;} if(C>0){printf("C,");++stringcounter;}
	if(d>0){printf("d,");++stringcounter;} if(D>0){printf("D,");++stringcounter;}
	if(e>0){printf("e,");++stringcounter;} if(E>0){printf("E,");++stringcounter;}
	if(f>0){printf("f,");++stringcounter;} if(F>0){printf("F,");++stringcounter;}
	if(g>0){printf("g,");++stringcounter;} if(G>0){printf("G,");++stringcounter;}
	if(h>0){printf("h,");++stringcounter;} if(H>0){printf("H,");++stringcounter;}
	if(i>0){printf("i,");++stringcounter;} if(I>0){printf("I,");++stringcounter;}
	if(j>0){printf("j,");++stringcounter;} if(J>0){printf("J,");++stringcounter;}
	if(k>0){printf("k,");++stringcounter;} if(K>0){printf("K,");++stringcounter;}
	if(l>0){printf("l,");++stringcounter;} if(L>0){printf("L,");++stringcounter;}
	if(m>0){printf("m,");++stringcounter;} if(M>0){printf("M,");++stringcounter;}
	if(n>0){printf("n,");++stringcounter;} if(N>0){printf("N,");++stringcounter;}
	if(o>0){printf("o,");++stringcounter;} if(O>0){printf("O,");++stringcounter;}
	if(p>0){printf("p,");++stringcounter;} if(P>0){printf("P,");++stringcounter;}
	if(q>0){printf("q,");++stringcounter;} if(Q>0){printf("Q,");++stringcounter;}
	if(r>0){printf("r,");++stringcounter;} if(R>0){printf("R,");++stringcounter;}
	if(s>0){printf("s,");++stringcounter;} if(S>0){printf("S,");++stringcounter;}
	if(t>0){printf("t,");++stringcounter;} if(T>0){printf("T,");++stringcounter;}
	if(u>0){printf("u,");++stringcounter;} if(U>0){printf("U,");++stringcounter;}
	if(v>0){printf("v,");++stringcounter;} if(V>0){printf("V,");++stringcounter;}
	if(w>0){printf("w,");++stringcounter;} if(W>0){printf("W,");++stringcounter;}
	if(x>0){printf("x,");++stringcounter;} if(X>0){printf("X,");++stringcounter;}
	if(y>0){printf("y,");++stringcounter;} if(Y>0){printf("Y,");++stringcounter;}
	if(z>0){printf("z,");++stringcounter;} if(Z>0){printf("Z,");++stringcounter;}
	if(stringcounter!=0){
	printf("\b");
	}
	printf(")\n");

}

main(){

	printf("Enter your set operation: ");
	scanf("%[^\n]",string);

	do{

		count++;

		if( (string[count]=='U') || (string[count]=='X') || (string[count]=='-') ){
	
			if( (string[count-1]==')') && (string[count+1]=='(') ){

				do{

					if( (string[0]=='(') && (string[invcount]==')') && (invcount!=count-1) ){

/* Comma count if there are 2 or more letters inside the perenthesis */

								comma = 2;
								comma2 = count + 3; 

								if( (string[comma]==',') && (string[comma2]==',') ){

									for(commacounter=comma;commacounter<count-1;commacounter+=2){
											comma += 2;

											if(string[commacounter]!=','){
													printf("Invalid input!\n");
													return 0;
												}
										}

									for(commacounter=comma2;commacounter<invcount;commacounter+=2){
											comma2 += 2;

											if(string[commacounter]!=','){
													printf("Invalid input!\n");
													return 0;
												}
										}

									if( comma==count-1 && comma2==invcount ){

										switch(string[count]){
													case 'U':
														alpha();
														aunion();
														break;
													case 'X':
														alpha();
														aintersect();
														break;
													case '-':
														adifference();
														break;
													default: break;
													}

										break;
										}
									else{
										printf("Invalid input!\n");
										}

          				break;
									}

			/*Comma count if there is only one letter in the 1st set*/
								else if(string[comma]==')'){

									for(commacounter=comma2;commacounter<invcount;commacounter+=2){
											comma2 += 2;

											if(string[commacounter]!=','){
													printf("Invalid input!\n");
													return 0;
												}
										}

									if(comma2==invcount){

										switch(string[count]){
													case 'U':
														alpha();
														aunion();
														break;
													case 'X':
														alpha();
														aintersect();
														break;
													case '-':
														adifference();
														break;
													default: break;
													}

										break;
										}
									else{
										printf("Invalid input!\n");
										}

          				break;
									}

			/*Comma count if there is only one letter in the 2st set*/
								else if(string[comma2]==')'){

									for(commacounter=comma;commacounter<count-1;commacounter+=2){
											comma += 2;

											if(string[commacounter]!=','){
													printf("Invalid input!\n");
													return 0;
												}
										}

									if(comma==count-1){

										switch(string[count]){
													case 'U':
														alpha();
														aunion();
														break;
													case 'X':
														alpha();
														aintersect();
														break;
													case '-':
														adifference();
														break;
													default: break;
													}

										break;
										}
									else{
										printf("Invalid input!\n");
										}

          				break;									
									}

								else if( (string[comma]==')') && (string[comma2]==')') ){

											switch(string[count]){
												case 'U':
													alpha();
													aunion();
													break;
												case 'X':
													alpha();
													aintersect();
													break;
												case '-':
													adifference();
													break;
												default: break;
												}

									break;	
									}

								else{
										printf("Invalid input!\n");
									}

/* -------------------------------------------------------------------------- */

						break;
						}

					else{

						if(invcount==1){

							printf("Invalid input!\n");
							break;
							}

						}

					--invcount;

					}while(invcount!=0);

				break;
				}

			else{

				printf("Invalid input!\n");
				break;
				}

			}

		else{

			if(count==99){

				printf("Invalid input!\n");
				break;
			}

		}
		
	}while(count!=99);

}
