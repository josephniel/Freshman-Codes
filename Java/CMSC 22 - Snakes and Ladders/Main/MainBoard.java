package Main;

import java.awt.Dimension;
import java.awt.GridBagConstraints;
import java.awt.GridBagLayout;

import javax.swing.JPanel;

public class MainBoard{

	public static JPanel content;
	public static int singleOrMulti;
	
	int[] tokenIndices;
	public static String[] playerNames;
	
	public MainBoard(int singleOrMulti, int numberOfPlayers, String[] playerNames, String tokenIndices) {
		
		CreateGUI.paneNumber = 2;
		
		content = new JPanel();
		
		MainBoard.singleOrMulti = singleOrMulti;
		MainBoard.playerNames = playerNames;
		
		this.tokenIndices = new int[numberOfPlayers];
		
		for(int i = 0; tokenIndices.length() != 0; i++){
			String currentNumber = "";
			while(!tokenIndices.startsWith("-")){
				currentNumber = currentNumber + tokenIndices.substring(0, 1);
				tokenIndices = tokenIndices.substring(1);
			}
			tokenIndices = tokenIndices.substring(1);
			this.tokenIndices[i] = Integer.parseInt(currentNumber);
		}
		
		content.setPreferredSize(new Dimension(1200,700));
		content.setOpaque(false);
		content.setLayout(new GridBagLayout());
		
		GridBagConstraints c = new GridBagConstraints();
		
		new InfoSide(numberOfPlayers, this.tokenIndices);
		new BoardSide(numberOfPlayers, this.tokenIndices);
		
		c.gridx = 1;
		
		content.add(BoardSide.container, c);
		
		c.gridx = 2;
		
		content.add(InfoSide.container, c);
		
	}

}
