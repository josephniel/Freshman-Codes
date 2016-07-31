package Main;

import java.awt.Graphics;
import java.awt.Image;
 
import javax.swing.JPanel;

public class BoardToken extends JPanel{
	
	private static final long serialVersionUID = 1L;
	private Image token;
	
	public int xPosition = 0, yPosition = 0;
	
	public static int count = -1, 
			xDestination = 0, 
			yDestination = 0, 
			xBound = 0,
			yBound = 0, 
			currentPosition = 0, 
			previousPosition = 0,
			delay;
	
	public BoardToken(int playerNumber, int tokenIndex) {
		
		switch(playerNumber){
			case 1:		
				xPosition = 0; 
				yPosition = 617;
				break;
			case 2:
				xPosition = 0; 
				yPosition = 580;
				break;
			case 3:
				xPosition = 0; 
				yPosition = 543;
				break;
			case 4:
				xPosition = 0; 
				yPosition = 506;
				break;
		}
		setBounds(0, 0, 1000, 700);
		
		String filename = "B" + String.valueOf(tokenIndex) + ".png";
		try{token = javax.imageio.ImageIO.read(new java.net.URL(getClass().getResource("images/" + filename),filename));}
		catch(Exception e){e.printStackTrace();}
		setOpaque(false);
	}
	
	@Override
	protected void paintComponent(Graphics g) {
		super.paintComponent(g);
		if (token != null)
			g.drawImage(token, xPosition, yPosition, 75, 75, this);
	}
}
