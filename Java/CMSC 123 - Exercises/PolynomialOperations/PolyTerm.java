package PolynomialOperations;

/**
* The <code>PolyTerm</code> class represents terms of a polynomial of 3 variables. It has fields 
* to store the coefficient of the term, and the exponents of variables x, y and z, respectively.
* 
* @author Richard Bryann Chua
* Original code was developed by the Java Education Development Initiative (JEDI) team.
* Code was migrated to be able to handle exponents that are >= 0.
*
*/
public class PolyTerm {
	
	boolean isHeaderNode;
	int expoX;
	int expoY;
	int expoZ;
	int coef;
	PolyTerm link;
	
	/**
	 * Creates a new term containing the list head. The list head has all the exponents set to 0. 
	 */
	public PolyTerm() {
		isHeaderNode = true;
		expoX = 0;
		expoY = 0;
		expoZ = 0;
		coef = 0;
		link = null;
	} // end constructor	
	
	/**
	 * Creates a new polynomial term with the corresponding exponents for the respective 
	 * variables and coefficient
	 * 
	 * @param expoX exponent of variable x
	 * @param expoY exponent of variable y
	 * @param expoZ exponent of variable z
	 * @param coef coefficient of the polynomial term
	 */
	public PolyTerm(int expoX, int expoY, int expoZ, int coef) {
		isHeaderNode = false;
		this.expoX = expoX;
		this.expoY = expoY;
		this.expoZ = expoZ;
		this.coef = coef;
		link = null;
	} // end constructor
	
	/**
	 * Compares this term with otherTerm canonically. Canonically means the canonical ordering for
	 * polynomials. For example, x^3 > x^2.
	 *  
	 * @param otherTerm the term that this term will be compared to
	 * @return 0 - this term and otherTerm are similar (both terms have the same exponents for x, y and z)
	 *       < 0 - this term should be canonically ordered after otherTerm
	 *       > 0 - this term should be canonically ordered before otherTerm 
	 */
	public int compareTo(PolyTerm otherTerm) {
		if (expoX == otherTerm.expoX) {
			if (expoY == otherTerm.expoY) {
				if (expoZ == otherTerm.expoZ) {
					return 0;
				} // end if (expoZ == otherTerm.expoZ)
				else {
					return (expoZ - otherTerm.expoZ);
				} // end else
			}
			else {
				return (expoY - otherTerm.expoY);
			} // end else
		} // end if (expoX == otherTerm.expoX)
		else {
			return (expoX - otherTerm.expoX);
		} // end else
	} // end compareTo method
}

