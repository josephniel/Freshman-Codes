package Main;

import java.awt.Dimension;
import java.awt.GridBagConstraints;
import java.awt.GridBagLayout;
import java.awt.Insets;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.ItemEvent;
import java.awt.event.ItemListener;

import javax.swing.ImageIcon;
import javax.swing.JButton;
import javax.swing.JLabel;
import javax.swing.JOptionPane;
import javax.swing.JPanel;
import javax.swing.JRadioButton;

public class SettingsButton extends JPanel implements ActionListener{

	private static final long serialVersionUID = 1L;
	
	static JPanel window;
	static SelectBetweenSinglePlayerAndMultiplayer main;
	public static JButton settings;
	public static int windowIndicator = 0;
	
	public SettingsButton() {
		
		window = new settingsWindow();		
		settings = new JButton();
		
		settings.setBounds(0, 0, 50, 50);
		settings.setContentAreaFilled(false);
		settings.setBorder(null);
		settings.setOpaque(false);
		settings.setIcon(new ImageIcon(getClass().getResource("images/settings.png")));
		settings.setPressedIcon(new ImageIcon(getClass().getResource("images/settings1.png")));
		settings.addActionListener(this);
	}
	
	@Override
	public void actionPerformed(ActionEvent arg0){
		
		Sound.click2.play(EnableMusic.SoundEnabled);
		
		SelectBetweenSinglePlayerAndMultiplayer.content.setVisible(false);
		if(CreateGUI.paneNumber >= 1)
			SelectNumberAndTokenOfPlayers.content.setVisible(false);
		if(CreateGUI.paneNumber == 2)
			MainBoard.content.setVisible(false);
		
		settings.setVisible(false);
		if(windowIndicator == 0){
			SettingsButton.settings.getParent().add(window);
			windowIndicator = 1;
		}
		else{
			window.setVisible(true);
		}
		
		if(CreateGUI.paneNumber == 0)
			ReturnToMainMenu.ReturnToMainMenu.setEnabled(false);
		else
			ReturnToMainMenu.ReturnToMainMenu.setEnabled(true);
	}
}

class settingsWindow extends JPanel{
	
	private static final long serialVersionUID = 1L;

	public settingsWindow() {
		setPreferredSize(new Dimension(1250,700));
		setOpaque(false);
		setLayout(new GridBagLayout());
		
		GridBagConstraints c = new GridBagConstraints();
		
		JLabel label = new JLabel("Disable Background Music");
		label.setFont(CreateGUI.quicksand2);
		label.setPreferredSize(new Dimension(350, 50));
		
		c.gridx = 1;
		c.gridy = 1;
		c.insets = new Insets(10, 10, 10, 10);
		
		add(label, c);
		
		JRadioButton enableBackgroundMusic = new EnableMusic(1);
		
		c.gridx = 2;
		
		add(enableBackgroundMusic, c);
		
		label = new JLabel("Disable Sound Effects");
		label.setFont(CreateGUI.quicksand2);
		label.setPreferredSize(new Dimension(350, 50));
		
		c.gridx = 1;
		c.gridy = 2;
		
		add(label, c);
		
		JRadioButton enableSoundEffects = new EnableMusic(2);
		
		c.gridx = 2;
		
		add(enableSoundEffects, c);
		
		JButton credits = new Credits();
		
		c.gridx = 1;
		c.gridy = 3;
		c.gridwidth = 2;
		
		add(credits, c);
		
		JButton returnToGame = new ReturnToGame();
		
		c.gridy = 4;
		
		add(returnToGame, c);
		
		new ReturnToMainMenu();
		
		c.gridy = 5;
		
		add(Main.ReturnToMainMenu.ReturnToMainMenu, c);
		
		JButton quit = new Quit();
		
		c.gridy = 6;
		
		add(quit, c);
	}
}

class EnableMusic extends JRadioButton implements ItemListener{
	
	private static final long serialVersionUID = 1L;
	private int a;
	
	public static int SoundEnabled = 1;
	public static int MusicEnabled = 1;
	
	public EnableMusic(int a) {
		this.a = a;
		setPreferredSize(new Dimension(50,50));	
		addItemListener(this);
		setIcon(new ImageIcon(getClass().getResource("images/unselected.png")));
		setSelectedIcon(new ImageIcon(getClass().getResource("images/selected.png")));
		setOpaque(false);
	}
	
	@Override
	public void itemStateChanged(ItemEvent e) {
		
		Sound.click1.play(EnableMusic.SoundEnabled);
		
		if(a == 1){
			if(EnableMusic.MusicEnabled == 1){
				Audio.disableBackgroundMusic();
				EnableMusic.MusicEnabled = 0;
			}
			else{
				EnableMusic.MusicEnabled = 1;
				if(CreateGUI.paneNumber == 2)
					Audio.startBackgroundMusic(2);
				else
					Audio.startBackgroundMusic(1);
			}
		}
		else
			if(EnableMusic.SoundEnabled == 1)
				EnableMusic.SoundEnabled = 0;
			else
				EnableMusic.SoundEnabled = 1;
	}
}

