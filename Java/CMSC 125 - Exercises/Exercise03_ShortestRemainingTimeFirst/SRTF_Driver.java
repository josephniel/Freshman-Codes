package Exercise03_ShortestRemainingTimeFirst;

import java.util.ArrayList;

import CPUScheduling.Process;

public class SRTF_Driver
{
    public static void main(String[] args)
    {
    	Process p1 = new Process(1,0,7);
    	Process p2 = new Process(2,2,4);
    	Process p3 = new Process(3,4,1);
    	Process p4 = new Process(4,5,4);
    	
    	ArrayList<Process> list= new ArrayList<Process>();
    	list.add(p1);
    	list.add(p2);
    	list.add(p3);
    	list.add(p4);
    	
    	SRTF_Tuazon.execute(list);
    
    }
}