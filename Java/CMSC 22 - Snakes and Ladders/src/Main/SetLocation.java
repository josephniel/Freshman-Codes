package Main;

import javax.swing.JOptionPane;

public class SetLocation{
	public SetLocation(){
			int xPos = 0, yPos = 0;
			
			if(Dice.currentPlayer == 1)
				BoardToken.currentPosition = Integer.parseInt(Dice.player1.getText());
			else if(Dice.currentPlayer == 2)
				BoardToken.currentPosition = Integer.parseInt(Dice.player2.getText());
			else if(Dice.currentPlayer == 3)
				BoardToken.currentPosition = Integer.parseInt(Dice.player3.getText());
			else if(Dice.currentPlayer == 4)
				BoardToken.currentPosition = Integer.parseInt(Dice.player4.getText());
			
			switch(BoardToken.currentPosition){
				case 1: xPos = 70; yPos = 590; break;
				case 2: xPos = 150; yPos = 590; break;
				case 3: xPos = 230; yPos = 590; break;
				case 4: xPos = 310; yPos = 590; break;
				case 5: xPos = 380; yPos = 590; break;
				case 6: xPos = 460; yPos = 590; break;
				case 7: xPos = 540; yPos = 590; break;
				case 8: xPos = 620; yPos = 590; break;
				case 9: xPos = 700; yPos = 590; break;
				case 10: xPos = 780; yPos = 590; break;
				case 11: xPos = 860; yPos = 590; break;
				case 12: xPos = 880; yPos = 510; break;
				case 13: xPos = 850; yPos = 430; break;
				case 14: xPos = 770; yPos = 430; break;
				case 15: xPos = 700; yPos = 435; break;
				case 16: xPos = 620; yPos = 440; break;
				case 17: xPos = 540; yPos = 445; break;
				case 18: xPos = 460; yPos = 450; break;
				case 19: xPos = 380; yPos = 455; break;
				case 20: xPos = 300; yPos = 460; break;
				case 21: xPos = 230; yPos = 465; break;
				case 22: xPos = 150; yPos = 475; break;
				case 23: xPos = 70; yPos = 475; break;
				case 24: xPos = 30; yPos = 400; break;
				case 25: xPos = 70; yPos = 320; break;
				case 26: xPos = 140; yPos = 310; break;
				case 27: xPos = 220; yPos = 310; break;
				case 28: xPos = 290; yPos = 310; break;
				case 29: xPos = 370; yPos = 310; break;
				case 30: xPos = 440; yPos = 310; break;
				case 31: xPos = 520; yPos = 310; break;
				case 32: xPos = 590; yPos = 310; break;
				case 33: xPos = 670; yPos = 310; break;
				case 34: xPos = 730; yPos = 295; break;
				case 35: xPos = 760; yPos = 210; break;
				case 36: xPos = 720; yPos = 120; break;
				case 37: xPos = 640; yPos = 120; break;
				case 38: xPos = 560; yPos = 130; break;
				case 39: xPos = 500; yPos = 140; break;
				case 40: xPos = 420; yPos = 150; break;
				case 41: xPos = 360; yPos = 160; break;
				case 42: xPos = 280; yPos = 170; break;
				case 43: xPos = 210; yPos = 180; break;
				case 44: xPos = 130; yPos = 190; break;
				case 45: xPos = 70; yPos = 170; break;
				case 46: xPos = 40; yPos = 100; break;
				case 47: xPos = 60; yPos = 20; break;
				case 48: xPos = 130; yPos = 20; break;
				case 49: xPos = 210; yPos = 20; break;
				case 50: xPos = 280; yPos = 20; break;
				case 51: xPos = 360; yPos = 20; break;
				case 52: xPos = 430; yPos = 20; break;
				case 53: xPos = 510; yPos = 20; break;
				case 54: xPos = 590; yPos = 20; break;
				case 55: xPos = 660; yPos = 20; break;
				default: 
					xPos = 740; yPos = 20;  
					if(Dice.currentPlayer == 1)
						Dice.player1finished = true;
					else if(Dice.currentPlayer == 2)
						Dice.player2finished = true;
					else if(Dice.currentPlayer == 3)
						Dice.player3finished = true;
					else
						Dice.player4finished = true;
					break;
			}
			
			if(Dice.currentPlayer == 1){
				BoardSide.token1.xPosition = xPos;
				BoardSide.token1.yPosition = yPos;
			}
			else if(Dice.currentPlayer == 2){
				BoardSide.token2.xPosition = xPos;
				BoardSide.token2.yPosition = yPos;
			}
			else if(Dice.currentPlayer == 3){
				BoardSide.token3.xPosition = xPos;
				BoardSide.token3.yPosition = yPos;
			}
			else{
				BoardSide.token4.xPosition = xPos;
				BoardSide.token4.yPosition = yPos;
			}
			
			BoardSide.token1.repaint();
			BoardSide.token2.repaint();
			if(Dice.numberOfPlayers >= 3)
				BoardSide.token3.repaint();
			if(Dice.numberOfPlayers == 4)
				BoardSide.token4.repaint();
			
			if(Dice.player1finished == true){
				if(Dice.player1indicator == 0){
					int a = 0;
					if(Dice.player2indicator == 0 && Dice.player3indicator == 0 && Dice.player4indicator == 0 )
						a = JOptionPane.showConfirmDialog(null, MainBoard.playerNames[0] + " just won snakes and ladders! Congratulations! Continue the game?");
					else if(Dice.player2indicator + Dice.player3indicator + Dice.player4indicator != 3 )
						a = JOptionPane.showConfirmDialog(null, MainBoard.playerNames[0] + " finished the game! Congratulations! Continue the game?");
					else {
						JOptionPane.showMessageDialog(null, "Thanks for playing Snakes and Ladders!");
						exitGame();
					}
					if(a == JOptionPane.NO_OPTION)
						exitGame();
					
					Dice.player1indicator = 1;
				}
			}	
			
			if(Dice.player2finished == true){
				if(Dice.player2indicator == 0){
					int a = 0;
					if(Dice.player1indicator == 0 && Dice.player3indicator == 0 && Dice.player4indicator == 0 )
						a = JOptionPane.showConfirmDialog(null, MainBoard.playerNames[1] + " just won snakes and ladders! Congratulations! Continue the game?");
					else if(Dice.player1indicator + Dice.player3indicator + Dice.player4indicator != 3 )
						a = JOptionPane.showConfirmDialog(null, MainBoard.playerNames[1] + " finished the game! Congratulations! Continue the game?");
					else {
						JOptionPane.showMessageDialog(null, "Thanks for playing Snakes and Ladders!");
						exitGame();
					}
					if(a == JOptionPane.NO_OPTION)
						exitGame();
					
					Dice.player2indicator = 1;
				}
			}

			if(Dice.player3finished == true){
				if(Dice.player3indicator == 0){
					int a = 0;
					if(Dice.player1indicator == 0 && Dice.player2indicator == 0 && Dice.player4indicator == 0 )
						a = JOptionPane.showConfirmDialog(null, MainBoard.playerNames[2] + " just won snakes and ladders! Congratulations! Continue the game?");
					else if(Dice.player1indicator + Dice.player2indicator + Dice.player4indicator != 3 )
						a = JOptionPane.showConfirmDialog(null, MainBoard.playerNames[2] + " finished the game! Congratulations! Continue the game?");
					else {
						JOptionPane.showMessageDialog(null, "Thanks for playing Snakes and Ladders!");
						exitGame();
					}
					if(a == JOptionPane.NO_OPTION)
						exitGame();
					Dice.player3indicator = 1;
				}
			}	
			
			if(Dice.player4finished == true){
				if(Dice.player4indicator == 0){
					int a = 0;
					if(Dice.player1indicator == 0 && Dice.player2indicator == 0 && Dice.player3indicator == 0 )
						a = JOptionPane.showConfirmDialog(null, MainBoard.playerNames[3] + " just won snakes and ladders! Congratulations! Continue the game?");
					else if(Dice.player1indicator + Dice.player2indicator + Dice.player3indicator != 3 )
						a = JOptionPane.showConfirmDialog(null, MainBoard.playerNames[3] + " finished the game! Congratulations! Continue the game?");
					else {
						JOptionPane.showMessageDialog(null, "Thanks for playing!");
						exitGame();
					}
					if(a == JOptionPane.NO_OPTION)
						exitGame();
					Dice.player4indicator = 1;
				}
			}		
		} // 
	
	static void exitGame(){
		Dice.currentPlayer = 1;		
		CreateGUI.paneNumber = 0;
		
		Audio.startBackgroundMusic(EnableMusic.MusicEnabled);
		
		SettingsButton.settings.setVisible(true);
		SelectBetweenSinglePlayerAndMultiplayer.content.setVisible(true);
		MainBoard.content.setVisible(false);
		InfoSide.container.setVisible(false);
	}
}