class Credits extends JButton implements ActionListener{	
	
	private static final long serialVersionUID = 1L;
	
	public Credits() {
		setEnabled(false);
		setPreferredSize(new Dimension(150, 50));
		addActionListener(this);
		setContentAreaFilled(false);
		setBorder(null);
		setOpaque(false);
		setIcon(new ImageIcon(getClass().getResource("images/about.png")));
		setPressedIcon(new ImageIcon(getClass().getResource("images/about1.png")));
	}
	
	@Override
	public void actionPerformed(ActionEvent arg0){
		Sound.click2.play(EnableMusic.SoundEnabled);
		JOptionPane.showMessageDialog(null, 
				"<html></html>");
	}
}

class ReturnToGame extends JButton implements ActionListener{	
	
	private static final long serialVersionUID = 1L;
	
	public ReturnToGame() {
		setPreferredSize(new Dimension(150,50));
		
		addActionListener(this);
		setContentAreaFilled(false);
		setBorder(null);
		setOpaque(false);
		setIcon(new ImageIcon(getClass().getResource("images/return.png")));
		setPressedIcon(new ImageIcon(getClass().getResource("images/return1.png")));
	}
	
	@Override
	public void actionPerformed(ActionEvent arg0) {
		Sound.click2.play(EnableMusic.SoundEnabled);
		
		if(CreateGUI.paneNumber == 2)
			MainBoard.content.setVisible(true);
		else if(CreateGUI.paneNumber == 1)
			SelectNumberAndTokenOfPlayers.content.setVisible(true);
		else
			SelectBetweenSinglePlayerAndMultiplayer.content.setVisible(true);
			
		super.getParent().setVisible(false);
		SettingsButton.settings.setVisible(true);
	}
	
}

class ReturnToMainMenu implements ActionListener{	
	
	public static JButton ReturnToMainMenu;
	
	public ReturnToMainMenu() {
	
		ReturnToMainMenu = new JButton();
		
		ReturnToMainMenu.setPreferredSize(new Dimension(150,50));
		ReturnToMainMenu.addActionListener(this);
		ReturnToMainMenu.setContentAreaFilled(false);
		ReturnToMainMenu.setBorder(null);
		ReturnToMainMenu.setOpaque(false);
		ReturnToMainMenu.setIcon(new ImageIcon(getClass().getResource("images/mainmenu.png")));
		ReturnToMainMenu.setPressedIcon(new ImageIcon(getClass().getResource("images/mainmenu1.png")));
	}
	
	@Override
	public void actionPerformed(ActionEvent arg0) {
		
		Sound.click2.play(EnableMusic.SoundEnabled);
		
		if(CreateGUI.paneNumber == 2){
			int a = JOptionPane.showConfirmDialog(null, "Leave the game?", "", JOptionPane.YES_NO_OPTION, JOptionPane.INFORMATION_MESSAGE);			
			if(a == JOptionPane.YES_OPTION){
				Dice.currentPlayer = 1;		
				CreateGUI.paneNumber = 0;
				
				Audio.startBackgroundMusic(EnableMusic.MusicEnabled);
				
				SettingsButton.settings.setVisible(true);
				SelectBetweenSinglePlayerAndMultiplayer.content.setVisible(true);
				MainBoard.content.setVisible(false);
				ReturnToMainMenu.getParent().setVisible(false);
			}
		}
		else if(CreateGUI.paneNumber == 1){
			CreateGUI.paneNumber = 0;
			
			SettingsButton.settings.setVisible(true);
			SelectBetweenSinglePlayerAndMultiplayer.content.setVisible(true);
			SelectNumberAndTokenOfPlayers.content.setVisible(false);
			ReturnToMainMenu.getParent().setVisible(false);
		}
	}
}

class Quit extends JButton implements ActionListener{	

	private static final long serialVersionUID = 1L;

	public Quit() {
		setPreferredSize(new Dimension(150, 50));
		
		addActionListener(this);
		setContentAreaFilled(false);
		setBorder(null);
		setOpaque(false);
		setIcon(new ImageIcon(getClass().getResource("images/quit.png")));
		setPressedIcon(new ImageIcon(getClass().getResource("images/quit1.png")));
	}

	@Override
	public void actionPerformed(ActionEvent e) {
		
		Sound.click2.play(EnableMusic.SoundEnabled);
		int a = JOptionPane.showConfirmDialog(null, "Do you really want to leave this awesome game?", "", JOptionPane.YES_NO_OPTION, JOptionPane.WARNING_MESSAGE, null);
		
		if(a == JOptionPane.YES_OPTION){
			JOptionPane.showMessageDialog(null, "Goodbye", "", JOptionPane.INFORMATION_MESSAGE);
			System.exit(0);
		}
		else
			JOptionPane.showMessageDialog(null, "Good.", "", JOptionPane.INFORMATION_MESSAGE);
	}
}