package Main;

import java.awt.Color;
import java.awt.Dimension;
import java.awt.Frame;
import java.awt.Graphics;
import java.awt.GridBagConstraints;
import java.awt.GridBagLayout;
import java.awt.Image;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.io.IOException;
import java.net.URL;

import javax.swing.ImageIcon;
import javax.swing.JButton;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JOptionPane;
import javax.swing.JPanel;

public class SelectBetweenSinglePlayerAndMultiplayer extends JFrame{

	private static final long serialVersionUID = 1L;
	
	private static final int AI = 1, HUMAN = 2;
	
	public static JPanel content;
	public static SelectNumberAndTokenOfPlayers tokenPage;
	public Audio Audio;
	
	public SelectBetweenSinglePlayerAndMultiplayer(int SoundIndicator) {
		
		try {
			Audio = new Audio();
		} catch (IOException e) {
			e.printStackTrace();
		}
		
		new SettingsButton();
		add(SettingsButton.settings);
		
		CreateGUI.paneNumber = 0;
		
		setLayout(new GridBagLayout());
		setUndecorated(true);
		setExtendedState(Frame.MAXIMIZED_BOTH);
		getContentPane().setBackground(new Color(242,242,240));
		
		content = new background();
		content.setLayout(new GridBagLayout());
		content.setBackground(new Color(242,242,240));
		content.setPreferredSize(new Dimension(1200,700));
		content.setMaximumSize(new Dimension(1200,700));
			
		GridBagConstraints c = new GridBagConstraints();
			
			java.net.URL buttonURL = getClass().getResource("images/1.png");
			
			JLabel image = new JLabel();
			image.setIcon(new ImageIcon(buttonURL));
			image.setPreferredSize(new Dimension(300,300));
			
			c.gridx = 1;
			c.gridy = 1;
				
			content.add(image, c);
				
			image = new JLabel();
			image.setPreferredSize(new Dimension(100,300));
			image.setBackground(content.getBackground());
				
			c.gridx = 2;				
				
			content.add(image, c);
				
			buttonURL = getClass().getResource("images/2.png");
				
			image = new JLabel();
			image.setIcon(new ImageIcon(buttonURL));
			image.setPreferredSize(new Dimension(300,300));
				
			c.gridx = 3;
			
			content.add(image, c);
				
			JButton button = new SelectButton(AI);
		
			c.gridx = 1;
			c.gridy = 2;
				
			content.add(button, c);
				
			image = new JLabel();
			image.setPreferredSize(new Dimension(100,100));
			image.setBackground(content.getBackground());
				
			c.gridx = 2;
				
			content.add(image, c);
				
			button = new SelectButton(HUMAN);
				
			c.gridx = 3;
					
			content.add(button, c);
			
		add(content);
		
		Main.Audio.startBackgroundMusic(SoundIndicator);
		
		setVisible(true);
		setDefaultCloseOperation(JFrame.DO_NOTHING_ON_CLOSE);
	}
	
	class SelectButton extends JButton implements ActionListener{

		private static final long serialVersionUID = 1L;
		
		//private static final int AI = 1;
		private static final int HUMAN = 2;
		int indicator;
		
		public SelectButton(int indicator) {
			
			this.indicator = indicator;
			
			setPreferredSize(new Dimension(300,100));
			setBorderPainted(false); 
			setContentAreaFilled(false); 
			setFocusPainted(false); 
			
			URL buttonURL, buttonURL1;
			
			if(indicator == 1){
				buttonURL = getClass().getResource("images/3.png");
				buttonURL1 = getClass().getResource("images/3-1.png");
			}
			else{
				buttonURL = getClass().getResource("images/4.png");
				buttonURL1 = getClass().getResource("images/4-1.png");
			}
			
			setIcon(new ImageIcon(buttonURL));
			setPressedIcon(new ImageIcon(buttonURL1));
			
			addActionListener(this);
		}

		@Override
		public void actionPerformed(ActionEvent arg0) {
		
			Sound.click3.play(EnableMusic.SoundEnabled);
			
			tokenPage = new SelectNumberAndTokenOfPlayers();
			
			if(indicator == 1){
				JOptionPane.showMessageDialog(null, "This version of the game will be available soon.");
			}
			else{
				super.getParent().getParent().add(SelectNumberAndTokenOfPlayers.content);
				SelectNumberAndTokenOfPlayers.humanOrAI = HUMAN;
				SelectBetweenSinglePlayerAndMultiplayer.content.setVisible(false);
			}
		}
		
	}
}

class background extends JPanel {

	private static final long serialVersionUID = 1L;
	private Image image;
	  
	public background() {
		try{image = javax.imageio.ImageIO.read(new java.net.URL(getClass().getResource("images/background1.jpg"), "background1.jpg"));}
		catch(Exception e){e.printStackTrace();}
	}

	@Override
	protected void paintComponent(Graphics g) {
		super.paintComponent(g);
		if (image != null)
			g.drawImage(image, 0,0,this.getWidth(),this.getHeight(),this);
	  }
}