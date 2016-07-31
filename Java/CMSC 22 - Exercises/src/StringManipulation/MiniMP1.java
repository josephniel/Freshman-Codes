/*
 * String Manipulation by Joseph Niel Tuazon
 * Created June 13, 2013, Saturday; 6:26 am
 * Modified June 16, 2013, Tuesday
 * 
 * */

package StringManipulation;

import java.util.StringTokenizer;

public class MiniMP1 {
	
	static int zeroIndicator;
	static int onesIndicator;
	static int tensIndicator;
	static int specialTensIndicator;
	static int hundredsIndicator;
	
	static int firstNumber = -1;
	static int secondNumber = -1;
	
	static int one;
	static int ten;
	static int hundred;
	
	public static void stringChecker(String[] array){
	
		String[] number = new String[array.length];
		
		converter(array,number);
		
		// checks if tens and ones are interchanged 
		if(one > ten && tensIndicator != 0 && onesIndicator != 0)
			showErrorMessage();
		
		// This checks if the array with the string "0" has other strings present in it
		for(int i = 0; i < number.length; i++){
			if(number.length > 2 && number[i].equals("0") && zeroIndicator != 1)
				showErrorMessage();
			else if(number[i].equals("0")){
				parse(number[i]);
				return;
			}
		}
		
		// This converts an array of strings to just be a string
		StringBuffer result = new StringBuffer();
		for(int i = 0; i < number.length; i++)
			result.append(number[i]);
		
		String newNumber = result.toString();
		
		/* Checks if length of string is more than 3. 
		 * Input's length must be a maximum of 3 because numbers 
		 * computed are of the range 0 - 999
		 */
		if(newNumber.length() - 1 > 3)
			showErrorMessage();
		
		if(hundredsIndicator == 1 && newNumber.substring(1, 2).compareTo("h") == 0){
			// checks if there is nothing on the ones place value and tens place value
			if(newNumber.length() - 1 == 1){ // && onesIndicator == 0 && tensIndicator== 0 && specialTensIndicator == 0
				newNumber = newNumber + "00";
			}
			// checks if there is a number in the tens place value and none on the ones
			else if(newNumber.length() - 1 == 2 && tensIndicator == 1){ // && onesIndicator == 0 && specialTensIndicator == 0
				newNumber = newNumber + "0";
			}
			// checks if there's a number in the ones place value and none on the tens
			else if(newNumber.length() - 1 == 2 && onesIndicator == 1){ // && tensIndicator == 0 && specialTensIndicator == 0
				String temp1,temp2;
				
				temp1 = newNumber.substring(0, 1);
				temp2 = newNumber.substring(2, 3);
				
				newNumber = temp1 + "0" + temp2;
			}
			else if(onesIndicator == 1 && tensIndicator == 1){ 
				// Nothing will happen.
			}
			else if(newNumber.length() - 1 == 3 && specialTensIndicator == 1){ // && onesIndicator == 0 && tensIndicator == 0
				// Nothing will happen.
			}
			else{showErrorMessage();}
		}
		else if(hundredsIndicator == 0){
			// Checks if string has a number in the tens place value and none on the ones
			if(newNumber.length() - 1 == 0 && tensIndicator == 1){ // && onesIndicator == 0 && specialTensIndicator == 0
				newNumber = newNumber + "0";
			}
			// Checks if string has a number in the ones place value and none on the tens
			else if(newNumber.length() - 1 == 0 && onesIndicator == 1){ // && tensIndicator == 0 && specialTensIndicator == 0 
				// Nothing will happen.
			}
			else if(newNumber.length() - 1 == 1 && onesIndicator == 1 && tensIndicator == 1){
				// Nothing will happen.
			}
			else if(newNumber.length() - 1 == 1 && specialTensIndicator == 1 ){ //&& onesIndicator == 0 && tensIndicator == 0
				// Nothing will happen.
			}
			else{showErrorMessage();}
		}
		else{showErrorMessage();}
		
		newNumber = newNumber.replaceAll("h", "");
		parse(newNumber);
		
	}
	
	public static void parse(String newNumber){
		if(firstNumber == -1)
			firstNumber = Integer.parseInt(newNumber);
		else
			secondNumber = Integer.parseInt(newNumber);
	}
	
	public static void onesIndicator(){
		if(tensIndicator == 0)
			one = 1;
		onesIndicator++; 
	}
	
	public static void tensIndicator(){
		if(onesIndicator == 0)
			ten = 1;
		tensIndicator++;
	}
	
	public static void showErrorMessage(){
		System.err.println("\nInvalid input!"); 
		System.exit(0);
	}
	
