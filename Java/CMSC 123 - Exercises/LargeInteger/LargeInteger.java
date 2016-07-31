package LargeInteger;
/**
 * Class that handles very large integer values which will not even fit into long. 
 * 
 * @author TKFC Group; Ma. Isabella Dominique Inosantos and Joseph Niel Tuazon
 *
 */


public class LargeInteger {
	
	private int[] largeInteger; /* array of integers containing the parts of the LargeInteger */
	private int r = 10000; /* the radix */
	
	private int sign; /* The sign of this LargeInteger */

	Node head; /* The list head */
	
	/**
	 * Creates the head node
	 * 
	 * @param L the node to be made as a head node
	 * @return L the head node created
	 */
	private Node zeroLongInteger(Node L){
		Node tau = new Node();
		L = tau;
		tau.number = 0;
		tau.llink = tau;
		tau.rlink = tau;
		return L;
	}
	
	/**
	 * Inserts a new node with its data set to a portion 
	 * of this LargeInteger
	 * 
	 * @param L the node to be connected to (the head node)
	 * @param portion the part of the LargeInteger to be stored on the new node created
	 * @return L the head node with the connected nodes
	 */
	private Node insertAtTail(Node L, int portion){
		Node tau = new Node();
		L.llink.rlink = tau;
		tau.number = portion;
		tau.rlink = L;
		tau.llink = L.llink;
		L.llink = tau;
		return L;
	}
	
	/**
	 * Inserts a new node with its data set to a portion 
	 * of this LargeInteger
	 * 
	 * @param L the node to be connected to (the head node)
	 * @param portion the part of the LargeInteger to be stored on the new node created
	 * @return L the head node with the connected nodes
	 */
	private Node insertAtHead(Node L, int portion){
		Node tau = new Node();
		tau.number = portion;
		tau.rlink = L.rlink;
		tau.llink = L;
		L.rlink.llink = tau;
		L.rlink = tau;
		return L;
	}
	
	/**
	 * Reads the LargeInteger divided by the divider function 
	 * and stores it in a doubly linked list
	 * 
	 * @param L the head node
	 * @param sign the sign of this LargeInteger
	 * @return L the head node with all the stored parts of the LargeInteger 
	 *		   in the nodes along it.
	 */
	private Node readLongInteger(Node L, int sign){
		L = zeroLongInteger(L);
		int nTerms = 0;
		for(int i : largeInteger){
			L = insertAtTail(L, i);
			nTerms++;
		}
		L.number = sign * nTerms;
		return L;
	}
	
	/**
	 * Divides the LargeInteger input into smaller substrings that 
	 * would be parsed and stored at an array of integers.
	 * 
	 * @param val the string input for this LargeInteger
	 */
	private void divider(String val){
		int capacity;
		int a = 4;
		
		if(val.length()%a== 0)
			capacity = val.length()/a;
		else{
			capacity = (int) Math.floor(val.length()/a) + 1;
			int b = a*capacity - val.length();
			while(b!=0){
				String temp = "0";
				val = temp.concat(val);
				b--;
			}
		}
	
		largeInteger = new int[capacity];
		
		for(int i = 0; i < capacity; i++){
			largeInteger[i] = Integer.parseInt(val.substring(0, a));
			val = val.substring(a);
		}
	}
	
	/**
	 * Creates a LargeInteger object with its value set to the parameter.
	 * 
	 * @param val initial value of the LargeInteger object
	 */
	public LargeInteger(String val) {
		sign = 1;
		if(val.startsWith("-")){
			val = val.replace("-", "");
			sign = -1;
		}
		divider(val);
		head = readLongInteger(head, sign);
	}
	
