package Exercise02_ShortestJobFirst;


import java.awt.Dimension;
import java.awt.Font;
import java.awt.GridBagConstraints;
import java.awt.GridBagLayout;
import java.awt.Insets;
import java.text.DecimalFormat;
import java.util.ArrayList;

import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JPanel;
import javax.swing.JScrollPane;
import javax.swing.SwingConstants;

import CPUScheduling.Process;


public class SJF_Tuazon {

	public static void execute(ArrayList<Process> list) {
		
		ArrayList<Process> finalList = new ArrayList<Process>();
		
		Process firstProcess = list.get(0);
		
		for(int i = 1; i < list.size(); i++){
			if(firstProcess.getArrivalTime() > list.get(i).getArrivalTime()){
				firstProcess = list.get(i);
			} else if(firstProcess.getArrivalTime() == list.get(i).getArrivalTime() && firstProcess.getBurstTime() > list.get(i).getBurstTime()){
				firstProcess = list.get(i);
			}
		}
		
		firstProcess.setWaitingTime(0);
		firstProcess.setTurnaroundTime(firstProcess.getBurstTime() + firstProcess.getWaitingTime());
		firstProcess.setEndTime(firstProcess.getArrivalTime() + firstProcess.getTurnaroundTime());
		
		finalList.add(firstProcess);
		
		int tempEndTime = firstProcess.getEndTime();
		
		double averageWaitingTime = firstProcess.getWaitingTime();
		double averageTurnaroundTime = firstProcess.getTurnaroundTime();
		
		while(finalList.size() != list.size()){
			
			ArrayList<Process> tempList = new ArrayList<Process>();
			for(Process tempProcess : list){
				if(tempProcess.getArrivalTime() <= tempEndTime && tempProcess.getEndTime() == 0){
					tempList.add(tempProcess);
				}
			}
			
			Process nextProcess = tempList.get(0);
			for(int i = 1; i < tempList.size(); i++){
				if(nextProcess.getBurstTime() > tempList.get(i).getBurstTime()){
					nextProcess = tempList.get(i);
				}
			}
				
			nextProcess.setWaitingTime(finalList.get(finalList.size()-1).getEndTime() - nextProcess.getArrivalTime()); /* ET of previous - AT */
			
			if(nextProcess.getWaitingTime() < 0){
				nextProcess.setWaitingTime(0);
			}
			averageWaitingTime += nextProcess.getWaitingTime();
			
			nextProcess.setTurnaroundTime(nextProcess.getBurstTime() + nextProcess.getWaitingTime());
			averageTurnaroundTime += nextProcess.getTurnaroundTime();
			
			nextProcess.setEndTime(nextProcess.getArrivalTime() + nextProcess.getTurnaroundTime());
			
			tempEndTime = nextProcess.getArrivalTime() + nextProcess.getTurnaroundTime();
			
			finalList.add(nextProcess);
		}
		
		int finalEndTime = finalList.get(finalList.size() - 1).getEndTime();
		
		averageWaitingTime /= list.size();
		averageTurnaroundTime /= list.size();
		
		double throughput = (double) list.size() / finalEndTime;
		
		InterfaceCreator(list, new DecimalFormat("#.####").format(averageWaitingTime), new DecimalFormat("#.####").format(averageTurnaroundTime), throughput);
		
	}
	
	private static void InterfaceCreator(ArrayList<Process> list, String string, String string2, double throughput){
		
		JFrame mainframe = new JFrame();
		mainframe.setLocationRelativeTo(null);
		mainframe.setVisible(true);
		mainframe.setResizable(false);
		
			GridBagConstraints c = new GridBagConstraints();
		
			JPanel mainpanel = new JPanel(new GridBagLayout());
			
				JLabel label = new JLabel("Shortest Job First", SwingConstants.CENTER);
				label.setFont(new Font("Arial", Font.BOLD, 25));
					c.gridx = 1;
					c.gridy = 1;
					c.gridwidth = 6;
					c.insets = new Insets(20, 20, 20, 20);
				mainpanel.add(label, c);
				
				label = new JLabel("PID", SwingConstants.CENTER);
					c.gridx = 1;
					c.gridy = 2;
					c.gridwidth = 1;
				mainpanel.add(label, c);
				
				label = new JLabel("AT", SwingConstants.CENTER);
					c.gridx = 2;
				mainpanel.add(label, c);
				
				label = new JLabel("BT", SwingConstants.CENTER);
					c.gridx = 3;
				mainpanel.add(label, c);
				
				label = new JLabel("WT", SwingConstants.CENTER);
					c.gridx = 4;
				mainpanel.add(label, c);
				
				label = new JLabel("TT", SwingConstants.CENTER);
					c.gridx = 5;
				mainpanel.add(label, c);
				
				label = new JLabel("ET", SwingConstants.CENTER);
					c.gridx = 6;
				mainpanel.add(label, c);
				
				c.gridy = 3;
				
				for(int i  = 0; i < list.size(); i++){
					label = new JLabel(String.valueOf(list.get(i).getId()), SwingConstants.CENTER);
						c.gridx = 1;
					mainpanel.add(label,c);
					label = new JLabel(String.valueOf(list.get(i).getArrivalTime()), SwingConstants.CENTER);
						c.gridx = 2;
					mainpanel.add(label,c);
					label = new JLabel(String.valueOf(list.get(i).getBurstTime()), SwingConstants.CENTER);
						c.gridx = 3;
					mainpanel.add(label,c);
					label = new JLabel(String.valueOf(list.get(i).getWaitingTime()), SwingConstants.CENTER);
						c.gridx = 4;
					mainpanel.add(label,c);
					label = new JLabel(String.valueOf(list.get(i).getTurnaroundTime()), SwingConstants.CENTER);
						c.gridx = 5;
					mainpanel.add(label,c);
					label = new JLabel(String.valueOf(list.get(i).getEndTime()), SwingConstants.CENTER);
						c.gridx = 6;
					mainpanel.add(label,c);
					c.gridy++;
				}
				
				label = new JLabel("Average", SwingConstants.CENTER);
					c.gridx = 1;
				mainpanel.add(label,c);
				label = new JLabel("-", SwingConstants.CENTER);
					c.gridx = 2;
				mainpanel.add(label,c);
				label = new JLabel("-", SwingConstants.CENTER);
					c.gridx = 3;
				mainpanel.add(label,c);
				label = new JLabel(String.valueOf(string), SwingConstants.CENTER);
					c.gridx = 4;
				mainpanel.add(label,c);
				label = new JLabel(String.valueOf(string2), SwingConstants.CENTER);
					c.gridx = 5;
				mainpanel.add(label,c);
				label = new JLabel("-", SwingConstants.CENTER);
					c.gridx = 6;
				mainpanel.add(label,c);
				
				label = new JLabel("Throughput: " + String.valueOf(throughput), SwingConstants.LEFT);
					c.gridy++;
					c.gridx = 1;
					c.gridwidth = 6;
				mainpanel.add(label,c);
				
			JScrollPane scrollpane = new JScrollPane(mainpanel, JScrollPane.VERTICAL_SCROLLBAR_ALWAYS, JScrollPane.HORIZONTAL_SCROLLBAR_NEVER);
				scrollpane.setPreferredSize(new Dimension(600, 500));
				scrollpane.setMaximumSize(new Dimension(600,500));
				
			mainframe.add(scrollpane);
		
		mainframe.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		mainframe.pack();
		
	}
	
	

}
