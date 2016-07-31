package PolynomialOperations;

/**
 * The <code>Polynomial</code> class stores polynomial with the terms of type <code>PolyTerm</code> and
 * terms are ordered in canonical ordering (i.e. x^2 + xy + y^2).
 * 
 * @see PolyTerm
 * 
 * @author Richard Bryann Chua
 * Original code was developed by the Java Education Development Initiative (JEDI) team.
 * Code was migrated to be able to handle exponents that are >= 0.
 *
 */
public class Polynomial {
	PolyTerm head = new PolyTerm(); /* list head */
	
	/**
	 * Creates an empty polynomial
	 */
	public Polynomial() {
		head.link = head;
	} // end constructor
	
	/**
	 * Creates a new polynomial with head h 
	 */
	public Polynomial(PolyTerm h) {
		head = h;
		h.link = head;
	} // end constructor
	
	/**
	 * Inserts a term to [this] polynomial by inserting
	 * in its proper location to maintain canonical form
	 * 
	 * @param p - the polynomial term that is to be inserted into his polynomial
	 */
	public void insertTerm(PolyTerm p) {
		PolyTerm alpha = head.link; // roving pointer
		PolyTerm beta = head;
		
		if (alpha == head) {
			head.link = p;
			p.link = head;
			return;
		} // end if (alpha == head)
		else {
			while(true) {
				/* If the current term is less than alpha or
				 * is the least in the polynomial, then insert.
				 */				
				if ((alpha.compareTo(p) < 0) || (alpha == head)) {
					p.link = alpha;
					beta.link = p;
					return;
				} // end if 
				
				/* Advance alpha and beta */
				alpha = alpha.link;
				beta = beta.link;
				
				/* If we have come full circle, return */
				if (beta == head)
					return;
			} // end while(true)
		} // end else
	} // end insertTerm method
	
	/**
	 * Performs the operation Q = P + Q, Q is [this] polynomial
	 * 
	 * @param P - the polynomial that is to be added to this polynomial
	 */
	public void add(Polynomial P) {
		/* Roving pointer in P */
		PolyTerm alpha = P.head.link;
		
		/* Roving pointer in Q */
		PolyTerm beta = head.link;
		
		// Pointer to the node behind beta, used in insertion to Q
		PolyTerm sigma = head;
		
		PolyTerm tau;
		
		while(true) {
			/* Current term in P > current term in Q */
			if (alpha.compareTo(beta) < 0) {
				// Advance pointers in Q
				sigma = beta;
				beta = beta.link;
			}			
			else if (alpha.compareTo(beta) > 0) {
				// Insert the current term in P to Q
				tau = new PolyTerm();
				tau.coef = alpha.coef;				
				tau.isHeaderNode = alpha.isHeaderNode;
				tau.expoX = alpha.expoX;
				tau.expoY = alpha.expoY;
				tau.expoZ = alpha.expoZ;
				sigma.link = tau;
				tau.link = beta;
				sigma = tau;
				
				alpha = alpha.link; // Advance pointer in P
			}
			else { // Terms in P and Q can be added
				if (alpha.isHeaderNode)
					return; // The sum is already in Q
				else {
					beta.coef = beta.coef + alpha.coef;					
					
					// If adding will cause to cancel out
					// the term
					if (beta.coef == 0) {						
						tau = beta;
						sigma.link = beta.link;
						beta = beta.link;
						tau = null;
					}
					else { // Advance pointers in Q
						sigma = beta;
						beta = beta.link;
						
					}
					
					// Advance pointer in P
					alpha = alpha.link;
				}
				
			}
		}
	}
	
	/**
	 * Performs the operation Q = Q - P, Q is [this] polynomial
	 * 
	 * @param P - the polynomial that is to be subtracted from this polynomial
	 */
	public void subtract(Polynomial P) {
		PolyTerm alpha = P.head.link;
		
		// Negate every term in P
		while(!alpha.isHeaderNode) {
			alpha.coef = - alpha.coef;
			alpha = alpha.link;
		}
		
		// Add P to [this] polynomial 
		this.add(P);
		
		// Restore P
		alpha = P.head.link;
		while (!alpha.isHeaderNode) {
			alpha.coef = - alpha.coef;
			alpha = alpha.link;
		}
	}
	
	/**
	 * Performs the operation R = R + P*Q, where T is initially
	 * a zero polynomial and R is this polynomial
	 * 
	 * @param P - the polynomial that is to be multiplied
	 * @param Q - the polynomial that is to be multiplied
	 */
	public void multiply(Polynomial P, Polynomial Q) {
		// Create temporary polynomial T to contain product term
		Polynomial T = new Polynomial();
		
		// Roving pointer in T 
		PolyTerm tau = new PolyTerm();
		
		// To contain the product
		Polynomial R = new Polynomial();
		
		// Roving pointers in P and Q
		PolyTerm alpha, beta;
		
		// Initialize T and tau
		T.head.link = tau;
		tau.link = T.head;
		
		// Multiply
		alpha = P.head.link;
		
		// For every term in P...
		while(!alpha.isHeaderNode) {
			beta = Q.head.link;
			
			// multiply with every term in Q
			while(!beta.isHeaderNode) {
				tau.coef = alpha.coef * beta.coef;		
				tau.isHeaderNode = false;
				tau.expoX = alpha.expoX + beta.expoX;
				tau.expoY = alpha.expoY + beta.expoY;
				tau.expoZ = alpha.expoZ + beta.expoZ;
				R.add(T);
				beta = beta.link;
			}
			alpha = alpha.link;
		}
		
		this.head = R.head; // Make [this] polynomial be R
	}	
	
	/**
	 * Display the polynomial
	 * 
	 * @return String representation of the polynomial
	 */
	@Override
	public String toString() {
		if (head.link.isHeaderNode) {
			return "Zero Polynomial";
		}
		else {
			StringBuilder polynomialString = new StringBuilder();
			
			PolyTerm alpha = head.link;
			while(!alpha.isHeaderNode) {
				if (alpha.coef < 0) {
					polynomialString.append(" - " + Math.abs(alpha.coef));					
				}
				else {
					polynomialString.append(" + " + alpha.coef);					
				}				
				
				polynomialString.append("x^{" + alpha.expoX + "}");
				polynomialString.append("y^{" + alpha.expoY + "}");
				polynomialString.append("z^{" + alpha.expoZ + "}");
				
				alpha = alpha.link;
			}
			
			return polynomialString.toString();
		}
	}
}

