package scheduling;

import java.io.File;

import userInterface.MainInterface;
import userInterface.Panel_TableResultsPanel;

public class MultilevelQueue {
	
	public MultilevelQueue() {
		new MainInterface();
	}
	
	public MultilevelQueue(File processFile, int numberOfQueues, int lastAlgorithm, int[] timeQuanta) {
		
		Process_File fileProcessor = new Process_File(processFile);
		fileProcessor.parseFile();
		
		Process_ExecuteScheduling execute = 
			new Process_ExecuteScheduling(
					fileProcessor.getProcesses(), 
					numberOfQueues, 
					lastAlgorithm, 
					timeQuanta);
		
		fileProcessor.saveToFile(execute.getProcesses(),execute.getAverageWaitingTime(),execute.getAverageTurnaroundTime(),execute.getThroughput(),lastAlgorithm);
		Panel_TableResultsPanel.displayTable(execute.getProcesses());
		Panel_TableResultsPanel.displayLog(execute.getFinalLog());
		Panel_TableResultsPanel.displayGantt(execute.getGanttChart());
	}
	
}
