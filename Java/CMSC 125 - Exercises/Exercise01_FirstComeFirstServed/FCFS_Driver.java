package Exercise01_FirstComeFirstServed;

import java.util.ArrayList;

import CPUScheduling.Process;

public class FCFS_Driver
{
    public static void main( String[] args)
    {
    	Process p4 = new Process(1,0,5);
    	Process p3 = new Process(2,7,3);
    	Process p2 = new Process(3,7,8);
    	Process p1 = new Process(4,7,6);
    	
    	ArrayList<Process> list= new ArrayList<Process>();
	list.add(p1);
	list.add(p2);
	list.add(p3);
	list.add(p4);
    	
    	FCFS_Tuazon.execute(list);
    
    }
}