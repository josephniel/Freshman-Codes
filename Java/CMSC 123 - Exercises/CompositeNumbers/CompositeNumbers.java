/*
 * CMSC 123 
 * Prof. Richard Bryann Chua
 * 
 * Composite Numbers by Joseph Niel Tuazon
 * Created Friday, June 28, 2013; 8:35PM
 * 
 * */

package CompositeNumbers;

import java.util.Scanner;

public class CompositeNumbers {

	public static void main(String[] args) {
		
			Scanner input = new Scanner(System.in);
			System.out.print("Input any number of choice: ");
			int upperLimit = input.nextInt();
			input.close();
			
			System.out.println("\nList of composite numbers between 0 to " + upperLimit + ":");
			
			for(int x = 4; x <= upperLimit; x++){ //start with 4 because it's the first composite number
			
				int repeatIndicator = 0;
				
				for(int y = 2; y < x; y++){ //start with 2 because it's the smallest non-negligible factor of whole numbers
					
					if(x%y == 0 && repeatIndicator == 0){
						System.out.println(x);
						repeatIndicator = 1;
					}
					
				}
				
			}
			
	}
	
}
