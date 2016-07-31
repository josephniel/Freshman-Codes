/**
 * Dice class - Adapted from Stijn Strickx's Dice Class
 */

package Main;

import java.awt.Dimension;
import java.awt.GridBagConstraints;
import java.awt.GridBagLayout;
import java.io.IOException;
import java.util.ArrayList;

import javax.swing.ImageIcon;
import javax.swing.JButton;
import javax.swing.JLabel;
import javax.swing.JPanel;

class Dice{

	public JPanel container;
	
	public static JButton roll;
	public static JLabel 
		player1, player2, player3, player4,
		player1Icon, player2Icon, player3Icon, player4Icon;
	public static int 
		currentPlayer = 1,
		player1score = 0, 
		player2score = 0, 
		player3score = 0, 
		player4score = 0,
		numberOfPlayers,
		player1IconIndex,
		player2IconIndex,
		player3IconIndex,
		player4IconIndex,
		player1indicator = 0, 
		player2indicator = 0, 
		player3indicator = 0,
		player4indicator = 0;
	public static boolean 
		player1finished = false,
		player2finished = false,
		player3finished = false,
		player4finished = false;
	public static ArrayList<Integer> ladderCheckpoints, snakesCheckpoints, ladderEnd, snakesEnd;
	public static UpdateBoard updateBoard;
	
	public Dice(int numberOfPlayers) {
		
		ladderCheckpoints = new ArrayList<Integer>();
		snakesCheckpoints = new ArrayList<Integer>();
		ladderEnd = new ArrayList<Integer>();
		snakesEnd = new ArrayList<Integer>();
		
		ladderCheckpoints.add(4);
		ladderCheckpoints.add(7);
		ladderCheckpoints.add(14);
		ladderCheckpoints.add(20);
		ladderCheckpoints.add(25);
		ladderCheckpoints.add(30);
		ladderCheckpoints.add(41);
		
		snakesCheckpoints.add(13);
		snakesCheckpoints.add(18);
		snakesCheckpoints.add(23);
		snakesCheckpoints.add(36);
		snakesCheckpoints.add(48);
		snakesCheckpoints.add(53);
		
		ladderEnd.add(19);
		ladderEnd.add(31);
		ladderEnd.add(34);
		ladderEnd.add(49);
		ladderEnd.add(45);
		ladderEnd.add(39);
		ladderEnd.add(51);
		
		snakesEnd.add(9);
		snakesEnd.add(8);
		snakesEnd.add(3);
		snakesEnd.add(33);
		snakesEnd.add(44);
		snakesEnd.add(22);
		
		try{new QuestionsGenerator();} 
		catch (IOException e){e.printStackTrace();}
		
		container = new JPanel(new GridBagLayout());
		
		Dice.numberOfPlayers = numberOfPlayers;
		
		container.setPreferredSize(new Dimension(200,200));
		container.setOpaque(false);
		
		GridBagConstraints c = new GridBagConstraints();
		
		JLabel dice = new JLabel(new ImageIcon(getClass().getResource("images/D1.png")));
		
		c.gridx = 1;
		c.gridy = 1;
		
		container.add(dice, c);
		
		roll = new RollButton(dice);
		
		c.gridx = 2;
		
		container.add(roll, c);	
	}
}