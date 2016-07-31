taller(bob,mike).
taller(X,Y):-tall(X,Y).
taller(X,Y):-tall(A,Y),taller(X,A).
tall(mike,jim).
tall(jim,george).