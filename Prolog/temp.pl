mother('Elizabeth Ball','John').
mother('Georgina Thompson','Mary Hogarth').
mother('Catherine Hogarth','Kate').
mother('Catherine Hogarth','Mary').

father('William','Will').
father('Charles Barrow','Mary Barrow').
father('George Hogarth','Georgina Hogarth').
father('Charles John','Walter').

son('Thomas Barrow','Mary Culliford').
son('Walter','Charles John').
son('Francis','Charles John').
son('Sydney','Charles John').
son('Henry','Charles John').
son('Bryan','Georgina Hogarth').

daughter('Letitia Mary','John').
daughter('Harriet Ellen','Elizabeth Barrow').
daughter('Kate','Catherine Hogarth').

brother('John','Will').
brother('Frederick William','Letitia Mary').
brother('Alfred Lamarte', 'Harriet Ellen').
brother('Charles John', 'Letitia Mary').
brother('Alfred', 'Charles Boz').
brother('Sydney', 'Kate').
brother('Edward', 'Mary').

sister('Elizabeth Barrow','Mary Barrow').
sister('Elizabeth Barrow','Thomas Barrow').
sister('Letitia Mary','Augustus').
sister('Frances','Harriet Ellen').
sister('Catherine Hogarth','Mary Hogarth').
sister('Mary Hogarth','Georgina Hogarth').

father(F,C):-man(F),parent(F,C).      
mother(M,C):-woman(M),parent(M,C). 
son(S,P):-man(S),parent(P,S).
daughter(D,P):-woman(D),parent(P,D).
children(C,P):-parent(P,C).

brother(B,S):-man(B), ( (sibling(B,S) | sibling(S,B)) | (parent(X,B),parent(X,S)) ).
sister(Sis,S):-woman(Sis),sibling(Sis,S) | sibling(S,Sis).
