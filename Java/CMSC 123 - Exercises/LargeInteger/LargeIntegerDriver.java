package LargeInteger;
/*
 * LargeInteger driver created by Joseph Niel Tuazon
 */


public class LargeIntegerDriver {

	public static void main(String[] args){
		
		LargeInteger large1 = new LargeInteger("-123456789101112131415161718192021222324252627282930313233343536373839404142434445464748495051525354555657585960");
		LargeInteger large2 = new LargeInteger("1012345678910111213141516171819202122232425262728293132333435363738394041424344454647484950515253545556575");
		
		LargeInteger sum = large1.add(large2);
		LargeInteger difference = large1.minus(large2);
		LargeInteger product = large1.times(large2);
		
		System.out.println("1st LargeInteger: " + large1);
		System.out.println("\n2nd LargeInteger: " + large2);
		System.out.println("\nSum of 1st and 2nd: " + sum);
		System.out.println("\nDifference of 1st and 2nd: " + difference);
		System.out.println("\nProduct of 1st and 2nd: " + product);
		
		// Value came from http://www.javascripter.net/math/calculators/100digitbigintcalculator.htm
		//System.out.println(difference.equals("-123457801446791041526374859708193041526374859708193041526475869809203142536475869809203142536475869809203142535"));
		//System.out.println(sum.equals("-123455776755433221303948576675849403122130394857667584940211202938475665748393021120293847566574839302112029385"));
		System.out.println(product.equals("-124980946978627779330876462832694880754293368343264315639828548529990250532062901239825054030778245685196941487297615763634621801104503859015612609092557026132140544914401632794622996612280327918497183847349105687000"));
	}
}
