package Exercise06_PriorityWithPreemption;

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

public class PWP_Tuazon {

	public static void execute(ArrayList<Process> list) {
		
		for(int i = 0; i < list.size(); i++){
			for(int j = 0; j < list.size(); j++){
				if(list.get(i).getArrivalTime() < list.get(j).getArrivalTime()){
					Process temp = list.get(i);
					list.set(i, list.get(j));
					list.set(j, temp);
				} else if(list.get(i).getArrivalTime() == list.get(j).getArrivalTime() && list.get(i).getPriorityNum() < list.get(j).getPriorityNum()){
					Process temp = list.get(i);
					list.set(i, list.get(j));
					list.set(j, temp);
				}
			}
		}
		
		
		ArrayList<Process> tempList = new ArrayList<Process>();
		for(Process p : list){
			tempList.add(new Process(p.getId(), p.getArrivalTime(), p.getBurstTime(),p.getPriorityNum()));
		}
		
		ArrayList<Integer> ganttChart = new ArrayList<Integer>();
		ArrayList<Process> processInQueue = new ArrayList<Process>();
		
		Process currentProcess = tempList.get(0);
		int currentId = currentProcess.getId();
		
		processInQueue.add(currentProcess);
		while(tempList.size() != 0){
			
			ganttChart.add(currentProcess.getId());
			currentProcess.setBurstTime(currentProcess.getBurstTime() - 1);
			
			if(currentProcess.getBurstTime() == 0){
				tempList.remove(currentProcess);
				processInQueue.remove(currentProcess);
			}
			
			if(processInQueue.size() != tempList.size()){
				for(Process p : tempList){
					if(p.getArrivalTime() <= ganttChart.size() && !processInQueue.contains(p)){
						processInQueue.add(p);
					}
				}
			}
			
			if(currentProcess.getBurstTime() == 0 && tempList.size() != 0){
				currentProcess = tempList.get(0);
			}
			for(Process p : processInQueue){
				if(p.getPriorityNum() < currentProcess.getPriorityNum() && currentId != p.getId()){
					currentProcess = p;
				}
			}
			currentId = currentProcess.getId();
		}
		
		double averageWaitingTime = 0;
		double averageTurnaroundTime = 0;
		
		for(int i = 0; i < list.size(); i++){
			Process currentProcess1 = list.get(i);
			
			for(int j = ganttChart.size() - 1; j > 0; j--){
				if(ganttChart.get(j) == currentProcess1.getId()){
					currentProcess1.setEndTime(j + 1);
					break;
				}
			}
			
			int waitingTime = ((currentProcess1.getEndTime() - currentProcess1.getArrivalTime()) - currentProcess1.getBurstTime());
			currentProcess1.setWaitingTime(waitingTime);
			averageWaitingTime += waitingTime;
			
			
			currentProcess1.setTurnaroundTime(currentProcess1.getBurstTime() + currentProcess1.getWaitingTime());
			averageTurnaroundTime += currentProcess1.getTurnaroundTime();
		}
		
		int finalEndTime = ganttChart.size();
		
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
			
				JLabel label = new JLabel("Preemptive Priority", SwingConstants.CENTER);
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
