<%@page language="java" contentType="text/html" pageEncoding="UTF-8" import="java.lang.*" %>
<!DOCTYPE HTML>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Evaluate Random Number Experiment</title>
  
  <style type="text/css">
	*{
		margin:0;padding:0;
	}
	html{
		min-height:100%;
		position:relative;
	}
	body{
		background-image: url('Images/pattern36.png');
		font-family: Arial;
		position:absolute;
		width:100%;
		height:100%;
		min-width:500px;
		min-height:440px;
	}
	div{
		width:100%;
		height:400px;
		overflow:auto;
		position:absolute;
		top:50%;
		margin-top: -220px;
		padding:20px 0;
		color: #fff;
		background-image: url('Images/low_contrast_linen.png');
		box-shadow: 0 0 10px #000;
	}
	a{
		color: #fff;
		font-weight: bold;
		position:absolute;
		bottom:20px;
	}
	h1{
		position: absolute;
		width:700px;
		left:50%;
		top:50%;
		margin:-40px 0 0 -350px;
	}
	table{
		text-align:center;
	}
	table td,
	table th{
		width: 350px !important;
		border: 1px solid #fff;
		border-top: none;
		border-left: none;
		border-right: none;
		padding: 5px 0;
	}
  </style>
  
</head>
     
<body>
	
	<% 
		int nmin = Integer.parseInt(request.getParameter("NMin"));
		int nmax = Integer.parseInt(request.getParameter("NMax"));
		int ntrials = Integer.parseInt(request.getParameter("NTrials"));
		
		if(nmin > nmax){
	%>
	
	<div>
		<center>
		<h1>Error: Minimum number is greater than maximum number. Please try again.</h1>
		<a href="CollectUserInput.jsp">Go Back</a>
		</center>
	</div>
	
	<%
		}
		else{
			int[][] frequency = new int[2][nmax-nmin+1];
		
			for(int i = nmin, j = 0; i <= nmax; i++, j++){
				frequency[0][j] = i;
				frequency[1][j] = 0;
			}
		
			for(int i = 0; i != ntrials; i++){
				int j = nmin + (int)(Math.random() * ((nmax - nmin) + 1));
				for(int k = nmin, l = 0; k <= nmax; k++, l++){
					if(frequency[0][l] == j){
						frequency[1][l]++;
					}
				}
			}
	%>
	
	<div>
	<center>
	<table>
		<tr>
			<th>Number</th>
			<th>Relative Frequency</th>
		</tr>
	<%
			for(int i = 0; i != nmax-nmin+1; i++){
				Float a = new Float(frequency[1][i]);
				Float b = new Float(ntrials);
				Float c = a/b * 100;
			
	%>
		<tr>
			<td><%=frequency[0][i]%></td> 
			<td><%=String.format("%.2f", c)%>%</td>
		</tr>
	<%
			}
		}
	%>
	</table>
	</center>
	</div>
</body>
</html>