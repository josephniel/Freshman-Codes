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

class deleteEntityPanel extends mainJPanelClass{
	
	private static final long serialVersionUID = 37667825254772663L;
	public JTextField deleteName;
	
	public deleteEntityPanel() {

		GridBagConstraints c = new GridBagConstraints();
		
		JLabel title = new JLabel("DELETE A SPECIFIC PERSON (IN YOUR LIFE)");
		title.setFont(new Font("Calibri Light", Font.PLAIN, 48));
		
		c.gridx = 0;
		c.gridy = 0;
		c.gridwidth = 3;
		c.insets = new Insets(0, 0, 100, 0);
		
		add(title, c);
		
		deleteName = new JTextField();
		deleteName.setPreferredSize(new Dimension(400, 40));
		
		c.gridx = 0;
		c.gridy = 1;
		c.gridwidth = 1;
		c.insets = new Insets(0, 10, 0, 10);
		
		add(deleteName, c);
		
		JButton confirm = new deleteConfirm();
		
		c.gridx = 1;
		
		add(confirm, c);
		
		JButton back = new backButton(4);
		
		c.gridx = 2;
		
		add(back, c);
		
	}
	
	class deleteConfirm extends JButton implements ActionListener{
		
		private static final long serialVersionUID = 2045088800630614524L;

		public deleteConfirm() {
			
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
				CommunityInterface.mainFunction.delete(deleteName.getText());
			} catch (ClassNotFoundException | IOException e) {
				e.printStackTrace();
			}
			
		}
		
	}
	
}