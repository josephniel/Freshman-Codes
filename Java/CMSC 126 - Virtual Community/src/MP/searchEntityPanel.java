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

class searchEntityPanel extends mainJPanelClass{
	
	private static final long serialVersionUID = -996024753255099270L;
	
	public JTextField searchBox;
	
	public searchEntityPanel(int indicator){
		
		GridBagConstraints c = new GridBagConstraints();
		
		JLabel title;
		if(indicator == 1){
			title = new JLabel("SEARCH FOR A SPECIFIC PERSON");
		}
		else{
			title = new JLabel("SEARCH FOR A FAMILY NAME");
		}
		title.setFont(new Font("Calibri Light", Font.PLAIN, 48));
		
		c.gridx = 0;
		c.gridy = 0;
		c.gridwidth = 3;
		c.insets = new Insets(0, 0, 100, 0);
		
		add(title, c);
		
		searchBox = new JTextField();
		searchBox.setPreferredSize(new Dimension(400, 40));
		
		c.gridx = 0;
		c.gridy = 1;
		c.gridwidth = 1;
		c.insets = new Insets(0, 10, 0, 10);
		
		add(searchBox, c);
		
		JButton confirm = new searchConfirm(indicator);
		
		c.gridx = 1;
		
		add(confirm, c);
		
		JButton back = new backButton(3);
		
		c.gridx = 2;
		
		add(back, c);
		
	}
	
	class searchConfirm extends JButton implements ActionListener{
		
		private static final long serialVersionUID = -646301223996544431L;
		
		public int indicator;
		
		public searchConfirm(int indicator) {
			
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
			
			if(indicator == 1){
				
				try {
					CommunityInterface.mainFunction.search(1, searchBox.getText());
				} catch (ClassNotFoundException | IOException e) {
					e.printStackTrace();
				}
				
			}else{
				
				try {
					CommunityInterface.mainFunction.search(2, searchBox.getText());
				} catch (ClassNotFoundException | IOException e) {
					e.printStackTrace();
				}
				
			}
			
			
		}
		
	}

	
}