<?php
/*
Date Today
The Internet's Most Notorious Dating Site

Authors: 

Joseph Niel Tuazon
	Website: http://josephnieltuazon.tumblr.com
	Email: josephnieltuazon@yahoo.com
Ruahden Dang-Awan
	Email: 
*/

    header("Content-type: text/css; charset: UTF-8");

	$background = rand(1, 5);
	
?>

html,
body {
    min-height: 100%;
}

*{
	font-family: 'Open Sans', sans-serif;
	font-size: 14px;
}
div{
	-webkit-transition: all 0.5s ease-in-out;
	-moz-transition: all 0.5s ease-in-out;
	-ms-transition: all 0.5s ease-in-out;
	-o-transition: all 0.5s ease-in-out;
	transition: all 0.5s ease-in-out;
}
p{
	font-family: 'Open Sans', sans-serif;
	font-size: 14px;
	line-height: 23px;
	margin: 0 0 23px 0;
	}
h1 {
	font-family: 'Roboto Slab', serif;
	font-weight: 400;
	line-height: 46px;
	font-size: 40px;
	margin: 0 0 23px 0;
	}
h2 {
	font-family: 'Roboto Slab', serif;
	font-weight: 800;
	font-size: 18px;
	line-height: 23px;
	margin: 0 0 23px 0;
	}
h3 {
	margin: 0 0 23px 0;
}

html,body{
	position: relative;
}

