package Syncronization;


class InterruptSample extends Thread{  
	public void run(){  
		System.out.println("Thread is running...");  
		try{  
			Thread.sleep(1000);  
			System.out.println("Task");  
		}catch(InterruptedException e){  
			System.out.println("Exception handled: "+e);  
		}  
		
	}  

	public static void main(String args[]){  
		InterruptSample t1=new InterruptSample();  
		t1.start();  

		System.out.println("Thread started.");
		t1.interrupt();  

	}  
}  