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

class migrateEntityPanel extends mainJPanelClass{
	
	private static final long serialVersionUID = -5100994882715133424L;
	public JTextField nameOfEntity, nameOfFile;
	
	public migrateEntityPanel(int indicator) {
		
		GridBagConstraints c = new GridBagConstraints();
		
		JLabel title = new JLabel("MIGRATE PEOPLE OR FAMILY");
		title.setFont(new Font("Calibri Light", Font.PLAIN, 48));
		
		c.gridx = 0;
		c.gridy = 0;
		c.gridwidth = 3;
		c.insets = new Insets(0, 0, 100, 0);
		
		add(title, c);
		
		JLabel label = new JLabel("Name of Person / Family");
		
		c.gridx = 0;
		c.gridy = 1;
		c.gridwidth = 1;
		c.insets = new Insets(5, 10, 5, 10);
		
		add(label, c);
		
		nameOfEntity = new JTextField();
		nameOfEntity.setPreferredSize(new Dimension(400, 40));
		
		c.gridy = 2;
		
		add(nameOfEntity, c);
		
		label = new JLabel("Name of File");
		
		c.gridy = 3;
		
		add(label, c);
		
		nameOfFile = new JTextField();
		nameOfFile.setPreferredSize(new Dimension(400, 40));
		
		c.gridy = 4;
		
		add(nameOfFile, c);
		
		JButton confirm = new migrateConfirm(indicator);
		
		c.gridx = 1;
		c.gridy = 1;
		c.gridheight = 4;
		
		add(confirm, c);
		
		JButton back = new backButton(6);
		
		c.gridx = 2;
		
		add(back, c);
		
	}
	
	class migrateConfirm extends JButton implements ActionListener{
		
		private static final long serialVersionUID = 4029139282357675357L;
		public int indicator;
		
		public migrateConfirm(int indicator) {
			
			this.indicator = indicator;
			
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
			
			if(indicator == 1){ // migrate person
				
				try {
					CommunityInterface.mainFunction.migrate(1, 1, nameOfEntity.getText(), nameOfFile.getText());
				} catch (ClassNotFoundException | IOException e) {
					e.printStackTrace();
				}
				
			}
			else if(indicator == 2){ // migrate family
				
				try {
					CommunityInterface.mainFunction.migrate(2, 1, nameOfEntity.getText(), nameOfFile.getText());
				} catch (ClassNotFoundException | IOException e) {
					e.printStackTrace();
				}
				
			}
			else if(indicator == 4){ // accept person
				
				try {
					CommunityInterface.mainFunction.migrate(1, 2, nameOfEntity.getText(), nameOfFile.getText());
				} catch (ClassNotFoundException | IOException e) {
					e.printStackTrace();
				}
				
			}
			else{ // accept family
				
				try {
					CommunityInterface.mainFunction.migrate(2, 2, nameOfEntity.getText(), nameOfFile.getText());
				} catch (ClassNotFoundException | IOException e) {
					e.printStackTrace();
				}
				
			}
			
		}
		
	}
	
}