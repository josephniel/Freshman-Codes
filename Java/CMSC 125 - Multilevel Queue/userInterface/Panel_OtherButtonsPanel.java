package userInterface;

import java.awt.Dimension;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.util.ArrayList;

import javax.swing.JButton;
import javax.swing.JPanel;


public class Panel_OtherButtonsPanel extends JPanel implements ActionListener{


	private static final long serialVersionUID = 1L;
	
	static JButton addButton, processButton;
	
	public Panel_OtherButtonsPanel() {
		
		this.setPreferredSize(new Dimension(MainInterface.mainRowWidth, MainInterface.mainRowHeight));
		this.setOpaque(false);
		
		addButton = new JButton("Add Queue");
		addButton.setPreferredSize(new Dimension(120,30));
		addButton.addActionListener(this);
		addButton.setBackground(MainInterface.buttonColor);
		addButton.setFont(MainInterface.mainFontBold);
		
		this.add(addButton);
		
		processButton = new JButton("Simulate");
		processButton.setPreferredSize(new Dimension(120,30));
		processButton.addActionListener(this);
		processButton.setBackground(MainInterface.buttonColor);
		processButton.setFont(MainInterface.mainFontBold);
		
		this.add(processButton);
		
	}
	
	@Override
	public void actionPerformed(ActionEvent e) {
		
		if (e.getSource() == addButton) {
			
			ArrayList<QueuesPanel_CreateRoundRobinQueue> roundRobins = Panel_QueuesPanel.roundRobins;
			ArrayList<QueuesPanel_CreateRoundRobinQueue.hideButton> hiddenButtons = Panel_QueuesPanel.hiddenButtons;
			
			int noOfRRs = Panel_QueuesPanel.getNoOfVisibleRRQueues();
			
			if(noOfRRs < 4){
				roundRobins.get(noOfRRs).setVisible(true);
				hiddenButtons.get(noOfRRs - 1).setEnabled(false);
				
				Panel_QueuesPanel.setNoOfVisibleRRQueues(noOfRRs + 1);
				if(Panel_QueuesPanel.getNoOfVisibleRRQueues() == 4){
					addButton.setEnabled(false);
				}
			}
			
		} else if(e.getSource() == processButton){
			
			int numberOfQueues = Panel_QueuesPanel.getNoOfVisibleRRQueues() + 1;
			int lastAlgorithm = Panel_QueuesPanel.getSelectedSchedulingAlgorithm();

			int[] timeQuanta = new int[numberOfQueues];
			int counter = 0;
			
			boolean error = false;
			String errorMessage1 = new String();
			String errorMessage2 = new String();
			
			if(Panel_FileUploadPanel.processFile == null){
				error = true;
				errorMessage1 = "\nNo File Selected. Please select file to process.\n";
			}
			
			for(int i = 0; i < numberOfQueues - 1; i++){
				Integer content = parseInt(Panel_QueuesPanel.timeQuanta.get(i).getText());
				if(content != null){
					timeQuanta[i] = (int) content;
				} else{
					error = true;
					errorMessage2 = "\nPlease fill up necessary time quanta.\n";
				}
				counter++;
			}
			if(lastAlgorithm == 4){
				Integer content = parseInt(QueuesPanel_CreateLastQueue.timeQuantum.getText());
				if(content != null){
					timeQuanta[counter] = (int) content;
				} else{
					error = true;
					errorMessage2 = "\nPlease fill up necessary time quanta.\n";
				}
			} else{
				timeQuanta[counter] = 0;
			}
			
			if(!error){
				MainInterface.executeScheduling(Panel_FileUploadPanel.processFile, numberOfQueues, lastAlgorithm, timeQuanta);
			} else{
				MainInterface.showErrorMessage(errorMessage1 + errorMessage2 + "\n");
			}
			
		}
		
	}
	
	public static Integer parseInt(String text) {
		try { 
			return new Integer(text); 
		} 
		catch (NumberFormatException e) {
			return null;
		}
	}
	
}