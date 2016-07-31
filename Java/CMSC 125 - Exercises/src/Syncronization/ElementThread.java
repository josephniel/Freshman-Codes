package Syncronization;


public class ElementThread implements Runnable{
	
	private int row;
	private int col;
	private int MatrixA[][];
	private int MatrixB[][];
	private int MatrixC[][];
	
	public ElementThread(int row, int col, int MatrixA[][],
			int MatrixB[][], int MatrixC[][]){
		this.row=row;
		this.col=col;
		this.MatrixA = MatrixA;
		this.MatrixB = MatrixB;
		this.MatrixC = MatrixC;
	}

	@Override
	public void run() {
		for(int i = 0; i <MatrixB.length; i++){
			MatrixC[row][col] += MatrixA[row][i] * MatrixB[i][col];
		}
		
	}
}