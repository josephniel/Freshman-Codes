package Main;

import java.awt.Dimension;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.util.Timer;

import javax.swing.ImageIcon;
import javax.swing.JButton;
import javax.swing.JLabel;

public class RollButton extends JButton implements ActionListener{
	
	private static final long serialVersionUID = 1L;
	public static JLabel dice;
	
	public RollButton(JLabel dice) {
		RollButton.dice = dice;
		RollButton.dice.setPreferredSize(new Dimension(100,100));
		
		setPreferredSize(new Dimension(100,50));
		setContentAreaFilled(false);
		setBorder(null);
		setIcon(new ImageIcon(getClass().getResource("images/roll1.png")));
		setPressedIcon(new ImageIcon(getClass().getResource("images/roll2.png")));
		addActionListener(this);
	}

	@Override
	public void actionPerformed(ActionEvent arg0) {
		 
		Timer timer = new Timer();
		Sound.dice.play(EnableMusic.SoundEnabled);
		timer.scheduleAtFixedRate(new ThrowDice(dice), 0, 75);
	}
}