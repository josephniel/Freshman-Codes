package scheduling;

import java.util.ArrayList;

public class Process_ExecuteScheduling {
	
	private ArrayList<Process> processes;
	
	private ArrayList<ArrayList<Integer>> processesInQueues;
	private ArrayList<Integer> ganttChart;
	private ArrayList<Process> tempList;
	private ArrayList<String> log;
	
	private Process currentProcess;
	
	private int currentId;
	private int currentQueue;
	private int currentTimeQuantum;
	private int batchIndicator;
	
	private boolean indicator;
	
	private String finalLog;

	private double throughput;
	private double averageWaitingTime;
	private double averageTurnaroundTime;
	
	protected Process_ExecuteScheduling(ArrayList<Process> processes, int numberOfQueues, int lastAlgorithm, int[] timeQuanta) {
		
		this.processes = processes;
		
		// Sorts the processes based on arrival time primarily and priority
		for(int i = 0; i < this.processes.size(); i++){
			for(int j = 0; j < this.processes.size(); j++){
				if(this.processes.get(i).getArrivalTime() < this.processes.get(j).getArrivalTime()){
					
					Process temp = this.processes.get(i);
					this.processes.set(i, this.processes.get(j));
					this.processes.set(j, temp);
					
				} else if(this.processes.get(i).getArrivalTime() == this.processes.get(j).getArrivalTime() 
						&& this.processes.get(i).getPriorityNum() < this.processes.get(j).getPriorityNum()){
					
					Process temp = this.processes.get(i);
					this.processes.set(i, this.processes.get(j));
					this.processes.set(j, temp);
					
				}
			}
		}
		
		// Puts the list in a new (not pointed) array list of processes
		tempList = new ArrayList<Process>();
		for(Process p : this.processes){
			tempList.add(new Process(p.getId(), p.getArrivalTime(), p.getBurstTime(),p.getPriorityNum()));
		}
		
		// Initializes Gantt representation of the scheduling
		ganttChart = new ArrayList<Integer>();
		
		// Initializes and creates the processesInQueue
		processesInQueues = new ArrayList<ArrayList<Integer>>();
		for(int i = 0; i < numberOfQueues; i++){
			ArrayList<Integer> queue = new ArrayList<Integer>();
			processesInQueues.add(queue);
		}
		
		// other dependencies used by the algorithm
		int currentTime = 0;
		int arrivedProcesses = 0;
		int lastQueue = numberOfQueues - 1;
		
		/*
		 * NOTE: A PROCESS IS ONLY HALTED WHENEVER A NEW PROCESS ARRIVES. 
		 * ALL PROCESSES SHOULD BE AT THE SAME QUEUE 
		 * OR THE HALTED PROCESS SHOULD BE AT LEAST 1 QUEUE EARLIER
		 * IF NOT ON THE SAME QUEUE BASED ON THE ALGORITHM
		 * 
		 * HALTED PROCESS IS ALWAYS THE 0 INDEX OF ITS QUEUE
		 * 
		 */
		log = new ArrayList<String>();
		
		currentProcess = null;
		batchIndicator = -1;
		currentQueue = -1;
		
		/*
		 * INDICATOR INDICATES WHETHER A BLOCK OF CODE USED IN THE LAST SCHEDULING
		 * IS TO BE RUN (BECAUSE SOME BLOCK OF CODE IN THE LAST QUEUE SCHEDULING
		 * WOULD NOT WORK WHEN REPEATED FOR EVERY PROCESSING)
		 * 
		 * THE MYSTERY AS TO WHY THE CODE DOESN'T WORK AS IT SHOULD BE IS BECAUSE OF THE
		 * BATCH PROCESSING (THE SETTING OF THE ARRIVAL TIME FOR EACH ARRIVED PROCESS AT THE QUEUE)
		 * 
		 * WHENEVER A PROCESS ARRIVES AT THE LAST QUEUE, IF THERE IS NO INDICATOR THAT THE BLOCK 
		 * HAS BEEN EXECUTED ONCE, IT WILL CONTINUE TO EXECUTE BECAUSE PROCESSING IS STILL AT LAST QUEUE
		 * AND THE DESIGN OF THE CODE SHOULD ONLY BE RUN AT INITAILIZATION. RUNNING IT EVERY ITERATION 
		 * WOULD CAUSE ERRORS
		 * 
		 * */
		indicator = true;
		while(!tempList.isEmpty()){
	
			log.add("Current time: " + (currentTime + 1) + "\n");
				
			// adds currently arriving process into first queue
			if(arrivedProcesses != processes.size()){
				for(Process p : tempList){
					if(p.getArrivalTime() == currentTime && !processesInQueues.get(0).contains(p.getId())){
						processesInQueues.get(0).add(p.getId());
						arrivedProcesses++;
						
						log.set(currentTime, (log.get(currentTime) + "        Process " + p.getId() + " has arrived.\n"));
					}
				}
			}
			
			// resets the currentQueue to initial value
			if(currentProcess == null){
				currentQueue = -1;
			}
			
			// checks for arriving process
			// if current process is not on first queue, then prioritize arrived process first
			if(!processesInQueues.get(0).isEmpty() && currentQueue != 0){
				currentId = processesInQueues.get(0).get(0);
				breakLoop:
				for(Process p : tempList){
					if(p.getId() == currentId){
						currentProcess = p;
						break breakLoop;
					}
				}
				currentQueue = 0;
				currentTimeQuantum = timeQuanta[currentQueue];
				
				indicator = true;
				log.set(currentTime, (log.get(currentTime) + "        Process " + currentId + " is being processed.\n"));
			} 
			
			// updates time and gantt chart
			currentTime++;
			ganttChart.add(currentId);
		
			if(currentProcess != null){
				
				currentProcess.setBurstTime(currentProcess.getBurstTime() - 1);
				currentProcess.setTimeQuantumSpent(currentProcess.getTimeQuantumSpent() + 1);
				
				if(currentProcess.getBurstTime() == 0){
					// regardless of whether the current process is in the last queue of not,
					// if the burst time is zero,
					
					// remove the process in the loop-condition list
					tempList.remove(currentProcess);
					
					// remove the process in the current queue
					processesInQueues.get(currentQueue).remove(0);
					
					log.set(currentTime-1, (log.get(currentTime-1) + "        Process " + currentId + " has been processed.\n"));
				
					// set currentProcess to null
					currentProcess = null;
					currentId = 0;
					
					if(!tempList.isEmpty()){
						// if there are still processes to process
						
						if(!processesInQueues.get(currentQueue).isEmpty()){ 
							// if there are other processes to process on the same queue
							
							currentId = processesInQueues.get(currentQueue).get(0);
							breakLoop1:
							for(Process p : tempList){
								if(p.getId() == currentId){
									currentProcess = p;
									break breakLoop1;
								}
							}
							// currentQueue remains the same
							// currentTimeQuantum remains the same
							
						} else{ 
							// if there are no other processes on the same queue, go to next queue that has content
						
							breakLoop2:
							for(int i = currentQueue + 1; i < numberOfQueues; i++){
								if(processesInQueues.get(i).size() != 0){
									currentQueue = i;
									currentId = processesInQueues.get(currentQueue).get(0);
									currentTimeQuantum = timeQuanta[currentQueue];
									for(Process p : tempList){
										if(p.getId() == currentId){
											currentProcess = p;
											break breakLoop2;
										}
									}
								}
							}
						}
						
						log.set(currentTime-1, (log.get(currentTime-1) + "        Process " + currentId + " is being processed.\n"));
					}
					
				} else if(currentQueue != lastQueue){
					// if currentQueue is not the last queue
					
					if(currentProcess.getTimeQuantumSpent() == currentTimeQuantum){
						// if total time quantum for particular queue is spent
						
						// remove current process in current queue
						processesInQueues.get(currentQueue).remove(0);
						
						// add process to next queue
						if(!processesInQueues.get(currentQueue + 1).contains(currentId)){
							processesInQueues.get(currentQueue + 1).add(currentId);
						}
						
						// set current queue for current process
						currentProcess.setCurrentQueue(currentQueue + 1);
						
						// reset current process's time quantum
						currentProcess.setTimeQuantumSpent(0);
						
						if(!processesInQueues.get(currentQueue).isEmpty()){ 
							// if there are other processes to process on the same queue
							
							log.set(currentTime-1, (log.get(currentTime-1) + "        Process " + currentId + " has been moved from queue " + (currentQueue + 1) + " to " + (currentQueue + 2) + ".\n"));
							log.set(currentTime-1, (log.get(currentTime-1) + "        Process " + currentId + " has been paused.\n"));
							
							currentId = processesInQueues.get(currentQueue).get(0);
							breakLoop3:
							for(Process p : tempList){
								if(p.getId() == currentId){
									currentProcess = p;
									break breakLoop3;
								}
							}
							// currentQueue remains the same
							// currentTimeQuantum remains the same
							
						} else{ // if there are no other processes to process
							
							// set current queue to next queue
							currentQueue = currentProcess.getCurrentQueue();
							
							log.set(currentTime-1, (log.get(currentTime-1) + "        Process " + currentId + " has been moved from queue " + currentQueue + " to " + (currentQueue + 1) + ".\n"));
							log.set(currentTime-1, (log.get(currentTime-1) + "        Process " + currentId + " has been paused.\n"));
							
							// get current time quantum for the current queue (this is automatically 0 when not a round robin)
							currentTimeQuantum = timeQuanta[currentQueue];
						
							// check if there are other processes that are in queue for processing at the current queue
							if(processesInQueues.get(currentQueue).size() != 1){ 
								// if current process is not the only one in the new queue
								
								// get the first one to arrive at that queue to represent as current process
								currentId = processesInQueues.get(currentQueue).get(0);
								breakLoop4:
								for(Process p : tempList){
									if(p.getId() == currentId){
										currentProcess = p;
										break breakLoop4;
									}
								}
							}
							
						}
						
						log.set(currentTime-1, (log.get(currentTime-1) + "        Process " + currentId + " is being processed.\n"));
					}
					// ELSE: CONTINUE PROCESSING
					
				} 
				
				
			/*
			 * THIS BLOCK IS REPEATED BECAUSE THERE WILL BE AN INSTANCE WHERE
			 * ALL THE PROCESSES ARE IN THE 2ND QUEUE AND AT THAT TIME, A PROCESS ARRIVES.
			 * WITHOUT THIS, SOME FUNCTIONS WITHIN THE BLOCK OF CODE BELOW THIS BLOCK
			 * WOULD TURN OUT TO BE ERRONEOUS 
			 * 
			 * */
				
				// adds currently arriving process into first queue
				if(arrivedProcesses != processes.size()){
					for(Process p : tempList){
						if(p.getArrivalTime() == currentTime && !processesInQueues.get(0).contains(p.getId())){
							processesInQueues.get(0).add(p.getId());
							arrivedProcesses++;
							
							log.set(currentTime-1, (log.get(currentTime-1) + "        Process " + p.getId() + " has arrived.\n"));
						}
					}
				}
				
				// resets the currentQueue to initial value
				if(currentProcess == null){
					currentQueue = -1;
				}
				
				// checks for arriving process
				// if current process is not on first queue, then prioritize arrived process first
				if(!processesInQueues.get(0).isEmpty() && currentQueue != 0){
					log.set(currentTime-1, (log.get(currentTime-1) + "        Process " + currentId + " has been paused.\n"));
					
					currentId = processesInQueues.get(0).get(0);
					breakLoop:
					for(Process p : tempList){
						if(p.getId() == currentId){
							currentProcess = p;
							break breakLoop;
						}
					}
					currentQueue = 0;
					currentTimeQuantum = timeQuanta[currentQueue];
					
					indicator = true;
					
					log.set(currentTime-1, (log.get(currentTime-1) + "        Process " + currentId + " has been prioritized and is being processed.\n"));
				} 	
				
			/*
			 * THIS BLOCK IS SEPARATED BECAUSE THERE WILL BE AN INSTANCE WHERE THE SECOND CONDITION, 
			 * EVEN WHEN TRUE, NEEDS THIS BLOCK TO CONTINUE FUNCTIONALITY -
			 * THAT IS WHEN ALL PROCESSES HAVE BEEN PUT INTO THE LAST QUEUE 
			 * AND FOR THE ITERATOR NOT TO SUBTRACT ANOTHER BURST FROM THE CURRENT PROCESS
			 * 
			 * */
				if(currentQueue == lastQueue && currentProcess != null){
					// if currentQueue is the last queue
					
					if(lastAlgorithm == 1){
						// if last queue is first come first served
						// JUST CONTINUE ALGORITHM 
						// REMOVAL AND ORDER OF PROCESS IS HANDLED ALREADY
						
					} else if(lastAlgorithm == 2){
						// if last queue is shortest job first
						// there would be a change in order for the processes in the last queue
						// where the processes should be arranged according to shortest burst time
						
						if(indicator){
							
							log.set(currentTime-1, (log.get(currentTime-1) + "        Process " + currentId + " has been paused.\n"));
							
							// get the processes and store it in an array
							ArrayList<Process> tempProcesses = new ArrayList<Process>();
							for(int id : processesInQueues.get(currentQueue)){
								breakLoop:
								for(Process p : tempList){
									if(p.getId() == id){
										if(p.getArrivalTime() >= 0){
											p.setArrivalTime(batchIndicator);
										}
										tempProcesses.add(p);
										break breakLoop;
									}
								}
							}
							batchIndicator--;
							
							// sort processes according to
							// 1. batch (as indicated in arrival time, higher value is prioritized)
							// 2. burst time
							for(int i = 0; i < tempProcesses.size(); i++){
								for(int j = i + 1; j < tempProcesses.size(); j++){
									if(tempProcesses.get(j).getArrivalTime() > tempProcesses.get(i).getArrivalTime()){
										Process tempProcess = tempProcesses.get(i);
										tempProcesses.set(i, tempProcesses.get(j));
										tempProcesses.set(j, tempProcess);
									} else if(tempProcesses.get(j).getArrivalTime() == tempProcesses.get(i).getArrivalTime()
											&& tempProcesses.get(j).getBurstTime() < tempProcesses.get(i).getBurstTime()){
										Process tempProcess = tempProcesses.get(i);
										tempProcesses.set(i, tempProcesses.get(j));
										tempProcesses.set(j, tempProcess);
									} 
								}
							}
						
							processesInQueues.get(currentQueue).clear();
							for(Process p : tempProcesses){
								processesInQueues.get(currentQueue).add(p.getId());
							}
							
							currentId = processesInQueues.get(currentQueue).get(0);
							breakLoop:
							for(Process p : tempList){
								if(p.getId() == currentId){
									currentProcess = p;
									break breakLoop;
								}
							}
							// currentQueue remains the same
							// currentTimeQuantim remains the same
							
							indicator = false;
							
							log.set(currentTime-1, (log.get(currentTime-1) + "        Process " + currentId + " is being processed.\n"));
						
						}
						
					} else if(lastAlgorithm == 3){
						// if last queue is shortest time remaining first
						
						if(indicator){
							
							log.set(currentTime-1, (log.get(currentTime-1) + "        Process " + currentId + " has been paused.\n"));
							
							// get the processes and store it in an array
							ArrayList<Process> tempProcesses = new ArrayList<Process>();
							for(int id : processesInQueues.get(currentQueue)){
								breakLoop:
								for(Process p : tempList){
									if(p.getId() == id){
										p.setArrivalTime(-1);
										tempProcesses.add(p);
										break breakLoop;
									}
								}
							}
							
							// sort processes according to
							// 1. batch (as indicated in arrival time, higher value is prioritized)
							// 2. burst time
							for(int i = 0; i < tempProcesses.size(); i++){
								for(int j = i + 1; j < tempProcesses.size(); j++){
									if(tempProcesses.get(j).getArrivalTime() > tempProcesses.get(i).getArrivalTime()){
										Process tempProcess = tempProcesses.get(i);
										tempProcesses.set(i, tempProcesses.get(j));
										tempProcesses.set(j, tempProcess);
									} else if(tempProcesses.get(j).getArrivalTime() == tempProcesses.get(i).getArrivalTime()
											&& tempProcesses.get(j).getBurstTime() < tempProcesses.get(i).getBurstTime()){
										Process tempProcess = tempProcesses.get(i);
										tempProcesses.set(i, tempProcesses.get(j));
										tempProcesses.set(j, tempProcess);
									}
								}
							}
						
							processesInQueues.get(currentQueue).clear();
							for(Process p : tempProcesses){
								processesInQueues.get(currentQueue).add(p.getId());
							}
							
							currentId = processesInQueues.get(currentQueue).get(0);
							breakLoop:
							for(Process p : tempList){
								if(p.getId() == currentId){
									currentProcess = p;
									break breakLoop;
								}
							}
							// currentQueue remains the same
							// currentTimeQuantim remains the same
							
							indicator = false;
							
							log.set(currentTime-1, (log.get(currentTime-1) + "        Process " + currentId + " is being processed.\n"));
						}
						
					} else if(lastAlgorithm == 4){
						// if last queue is a round robin
						
						if(currentProcess.getTimeQuantumSpent() == currentTimeQuantum){
							// if the current process is done with it's time quantum
							
							processesInQueues.get(currentQueue).remove(0);
							processesInQueues.get(currentQueue).add(currentId);
							
							currentProcess.setTimeQuantumSpent(0);
							
							if(currentProcess.getBurstTime() != 0){
								log.set(currentTime-1, (log.get(currentTime-1) + "        Process " + currentId + " has been paused.\n"));
							}
								
							currentId = processesInQueues.get(currentQueue).get(0);
							log.set(currentTime-1, (log.get(currentTime-1) + "        Process " + currentId + " is being processed.\n"));
							
							breakLoop:
							for(Process p : tempList){
								if(p.getId() == currentId){
									currentProcess = p;
									break breakLoop;
								}
							}
							// currentQueue remains the same
							// currentTimeQuantum remains the same
						}
						
					} else if(lastAlgorithm == 5){
						// if last queue is priority without preemption
						
						if(indicator){
							
							log.set(currentTime-1, (log.get(currentTime-1) + "        Process " + currentId + " has been paused.\n"));
							
							// get the processes and store it in an array
							ArrayList<Process> tempProcesses = new ArrayList<Process>();
							for(int id : processesInQueues.get(currentQueue)){
								breakLoop5:
								for(Process p : tempList){
									if(p.getId() == id){
										if(p.getArrivalTime() >= 0){
											p.setArrivalTime(batchIndicator);
										}
										tempProcesses.add(p);
										break breakLoop5;
									}
								}
							}
							batchIndicator--;
							
							// sort processes according to
							// 1. batch (as indicated in arrival time, higher value is prioritized)
							// 2. priority
							for(int i = 0; i < tempProcesses.size(); i++){
								for(int j = i + 1; j < tempProcesses.size(); j++){
									if(tempProcesses.get(j).getArrivalTime() > tempProcesses.get(i).getArrivalTime()){
										Process tempProcess = tempProcesses.get(i);
										tempProcesses.set(i, tempProcesses.get(j));
										tempProcesses.set(j, tempProcess);
									} else if(tempProcesses.get(j).getArrivalTime() == tempProcesses.get(i).getArrivalTime()
											&& tempProcesses.get(j).getPriorityNum() < tempProcesses.get(i).getPriorityNum()){
										Process tempProcess = tempProcesses.get(i);
										tempProcesses.set(i, tempProcesses.get(j));
										tempProcesses.set(j, tempProcess);
									}
								}
							}
						
							processesInQueues.get(currentQueue).clear();
							for(Process p : tempProcesses){
								processesInQueues.get(currentQueue).add(p.getId());
							}
							
							currentId = processesInQueues.get(currentQueue).get(0);
							breakLoop6:
							for(Process p : tempList){
								if(p.getId() == currentId){
									currentProcess = p;
									break breakLoop6;
								}
							}
							// currentQueue remains the same
							// currentTimeQuantim remains the same
							
							indicator = false;
							
							log.set(currentTime-1, (log.get(currentTime-1) + "        Process " + currentId + " is being processed.\n"));
						}
						
					} else if(lastAlgorithm == 6){
						// if last queue is priority with preemption
						
						if(indicator){
							
							log.set(currentTime-1, (log.get(currentTime-1) + "        Process " + currentId + " has been paused.\n"));
							
							// get the processes and store it in an array
							ArrayList<Process> tempProcesses = new ArrayList<Process>();
							for(int id : processesInQueues.get(currentQueue)){
								breakLoop5:
								for(Process p : tempList){
									if(p.getId() == id){
										p.setArrivalTime(-1);
										tempProcesses.add(p);
										break breakLoop5;
									}
								}
							}
							
							// sort processes according to
							// 1. batch (as indicated in arrival time, higher value is prioritized)
							// 2. burst time
							for(int i = 0; i < tempProcesses.size(); i++){
								for(int j = i + 1; j < tempProcesses.size(); j++){
									if(tempProcesses.get(j).getArrivalTime() > tempProcesses.get(i).getArrivalTime()){
										Process tempProcess = tempProcesses.get(i);
										tempProcesses.set(i, tempProcesses.get(j));
										tempProcesses.set(j, tempProcess);
									} else if(tempProcesses.get(j).getArrivalTime() == tempProcesses.get(i).getArrivalTime()
											&& tempProcesses.get(j).getPriorityNum() < tempProcesses.get(i).getPriorityNum()){
										Process tempProcess = tempProcesses.get(i);
										tempProcesses.set(i, tempProcesses.get(j));
										tempProcesses.set(j, tempProcess);
									}
								}
							}
						
							processesInQueues.get(currentQueue).clear();
							for(Process p : tempProcesses){
								processesInQueues.get(currentQueue).add(p.getId());
							}
							
							currentId = processesInQueues.get(currentQueue).get(0);
							breakLoop6:
							for(Process p : tempList){
								if(p.getId() == currentId){
									currentProcess = p;
									break breakLoop6;
								}
							}
							// currentQueue remains the same
							// currentTimeQuantim remains the same
							
							indicator = false;
							
							log.set(currentTime-1, (log.get(currentTime-1) + "        Process " + currentId + " is being processed.\n"));
						}
					}
					
				}
				
			}
			
		}
		
		setAverageWaitingTime(0);
		setAverageTurnaroundTime(0);
		
		for(int i = 0; i < this.processes.size(); i++){
			Process currentProcess1 = this.processes.get(i);
			
			for(int j = ganttChart.size() - 1; j >= 0; j--){
				if(ganttChart.get(j) == currentProcess1.getId()){
					currentProcess1.setEndTime(j + 1);
					break;
				}
			}
			
			int waitingTime = ((currentProcess1.getEndTime() - currentProcess1.getArrivalTime()) - currentProcess1.getBurstTime());
			currentProcess1.setWaitingTime(waitingTime);
			setAverageWaitingTime(getAverageWaitingTime() + waitingTime);
			
			
			currentProcess1.setTurnaroundTime(currentProcess1.getBurstTime() + currentProcess1.getWaitingTime());
			setAverageTurnaroundTime(getAverageTurnaroundTime()
					+ currentProcess1.getTurnaroundTime());
		}
		
		int finalEndTime = ganttChart.size();
		
		setAverageWaitingTime(getAverageWaitingTime() / this.processes.size());
		setAverageTurnaroundTime(getAverageTurnaroundTime() / this.processes.size());
		
		setThroughput((double) this.processes.size() / finalEndTime);
		
		for(int i = 0; i < processes.size(); i++){
			for(int j = i + 1; j < processes.size(); j++){
				if(processes.get(i).getId() > processes.get(j).getId()){	
					Process temp = processes.get(i);
					processes.set(i, processes.get(j));
					processes.set(j, temp);
				}
			}
		}
		
		finalLog = new String();
		for(String s : log){
			if(s.trim().replaceAll(" +", " ").length() > 30){
				finalLog += s + "\n\n";
			}
		}
		finalLog = finalLog.trim();
		
	}

	private void setAverageWaitingTime(double averageWaitingTime) {
		this.averageWaitingTime = averageWaitingTime;
	}
	
	private void setAverageTurnaroundTime(double averageTurnaroundTime) {
		this.averageTurnaroundTime = averageTurnaroundTime;
	}
	
	private void setThroughput(double throughput) {
		this.throughput = throughput;
	}
	
	protected ArrayList<Process> getProcesses(){
		return processes;
	}
	
	protected String getFinalLog(){
		return finalLog;
	}
	
	protected ArrayList<Integer> getGanttChart(){
		return ganttChart;
	}

	protected double getThroughput() {
		return throughput;
	}

	protected double getAverageWaitingTime() {
		return averageWaitingTime;
	}

	protected double getAverageTurnaroundTime() {
		return averageTurnaroundTime;
	}

	
	
}
