package Main;

import javax.swing.ImageIcon;

public class UpdateBoard {
	public UpdateBoard(int currentPlayer){		
		
		if(MainBoard.singleOrMulti == 2){
			if(currentPlayer == 1){
				Dice.player1Icon.setIcon(new ImageIcon(getClass().getResource("images/I" + String.valueOf(Dice.player1IconIndex) + ".png")));

				new SetLocation();
				new SnakeOrLadderChecker(BoardToken.currentPosition, 1);
				
				if(!Dice.ladderCheckpoints.contains(Integer.parseInt(Dice.player1.getText())) && !Dice.snakesCheckpoints.contains(Integer.parseInt(Dice.player1.getText()))){
					if(Dice.player2finished == false){
						Dice.player2Icon.setIcon(new ImageIcon(getClass().getResource("images/C" + String.valueOf(Dice.player2IconIndex) + ".png")));
						Dice.currentPlayer = 2;
					}
					else if(Dice.player3finished == false && Dice.numberOfPlayers >= 3){
						Dice.player3Icon.setIcon(new ImageIcon(getClass().getResource("images/C" + String.valueOf(Dice.player3IconIndex) + ".png")));
						Dice.currentPlayer = 3;
					}
					else if(Dice.player4finished == false && Dice.numberOfPlayers == 4){
						Dice.player4Icon.setIcon(new ImageIcon(getClass().getResource("images/C" + String.valueOf(Dice.player4IconIndex) + ".png")));
						Dice.currentPlayer = 4;
					}
				}
				Dice.roll.setEnabled(true);
			}
			else if(currentPlayer == 2){
				Dice.player2Icon.setIcon(new ImageIcon(getClass().getResource("images/I" + String.valueOf(Dice.player2IconIndex) + ".png")));
				
				new SetLocation();
				new SnakeOrLadderChecker(BoardToken.currentPosition, 2);
				
				if(!Dice.ladderCheckpoints.contains(Integer.parseInt(Dice.player2.getText())) && !Dice.snakesCheckpoints.contains(Integer.parseInt(Dice.player2.getText()))){
					if(Dice.player3finished == false && Dice.numberOfPlayers >= 3){
						Dice.player3Icon.setIcon(new ImageIcon(getClass().getResource("images/C" + String.valueOf(Dice.player3IconIndex) + ".png")));
						Dice.currentPlayer = 3;
					}
					else if(Dice.player4finished == false && Dice.numberOfPlayers == 4){
						Dice.player4Icon.setIcon(new ImageIcon(getClass().getResource("images/C" + String.valueOf(Dice.player4IconIndex) + ".png")));
						Dice.currentPlayer = 4;
					}
					else if(Dice.player1finished == false){
						Dice.player1Icon.setIcon(new ImageIcon(getClass().getResource("images/C" + String.valueOf(Dice.player1IconIndex) + ".png")));
						Dice.currentPlayer = 1;
					}
				}
				Dice.roll.setEnabled(true);
			}
			else if(currentPlayer == 3){
				Dice.player3Icon.setIcon(new ImageIcon(getClass().getResource("images/I" + String.valueOf(Dice.player3IconIndex) + ".png")));
				
				new SetLocation();
				new SnakeOrLadderChecker(BoardToken.currentPosition, 3);
				
				if(!Dice.ladderCheckpoints.contains(Integer.parseInt(Dice.player3.getText())) && !Dice.snakesCheckpoints.contains(Integer.parseInt(Dice.player3.getText()))){
					if(Dice.player4finished == false && Dice.numberOfPlayers == 4){
						Dice.player4Icon.setIcon(new ImageIcon(getClass().getResource("images/C" + String.valueOf(Dice.player4IconIndex) + ".png")));
						Dice.currentPlayer = 4;
					}
					else if(Dice.player1finished == false){
						Dice.player1Icon.setIcon(new ImageIcon(getClass().getResource("images/C" + String.valueOf(Dice.player1IconIndex) + ".png")));
						Dice.currentPlayer = 1;
					}
					else if(Dice.player2finished == false){
						Dice.player2Icon.setIcon(new ImageIcon(getClass().getResource("images/C" + String.valueOf(Dice.player2IconIndex) + ".png")));
						Dice.currentPlayer = 2;
					}
				}
				Dice.roll.setEnabled(true);
			}
			else{
				Dice.player4Icon.setIcon(new ImageIcon(getClass().getResource("images/I" + String.valueOf(Dice.player4IconIndex) + ".png")));
				
				new SetLocation();
				new SnakeOrLadderChecker(BoardToken.currentPosition, 4);
				
				if(!Dice.ladderCheckpoints.contains(Integer.parseInt(Dice.player4.getText())) && !Dice.snakesCheckpoints.contains(Integer.parseInt(Dice.player4.getText()))){
					if(Dice.player1finished == false){
						Dice.player1Icon.setIcon(new ImageIcon(getClass().getResource("images/C" + String.valueOf(Dice.player1IconIndex) + ".png")));
						Dice.currentPlayer = 1;
					}
					else if(Dice.player2finished == false){
						Dice.player2Icon.setIcon(new ImageIcon(getClass().getResource("images/C" + String.valueOf(Dice.player2IconIndex) + ".png")));
						Dice.currentPlayer = 2;
					}
					else if(Dice.player3finished == false && Dice.numberOfPlayers >= 3){
						Dice.player3Icon.setIcon(new ImageIcon(getClass().getResource("images/C" + String.valueOf(Dice.player3IconIndex) + ".png")));
						Dice.currentPlayer = 3;
					}
				}	
				Dice.roll.setEnabled(true);
			}
		}
	}
}
