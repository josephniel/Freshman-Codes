package PolynomialOperations;

public class PolynomialDriver {

	public static void main(String[] args) {
		Polynomial poly1 = new Polynomial();
		
		//PolyTerm term1 = new PolyTerm(200, 1); // x^2
		//PolyTerm term2 = new PolyTerm(110, 1); // xy
		//PolyTerm term3 = new PolyTerm(20, 1); // y^2
		
		PolyTerm term1 = new PolyTerm(2, 0, 0, 1); // x^2
		PolyTerm term2 = new PolyTerm(1, 1, 0, 1); // xy
		PolyTerm term3 = new PolyTerm(0, 2, 0, 1); // y^2
		
		poly1.insertTerm(term2);
		poly1.insertTerm(term3);
		poly1.insertTerm(term1);
		
		System.out.println("Polynomial 1 = " + poly1);
		
		//PolyTerm term4 = new PolyTerm(200, 1); // x^2
		//PolyTerm term5 = new PolyTerm(110, -1); // xy
		//PolyTerm term6 = new PolyTerm(20, 1); // y^2
		PolyTerm term4 = new PolyTerm(2, 0, 0, 1); // x^2
		PolyTerm term5 = new PolyTerm(1, 1, 0, -1); // xy
		PolyTerm term6 = new PolyTerm(0, 2, 0, 1); // y^2
		Polynomial poly2 = new Polynomial();
		poly2.insertTerm(term4);
		poly2.insertTerm(term5);
		poly2.insertTerm(term6);
		
		System.out.println("Polynomial 2 = " + poly2); 
		
		poly1.add(poly2);
		System.out.println("After polynomial 1 + polynomial 2");
		System.out.println("Polynomial 1 = " + poly1);
		
		/*
		//Polynomial poly3 = new Polynomial();
		//poly3.multiply(poly1, poly2);
		//System.out.println("After polynomial 1 * polynomial 2");
		//System.out.println("Polynomial 3 = " + poly3);
		
		// x + y
		PolyTerm term11 = new PolyTerm(1, 0, 0, 1);
		PolyTerm term12 = new PolyTerm(0, 1, 0, 1);
		Polynomial poly10 = new Polynomial();
		poly10.insertTerm(term11);
		poly10.insertTerm(term12);
		
		// x^2 - xy + y^2
		PolyTerm term21 = new PolyTerm(2, 0, 0, 1);
		PolyTerm term22 = new PolyTerm(1, 1, 0, -1);
		PolyTerm term23 = new PolyTerm(0, 2, 0, 1);
		Polynomial poly20 = new Polynomial();
		poly20.insertTerm(term21);
		poly20.insertTerm(term22);
		poly20.insertTerm(term23);
		
		Polynomial poly30 = new Polynomial();
		System.out.println(poly30);
		poly30.multiply(poly10, poly20);
		System.out.println(poly30);
		*/
	}

}

