package Main;

import java.awt.Color;
import java.awt.Dimension;
import java.awt.Frame;
import java.awt.GridBagLayout;

import javax.swing.ImageIcon;
import javax.swing.JFrame;
import javax.swing.JLabel;

public class StartScreen extends JFrame{
	
	private static final long serialVersionUID = 1L;
	public StartScreen() {
		setLayout(new GridBagLayout());
		getContentPane().setBackground(new Color(242,242,240));
		
			java.net.URL buttonURL = getClass().getResource("images/startscreen.gif");
		
			JLabel image = new JLabel();
			image.setIcon(new ImageIcon(buttonURL));
			image.setPreferredSize(new Dimension(1200,700));
			
		add(image);
		
		setUndecorated(true);
		setExtendedState(Frame.MAXIMIZED_BOTH);
		setDefaultCloseOperation(JFrame.DO_NOTHING_ON_CLOSE);	
		setVisible(true);
	}

}