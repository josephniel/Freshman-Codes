man('John').
man('William').
man('Will').
man('Charles Barrow').
man('George Hogarth').
man('Frederick William').
man('Alfred Lamarte').
man('Charles John').
man('Alfred').
man('Charles Boz').
man('Sydney').
man('Edward').
man('Thomas Barrow').
man('Walter').
man('Francis').
man('Henry').
man('Bryan').
man('Augustus').
            
woman('Elizabeth Ball').    
woman('Georgina Thompson').    
woman('Mary Hogarth').    
woman('Catherine Hogarth').    
woman('Kate').
woman('Mary').        
woman('Mary Barrow').    
woman('Georgina Hogarth').    
woman('Letitia Mary').
woman('Harriet Ellen').    
woman('Mary Culliford').   
woman('Elizabeth Barrow'). 
woman('Frances'). 

parent('Elizabeth Ball','John').
parent('Georgina Thompson','Mary Hogarth').
parent('Catherine Hogarth','Kate').
parent('Catherine Hogarth','Mary').
parent('William','Will').
parent('Charles Barrow','Mary Barrow').
parent('George Hogarth','Georgina Hogarth').
parent('Charles John','Walter').
parent('Mary Culliford','Thomas Barrow').
parent('Charles John','Walter').
parent('Charles John','Francis').
parent('Charles John','Sydney').
parent('Charles John','Henry').
parent('Georgina Hogarth','Bryan').
parent('John','Letitia Mary').
parent('Elizabeth Barrow','Harriet Ellen').
parent('Catherine Hogarth','Kate').

sibling('John','Will').
sibling('Frederick William','Letitia Mary').
sibling('Alfred Lamarte', 'Harriet Ellen').
sibling('Charles John', 'Letitia Mary').
sibling('Alfred', 'Charles Boz').
sibling('Sydney', 'Kate').
sibling('Edward', 'Mary').
sibling('Elizabeth Barrow','Mary Barrow').
sibling('Elizabeth Barrow','Thomas Barrow').
sibling('Letitia Mary','Augustus').
sibling('Frances','Harriet Ellen').
sibling('Catherine Hogarth','Mary Hogarth').
sibling('Mary Hogarth','Georgina Hogarth').
sibling('Alfred','Kate').

husband('John','Elizabeth Barrow').

father(F,C):-man(F),parent(F,C).      
mother(M,C):-woman(M),parent(M,C). 
son(S,P):-man(S),parent(P,S).
daughter(D,P):-woman(D),parent(P,D).
children(C,P):-parent(P,C).

siblings(X,Y):-
	( (sibling(X,Y)|sibling(Y,X)) |
	( (sibling(X,Z),sibling(Y,Z)) | (sibling(X,Z),sibling(Z,Y)) | (sibling(Z,X),sibling(Y,Z)) | (sibling(Z,X),sibling(Z,Y)) ) |
	( (sibling(X,Z),(sibling(Z,A)|sibling(A,Z)),sibling(Y,A)) | (sibling(X,Z),(sibling(Z,A)|sibling(A,Z)),sibling(A,Y)) | (sibling(Z,X),(sibling(Z,A)|sibling(A,Z)),sibling(Y,A)) | (sibling(Z,X),(sibling(Z,A)|sibling(A,Z)),sibling(A,Y)) , Z\=A ) |
	( parent(Z,X),parent(Z,Y) ) |
	( (sibling(X,Z),parent(A,Z),parent(A,Y)) | (sibling(Y,Z),parent(A,Z),parent(A,X)) | (sibling(Z,X),parent(A,Z),parent(A,Y)) | (sibling(Z,Y),parent(A,Z),parent(A,X)) ) |
	( (sibling(X,A),sibling(A,Z),parent(B,Z),parent(B,Y)) | (sibling(A,X),sibling(A,Z),parent(B,Z),parent(B,Y)) | (sibling(X,A),sibling(Z,A),parent(B,Z),parent(B,Y)) | (sibling(A,X),sibling(Z,A),parent(B,Z),parent(B,Y)) , Z\=A )
	),
	X\=Y.
brother(B,S):-man(B),siblings(S,B).
sister(Sis,S):-woman(Sis),siblings(Sis,S).

uncle(U,N):-man(U),parent(P,N),siblings(U,P).
aunt(A,N):-woman(A),parent(P,N),siblings(A,P).
niece(N,UA):-woman(N),parent(P,N),siblings(P,UA).
nephew(N,UA):-man(N),parent(P,N),siblings(P,UA).
cousin(C1,C2):-parent(P1,C1),parent(P2,C2),siblings(P1,P2).

grandfather(GF,GC):-man(GF),parent(P,GC),children(P,GF).
grandmother(GM,GC):-woman(GM),parent(P,GC),children(P,GM).
grandchildren(GC,GP):-parent(P,GC),parent(GP,P).

greatgrandchildren(GGC,GGP):-parent(GGP,GP),grandchildren(GGC,GP).
