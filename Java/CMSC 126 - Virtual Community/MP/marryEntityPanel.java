package MP;

import java.awt.Dimension;
import java.awt.Font;
import java.awt.GridBagConstraints;
import java.awt.Insets;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.io.IOException;
import java.net.MalformedURLException;

import javax.swing.ImageIcon;
import javax.swing.JButton;
import javax.swing.JLabel;
import javax.swing.JTextField;

class marryEntityPanel extends mainJPanelClass{
	
	private static final long serialVersionUID = 8420435417941455157L;
	public JTextField groom, bride;
	
	public marryEntityPanel() {
		
		GridBagConstraints c = new GridBagConstraints();
		
		JLabel title = new JLabel("MARRY TWO PEOPLE");
		title.setFont(new Font("Calibri Light", Font.PLAIN, 48));
		
		c.gridx = 0;
		c.gridy = 0;
		c.gridwidth = 4;
		c.insets = new Insets(0, 0, 100, 0);
		
		add(title, c);
		
		JLabel label = new JLabel("Groom's Complete Name");
		
		c.gridx = 0;
		c.gridy = 1;
		c.gridwidth = 1;
		c.insets = new Insets(5, 10, 5, 10);
		
		add(label, c);
		
		groom = new JTextField();
		groom.setPreferredSize(new Dimension(200, 30));
		
		c.gridx = 1;
		
		add(groom, c);
		
		label = new JLabel("Bride's Complete Name");
		
		c.gridx = 0;
		c.gridy = 2;
		
		add(label, c);
		
		bride = new JTextField();
		bride.setPreferredSize(new Dimension(200, 30));
		
		c.gridx = 1;
		
		add(bride, c);
		
		JButton confirm = new marriageConfirm();
		
		c.gridx = 2;
		c.gridy = 1;
		c.gridheight = 2;
		c.insets = new Insets(0, 10, 0, 10);
		
		add(confirm, c);
		
		JButton back = new backButton(5);
		
		c.gridx = 3;
		
		add(back, c);
		
	}

	class marriageConfirm extends JButton implements ActionListener{
		
		private static final long serialVersionUID = -6221384324199989515L;

		public marriageConfirm() {
			
			addActionListener(this);
			
			setPreferredSize(new Dimension(200, 200));
			
			String URL = "Images/10.png";
			String desc = "10.png";
			try {
				setIcon(new ImageIcon(new java.net.URL(getClass().getResource(URL), desc)));
			} catch (MalformedURLException e) {
				e.printStackTrace();
			}
			
			setBorderPainted(false);
			setFocusPainted(false);
			setContentAreaFilled(false);
			
		}
		
		@Override
		public void actionPerformed(ActionEvent arg0) {
			
			try {
				CommunityInterface.mainFunction.marry(groom.getText(), bride.getText());
			} catch (ClassNotFoundException | IOException e) {
				e.printStackTrace();
			}
			
		}
		
	}
	
}

