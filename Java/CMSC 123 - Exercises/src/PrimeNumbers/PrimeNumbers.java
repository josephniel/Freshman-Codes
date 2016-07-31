/**
 * Prime Number Generator 
 * @author Joseph Niel Tuazon
 * 
 * Created Tuesday, June 16, 2013, 12:46 PM
 * 
 * */
package PrimeNumbers;

import java.util.ArrayList;
import java.util.Scanner;

public class PrimeNumbers {
	
	static ArrayList<Integer> compositeNumbers = new ArrayList<Integer>();
	
	public static void compositeNumberGenerator(int upperLimit){
			
		for(int x = 4; x <= upperLimit; x++){ //start with 4 because it's the first composite number
			int repeatIndicator = 0;
			for(int y = 2; y < x; y++){ //start with 2 because it's the smallest non-negligible factor of whole numbers
				
				if(x%y == 0 && repeatIndicator == 0){
					compositeNumbers.add(x);
					repeatIndicator = 1;
				}	
			}	
		}
		
	}

	public static void main(String[] args) {
		
		Scanner input = new Scanner(System.in);
		System.out.print("Input any number of choice: ");
		int upperLimit = input.nextInt();
		input.close();
		
		compositeNumberGenerator(upperLimit);
		
		for(int i = 3; i < upperLimit; i++){
			if(!compositeNumbers.contains(i)){
				System.out.println(i);
			}
		}
		
	}
	
}
