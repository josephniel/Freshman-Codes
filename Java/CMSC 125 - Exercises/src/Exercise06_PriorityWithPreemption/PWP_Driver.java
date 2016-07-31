package Exercise06_PriorityWithPreemption;

import java.util.ArrayList;

import CPUScheduling.Process;

public class PWP_Driver {
	
	public static void main(String[] args) {
		
		Process p1 = new Process(1,0,10,3);
		Process p2 = new Process(2,1,1,1);
		Process p3 = new Process(3,2,2,4);
		Process p4 = new Process(4,3,1,5);
		Process p5 = new Process(5,5,5,2);
		
		ArrayList<Process> list= new ArrayList<Process>();
		list.add(p1);
		list.add(p2);
		list.add(p3);
		list.add(p4);
		list.add(p5);
			    	
		PWP_Tuazon.execute(list);
		
	}
	
}
