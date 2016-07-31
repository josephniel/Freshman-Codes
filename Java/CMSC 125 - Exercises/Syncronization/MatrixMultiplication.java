package Syncronization;


public class MatrixMultiplication {
	private static void printMatrix(String label, int matrix[][]){
		System.out.println(label+":");
		for(int i =0; i<matrix.length; i++){
			for(int j =0; j < matrix[i].length; j++){
				System.out.print(" " + matrix[i][j]);
			}
			System.out.println();
		}
	}
	
	public static void main(String args[]){
		int MatrixA[][] ={{1,4},{2,5},{3,6}};
		int MatrixB[][] = {{8,7,6},{5,4,3}};
		
		int totalRow = MatrixA.length;
		int totalCol = MatrixB[0].length;
		
		int MatrixC[][] = new int[totalRow][totalCol];
		
		Thread threads[][] = new Thread[totalRow][totalCol];
		
		for(int row = 0; row<totalRow; row++){
			for(int col = 0; col < totalCol; col++){
				threads[row][col] = new Thread(
						new ElementThread(row, col, MatrixA,MatrixB, MatrixC));
				threads[row][col].start();
			}
		}
		
		
		for(int row = 0; row<totalRow; row++){
			for(int col = 0; col < totalCol; col++){
				try{
					threads[row][col].join();
				}
				catch(InterruptedException e){}
			}
		}
		
		printMatrix("Matrix A", MatrixA);
		printMatrix("Matrix B", MatrixB);
		printMatrix("Matrix C", MatrixC);	
		
	}
}