	/**
	 * Checks if the value of this LargeInteger is greater than the 
	 * parameter LargeInteger other
	 * 
	 * @param other Other LargeInteger that is to be compared with this LargeInteger
	 * @return true - this LargeInteger is greater than other LargeInteger
	 * 		   false - this LargeInteger is not greater that the other LargeInteger
	 */
	private boolean isGreaterThan(LargeInteger other){
		int m = Math.abs(this.head.number);
		int n = Math.abs(other.head.number);
		
		if(m > n)
			return true;
		else if(m < n)
			return false;
		else if(m == n){
			Node alpha = this.head.rlink;
			Node beta = other.head.rlink;
			while(alpha != this.head){
				if(alpha.number > beta.number)
					return true;
				else if(alpha.number < beta.number)
					return false;
				else if(alpha.number == beta.number){
					alpha = alpha.rlink;
					beta = beta.rlink;
				} 
			}	
		}
		return false;
	}
	
	/**
	 * Deletes the whole sum (all the zeroes) of 2 numbers with the same magnitude 
	 * but with different signs
	 * 
	 */
	private void deleteZeros(Node L, int nTerms){
		Node alpha = L.rlink;
		
		while(alpha != L){
			if(alpha.number == 0){
				L.rlink = alpha.rlink;
				alpha.rlink.llink = L;
				alpha = null;
				nTerms = nTerms - 1;
				alpha = L.rlink;
			}
			else{return;}
		}
	}
	
	/**
	 * Adds the value of this BigInteger to object to the other BigInteger object
	 * and returns the sum
	 *   
	 * @param other Other BigInteger object that is to be added to this BigInteger object
	 * @return Sum of this BigInteger with the other BigInteger
	 */
	public LargeInteger add(LargeInteger other) {
		
		Node sum = new Node();
		
		int signA, signB, signS;
		
		int dataA = this.head.number;
		int dataB = other.head.number;
		
		if(this.isGreaterThan(other)){
			signA = 1;
			if(dataA * dataB > 0)
				signB = 1;
			else
				signB = -1;
		}
		else{
			signB = 1;
			if(dataA * dataB > 0)
				signA = 1;
			else
				signA = -1;
		}
		
		if( (dataA > 0 && dataB > 0) || (this.isGreaterThan(other) && dataA > 0) || (other.isGreaterThan(this) && dataB > 0) )
			signS = 1;
		else
			signS = -1;
		
		sum = zeroLongInteger(sum);
		
		int nTerms = 0, carry = 0, tau = 0;
		Node alpha = this.head.llink;
		Node beta = other.head.llink;
		
		Node A = this.head;
		Node B = other.head;
		
		int indicator = 0;
		while(indicator!=1){
			
			if(alpha != A && beta != B){
				tau = signA * alpha.number + signB * beta.number + carry;
				alpha = alpha.llink;
				beta = beta.llink;
			}
			else if(alpha != A && beta == B){
				tau = signA * alpha.number + carry;
				alpha = alpha.llink;
			}
			else if(alpha == A && beta != B){
				tau = signB * beta.number + carry;
				beta = beta.llink;
			}
			else if(alpha == A && beta == B){
				if(carry != 0){
					insertAtTail(sum, carry);
					nTerms++;
				}
				else{
					if(signA != signB && Math.abs(A.number) == Math.abs(B.number) && Math.abs(Integer.parseInt(this.toString())) == Math.abs(Integer.parseInt(other.toString())))
						deleteZeros(sum, nTerms);
				}
				sum.number = signS * nTerms;
				indicator = 1;
			}
			
			if(indicator != 1){
				int portion = (tau % r + r) % r;
				
				insertAtTail(sum, portion);
				
				if(tau < 0 && portion != 0){ carry = (int) Math.floor(tau/r)-1;}
				else{ carry = (int) Math.floor(tau/r); }
				
				nTerms++;
			}
		}
		
		String tempString = new String();
		
		Node theta = sum.llink;
		while(theta != sum){
			
			if(String.valueOf(theta.number).length() != 4){
				
				String another = String.valueOf(theta.number);
				int C = 4 - String.valueOf(theta.number).length();

				while(C != 0){
					String zero = "0";
					another = zero.concat(another);
					C--;
				}
				tempString = tempString.concat(another);
			}
			else
				tempString = tempString.concat(String.valueOf(theta.number));
			
			theta = theta.llink;		
		}
		
		if(sum.number < 0){
			String sign = "-";
			tempString = sign.concat(tempString);
		}
		
		LargeInteger returnSum = new LargeInteger(tempString);
		
		return returnSum;
	}
	
