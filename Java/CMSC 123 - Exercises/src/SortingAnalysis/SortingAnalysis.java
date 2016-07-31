/*
 * CMSC 123
 * Prof. Richard Bryann Chua
 * 
 * Modified Version of Sorting Analysis created by Prof. Richard Bryann Chua
 * 		- Added Merge Sort
 * 		- Changed very little amount of code
 * 
 * Modified by Joseph Niel Tuazon
 * Modified Sunday, July 7, 2013; 8:35PM
 * 
 * */

package SortingAnalysis;

import java.io.File;
import java.io.FileNotFoundException;
import java.util.Scanner;


public class SortingAnalysis {
	
	static String type = "";
	
	public static void insertionSort(String[] a) {
		
		for(int i = 1; i < a.length; i++) {
			
			String cur = a[i];
			int j = i - 1;
			
			while((j >= 0) && (a[j].compareTo(cur) > 0)) 
				a[j + 1] = a[j--];
			
			a[j + 1] = cur;
		}
		
		type = "insertion";
	}
	
    public static void mergeSortMain(String[] main){
        String[] toCopy = new String[ main.length ];
        mergeSort( main, toCopy, 0, main.length - 1 );
        type = "merge";
    }

    public static void mergeSort(String[] main, String[] toCopy, int leftPortion, int rightPortion){
    	if(leftPortion < rightPortion){
    		int center = (leftPortion + rightPortion) / 2;
            
            mergeSort(main, toCopy, leftPortion, center);
            mergeSort(main, toCopy, center + 1, rightPortion);
            merge(main, toCopy, leftPortion, center + 1, rightPortion);
        }
    }

    public static void merge(String[] main, String[] toCopy, int leftPosition, int rightPosition, int rightEnd){
        
    	int leftEnd = rightPosition - 1;
        int tempPosition = leftPosition;
        int numElements = rightEnd - leftPosition + 1;

        while(leftPosition <= leftEnd && rightPosition <= rightEnd ){
        	
            if(main[leftPosition].compareTo( main[rightPosition] ) <= 0 )
            	toCopy[tempPosition++] = main[leftPosition++];
            else
            	toCopy[tempPosition++] = main[rightPosition++];
        
        }
        
        while(leftPosition <= leftEnd)
        	toCopy[tempPosition++] = main[leftPosition++];

        while(rightPosition <= rightEnd)
        	toCopy[tempPosition++] = main[rightPosition++];

        for(int i = 0; i < numElements; i++, rightEnd--)
            main[rightEnd] = toCopy[rightEnd];
        
    }
	
	public static void main(String[] args) {
		
		try {
			
			final int NO_OF_WORDS = 1000;
			
			Scanner file = new Scanner(new File(args[0]));
			String[] words = new String[NO_OF_WORDS];
			
			//Assigns words on file to String[] words
			for(int i = 0; file.hasNext() && i < NO_OF_WORDS; i++)
				words[i] = file.next();
			file.close(); //Close file just for formality
			
				long start = System.currentTimeMillis(); //Records time before execution of sort
					//insertionSort(words);
					mergeSortMain(words);
				long end = System.currentTimeMillis(); //Records time after execution of sort
		
			System.out.println("Sorted Words: \n");
			
			for(int j = 0; j < words.length; j++)
				System.out.println(words[j]);
			
			System.out.print("\nRunning time of " + type + " sort: " + (end - start) + "ms");
			
		}
		
		catch(SecurityException securityException) {
			System.err.println("You do not have proper privilege to access the files.");
			System.exit(1);
		}
		
		catch(FileNotFoundException fileNotFoundException) {
			System.err.println("Error accessing file");
			System.exit(1);
		}
		
	} //End of Main Function
} //End of Class