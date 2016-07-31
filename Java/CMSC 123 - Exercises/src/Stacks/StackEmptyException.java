package Stacks;
/**
 * Runtime exception thrown when one tries to perform operation top or
 * pop on an empty stack
 * @author Richard Bryann Chua
 *
 * Adapted from the book 
 * "Data Structures and Algorithms in Java"
 * by Michael Goodrich and Robert Tamassia
 */
public class StackEmptyException extends RuntimeException {

	private static final long serialVersionUID = 1L;

	public StackEmptyException(String err) {
		super(err);
	}
}
