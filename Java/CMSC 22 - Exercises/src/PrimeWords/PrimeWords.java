/**
 * Prime Words:
 * a program that checks if any of the valid input
 * is a prime word.
 * 
 * CMSC 22 Lab
 * Prof. John Althom Mendoza
 * 
 * @author Joseph Niel Tuazon
 * Created Tuesday, June 16, 2013, 12:50 PM
 * 
 * */

package PrimeWords;

import java.util.ArrayList;
import java.util.Scanner;
import java.util.StringTokenizer;

public class PrimeWords {
	
	static ArrayList<Integer> primeNumbers = new ArrayList<Integer>();
	static ArrayList<Integer> compositeNumbers = new ArrayList<Integer>();
	
	final static int upperLimit = 2000;
	
	public static void primeNumberGenerator(){
		
		for(int x = 4; x <= upperLimit; x++){ 
			int repeatIndicator = 0;
			for(int y = 2; y < x; y++){
				
				if(x%y == 0 && repeatIndicator == 0){
					compositeNumbers.add(x);
					repeatIndicator = 1;
				}	
			}	
		}
		
		for(int x = 3; x < upperLimit; x++){
			if(!compositeNumbers.contains(x)){
				primeNumbers.add(x);
			}
		}
		
		
	}
	
	public static int alphabet(char x){		
		int y = 0;
		switch(x){
			case 'a': y = 1; break; case 'b': y = 2; break;
			case 'c': y = 3; break; case 'd': y = 4; break;
			case 'e': y = 5; break; case 'f': y = 6; break;
			case 'g': y = 7; break; case 'h': y = 8; break;
			case 'i': y = 9; break; case 'j': y = 10; break;
			case 'k': y = 11; break; case 'l': y = 12; break; 
			case 'm': y = 13; break; case 'n': y = 14; break;
			case 'o': y = 15; break; case 'p': y = 16; break;
			case 'q': y = 17; break; case 'r': y = 18; break;
			case 's': y = 19; break; case 't': y = 20; break;
			case 'u': y = 21; break; case 'v': y = 22; break;
			case 'w': y = 23; break; case 'x': y = 24; break;
			case 'y': y = 25; break; case 'z': y = 26; break;
			default: 
				System.err.println("Input must contain the english alphabet only!");
				System.exit(0);
				//break;
		}
		return y;
	}
	
	public static void main(String args[]){
		
		Scanner input = new Scanner(System.in);
		System.out.print("Input any word(s) to check: ");
		String words = input.nextLine();
		input.close();

		primeNumberGenerator();
		
		StringTokenizer tokens = new StringTokenizer(words);
		String[] array = new String[tokens.countTokens()];

		System.out.println("\nList of prime words on your input: ");
		
		for(int i = 0; tokens.hasMoreElements(); i++){
			
			String word = tokens.nextToken().toString();
			array[i] = word.toLowerCase();
			
			char[] charArray = new char[array[i].length()];
			int[] numberArray = new int[array[i].length()];
			
			int total = 0;
			
			for(int j = 0;j < array[i].length(); j++){
			    charArray[j] = array[i].charAt(j);
			    numberArray[j] = alphabet(charArray[j]);
			    total = total + numberArray[j];
			}
			
			if(primeNumbers.contains(total)){
				System.out.println(word + " = " + total); 
			}
				
		}
		

	}
	
}
