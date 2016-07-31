package Main;

import java.awt.Dimension;
import java.awt.Graphics;
import java.awt.Image;

import javax.swing.JPanel;

public class BoardSide{
	
	static JPanel container;
	JPanel previewPane;
	public static BoardToken token1, token2, token3, token4;
	
	public BoardSide(int numberOfPlayers, int[] tokenIndices) {
		container = new boardBackground();
		container.setPreferredSize(new Dimension(1000,700));
		container.setOpaque(false);
		container.setLayout(null);
		
		token1 = new BoardToken(1, tokenIndices[0]);
		token2 = new BoardToken(2, tokenIndices[1]);
		if(numberOfPlayers >= 3){
			token3 = new BoardToken(3, tokenIndices[2]);
		}
		if(numberOfPlayers == 4){
			token4 = new BoardToken(4,  tokenIndices[3]);
		}
		
		container.add(token1);
		container.add(token2);
		if(numberOfPlayers >= 3){
			container.add(token3);
		}
		if(numberOfPlayers == 4){
			container.add(token4);
		}
	}
	
}

class boardBackground extends JPanel{

	private static final long serialVersionUID = 1L;
	private Image image;
	  
	public boardBackground() {
		try{image = javax.imageio.ImageIO.read(new java.net.URL(getClass().getResource("images/GameBoard.jpg"), "GameBoard.jpg"));}
		catch(Exception e){e.printStackTrace();}
	}

	@Override
	protected void paintComponent(Graphics g) {
		super.paintComponent(g);
		if(image != null)
			g.drawImage(image, 0,0,this.getWidth(),this.getHeight(),this);
	  }
}