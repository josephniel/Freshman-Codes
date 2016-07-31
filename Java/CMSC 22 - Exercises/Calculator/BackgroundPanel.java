package Calculator;

import java.awt.Graphics;
import java.awt.Image;

import javax.swing.JPanel;

public class BackgroundPanel extends JPanel {

	private static final long serialVersionUID = 1L;
	private Image image;
	  
	public BackgroundPanel(int i) {
		try{
			if(i == 0)
				image = javax.imageio.ImageIO.read(new java.net.URL(getClass().getResource("images/background1.png"), "background1.png"));
			else
				image = javax.imageio.ImageIO.read(new java.net.URL(getClass().getResource("images/cover.png"), "cover.png"));
		}
		catch(Exception e){e.printStackTrace();}
	}

	@Override
	protected void paintComponent(Graphics g) {
		super.paintComponent(g);
		if (image != null)
			g.drawImage(image, 0,0,this.getWidth() - 10,this.getHeight() - 30,this);
	  }
}