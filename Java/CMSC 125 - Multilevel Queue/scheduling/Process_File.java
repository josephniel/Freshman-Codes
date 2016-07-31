package scheduling;

import java.io.BufferedReader;
import java.io.File;
import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.io.FileReader;
import java.io.IOException;
import java.io.PrintWriter;
import java.util.ArrayList;

public class Process_File {
	
	private ArrayList<Process> processes;
	private File processFile;
	
	protected Process_File(File processFile) {
		this.processFile = processFile; 
		this.processes = new ArrayList<Process>();
	}
	
	protected void parseFile(){
		
		File fileToProcess = processFile;		
		try {
			BufferedReader inputStream = new BufferedReader(new FileReader(fileToProcess));
			String currLine = "";
			int procID = 1;
			while ((currLine = inputStream.readLine()) != null) {
				String[] lineParsed = currLine.split("\\s+");
				Process newProc = new Process(
						procID,
						Integer.parseInt(lineParsed[1]),
						Integer.parseInt(lineParsed[2]),
						Integer.parseInt(lineParsed[0]));
				processes.add(newProc);
				procID++;
			}
			inputStream.close();
		} catch (FileNotFoundException e) {
			System.out.println("No file found.");
		} catch (IOException e) {
			System.out.println("IO ERROR");
		}
		
	}
	
	protected void saveToFile(ArrayList<Process> scheduledProcesses, double AveWT, double AveTT, double throughput, int lastQueue){
		
		try{
			
			String path = processFile.getAbsolutePath();
			path = path.substring(0, path.lastIndexOf('\\'));
			
			String lastQueueAlgo = new String();
			switch(lastQueue){
				case 1:
					lastQueueAlgo = "FCFS";
					break;
				case 2:
					lastQueueAlgo = "SJF";
					break;
				case 3:
					lastQueueAlgo = "SRTF";
					break;
				case 4:
					lastQueueAlgo = "RR";
					break;
				case 5:
					lastQueueAlgo = "PWOW";
					break;
				case 6:
					lastQueueAlgo = "PWP";
					break;
				default:
					lastQueueAlgo = "FCFS";
					break;
			}
			
			File file = new File(path, 
					(processFile.getName().substring(0,  processFile.getName().length() - 4) + "_" + lastQueueAlgo + "_output.txt"));
			
			
			file.createNewFile();
			
			PrintWriter outputStream = new PrintWriter(new FileOutputStream(file));
			String dispFormat = "| %-2d | %-12d | %-12d | %-17d | %-14d | %-17d | %-10d |%n";
			outputStream.format("+-------------------+--------------+-------------------+----------------+-------------------+------------+%n");
			outputStream.printf("| ID | Arrival Time |  Burst Time  |  Priority Number  |  Waiting Time  |  Turnaround Time  |  End Time  |%n");
			outputStream.format("+-------------------+--------------+-------------------+----------------+-------------------+------------+%n");
			for(Process p : scheduledProcesses){
				outputStream.format(dispFormat,
						p.getId(),
						p.getArrivalTime(), 
						p.getBurstTime(),
						p.getPriorityNum(),
						p.getWaitingTime(),
						p.getTurnaroundTime(),
						p.getEndTime());
			outputStream.format("+-------------------+--------------+-------------------+----------------+-------------------+------------+%n");
			}
			
			outputStream.printf("Average Waiting Time: " + AveWT + "%n");
			outputStream.printf("Average Turnaround Time: " + AveTT + "%n");
			outputStream.printf("Throughput: " + throughput + "%n");
			
			outputStream.close();
		}
		catch(FileNotFoundException e){
			e.printStackTrace();
		} catch (IOException e) {
			e.printStackTrace();
		} 
		
	}
	
	protected ArrayList<Process> getProcesses(){
		return processes;
	}
	
}