	public static void converter(String[] array, String[] newArray){
		
		zeroIndicator = 0;
		onesIndicator = 0;
		tensIndicator = 0;
		specialTensIndicator = 0;
		hundredsIndicator = 0;
		
		one = 0;
		ten = 0;
		
		for(int j = 0; j < array.length; j++){
			
			switch(array[j]){
					// ones
					case "zero": newArray[j] = "0"; zeroIndicator++; break;
					case "one": newArray[j] = "1"; onesIndicator(); break;
					case "two": newArray[j] = "2"; onesIndicator(); break;
					case "three": newArray[j] = "3"; onesIndicator(); break;
					case "four": newArray[j] = "4"; onesIndicator(); break;
					case "five": newArray[j] = "5"; onesIndicator(); break;
					case "six": newArray[j] = "6"; onesIndicator(); break;
					case "seven": newArray[j] = "7"; onesIndicator(); break;
					case "eight": newArray[j] = "8"; onesIndicator(); break;
					case "nine": newArray[j] = "9"; onesIndicator(); break;
					// special case tens
					case "ten": newArray[j] = "10"; specialTensIndicator++; break;
					case "eleven": newArray[j] = "11"; specialTensIndicator++; break;
					case "twelve": newArray[j] = "12"; specialTensIndicator++; break;
					case "thirteen": newArray[j] = "13"; specialTensIndicator++; break;
					case "fourteen": newArray[j] = "14"; specialTensIndicator++; break;
					case "fifteen": newArray[j] = "15"; specialTensIndicator++; break;
					case "sixteen": newArray[j] = "16"; specialTensIndicator++; break;
					case "seventeen": newArray[j] = "17"; specialTensIndicator++; break;
					case "eighteen": newArray[j] = "18"; specialTensIndicator++; break;
					case "nineteen": newArray[j] = "19"; specialTensIndicator++; break;
					// regular tens
					case "twenty": newArray[j] = "2"; tensIndicator(); break;
					case "thirty": newArray[j] = "3"; tensIndicator(); break;
					case "forty": newArray[j] = "4"; tensIndicator(); break;
					case "fifty": newArray[j] = "5"; tensIndicator(); break;
					case "sixty": newArray[j] = "6"; tensIndicator(); break;
					case "seventy": newArray[j] = "7"; tensIndicator(); break;
					case "eighty": newArray[j] = "8"; tensIndicator(); break;
					case "ninety": newArray[j] = "9"; tensIndicator(); break;
					case "hundred": newArray[j] = "h"; hundredsIndicator++; onesIndicator--; break;
					default: 
						showErrorMessage();
						//break;
			} // end of switch
		} //end of for
		
	}
	
	public static void calculator(String operation){
		
		if(operation.compareToIgnoreCase("plus") == 0){
			System.out.print("The sum of " + firstNumber + " and " + secondNumber + " is ");
			System.out.print(firstNumber + secondNumber);
		}
		else if(operation.compareToIgnoreCase("minus") == 0){
			System.out.print("The difference of " + firstNumber + " and " + secondNumber + " is ");
			System.out.println(firstNumber - secondNumber);
		}
		else if(operation.compareToIgnoreCase("times") == 0){
			System.out.print("The product of " + firstNumber + " and " + secondNumber + " is ");
			System.out.println(firstNumber * secondNumber);
		}
		else if(operation.compareToIgnoreCase("divided by") == 0){
			if(secondNumber != 0){
				System.out.print("The quotient of " + firstNumber + " and " + secondNumber + " is ");
				System.out.println(firstNumber / secondNumber);
			}
			else
				System.out.println("The quotient is undefined");
		}
		else if(operation.compareToIgnoreCase("modulo") == 0){
			if(secondNumber != 0){
				System.out.print("The modulo of " + firstNumber + " and " + secondNumber + " is ");
				System.out.println(firstNumber % secondNumber);
			}
			else
				System.out.println("Divisor is zero. Program cannot attain modulo.");
		}
		else{
			System.err.println("There is no such operation!");
			System.exit(0);
		}
		
	}

	public static void main(String[] args){
		
		if(args.length - 1 != 2){
			System.err.println("\nYou have entered an invalid input on the arguments.");
			System.exit(0);
		}
		
		for(int i = 0; i < args.length; i = i + 2){
			StringTokenizer input = new StringTokenizer(args[i]);
			
			if(i == 0){
				String[] firstArray = new String[input.countTokens()];
				
				for(int j = 0; input.hasMoreElements(); j++){
					firstArray[j] = input.nextToken().toString().toLowerCase();
				}
				stringChecker(firstArray);
			}		
			else if(i == 2){
				String[] secondArray = new String[input.countTokens()];
				for(int j = 0; input.hasMoreElements(); j++){
					secondArray[j] = input.nextToken().toString().toLowerCase();
				}
				stringChecker(secondArray);
			}
			
		} // end of for
		
		calculator(args[1]);
		
	} // end of main
}// end of class
