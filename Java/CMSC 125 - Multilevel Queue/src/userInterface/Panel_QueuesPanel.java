package userInterface;

import java.awt.Dimension;
import java.util.ArrayList;

import javax.swing.JPanel;
import javax.swing.JTextField;

public class Panel_QueuesPanel extends JPanel{
	
	private static final long serialVersionUID = 1L;

	private static int visibleRRQueues = 1;
	private static int selectedSchedulingAlgorithm;
	
	static ArrayList<QueuesPanel_CreateRoundRobinQueue> roundRobins;
	static ArrayList<QueuesPanel_CreateRoundRobinQueue.hideButton> hiddenButtons;
	static ArrayList<JTextField> timeQuanta;
	
	Panel_QueuesPanel(){
		
		roundRobins = new ArrayList<QueuesPanel_CreateRoundRobinQueue>();
		hiddenButtons = new ArrayList<QueuesPanel_CreateRoundRobinQueue.hideButton>();
		timeQuanta = new ArrayList<JTextField>();
		
		int noOfRoundRobins = 4;
		
		for(int i = 0; i < noOfRoundRobins; i++){
			boolean visible = false;
			if(i < visibleRRQueues){
				visible = true;
			}
			roundRobins.add(new QueuesPanel_CreateRoundRobinQueue(visible, i));
			this.add(roundRobins.get(i));
		}
		
		this.setPreferredSize(new Dimension(MainInterface.mainRowWidth, (MainInterface.mainRowHeight * 5) + 30));
		this.setOpaque(false);
		this.add(new QueuesPanel_CreateLastQueue());
		
	}
	
	public static int getNoOfVisibleRRQueues() {
		return visibleRRQueues;
	}

	public static void setNoOfVisibleRRQueues(int visibleRRQueues) {
		Panel_QueuesPanel.visibleRRQueues = visibleRRQueues;
	}

	public static int getSelectedSchedulingAlgorithm() {
		return selectedSchedulingAlgorithm;
	}

	public static void setSelectedSchedulingAlgorithm(
			int selectedSchedulingAlgorithm) {
		Panel_QueuesPanel.selectedSchedulingAlgorithm = selectedSchedulingAlgorithm;
	}
	
	
}
