package Main;

import java.awt.Dimension;
import java.awt.GridBagConstraints;
import java.awt.GridBagLayout;

import javax.swing.ImageIcon;
import javax.swing.JLabel;
import javax.swing.JPanel;
import javax.swing.SwingConstants;

public class InfoSide{
	
	public static JPanel container;
	public static player player1, player2, player3, player4;
	
	public InfoSide(int numberOfPlayers, int[] tokenIndices) {
		container = new JPanel(new GridBagLayout());
		container.setPreferredSize(new Dimension(200,700));
		container.setOpaque(false);
		
		GridBagConstraints c = new GridBagConstraints();
		
			Dice dice = new Dice(numberOfPlayers);
			
			c.gridx = 1;
			c.gridy = 1;
			
			container.add(dice.container, c);
			
			JPanel players = new JPanel(new GridBagLayout());
			players.setPreferredSize(new Dimension(200,500));
			players.setOpaque(false);
			
				player1 = new player(1, tokenIndices, MainBoard.playerNames[0]);
		
				c.gridy = 1;
			
				players.add(player1.content, c);
			
				player2 = new player(2, tokenIndices, MainBoard.playerNames[1]);
		
				c.gridy = 2;
			
				players.add(player2.content, c);
			
				if(numberOfPlayers >= 3){
					player3 = new player(3, tokenIndices, MainBoard.playerNames[2]);
					c.gridy = 3;
					players.add(player3.content, c);
				}
				if(numberOfPlayers == 4){
					player4 = new player(4, tokenIndices, MainBoard.playerNames[3]);
					c.gridy = 4;
					players.add(player4.content, c);
				}
	
			c.gridy = 2;		
			container.add(players, c);
	}
	
	static class player{
		
		public JPanel content;
		public static position position;
		
		public player(int playerNumber, int[] tokenIndex, String playerName) {
			
			content = new JPanel();
			
			content.setPreferredSize(new Dimension(200,125));
			content.setLayout(new GridBagLayout());
			content.setOpaque(false);
			
			GridBagConstraints c = new GridBagConstraints();
			
			token token = new token(playerNumber, tokenIndex);
			
			c.gridx = 1;
			c.gridy = 1;
			
			content.add(token.tokenContainer, c);
			
			position = new position(playerNumber);
			
			c.gridx = 2;
			
			content.add(position.content, c);
			JLabel name = new JLabel(playerName);
			name.setPreferredSize(new Dimension(200,25));
			name.setFont(CreateGUI.quicksand2);
			name.setHorizontalAlignment(SwingConstants.CENTER);
			
			c.gridx = 1;
			c.gridy = 2;
			c.gridwidth = 2;
			
			content.add(name, c);
			
		}

	}
}

class token{
	
	public JLabel tokenContainer;
	
	public token(int playerNumber, int[] tokenIndex) {	
		
		tokenContainer = new JLabel();
		
		tokenContainer.setPreferredSize(new Dimension(100,100));
		tokenContainer.setOpaque(false);
		
		String filename; 
		
		switch(playerNumber){
		case 1:
			Dice.player1IconIndex = tokenIndex[0];
			
			filename = "C" + String.valueOf(tokenIndex[0]) + ".png";
			tokenContainer.setIcon(new ImageIcon(getClass().getResource("images/" + filename)));
			
			Dice.player1Icon = tokenContainer;
			break;
		case 2:
			Dice.player2IconIndex = tokenIndex[1];
			
			filename = "I" + String.valueOf(tokenIndex[1]) + ".png";
			tokenContainer.setIcon(new ImageIcon(getClass().getResource("images/" + filename)));
			
			Dice.player2Icon = tokenContainer;
			break;
		case 3:
			Dice.player3IconIndex = tokenIndex[2];
			
			filename = "I" + String.valueOf(tokenIndex[2]) + ".png";
			tokenContainer.setIcon(new ImageIcon(getClass().getResource("images/" + filename)));
			
			Dice.player3Icon = tokenContainer;
			break;
		case 4:
			Dice.player4IconIndex = tokenIndex[3];
			
			filename = "I" + String.valueOf(tokenIndex[3]) + ".png";
			tokenContainer.setIcon(new ImageIcon(getClass().getResource("images/" + filename)));
			
			Dice.player4Icon = tokenContainer;
			break;
		}	
		
	}
}

class position{
	
	public JPanel content;
	
	public position(int playerNumber) {
		
		content = new JPanel(); 
		
		content.setPreferredSize(new Dimension(100,100));
		content.setOpaque(false);
		content.setLayout(new GridBagLayout());
		
		new currentLocation(playerNumber);
		
		content.add(currentLocation.location);
	}
}

class currentLocation{

	public static JLabel location;
	
	public currentLocation(int playerNumber) {
		location = new JLabel();
		location.setText("0");
		location.setFont(CreateGUI.quicksand1);
		
		switch(playerNumber){
			case 1:
				Dice.player1 = location;
				break;
			case 2:
				Dice.player2 = location;
				break;
			case 3:
				Dice.player3 = location;
				break;
			case 4:
				Dice.player4 = location;
				break;
		}	
	}
}