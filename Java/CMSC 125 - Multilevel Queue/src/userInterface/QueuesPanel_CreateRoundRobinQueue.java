package userInterface;

import java.awt.Dimension;
import java.awt.GridBagConstraints;
import java.awt.GridBagLayout;
import java.awt.Insets;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

import javax.swing.JButton;
import javax.swing.JLabel;
import javax.swing.JPanel;
import javax.swing.JTextField;

public class QueuesPanel_CreateRoundRobinQueue extends JPanel{
	
	private static final long serialVersionUID = 1L;

	QueuesPanel_CreateRoundRobinQueue(boolean visible, int queueNumber) {
		
		this.setLayout(new GridBagLayout());
		this.setOpaque(false);
		
		GridBagConstraints c = new GridBagConstraints();
		
		c.gridx = 1;
		c.gridy = 1;
		
		Panel_QueuesPanel.hiddenButtons.add(new hideButton(queueNumber));
		this.add(Panel_QueuesPanel.hiddenButtons.get(Panel_QueuesPanel.hiddenButtons.size()-1), c);	
		
		JLabel label = new JLabel("Round Robin");
		label.setPreferredSize(new Dimension(200, 30));
		label.setFont(MainInterface.mainFont);
		
		c.gridx = 2;
		c.insets = new Insets(0, 20, 0, 20);
		
		this.add(label, c);
		
		JTextField temp = new JTextField();
		temp.setPreferredSize(new Dimension(100,30));
		temp.setBackground(MainInterface.inputBoxColor);
		temp.setBorder(MainInterface.defaultInputBorder);
		temp.setFont(MainInterface.mainFontBold);
		Panel_QueuesPanel.timeQuanta.add(temp);
		
		c.gridx = 3;
		c.insets = new Insets(0, 0, 0, 0);
		
		this.add(Panel_QueuesPanel.timeQuanta.get(Panel_QueuesPanel.timeQuanta.size()-1), c);
		
		this.setPreferredSize(new Dimension(MainInterface.mainRowWidth, MainInterface.mainRowHeight));
		this.setVisible(visible);
	}
	
	class hideButton extends JButton implements ActionListener{

		private static final long serialVersionUID = 1L;
		private int queueNumber;
		
		public hideButton(int queueNumber) {
			
			this.queueNumber = queueNumber;
			
			if(queueNumber == 0){
				setEnabled(false);
			}
			
			this.setIcon(MainInterface.getImageIcon("remove.png"));
			this.setBorderPainted(false); 
			this.setContentAreaFilled(false); 
			this.setFocusPainted(false); 
			this.setOpaque(false);
			
			this.setPreferredSize(new Dimension(30,30));
			this.addActionListener(this);
		}
		
		@Override
		public void actionPerformed(ActionEvent arg0) {
			
			if(Panel_QueuesPanel.getNoOfVisibleRRQueues() > 1){
				Panel_QueuesPanel.roundRobins.get(this.queueNumber).setVisible(false);
				Panel_QueuesPanel.setNoOfVisibleRRQueues(Panel_QueuesPanel.getNoOfVisibleRRQueues() - 1);
				
				if(Panel_QueuesPanel.getNoOfVisibleRRQueues() != 1){
					Panel_QueuesPanel.hiddenButtons.get(Panel_QueuesPanel.getNoOfVisibleRRQueues() - 1).setEnabled(true);
				}
				
				Panel_OtherButtonsPanel.addButton.setEnabled(true);
			}
			
		}
		
	}
	
}
