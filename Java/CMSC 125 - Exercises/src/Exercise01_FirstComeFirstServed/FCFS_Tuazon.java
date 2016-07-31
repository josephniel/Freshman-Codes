package Exercise01_FirstComeFirstServed;

import java.awt.Dimension;
import java.awt.Font;
import java.awt.GridBagConstraints;
import java.awt.GridBagLayout;
import java.awt.Insets;
import java.util.ArrayList;

import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JPanel;
import javax.swing.JScrollPane;
import javax.swing.SwingConstants;

import CPUScheduling.Process;

public class FCFS_Tuazon {

	public static void execute(ArrayList<Process> list) {
		
		for(int i = 0; i < list.size(); i++){
			for(int j = 0; j < list.size(); j++){
				if(list.get(i).getArrivalTime() < list.get(j).getArrivalTime()){
					Process temp = list.get(i);
					list.set(i, list.get(j));
					list.set(j, temp);
				}
			}
		}
		
		double averageWaitingTime = 0;
		double averageTurnaroundTime = 0;
		int finalEndTime = 0;
		
		for(int i = 0; i < list.size(); i++){
			int waitingTime = 0;
			if(i != 0){
				waitingTime = list.get(i-1).getEndTime() - list.get(i).getArrivalTime();
				if(waitingTime < 0)
					waitingTime = 0;
			}
			list.get(i).setWaitingTime(waitingTime);
			averageWaitingTime += waitingTime;
			
			int turnaroundTime = waitingTime + list.get(i).getBurstTime();
			list.get(i).setTurnaroundTime(turnaroundTime);
			averageTurnaroundTime += turnaroundTime;
			
			int endTime = turnaroundTime + list.get(i).getArrivalTime();
			list.get(i).setEndTime(endTime);
			finalEndTime = endTime;
		}
		
		averageWaitingTime /= list.size();
		averageTurnaroundTime /= list.size();
		
		double throughput = (double) list.size() / finalEndTime;	
		
		InterfaceCreator(list, averageWaitingTime, averageTurnaroundTime, throughput);
	}
	
	private static void InterfaceCreator(ArrayList<Process> list, double averageWaitingTime, double averageTurnaroundTime, double throughput){
		
		JFrame mainframe = new JFrame();
		mainframe.setLocationRelativeTo(null);
		mainframe.setVisible(true);
		mainframe.setResizable(false);
		
			GridBagConstraints c = new GridBagConstraints();
		
			JPanel mainpanel = new JPanel(new GridBagLayout());
			
				JLabel label = new JLabel("First Come, First Served", SwingConstants.CENTER);
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
				label = new JLabel(String.valueOf(averageWaitingTime), SwingConstants.CENTER);
					c.gridx = 4;
				mainpanel.add(label,c);
				label = new JLabel(String.valueOf(averageTurnaroundTime), SwingConstants.CENTER);
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