	/**
	 * Minus the value of the other BigInteger object from this BigInteger object
	 * and returns the difference
	 *   
	 * @param other Other BigInteger object that is to be subtracted to this BigInteger object
	 * @return Difference of this BigInteger with the other BigInteger
	 */
	public LargeInteger minus(LargeInteger other) {
		other.head.number = -other.head.number;
		return this.add(other);
	}
	
	private Node initialProduct(Node L, int nTerms){
		L = zeroLongInteger(L);
		int zero = 0;
		for(int i = 0; i < nTerms; i++)
			L = insertAtHead(L, zero);
		return L;
	}
	
	/**
	 * Multiplies the value of this BigInteger to object to the other BigInteger object
	 * and returns the product
	 *   
	 * @param other Other BigInteger object that is to be multiplied to this BigInteger object
	 * @return Product of this BigInteger with the other BigInteger
	 */
	public LargeInteger times(LargeInteger other) {
		
		Node product = new Node();
		
		int nTerms = Math.abs(this.head.number) + Math.abs(other.head.number);
		
		product = initialProduct(product, nTerms);
		
		Node tau = product;
		Node alpha = this.head.llink;
		
		while(alpha != this.head){
			
			int a = alpha.number;
			Node beta = other.head.llink;
			Node gamma = tau.llink;
			tau = gamma;
			
			int c = 0;
			while(beta != other.head){
				
				int t = a * beta.number + gamma.number + c;
				gamma.number = (t % r + r) % r;
				c = (int) Math.floor(t/r);
				beta = beta.llink;
				gamma = gamma.llink;
			}
			
			gamma.number = c;
			alpha = alpha.llink;
		}
		
		if(this.sign * other.sign < 0)
			product.number = -1;
		
		String tempString = new String();
	
		Node theta = product.llink;
		while(theta != product){
				
			if(String.valueOf(theta.number).length() != 4){
					
				String another = String.valueOf(theta.number);
				int C = 4 - String.valueOf(theta.number).length();

				while(C != 0){
					String zero = "0";
					another = zero.concat(another);
					C--;
				}
				tempString = another.concat(tempString);
			}
			else
				tempString = String.valueOf(theta.number).concat(tempString);
			
				theta = theta.llink;		
			}
			
			if(product.number < 0){
				String sign = "-";
				tempString = sign.concat(tempString);
			}
		
		LargeInteger returnProduct = new LargeInteger(tempString);
			
		return returnProduct;
	}	
	
	/**
	 * Compares this LargeInteger object with the specified object for equality
	 * @param x Object to which LargeInteger is to be compared
	 * @return true if and only if the specified Object is a LargeInteger object whose value
	 * 		   is numerically equal to this LargeInteger
	 */
	@Override	
	public boolean equals(Object x) {
		
		String A = this.toString();
		String B = x.toString();
		
		if(A.compareTo(B) == 0)
			return true;
		else
			return false;
	}
	
	/**
	 * Returns the string decimal representation of this LargeInteger
	 * 
	 * @return String decimal representation of this LargeInteger
	 */
	@Override
	public String toString() {
		String returnString = new String();
		
		Node alpha = this.head.llink;
		
		while(alpha != this.head){
			
			if(String.valueOf(alpha.number).length() != 4){
				returnString = String.valueOf(alpha.number).concat(returnString);				
				int A = 4 - String.valueOf(alpha.number).length();
				String zero = "0";
				while(A != 0){
					returnString = zero.concat(returnString);
					A--;
				}
			}
			else
				returnString = String.valueOf(alpha.number).concat(returnString);
			
			alpha = alpha.llink;
		}
		
		while(returnString.startsWith("0")){
			returnString = returnString.substring(1);
		}
		
		if(this.head.number < 0){
			String sign = "-";
			returnString = sign.concat(returnString);
		}
		
		if(returnString.length() == 0){
			returnString = "0";
		}
		
		return returnString; 
	}
}
