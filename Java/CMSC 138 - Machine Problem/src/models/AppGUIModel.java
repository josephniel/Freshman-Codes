package models;

import java.io.BufferedReader;
import java.io.InputStreamReader;

public class AppGUIModel { 
	
	public static BufferedReader readFromGUI() {
		
		/** 
		 * TODO Change to necessary JAVA GUI
		 * */
		
		return new BufferedReader( new InputStreamReader( System.in ) );
	}
	
	public static void writeToGUI( String message ) {
		
		/** 
		 * TODO Change to necessary JAVA GUI
		 * */
		
		System.out.print( message );
	}
	
	/** 
	 * TODO Add more functions if necessary
	 * */
}
