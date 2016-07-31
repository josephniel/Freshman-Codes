<%@page language="java" contentType="text/html" pageEncoding="UTF-8" import="java.util.*" %>

<!DOCTYPE HTML>
<html>
<head>
	<title>Results</title>
	
	<link rel="stylesheet" type="text/css" href="css/main.css" />
	<script src="scripts/jquery.js"></script>
	<script src="scripts/other.js"></script>
	<script src="scripts/jquery.masonry.min.js"></script>
	
</head>
<body id='results'>
	
	<h1 class='noMarginBottom'>Quine–McCluskey Algorithm</h1>
	<h3>Presented by Evangeline Louise Carandang and Joseph Niel Tuazon</h3>
	
	<%! 
	
	public int loopTerminator;
	public ArrayList<ArrayList> groupOfPossibleAnswers;
	public ArrayList<String> FinalAnswers;
	public String[] letters = {"A","B","C","D","E","F","G","H","I","J"};
	
	public String convertToDecimalRepresentation(ArrayList<Integer> array){
	
		String returnString = new String();
		
		returnString = returnString + "(";
		for(int a : array){
			returnString = returnString + a + ", ";
		}
		returnString = returnString.substring(0,returnString.length()-2) + ")";
		
		return returnString;
	}
	
	public String convertToLetters(String binary, int maxLengthOfBinary){
		String resultingString = new String();
		for(int j = 0; j < maxLengthOfBinary; j++){
			String tempDigit = binary.substring(j,j+1);
			if(tempDigit.equals("1")){
				resultingString = resultingString + letters[j];
			}
			else if(tempDigit.equals("0")){
				resultingString = resultingString + letters[j] + "'";
			}
		}
		return resultingString;
	}
	
	public ArrayList<String> compareBinaryDigits(ArrayList<String> first, ArrayList<String> second){
		
		ArrayList<String> returnArrayString = new ArrayList<String>();
		
		String firstBinary = first.get(0);
		String secondBinary = second.get(0);
		
		int repeatIndicator = 0;
		String tempReturnString = new String();
		
		for(int i = 0; i < firstBinary.length(); i++){
			if(!firstBinary.substring(i,i+1).equals(secondBinary.substring(i,i+1))){
				repeatIndicator++;
				tempReturnString = tempReturnString + "-";
			}
			else{
				tempReturnString = tempReturnString + firstBinary.substring(i,i+1);
			}
		}
		
		if(repeatIndicator == 1){
			returnArrayString.add(tempReturnString);
	
			String formattedFirstDecimal = first.get(1).replaceAll("\\(","").replaceAll("\\)","");
			String formattedSecondDecimal = second.get(1).replaceAll("\\(","").replaceAll("\\)","");
			
			String formattedResultDecimal = "(" + formattedFirstDecimal + ", " + formattedSecondDecimal + ")";
			
			returnArrayString.add(formattedResultDecimal); 
			returnArrayString.add("0");			

		}
		else{
			return null;
		}
		
		return returnArrayString;
	}
	
	%>

	<% 
		String input = request.getParameter("input"); 							
		
		input = input.replaceAll(","," "); 										
		
		StringTokenizer token = new StringTokenizer(input); 					
		int tokenCount = token.countTokens(); 									
		
		ArrayList<Integer> inputArray = new ArrayList<Integer>(); 				
		
		int tempTokenCount = tokenCount;
		for(int i = 0; i < tempTokenCount; i++){									
			String current = token.nextToken();									
			int currentNumber = Integer.parseInt(current);						
																				
			if(!inputArray.contains(currentNumber)){								
				inputArray.add(currentNumber);									
			}																	
			else{																
				tokenCount = tokenCount - 1;									
			}																	
		}																		
	
		Collections.sort(inputArray); 											
		
		String[][] BinaryInputArray = new String[tokenCount][4];			
		int maxLengthOfBinary = 0,												
			numberOfGroups = 0;													
			
		ArrayList<Integer> numberOfOnesGroup = new ArrayList<Integer>();		
		
		for(int i = 0; i < tokenCount; i++){
		
			String binaryString = Integer.toBinaryString(inputArray.get(i)); 	
			BinaryInputArray[i][0] = binaryString;								
			
			BinaryInputArray[i][1] = String.valueOf(inputArray.get(i));			
			
			int numberOfOnes = 0;												
			
			for(int j = 0; j < binaryString.length(); j++){						
				if(binaryString.substring(j,j+1).equals("1")){					 
					numberOfOnes++;												
				}																
			}																	
				
			if(!numberOfOnesGroup.contains(numberOfOnes)){	
				numberOfOnesGroup.add(numberOfOnes);
			}
			
			BinaryInputArray[i][2] = String.valueOf(numberOfOnes);				
			BinaryInputArray[i][3] = "0";										
			
			if(maxLengthOfBinary < binaryString.length()){						 
        		maxLengthOfBinary = binaryString.length();						
			}																	
		}
	
		numberOfGroups = numberOfOnesGroup.size();								
		
		for(int i = 0; i < tokenCount; i++){									
			while(BinaryInputArray[i][0].length() != maxLengthOfBinary){				 
				BinaryInputArray[i][0] = "0" + BinaryInputArray[i][0];			
			}																	
		}	

		ArrayList<ArrayList> superArray = new ArrayList<ArrayList>();
		ArrayList<ArrayList> mainArray = new ArrayList<ArrayList>();

		for(int i = 0; i < numberOfGroups;i++){
			ArrayList<ArrayList> groupArray = new ArrayList<ArrayList>();
			for(int j = 0; j < tokenCount; j++){
				ArrayList<String> nodeArray = new ArrayList<String>();
				if(numberOfOnesGroup.get(i) == Integer.parseInt(BinaryInputArray[j][2])){
					for(int k = 0; k < 4; k++){
						if(k != 2){
							nodeArray.add(BinaryInputArray[j][k]);
						}
					}
					groupArray.add(nodeArray);
				}
			}
			mainArray.add(groupArray);
		}

		superArray.add(mainArray);
		
		loopTerminator = 0;
		while(loopTerminator == 0){
			
			int numberOfComparisons = numberOfGroups - 1;
			
			ArrayList<ArrayList> currentTable = superArray.get(superArray.size()-1);
			ArrayList<ArrayList> newTable = new ArrayList<ArrayList>();
			
			for(int i = 0; i < numberOfComparisons; i++){
				
				ArrayList<ArrayList> firstGroupToCompare = currentTable.get(i);
				ArrayList<ArrayList> secondGroupToCompare = currentTable.get(i+1);
				
				ArrayList<ArrayList> resultingGroup = new ArrayList<ArrayList>();
				
				for(int j = 0; j < firstGroupToCompare.size(); j++){
					for(int k = 0; k < secondGroupToCompare.size(); k++){
						
						ArrayList firstNumberToCompare = firstGroupToCompare.get(j);
						ArrayList secondNumberToCompare = secondGroupToCompare.get(k);
						
						ArrayList resultingNumber = compareBinaryDigits(firstNumberToCompare,secondNumberToCompare);
						
						if(resultingNumber != null){
							firstNumberToCompare.set(2,"1");
							secondNumberToCompare.set(2,"1");
							
							int repeatedNumberIndicator = 0;
							
							for(int l = 0; l < resultingGroup.size(); l++){
								ArrayList tempNode = resultingGroup.get(l);
								if(tempNode.contains(resultingNumber.get(0))){
									repeatedNumberIndicator = 1;
								}
							}
							
							if(repeatedNumberIndicator == 0){
								resultingGroup.add(resultingNumber);
							}
						}
						
						firstGroupToCompare.set(j, firstNumberToCompare);
						secondGroupToCompare.set(k, secondNumberToCompare);
						
					}
				}
				
				if(resultingGroup.size()!=0){
					newTable.add(resultingGroup);
				}
				else{
					loopTerminator = 1;
				}
				
				currentTable.set(i, firstGroupToCompare);
				currentTable.set(i+1, secondGroupToCompare);		
			}
			
			superArray.set(superArray.size()-1, currentTable);
			
			numberOfGroups = newTable.size();
			
			if(numberOfGroups == 0){
				loopTerminator = 1;
			}
			else{
				superArray.add(newTable);
			}
			
		}
		
	%>
	
	<h2 class='alignLeft stepTitle'>Step 1: Finding Prime Implicants</h2>
	
	<div id='tableContainer'>
	
	<%
	
		groupOfPossibleAnswers = new ArrayList<ArrayList>();
	
		for(int i = 0; i < superArray.size(); i++){
		
			ArrayList<ArrayList> tempTable = superArray.get(i);
			
			%>
			
				
		<div class='item'>
			
			<h2>Table <%=i+1%></h2>
			<table>
					
				<tr><th>Binary</th><th>Decimal</th></tr>
				<tr><td colspan=2><hr /></td></tr>
			<%
			
			for(int j = 0; j < tempTable.size(); j++){
				ArrayList<ArrayList> tempGroup = tempTable.get(j);
				for(int k = 0; k < tempGroup.size(); k++){	
					ArrayList<String> tempNode = tempGroup.get(k);
					%>
						<tr <%if(tempNode.get(2).equals("0")){%>class='highlight'<%}%>>
							<td id='binary'>
								<%=tempNode.get(0)%>
							
								<%if(tempNode.get(2).equals("1")){%>
									<img src='images/check.png' class='check'/>
								<%}else{
									groupOfPossibleAnswers.add(tempNode);}%>
							</td> 
							<td id='decimal'><%=tempNode.get(1)%></td>
						</tr>
					<%
				}	
				if(j!=tempTable.size()-1){%>
					<tr><tr><td colspan=2><hr /></td></tr></tr>
				<%
				}
			}
			%>
			
			</table>
		</div>
		
		<%}%>
			
	</div>
			
			<%
			ArrayList<String> intialProduct = new ArrayList<String>();
			ArrayList<Integer> includedDecimals = new ArrayList<Integer>();
			ArrayList<ArrayList> ArrayListRepresentationOfDecimals = new ArrayList<ArrayList>();
			
			for(int i = 0; i < groupOfPossibleAnswers.size(); i++){
				String tempBinary = groupOfPossibleAnswers.get(i).get(0).toString();
				String resultingString = new String();
				for(int j = 0; j < maxLengthOfBinary; j++){
					String tempDigit = tempBinary.substring(j,j+1);
					if(tempDigit.equals("1")){
						resultingString = resultingString + letters[j];
					}
					else if(tempDigit.equals("0")){
						resultingString = resultingString + letters[j] + "'";
					}
				}
				intialProduct.add(resultingString);
				
				String tempDecimal = groupOfPossibleAnswers.get(i).get(1).toString();
				tempDecimal = tempDecimal.replaceAll("\\(","").replaceAll("\\)","").replaceAll(","," ");
				
				StringTokenizer tokenizer = new StringTokenizer(tempDecimal);
				while(tokenizer.hasMoreTokens()){
					int tempString = Integer.parseInt(tokenizer.nextToken());
					if(!includedDecimals.contains(tempString)){
						includedDecimals.add(tempString);
					}
				}
				
				ArrayList<Integer> tempNode = new ArrayList<Integer>();
				
				tokenizer = new StringTokenizer(tempDecimal);
				while(tokenizer.hasMoreTokens()){
					int tempString = Integer.parseInt(tokenizer.nextToken());
					tempNode.add(tempString);
				}
				
				ArrayListRepresentationOfDecimals.add(tempNode);
				
			}
			
			Collections.sort(includedDecimals);

			int[] countIndicator = new int[includedDecimals.size()];
			
			for(int i = 0; i < includedDecimals.size(); i++){
				countIndicator[i] = 0;
			}
			
			String initialStringAnswer = new String();
			for(String temp : intialProduct){
				initialStringAnswer = initialStringAnswer + temp + " + ";
			}
			initialStringAnswer = initialStringAnswer.substring(0,initialStringAnswer.length()-2);
			
			%>
			
			<h2 class='alignLeft marginBottom'>
				Initial Answer: 
					<%if(initialStringAnswer.trim().length() != 0){%>
						<span><%=initialStringAnswer%></span>
					<%}else{%>
						<span>1</span>
					<%}%>
			</h2>
			
			<%
			for(int i = 0; i < intialProduct.size(); i++){
				for(int j = 0; j < includedDecimals.size(); j++){
					if(ArrayListRepresentationOfDecimals.get(i).contains(includedDecimals.get(j))){
						countIndicator[j]++;
					}
				}
			}
			
			ArrayList<Integer> prime = new ArrayList<Integer>();
			for(int i = 0; i < includedDecimals.size(); i++){
				if(countIndicator[i] == 1){
					prime.add(includedDecimals.get(i));
				}
			}
			
			ArrayList<ArrayList> Primes = new ArrayList<ArrayList>();
			ArrayList<ArrayList> notPrimes = new ArrayList<ArrayList>();
			ArrayList<ArrayList> TempArrayListRepresentationOfDecimals = new ArrayList<ArrayList>();
			
			for(ArrayList a : ArrayListRepresentationOfDecimals){
				TempArrayListRepresentationOfDecimals.add(a);
			}
			
			for(int i = 0; i < TempArrayListRepresentationOfDecimals.size(); i++){
				int isPrime = 0;
				for(int j = 0; j < prime.size(); j++){
					if(TempArrayListRepresentationOfDecimals.get(i).contains(prime.get(j))){
						isPrime++;
					}
				}
				if(isPrime == 0){
					notPrimes.add(groupOfPossibleAnswers.get(i));
				}
				else{
					Primes.add(groupOfPossibleAnswers.get(i));
					ArrayList<String> tempArrayList = new ArrayList<String>();
					tempArrayList.add("~");
					TempArrayListRepresentationOfDecimals.set(i, tempArrayList);
				}
			}
			
			
			ArrayList<ArrayList> newArrayListRepresentationOfDecimals = new ArrayList<ArrayList>(TempArrayListRepresentationOfDecimals);
			ArrayList<ArrayList> temp = new ArrayList<ArrayList>();
			ArrayList<String> tempAr = new ArrayList<String>(Arrays.asList("~"));
			
			temp.add(tempAr);
			newArrayListRepresentationOfDecimals.removeAll(temp);
			
			ArrayList<Integer> notPrimesRemainingDecimal = new ArrayList<Integer>();
			
			for(int i = 0; i < includedDecimals.size(); i++){
				if(countIndicator[i] != 1){
					notPrimesRemainingDecimal.add(includedDecimals.get(i));
				}
			}
			
			for(int j = 0; j < Primes.size(); j++){
				String tempDecimal = Primes.get(j).get(1).toString();
				tempDecimal = tempDecimal.replaceAll("\\(","").replaceAll("\\)","").replaceAll(",","");
					
				StringTokenizer tokens = new StringTokenizer(tempDecimal);
			
				while(tokens.hasMoreTokens()){
					int tempNumber = Integer.parseInt(tokens.nextToken());
					for(int i = 0; i < notPrimesRemainingDecimal.size(); i++){
						int tempIndex = includedDecimals.indexOf(notPrimesRemainingDecimal.get(i));
						if(tempNumber == notPrimesRemainingDecimal.get(i)){
							notPrimesRemainingDecimal.remove(i);
							countIndicator[tempIndex] = 1;
						}
					}
				}
			}
			
			if(notPrimesRemainingDecimal.size()!=0){	
	
				ArrayList<ArrayList> PetrickMethod = new ArrayList<ArrayList>();
				
				for(int i = 0; i < newArrayListRepresentationOfDecimals.size(); i++){
				
					ArrayList<Integer> firstArray = newArrayListRepresentationOfDecimals.get(i);
					for(int j = 0; j < newArrayListRepresentationOfDecimals.size(); j++){
						
						ArrayList<Integer> secondArray = newArrayListRepresentationOfDecimals.get(j);
						for(int k = 0; k < newArrayListRepresentationOfDecimals.size(); k++){
						
								ArrayList<Integer> tempArray = new ArrayList<Integer>();
								
								tempArray.addAll(firstArray);
								tempArray.addAll(secondArray);
								
								ArrayList<Integer> temperFirstArray = new ArrayList<Integer>();
								ArrayList<Integer> temperSecondArray = new ArrayList<Integer>();
								
								temperFirstArray.addAll(firstArray);
								temperSecondArray.addAll(secondArray);
							
								temperFirstArray.removeAll(notPrimesRemainingDecimal);
								temperSecondArray.removeAll(notPrimesRemainingDecimal);
							
								ArrayList<Integer> tempestFirstArray = new ArrayList<Integer>();
								ArrayList<Integer> tempestSecondArray = new ArrayList<Integer>();
								
								tempestFirstArray.addAll(firstArray);
								tempestSecondArray.addAll(secondArray);
							
								tempestFirstArray.removeAll(temperFirstArray);
								tempestSecondArray.removeAll(temperSecondArray);
							
								tempestFirstArray.removeAll(tempestSecondArray);
							
								int indi = 0;
								if(tempArray.containsAll(notPrimesRemainingDecimal)){
									ArrayList<ArrayList> innerTempArray = new ArrayList<ArrayList>();

									if(tempestFirstArray.size()!=0){
										innerTempArray.add(firstArray);
										innerTempArray.add(secondArray);
									}
									else{
										innerTempArray.add(firstArray);
									}
							
									PetrickMethod.add(innerTempArray);
								}
						}		
					}
				}
				
				ArrayList<ArrayList> newPetrickMethod = new ArrayList<ArrayList>();
				for(Object a : PetrickMethod){
					ArrayList<String> inner = new ArrayList<String>();
					for(Object b : (ArrayList)a){
						String decimalRepresentation = convertToDecimalRepresentation((ArrayList) b);
						for(int i = 0; i < groupOfPossibleAnswers.size(); i++){
							String decimalOfPossible = groupOfPossibleAnswers.get(i).get(1).toString();
							if(decimalRepresentation.equals(decimalOfPossible)){
								inner.add(convertToLetters(groupOfPossibleAnswers.get(i).get(0).toString(), maxLengthOfBinary));
								Collections.sort(inner);
							}
						}
					}
					if(!newPetrickMethod.contains(inner)){
						newPetrickMethod.add(inner);
					}
				}
			
				
				FinalAnswers = new ArrayList<String>();
				if(newPetrickMethod.size()!=0){
					for(int i = 0; i < newPetrickMethod.size(); i++){
						String tempString = new String();
						for(int j = 0; j < newPetrickMethod.get(i).size(); j++){
							tempString = tempString + newPetrickMethod.get(i).get(j).toString() + " + ";
						}
						tempString = tempString.substring(0,tempString.length()-2);
						tempString.trim();
						
						for(int j = 0; j < Primes.size(); j++){
							tempString = convertToLetters(Primes.get(j).get(0).toString(), maxLengthOfBinary) + " + " + tempString;
						}
						FinalAnswers.add(tempString);
					}
				}
				else if(Primes.size() != 0){
					String tempString = new String();
					for(int j = 0; j < Primes.size(); j++){
						tempString = tempString + convertToLetters(Primes.get(j).get(0).toString(), maxLengthOfBinary) + " + ";
					}
					tempString = tempString.substring(0,tempString.length()-2);
					tempString.trim();
					FinalAnswers.add(tempString);
				}
				
			}
			else{
				FinalAnswers = new ArrayList<String>();
				if(Primes.size() != 0){
					String tempString = new String();
					for(int j = 0; j < Primes.size(); j++){
						tempString = tempString + convertToLetters(Primes.get(j).get(0).toString(), maxLengthOfBinary) + " + ";
					}
					tempString = tempString.substring(0,tempString.length()-2);
					tempString.trim();
					FinalAnswers.add(tempString);
				}
			}
			%>

		
			<h2 class='alignLeft'>Step 2: Prime Implicant Chart</h2>
			
			<div id='primeImplicantsTableContainer'>
			<table id='primeImplicantsTable'>
				<tr>
					<th>Minterms</th>
					<%
					for(int i : includedDecimals){
						%>
							<th><%=i%></th>
						<%
					}
					%>
				</tr>
				
				<%for(int i = 0; i < intialProduct.size(); i++){%>
				
							<%int l = 0;
								for(int k : notPrimesRemainingDecimal){
									if(ArrayListRepresentationOfDecimals.get(i).contains(k) && l == 0){
										l = 1;
									}
								}
								if(l == 0){
									%>
										<tr>
										<td>
										<img src='images/check.png' class='check' id='primeImplicantCheck'/>
									<%
								}
								else{
									%>
										<tr class='highlight'>
										<td>
									<%
								}
							%>
								
							<%=groupOfPossibleAnswers.get(i).get(1)%>
						</td>
						
						<%for(int j = 0; j < includedDecimals.size(); j++){%>
							<td>
								<%if(ArrayListRepresentationOfDecimals.get(i).contains(includedDecimals.get(j))){%>
									X
								<%}%>
							</td>
						<%}%>
					</tr>
					<%
				}
				%>
				
				<tr>
					<td>Prime</td>
					<%
					for(int j = 0; j < includedDecimals.size(); j++){%>
						<td>
						<%if(countIndicator[j]==1){%>
						<img src='images/check.png' class='check' id='primeImplicantCheckCount'/>
						<%}%>
						</td>
					<%}%>
				</tr>
			
			</table>
			</div>
			
			<h1>
				Final Answer(s): <br /><br />
				<%
				if(initialStringAnswer.trim().length() != 0){
					for(int i = 0; i < FinalAnswers.size(); i++){
						%>
							<span> <%=FinalAnswers.get(i)%> </span> <%if(i!=FinalAnswers.size()-1){%> & <%}%><br />
						<%
					}
				}
				else{
						%>
							<span> 1 </span>
						<%
				}
				%>
			</h1>
			
</body>
</html>