package MP;

import java.awt.Graphics;
import java.awt.Image;

import javax.swing.JPanel;

public class BackgroundImage extends JPanel {

	private static final long serialVersionUID = 1L;
	private Image image;
	  
	public BackgroundImage() {
		try{
			image = javax.imageio.ImageIO.read(new java.net.URL(getClass().getResource("Images/background.jpg"), "background.jpg"));
		}
		catch(Exception e){e.printStackTrace();}
	}

	@Override
	protected void paintComponent(Graphics g) {
		super.paintComponent(g);
		if (image != null)
			g.drawImage(image, 0,0,this.getWidth(),this.getHeight(),this);
	  }
}