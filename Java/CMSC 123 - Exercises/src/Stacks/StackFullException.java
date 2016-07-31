package Stacks;
/**
 * Runtime exception when one tries to push on a stack that
 * is already full.
 * 
 * @author Richard Bryann Chua
 *
 */
public class StackFullException extends RuntimeException {
	
	private static final long serialVersionUID = 1L;

	public StackFullException(String err){
		super(err);
	}
}
