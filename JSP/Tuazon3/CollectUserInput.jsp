<%@page language="java" contentType="text/html" pageEncoding="UTF-8" %>
<!DOCTYPE html>
<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
   <title>Collect User Input</title>
   
   <style type="text/css">
		*{
			margin:0; padding:0;
		}
		html{
			min-height:100%;
			position:relative;
		}
		body{
			position:absolute;
			width:100%;
			height:100%;
			min-height: 376px;
			min-width: 300px;
			background-image: url('Images/pattern36.png');
			font-family: arial;
		}
		div{
			background-image: url('Images/low_contrast_linen.png');
			background-color: #F5F5F5;
			box-shadow: 0px 0px 10px #000;
			width:100%;
			height:376px;
			position: absolute;
			top:50%;
			margin-top:-188px;
			left:0;
		}
		form{
			width:300px;
		}
		h1{
			padding:50px 0;
			color: #fff;
		}
		select{
			float:right;
			width:80px;
		}
		input{
			width:80px;
			height:25px;
			margin: 30px 0 0;
		}
		span{
			float:left;
			text-align: left;
			width:170px;
			font-size:20px;
			color: #fff;
		}
		select,
		span{
			height:25px;
			margin:0 0 20px;
		}
		
   </style>
   
</head>
<body>

	<div>
	<center>
	<h1>Collect User Input</h1>
   
	<form action="EvaluateRandomNumberExperiment.jsp" method="get">
		
		<p>
			<span>NTrials:</span>
			<select name='NTrials'>
				<% for(int i = 1; i < 1000; i++) { %>
					<option value="<%=i%>"><%=i%></option>
				<% } %>
			</select>
		</p>
		
		<p>
			<span>NMin:</span>
			<select name='NMin'>
				<% for(int i = 1; i < 100; i++) { %>
					<option value="<%=i%>"><%=i%></option>
				<% } %>
			</select>
		</p>
			
		<p>
			<span>NMax:</span>
			<select name='NMax'>
				<% for(int i = 2; i < 101; i++) { %>
					<option value="<%=i%>"><%=i%></option>
				<% } %>
			</select>
		</p>
		
		<center>
			<input type="submit" value="Submit" />
		</center>
		
	</form>
	</center>
	</div>
   
</body>
</html>