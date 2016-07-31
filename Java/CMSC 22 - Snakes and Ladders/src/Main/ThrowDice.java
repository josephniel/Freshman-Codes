package Main;

import java.util.Random;
import java.util.Timer;
import java.util.TimerTask;

import javax.swing.Icon;
import javax.swing.ImageIcon;
import javax.swing.JLabel;

public class ThrowDice extends TimerTask{
	
	private IconGetter getter;
	private Random r;
	private JLabel dice;
	private int count;
	
	public static Timer move;
	public static int diceNumber = 0;
	
	public ThrowDice(JLabel dice) {
		 this.dice = dice;
	     count = 15;
	     getter = new IconGetter();
	     r = new Random();
	}

	@Override
	public void run() {
		if(count > 0){
            count --;
            diceNumber = r.nextInt(6)+1;
            
            Icon icon = getter.getIcon((diceNumber) + ".png");
            dice.setIcon(icon);
            
            Dice.roll.setEnabled(false);
            
            try{Thread.sleep(60);} 
            catch(InterruptedException e){e.printStackTrace();}
        }
        else{
        	new MainThread();
	        this.cancel();
        }  
	}	
}

class IconGetter {
    public Icon getIcon(String name){
        return new ImageIcon(getClass().getResource("images/D" + name));
    }
}

class MainThread{

	public MainThread() {
		
		if(Dice.currentPlayer == 1){
	        	
			BoardSide.token2.repaint();
	       	if(Dice.numberOfPlayers >= 3)
	       		BoardSide.token3.repaint();
	       	if(Dice.numberOfPlayers == 4)
	       		BoardSide.token4.repaint();
	        	
	    	Dice.player1score = Integer.parseInt(Dice.player1.getText()) + ThrowDice.diceNumber;
	    	Dice.player1.setText(String.valueOf(Dice.player1score));
	    		
	    	new UpdateBoard(1);
		}
	   	else if(Dice.currentPlayer == 2){
	   		
	   		BoardSide.token1.repaint();
	   		if(Dice.numberOfPlayers >= 3)
	   			BoardSide.token3.repaint();
	   		if(Dice.numberOfPlayers == 4)
	   			BoardSide.token4.repaint();
	   		
	   		Dice.player2score = Integer.parseInt(Dice.player2.getText()) + ThrowDice.diceNumber;
	   		Dice.player2.setText(String.valueOf(Dice.player2score));
	   	
	   		new UpdateBoard(2);
	   	}
	   	else if(Dice.currentPlayer == 3){
	       	
	   		BoardSide.token1.repaint();
	   		BoardSide.token2.repaint();
	       	if(Dice.numberOfPlayers == 4)
	       		BoardSide.token4.repaint();
	   		
	       	Dice.player3score = Integer.parseInt(Dice.player3.getText()) + ThrowDice.diceNumber;
	   		Dice.player3.setText(String.valueOf(Dice.player3score));
    	
    		new UpdateBoard(3);
    	}
	   	else if(Dice.currentPlayer == 4){
	   		
	   		BoardSide.token1.repaint();
	   		BoardSide.token2.repaint();
	   		if(Dice.numberOfPlayers >= 3)
	   			BoardSide.token3.repaint();
	   		
    		Dice.player4score = Integer.parseInt(Dice.player4.getText()) + ThrowDice.diceNumber;    			
    		Dice.player4.setText(String.valueOf(Dice.player4score));
	    	
    		new UpdateBoard(4);
    	}
	}
}
