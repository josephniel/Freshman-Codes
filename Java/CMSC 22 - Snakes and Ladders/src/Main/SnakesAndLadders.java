package Main;

import java.awt.Font;

import javax.swing.JFrame;

public class SnakesAndLadders{
	public SnakesAndLadders(){
		new CreateGUI();
	}
}

class CreateGUI{
	
	public static Font quicksand1;
	public static Font quicksand2;
	public static int paneNumber = 0;
	
	CreateGUI(){
		
		quicksand1 = new Font("Quicksand Bold", Font.BOLD, 26); 
		quicksand2 = new Font("Quicksand Bold", Font.BOLD, 20); 

		JFrame start = new StartScreen();
		
		try { Thread.sleep(7500);} 
		catch (InterruptedException e) { Thread.currentThread().interrupt();}
		
		new SelectBetweenSinglePlayerAndMultiplayer(1);
		
		try { Thread.sleep(1000);} 
		catch (InterruptedException e) { Thread.currentThread().interrupt();}
		
		start.dispose();
		
	}

}

