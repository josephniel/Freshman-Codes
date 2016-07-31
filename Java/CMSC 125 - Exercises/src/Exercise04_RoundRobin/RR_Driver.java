package Exercise04_RoundRobin;

import java.util.ArrayList;

import CPUScheduling.Process;

public class RR_Driver {
	
	public static void main(String[] args){
		
		/*
		Process p1 = new Process(1,0,4);
		Process p2 = new Process(2,1,5);
		Process p3 = new Process(3,2,6);
		Process p4 = new Process(4,4,1);
		Process p5 = new Process(5,6,3);
		Process p6 = new Process(6,7,2);
				    	
		ArrayList<Process> list= new ArrayList<Process>();
		list.add(p1);
		list.add(p2);
		list.add(p3);
		list.add(p4);
		list.add(p5);
		list.add(p6);
		*/
		
		Process p1 = new Process(1,0,5);
		Process p2 = new Process(2,1,3);
		Process p3 = new Process(3,2,8);
		Process p4 = new Process(4,3,6);
				    	
		ArrayList<Process> list= new ArrayList<Process>();
		list.add(p1);
		list.add(p2);
		list.add(p3);
		list.add(p4);
			    	
		RR_Tuazon.execute(list, 3);
	}

}