ul li{
	margin-left:30px;
}

	/* Home Page --------------------------------------------------------- */

	.home{
		width: 100%;
		height: 100%;
		overflow:hidden;
	}
	#home{
		width:200%;
		height:100%;
		position:relative;
		left: 0;
	}
		#welcome-screen{
			position: absolute;
			top: 0;
			left: 0;
			width: 50%;
			height: 100%;
			background-image: url('../images/background/bg1.png'), url('../images/background/bg2.png'), url('../images/background/<?php echo $background ?>.jpg');
			background-repeat: repeat-x, repeat-x, no-repeat;
			background-position: bottom left, top left, center center;
			background-size: auto, auto, cover;
			background-attachment: fixed;
			display: table;
		}
			#inner-welcome-screen{
				display: table-cell;
				vertical-align: middle;
				-webkit-text-shadow: 0 0 10px #282828;
				-moz-text-shadow: 0 0 10px #282828;
				text-shadow: 0 0 10px #282828;
			}
				#inner-welcome-screen .row{
					position: relative;
				}
				#inner-welcome-screen h1,
				#inner-welcome-screen h2,
				#inner-welcome-screen h3{
					color: #f5f3f0 !important;
				}
				#inner-welcome-screen h1{
					margin: 0 0 5px 0;
					font-weight: bold;
				}
				#inner-welcome-screen label{
					color: #f5f3f0;
				}
				#inner-welcome-screen .required{
					color: #f00 !important;
				}
				#inner-welcome-screen .button{
					margin:10px 0 0 0;
				}
				#page-name{
					display: table;
				}
					#page-name span{
						display: table-cell;
						vertical-align: middle;
					}
			#sign-up-form input{
				margin-bottom: 0;
			}
			#sign-up-form small.noError{
				height: 0 !important;
				visibility: hidden;
				margin-bottom: 1em;
			}
				
		#others-screen{
			width: 50%;
			height: 300%;
			position: relative;
			left: 50%;
		}
			#about-screen{
				position: absolute;
				top: 0;
				left: 0;
				width: 100%;
				height: 33.34%;
			}
			
			#why-screen{
				position: absolute;
				top: 33.34%;
				left: 0;
				width: 100%;
				height: 33.33%;
			}
			
			#creators-screen{
				position: absolute;
				top: 66.67%;
				left: 0;
				width: 100%;
				height: 33.33%;
			}
			
		
		#fixed-menu{
			position: fixed;
			bottom: 0;
			width: 100%;
			background: #000;
			z-index: 99;
		}
			.breadcrumbs{
				margin:0 auto !important;
				background-color: transparent;
				border:none;
			}
			.copyright{
				float:right;
			}
			.copyright::before{
				display:none;
			}
		#login-modal{
			display: none;
			position: fixed;
			top: 0;
			left: 0;
			width:100%;
			height: 100%;
			background-image: url('../images/background/bg3.png');
			background-repeat: repeat;
			z-index: 100;
		}
			#outer-login-message-container{
				display: table;
				width:	100%;
				height: 100%;
			}
			#login-message-container{
				display: table-cell;
				vertical-align: middle;
			}
				#login-message-container #inner{
					padding: 30px;
					background: #f5f3f0;
				}
					#inner h1{
						margin: 0 0 5px;
					}
					#inner #go-back{
						margin: 0;
					}


	/* Date List Page --------------------------------------------------------- */
	
	.date-list{
		background: none;
		height: auto !important;
	}
		#background{
			padding: 0 0 100px;
			margin:0 0 40px;
			background-color: #f2f2f2;
			background-image: url('../images/background/bgtopleft.jpg'),url('../images/background/bgtopright.jpg'),url('../images/background/bgbottomleft.jpg'),url('../images/background/bgbottomright.jpg');
			background-position: top left,top right,bottom left,bottom right;
			background-repeat: no-repeat;
		}
			#page-title{
				margin:0 auto;
				padding:50px 0 20px;
			}
				#page-title h1{
					margin: 0 0 5px 0 !important;
				}
			.inner-date-list{
				margin: 100px auto 0;
			}
				#banner ul{
					background: #000;
				}
				#banner ul li{
					margin: 0;
				}
				#banner ul li img{
					margin: 0 auto;
				}
				.date-list .box{
					background-color: #f5f3f0;
					margin-bottom: 20px;
					border: 3px solid #cacaca;
					height: 100%;
					position: relative;
					overflow: hidden;
				}
					.date-list .box img#main{
						width: 100%;
					}
					.date-list .box img#ribbon{
						position:absolute;
						top:-5px;
						left: -5px;
						z-index: 99;
					}
					.date-list .box span.date-name{
						position: absolute;
						bottom: 20px;
						right: 0;
						padding: 10px;
						font-size: 16px;
						font-weight: 400;
						text-align: right;
						background: #f5f3f0;
					}
					.date-list .box .reveal{
						position: absolute;
						top: 0;
						left: -100%;
						width: 100%;
						height: 100%;
						background: rgb(0,0,0);
					}
					.date-list .box:hover .reveal{
						left: 0;
					}
						.reveal div{
							position:absolute;
							display: table;
							width: 100%;
							height: 100%;
						}
							.reveal div span{
								display: table-cell;
								vertical-align: middle;
								padding: 0 20px;
								color: #f5f3f0;
								font-size: 18px;
								text-align: center;
							}
						.reveal .button{
							position: absolute;
							bottom: 20px;
							left: 50%;
							margin: 0 0 0 -48px;
						}
			
			.inner-date-list .orbit-container{
				background: #cacaca;
				width: 100%;
				height: 406px !important;
				border: 3px solid #cacaca;
				display: block;
			}
			.inner-date-list .orbit-container .orbit-bullets-container{
				display: none;
			}
			.orbit-container ul li{
				margin: 0;
			}
				#date-details{
					background-color: #f5f3f0;
					margin: 50px 0;
					position: relative;
					bordeR: 3px solid #cacaca;
				}
					#date-details img{
						height: 400px;
					}
						#date-details-content{
							width: 603px;
							padding: 20px 300px 20px 20px;
							position:absolute;
							right: 0;
							top: 0;
							height: 400px;
						}
							#date-details-content #other-details{
								width: 270px;
								height: 100%;
								padding: 20px;
								background: #95bc3e;
								position: absolute;
								right: 0;
								top: 0;
								font-family: 'Roboto Slab', serif;
								font-weight: 800;
								font-size: 18px;
								line-height: 23px;
								margin: 0 0 23px 0;
								color: #f5f3f0;
							}
							#other-details h2{
								color: #f5f3f0;
							}
							#other-details span{
								font-family: 'Roboto Slab', serif;
								font-weight: 800;
								font-size: 18px;
								color: #282828;
							}
							#other-details hr{
								margin: 7px 0;
								border: none;
								border-top: 1px dotted #f5f3f0;
							} 
		
		/* Schedule Page -------------------------------------------- */
		
		.alert-box{
			margin: 0;
		}
		.schedules{
			background-image:  url('../images/background/<?php echo $background ?>.jpg');
			background-repeat: no-repeat;
			background-position: center center;
			background-size: cover;
			background-attachment: fixed;
		}
			.schedules h1{
				color: #f5f3f0;
				text-shadow: 0 0 10px #282828;
				margin: 70px 0;
			}
			#schedules-container{
				background: #f5f3f0;
				padding: 50px 0 40px;
				box-shadow: 0 0 10px #282828;
			}
				.schedules .box{
					border:3px solid #cacaca;
					margin:0 0 10px;
				}
					.schedule-header{
						height: 150px;
						position: relative;
						overflow: hidden;
						background: #95bc3e;
					}
						.schedule-header img{
							height: 100%;
						}
						.schedule-header span{
							position: absolute;
							top: 20px;
							left: 120px;
						}
							.schedule-header span h2{
								margin: 0 0 5px;
								padding: 0 20px 0 0;
							}
							.schedule-header span p{
								padding: 0 20px 0 0;
							}
					.schedules .box table{
						width: 100%;
						text-align: center;
						margin: 0;
					}
						.schedules .box table tr td{
							padding: 20px 10px;
						}
							input.sched-radio{
								margin: 0 !important;
							}
							
			#sched-total-price{
				padding: 50px 0;
				margin: 0 0 40px;
			}
			#sched-total-price *{
				margin-bottom: 0;
			}
				#sched-total-price .box{
					padding: 20px;
					background: #f5f3f0;
					margin: 0 auto;
				}
				
			.disabled{
				background: #eaeaea !important;
				border-top: 1px solid #f5f3f0;
				border-bottom: 1px solid #f5f3f0;
			}
				.disabled *{
					color: #666666;
					cursor: default;
				}
			.enabled{
				border-top: 1px solid #f5f3f0;
				border-bottom: 1px solid #f5f3f0;
			}
			
			.box-disabled{
				position:absolute;
				z-index: 98;
				width: 100%;
				height: 100%;
				background: rgba(0,0,0,0.6);
				top:0;
				left:0;
			}
				.box-disabled div{
					display: table;
					width: 100%;
					height: 100%;
				}
				.box-disabled span{
					color: #f5f3f0;
					display: table-cell;
					vertical-align: middle;
					width: 100%;
					text-align: center;
					font-size: 18px;
				}
				.box-disabled span h1{
					color: #f5f3f0;
				} 
				
		/* Final Page --------------------------- */
		
		.final{
			background-image:  url('../images/background/<?php echo $background ?>.jpg');
			background-repeat: no-repeat;
			background-position: center center;
			background-size: cover;
			background-attachment: fixed;
		}
			.final .box{
				border: 3px solid #cacaca;
				padding: 40px;
				background: #f2f2f2;
				margin-bottom: 40px;
			}

		/* 404 Page ------------------------------ */

		.body404{
			background: #f5f3f0 !important;
		}
