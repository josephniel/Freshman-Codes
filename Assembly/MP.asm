title MP - Game

.model small 
.stack 100h
.386
.data
	cursorRow				db	15
	cursorColumn			db	11
	character				db	0
	characterColor			db	0
	
	tempCursorRow			db	0
	tempIndex				dw	0
	decrementer				dw	0
	
	keyPress				db 	0
	
	bufferRow 				EQU	25
	bufferColumn			EQU 80
	
	buffer					db	bufferRow * bufferColumn dup(0)
	
	fileBuffer				db	bufferRow * bufferColumn dup(0)
	handle 					dw	?
	file					db	"hscores.txt",0
	lowestScore 			dw  0
	
	errorOpen 				db	0ah,"Error opening the file.$"
	errorRead 				db	0ah,"Error reading the file.$"
	errorCreate 			db	0ah,"Error creating the file.$"
	errorWrite 				db 	0ah,"Error writing the file.$"
	
	delayTime				db	0
	randomNumber1			dw	0
	randomNumber2			dw	0
	randomNumber3			dw	0
	
	menuString				db	'Start Game$','High Score$','Quit$'
	menuKeys				db 	13,72,80 								; enter, up, down
	menuChoice				db 	0 										; 0 - start game, 1 - high-score, 2 - quit
	indicator				db 	4 										; 0 - start game, 1 - high-score, 2 - quit

	HS						db 'HIGH SCORE$'
	border					db '------------------------------$'
	
	nameInputString			db	'Please enter your 3-letter initial.','$'
	nameInputKeys			db 	13, 72, 75, 77, 80 						; enter, up, left, right, down
	nameInputChoice			db 	0 										; 0 - 1st letter, 1 - 2nd letter, 2 - 3rd letter
	nameInput				db	'AAA$'
	
	characterSelectString	db	'Please choose a character.$'
	characterSelectKeys		db 	13, 75, 77 								; enter, left, right
	chosenCharacter			db	0										; 0 - rabbit, 1 - pig, 2 - cat
	
	difficultySelectString	db	'Please choose difficulty.$','Turtle-like Speed$','Normal Speed$','Insanely Fast Speed$'
	chosenDifficulty		db	2
	
	rabbitSegment			db	'(\_/)$','(^_^)$','(___)$',' /\  $','RABBIT$'
	pigSegment				db	' ^__^ $','( ^o^)$','( uu )$','  /\  $',' PIG  $'
	catSegment				db	' /\_/\  $','(=^.^=)$',' | ww | $','   /\  $','   CAT   $'
	
	score					dw	0
	displayScore			dw	0	
	tempScore				dw	0
	scoreArray				db 	3 dup(0)
	
	landIndex				dw	1845,1880,1883,1904,1947,1980,1993
	landIndexMinimum		dw 	1839,1839,1839,1839,1919,1919,1919
	landIndexMaximum		dw	1919,1919,1919,1919,1999,1999,1999
	landLineSize			dw	5,2,1,6,8,3,2
	
	characterStartIndex		dw	1443
	eyeCoordinates			dw	0,0
	jumpIndicator			db	0
	goingDown				db	0
	
	obstacleLocation		dw	0
	locationDifference		dw	0
	tempLocation			dw 	0
	tempMinimum				dw	0
	numberOfObstacles		db	0
	
	endGameIndicator		db	0
.code

	; ***
	; PRESET PROCEEDURES
	; ***
	
		; *** clearRegisters - CLEARS ALL THE REGISTER FOR ASSURANCE PURPOSES
		; * ACCEPT:
		; * 	none
		; * RETURN:
		; * 	none
			clearRegisters proc
				xor ax,ax
				xor bx,bx
				xor cx,cx
				xor dx,dx
				ret
			clearRegisters endp
		
		; *** clearBuffer - CLEARS THE DISPLAY BUFFER
		; * ACCEPT:
		; * 	buffer - the display buffer
		; * RETURN:
		; * 	none
			clearBuffer proc
				mov bx, 0
				clearBufferLoop:
					mov buffer[bx], 0
					inc bx
					cmp bx, 2000
				jne clearBufferLoop
				ret
			clearBuffer endp
		
		; *** clearBuffer - CLEARS THE ALL THE DATA USED IN THE GAME
		; * ACCEPT:
		; * 	none
		; * RETURN:
		; * 	none
			clearGameData proc
				mov nameInput[0], 'A'
				mov nameInput[1], 'A'
				mov nameInput[2], 'A'
				mov nameInputChoice, 0
				mov chosenCharacter, 0
				mov chosenDifficulty, 2
				mov score, 0
				mov tempScore, 0
				mov displayScore, 0
				mov eyeCoordinates[0], 0
				mov eyeCoordinates[1], 0
				mov characterStartIndex, 1443
				mov jumpIndicator, 0
				mov goingDown, 0
				mov obstacleLocation, 0
				mov locationDifference, 0
				mov tempLocation, 0
				mov tempMinimum, 0
				mov numberOfObstacles, 0
				mov endGameIndicator, 0
				call generateRandomNumber1
				call generateRandomNumber2
				call generateRandomNumber3
				ret
			clearGameData endp
		
		; *** setDelay - CREATES A DELAY FOR ANIMATION PURPOSES
		; * ACCEPT:
		; * 	delayTime - the duration of the delay 
		; * RETURN:
		; * 	none
			setDelay proc
				mov ah, 00h
				int 1Ah
				mov bx, dx

				jmp_delay:
					int 1Ah
					sub dx, bx
					cmp dl, delayTime
				jl jmp_delay
				ret
			setDelay endp
			
		; *** generateRandomNumber - GENERATES A RANDOM NUMBER FROM 30 - 60
		; * ACCEPT:
		; * 	none
		; * RETURN:
		; * 	randomNumber - generated random number
			generateRandomNumber1 proc
				mov ah, 2ch  	; Set function code
				int 21h      	; get time from MS-DOS
				mov al, dl   	; DL=hundredths of second
				xor ah, ah
				xor dx, dx
				
				mov bx, 30
				div bx
				
				add dx, 30
				
				mov randomNumber1, dx
				ret
			generateRandomNumber1 endp
			
		; *** generateRandomNumber - GENERATES A RANDOM NUMBER FROM 40 - 60
		; * ACCEPT:
		; * 	none
		; * RETURN:
		; * 	randomNumber - generated random number
			generateRandomNumber2 proc
				mov ah, 2ch  	; Set function code
				int 21h      	; get time from MS-DOS
				mov al, dl   	; DL=hundredths of second
				xor ah, ah
				xor dx, dx
				
				mov bx, 40
				div bx
				
				add dx, 20
				
				mov randomNumber2, dx
				ret
			generateRandomNumber2 endp
			
		; *** generateRandomNumber - GENERATES A RANDOM NUMBER FROM 30 - 55
		; * ACCEPT:
		; * 	none
		; * RETURN:
		; * 	randomNumber - generated random number
			generateRandomNumber3 proc
				mov ah, 2ch  	; Set function code
				int 21h      	; get time from MS-DOS
				mov al, dl   	; DL=hundredths of second
				xor ah, ah
				xor dx, dx
				
				mov bx, 25
				div bx
				
				add dx, 30
				
				mov randomNumber3, dx
				ret
			generateRandomNumber3 endp
			
		; *** clearPage - CLEARS THE CONSOLE AND CHANGES IT TO TEXT MODE (PIXEL: 320 x 200, TEXT: 80 x 25)
		; * ACCEPT:
		; * 	none
		; * RETURN:
		; * 	none
			clearPage proc
				mov ax, 0Eh			; 320 x 200 (TEXT: 80 x 25)
				int 10h
				ret
			clearPage endp
		
		; *** positionCursor - POSITIONS THE CURSOR IN THE CONSOLE
		; * ACCEPT:
		; * 	cursorColumn - column position of the cursor
		; * 	cursorRow - row position of the cursor
		; * RETURN:
		; * 	none
			positionCursor proc
				mov dh, cursorRow
				mov dl, cursorColumn
				xor bh, bh
				mov ah, 02h
				int 10h
				ret
			positionCursor endp
			
		; *** printCharacter - PRINTS THE CHARACTER IN THE CONSOLE
		; * ACCEPT:
		; * 	character - the character to print
		; * 	characterColor - the color of the character
		; * RETURN:
		; * 	none
			printCharacter proc
				mov al, character	
				mov bl, characterColor
				xor bh, bh
				mov cx, 1
				mov ah, 09h
				int 10h
				ret
			printCharacter endp
	
		; *** printScreen - PRINTS ALL THE CHARACTERS IN THE BUFFER TO THE SCREEN
		; * ACCEPT:
		; * 	buffer - the array of characters to be printed
		; * RETURN:
		; * 	none
			printScreen proc
				mov ax, @DATA
				mov es, ax
				
				mov bp, OFFSET buffer[320] 		
				mov ah, 13H 				
				mov al, 01H					
				xor bh, bh 					
				mov bl, 0Fh 				
				mov cx, 1680				
				mov dh, 0					
				mov dl, 0			 		
				int 10H
				ret
			printScreen endp
	
	; ***
	; MENU PROCEEDURES
	; ***
	
		; *** buildMenu - BUILDS THE UI FOR THE MENU
		; * ACCEPT:
		; * 	menuString - the string to be shown at the menu
		; * RETURN:
		; * 	none
			buildMenu proc
				call clearRegisters
			
				mov al, cursorRow
				mov tempCursorRow, al
				
				mov cursorRow, 15
				printBlankPointer:
					call positionCursor
						
					mov character, ' '
					call printCharacter
					
					inc cursorRow
					cmp cursorRow, 18
				jne printBlankPointer
				
				mov al, tempCursorRow
				mov cursorRow, al
				
				call positionCursor
					
				mov character, '>'
				mov characterColor, 0Eh
				call printCharacter
				
				mov cursorRow, 15
				mov cursorColumn, 13
				mov bx, 0
				cursorRowLoop:
					mov tempIndex, bx
						call positionCursor
					mov bx, tempIndex
						lea dx, menuString[bx]
						mov ah, 09h
						int 21h
					add bx, 11
					inc cursorRow
					cmp cursorRow, 18
				jne cursorRowLoop
				
				mov al, tempCursorRow
				mov cursorRow, al
				
				ret
			buildMenu endp
	
				; *** buildLogo - BUILDS THE LOGO FOR THE MENU SCREEN
				; * ACCEPT:
				; *		none
				; * RETURN:
				; *		none
					buildLogo proc
						
						
						ret
					buildLogo endp
	
		; *** handleMenuKeyPress - GETS THE KEY AND STORES IT IN keyPress
		; * ACCEPT:
		; *		menuKeys - all possible keys to click in the menu
		; * RETURN:
		; *		keyPress - the key pressed
			handleMenuKeyPress proc
				call clearRegisters
				
				mov ah, 00h        	
				int 16h  
			
				cmp al, 0
				jne notExtendedKeys
					mov bx, 0
					checkIfOtherKey:
						cmp ah, menuKeys[bx]
						je extendedKey
						
						inc bx
						cmp bx, 3
					jne checkIfOtherKey
					ret
					extendedKey:
						mov keyPress, ah					
					ret
				notExtendedKeys:
					mov bx, 0
					checkIfAnotherKey:
						cmp al, menuKeys[bx]
						je normalKey
							
						inc bx
						cmp bx, 3
					jne checkIfAnotherKey
					ret	
					normalKey:
						mov keyPress, al
					ret
			handleMenuKeyPress endp
	
		; *** handleMenuFunction - Handles the menu function
		; * ACCEPT:
		; *		keyPress - the pressed key
		; * RETURN:
		; *		menuChoice - the current menu chosen
		; * 	indicator - similar to that of menuChoice
			handleMenuFunction proc
				call clearRegisters
				
				mov cursorColumn, 11
				
				cmp keyPress, 80
					je downArrow
				cmp keyPress, 72
					je upArrow
				cmp keyPress, 13
					je enterKey
				ret
					
				downArrow:
					cmp menuChoice, 2
					jge doNotDown
						inc menuChoice
						inc cursorRow
					doNotDown:
						call buildMenu
				ret
				upArrow:
					cmp menuChoice, 0
					jle doNotUp
						dec menuChoice
						dec cursorRow
					doNotUp:
						call buildMenu
				ret
				enterKey:
					mov al, menuChoice
					mov indicator, al
				ret
			handleMenuFunction endp
	
	
	; ***
	; HIGH SCORE PROCEEDURES
	; ***
	
		; *** buildHighScore - 
		; * 
			buildHighScore proc 
				call clearPage
			
				mov cursorRow, 6
				mov cursorColumn, 25
				call positionCursor	
				
				lea dx, border
				mov ah, 09h
				int 21h
				
				mov cursorRow, 7
				mov cursorColumn, 35
				call positionCursor
				
				lea dx, HS
				mov ah, 09h
				int 21h
				
				mov cursorRow, 8
				mov cursorColumn, 25
				call positionCursor	
				
				lea dx, border
				mov ah, 09h
				int 21h
				
				; GETS FILE CONTENT
				;opens file
				mov dx, offset file  	  ;put address of filename in dx
				mov al, 2                 ;access mode - read and write
				mov ah, 3dh               ;function 3dh - open a file
				int 21h                  
				
				jc erroropening           ;jump if carry flag set - error!
				mov handle, ax            ;save file handle for later
				
				;reads from file
				mov dx, offset fileBuffer     ;address of buffer in dx
				mov bx, handle            ;handle in bx
				mov cx, 6                ;amount of bytes to be read
				mov ah, 3fh               ;function 3fh - read from file
				int 21h  
					
				jc errorReading
				
				;closes file
				mov bx, handle           	 ;put file handle in bx
				mov ah, 3eh              	 ;function 3eh - close a file
				int 21h
				
				mov cursorRow, 10
				mov cursorColumn, 35
				call positionCursor	
				
				xor bx,bx
				while1:
				mov dl, fileBuffer[bx]
				mov ah, 02h
				int 21h
				inc bx
				cmp bx, 3
				jne while1
				
				mov cursorRow, 10
				mov cursorColumn, 41
				call positionCursor	
				
				mov bx, 3
				while2:
				mov dl, fileBuffer[bx]
				mov ah, 02h
				int 21h
				inc bx
				cmp bx, 6
				jne while2
				
				jmp noError
				errorOpening:
				mov dx, offset errorOpen
				jmp noError
				errorReading:
				mov dx, offset errorRead
				jmp noError
				errorCreating:
				mov dx, offset errorCreate
				jmp noError
				errorWriting:
				mov dx, offset errorWrite
				jmp noError
				noError:
				
				infiniteLoop:
					mov ah, 01h
					int 16h
					jnz gotKey
					jmp infiniteLoop
					gotKey:
						mov ah,00h
						int 16h	

						cmp al, 13
					je outside
				jmp infiniteLoop
				
				outside:
					mov cursorRow, 16
					mov cursorColumn, 11
					mov indicator, 4
				ret
			buildHighScore endp
	
	; ***
	; MAIN GAME PROCEEDURES
	; ***
	
		; *** characterSelect - CONTAINS ALL THE PROCEDURES FOR SELECTING A CHARACTER
		; * ACCEPT:
		; *		none
		; * RETURN:
		; *		none
			characterSelect proc
				call clearPage
				characterSelectLoop:
					call buildCharacterSelect
					call handleCharacterSelectKeyPress
					call handleCharacterSelectFunction
					cmp keyPress, 13
				jne characterSelectLoop
				ret
			characterSelect endp
			
			; *** buildCharacterSelect - BUILDS THE CHARACTER SELECT DISPLAY PANEL
			; * ACCEPT:
			; *		chosenCharacter - the indicator of the chosen character
			; *		rabbitSegment - the segments of the rabbit to be displayed
			; *		pigSegment - the segments of the pig to be displayed
			; * 	catSegment - the segments of the cat to be displayed
			; * RETURN:
			; *		none
				buildCharacterSelect proc
					
					mov cursorRow, 18
					mov cursorColumn, 22
					printBlankDiamond:
						call positionCursor
							
						mov character, ' '
						call printCharacter
							
						add cursorColumn, 16
						cmp cursorColumn, 70
					jne printBlankDiamond
							
					cmp chosenCharacter, 0
						je aRabbit
					cmp chosenCharacter, 1
						je aPig
					cmp chosenCharacter, 2
						je aCat
								
					aRabbit:
						mov cursorColumn, 22
						jmp proceedBuildCharacterSelect
					aPig:
						mov cursorColumn, 38
						jmp proceedBuildCharacterSelect
					aCat:
						mov cursorColumn, 54
						
					proceedBuildCharacterSelect:
						call positionCursor
								
						mov character, 4
						call printCharacter
						
						mov cursorRow, 8
						mov cursorColumn, 27
						call positionCursor
							
						lea dx, characterSelectString[0]
						mov ah, 09h
						int 21h
						
						mov cursorRow, 11
						mov cursorColumn, 20
						call positionCursor
						
						lea dx, rabbitSegment[0]
						mov ah, 09h
						int 21h
						
						mov cursorColumn, 36
						call positionCursor
						
						lea dx, pigSegment[0]
						mov ah, 09h
						int 21h
						
						mov cursorColumn, 53
						call positionCursor
						
						lea dx, catSegment[0]
						mov ah, 09h
						int 21h
						
						mov cursorRow, 12
						mov cursorColumn, 20
						call positionCursor
						
						lea dx, rabbitSegment[6]
						mov ah, 09h
						int 21h
						
						mov cursorColumn, 36
						call positionCursor
						
						lea dx, pigSegment[7]
						mov ah, 09h
						int 21h
						
						mov cursorColumn, 53
						call positionCursor
						
						lea dx, catSegment[9]
						mov ah, 09h
						int 21h
						
						mov cursorRow, 13
						mov cursorColumn, 20
						call positionCursor
						
						lea dx, rabbitSegment[12]
						mov ah, 09h
						int 21h
						
						mov cursorColumn, 36
						call positionCursor
						
						lea dx, pigSegment[14]
						mov ah, 09h
						int 21h
						
						mov cursorColumn, 53
						call positionCursor
						
						lea dx, catSegment[18]
						mov ah, 09h
						int 21h
						
						mov cursorRow, 14
						mov cursorColumn, 20
						call positionCursor
						
						lea dx, rabbitSegment[18]
						mov ah, 09h
						int 21h
						
						mov cursorColumn, 36
						call positionCursor
						
						lea dx, pigSegment[21]
						mov ah, 09h
						int 21h
						
						mov cursorColumn, 53
						call positionCursor
						
						lea dx, catSegment[27]
						mov ah, 09h
						int 21h
						
						mov cursorRow, 16
						mov cursorColumn, 20
						call positionCursor
						
						lea dx, rabbitSegment[24]
						mov ah, 09h
						int 21h
						
						mov cursorColumn, 36
						call positionCursor
						
						lea dx, pigSegment[28]
						mov ah, 09h
						int 21h
						
						mov cursorColumn, 53
						call positionCursor
						
						lea dx, catSegment[36]
						mov ah, 09h
						int 21h
						
					ret
				buildCharacterSelect endp
				
			; *** handleCharacterSelectKeyPress - GETS THE KEY AND STORES IT IN keyPress
			; * ACCEPT:
			; *		characterSelectKeys - all possible keys to click in the character pick panel
			; * RETURN:
			; *		keyPress - the pressed key	
				handleCharacterSelectKeyPress proc
					call clearRegisters
					
					mov ah, 00h        	
					int 16h  
					
					cmp al, 0
					jne notExtendedKeys
						mov bx, 0
						checkIfOtherKey:
							cmp ah, characterSelectKeys[bx]
							je extendedKey
								
							inc bx
							cmp bx, 5
						jne checkIfOtherKey
						ret
						extendedKey:
							mov keyPress, ah					
						ret
					notExtendedKeys:
						mov bx, 0
						checkIfAnotherKey:
							cmp al, characterSelectKeys[bx]
							je normalKey
								
							inc bx
							cmp bx, 5
						jne checkIfAnotherKey
						ret	
						normalKey:
							mov keyPress, al
						ret
					handleCharacterSelectKeyPress endp
		
			; *** handleCharacterSelectFunction - UPDATES THE chosenCharacter VARIABLE
			; * ACCEPT:
			; *		keyPress - the pressed key
			; * RETURN:
			; *		chosenCharacter - the chosen character
				handleCharacterSelectFunction proc
					
					cmp keyPress, 77
						je rightArrow
					cmp keyPress, 75
						je leftArrow
					cmp keyPress, 13
						je enterKey
					ret
					
					rightArrow:
						cmp chosenCharacter, 2
						jge doNotIncrement
							inc chosenCharacter
						doNotIncrement:
					ret
					leftArrow:
						cmp chosenCharacter, 0
						jle doNotDecrement
							dec chosenCharacter
						doNotDecrement:
					ret
					enterKey:
							
					ret
				handleCharacterSelectFunction endp
		
		; *** dificultySelect - CONTAINS ALL THE PROCEDURES FOR SELECTING GAME DIFFICULTY
		; * ACCEPT:
		; *		none
		; * RETURN:
		; *		none
			dificultySelect proc
				call clearPage
				
				mov cursorRow, 13
				mov cursorColumn, 18
				
				dificultySelectLoop:
					call buildDifficultySelect
					call handleDificultySelectKeyPress
					call handleDificultySelectFunction
					cmp keyPress, 13
				jne dificultySelectLoop
				
				mov al, chosenDifficulty
				mov delayTime, al
				
				ret
			dificultySelect endp
		
			; *** buildGameDifficultySelect - BUILDS THE GAME DIFFICULTY SELECT PANEL
			; * ACCEPT:
			; *		none
			; * RETURN:
			; *		none
				buildDifficultySelect proc
					call clearRegisters
			
					mov al, cursorRow
					mov tempCursorRow, al
					
					mov cursorRow, 13
					printBlankPointer:
						call positionCursor
							
						mov character, ' '
						call printCharacter
						
						inc cursorRow
						cmp cursorRow, 16
					jne printBlankPointer
					
					mov al, tempCursorRow
					mov cursorRow, al
					
					call positionCursor
						
					mov character, '>'
					mov characterColor, 0Eh
					call printCharacter
					
					mov cursorRow, 8
					mov cursorColumn, 27
					call positionCursor
							
					lea dx, difficultySelectString[0]
					mov ah, 09h
					int 21h
							
					mov cursorRow, 13
					mov cursorColumn, 20
					call positionCursor	
					
					lea dx, difficultySelectString[26]
					mov ah, 09h
					int 21h
						
					mov cursorRow, 14
					call positionCursor
						
					lea dx, difficultySelectString[44]
					mov ah, 09h
					int 21h
					
					mov cursorRow, 15
					call positionCursor
						
					lea dx, difficultySelectString[57]
					mov ah, 09h
					int 21h
					
					mov al, tempCursorRow
					mov cursorRow, al
					mov cursorColumn, 18
					
					ret
				buildDifficultySelect endp
				
			; *** handleDificultySelectKeyPress - GETS THE KEY AND STORES IT IN keyPress
			; * ACCEPT:
			; *		characterSelectKeys - all possible keys to click in the character pick panel
			; * RETURN:
			; *		keyPress - the pressed key	
				handleDificultySelectKeyPress proc
					call clearRegisters
					
					mov ah, 00h        	
					int 16h  
					
					cmp al, 0
					jne notExtendedKeys
						mov bx, 0
						checkIfOtherKey:
							cmp ah, menuKeys[bx]
							je extendedKey
								
							inc bx
							cmp bx, 5
						jne checkIfOtherKey
						ret
						extendedKey:
							mov keyPress, ah					
						ret
					notExtendedKeys:
						mov bx, 0
						checkIfAnotherKey:
							cmp al, menuKeys[bx]
							je normalKey
								
							inc bx
							cmp bx, 5
						jne checkIfAnotherKey
						ret	
						normalKey:
							mov keyPress, al
						ret
					ret
				handleDificultySelectKeyPress endp
				
			; *** handleDificultySelectFunction - UPDATES THE chosenDifficulty VARIABLE
			; * ACCEPT:
			; *		keyPress - the pressed key
			; * RETURN:
			; *		chosenDifficulty - the chosen difficulty
				handleDificultySelectFunction proc
					
					cmp keyPress, 72
						je upArrow
					cmp keyPress, 80
						je downArrow
					cmp keyPress, 13
						je enterKey
					ret
					
					upArrow:
						cmp chosenDifficulty, 2
						jge doNotIncrement
							inc chosenDifficulty
							dec cursorRow
						doNotIncrement:
					ret
					downArrow:
						cmp chosenDifficulty, 0
						jle doNotDecrement
							dec chosenDifficulty
							inc cursorRow
						doNotDecrement:
					ret
					enterKey:
							
					ret
				handleDificultySelectFunction endp
		
		; *** gameProcess - CONTAINS ALL THE PROCEDURES FOR THE GAME PROCESS
		; * ACCEPT:
		; *		none
		; * RETURN:
		; *		none
			gameProcess proc
				call clearBuffer
				call buildLand
				call buildCharacter
				call buildObstacles
				call buildGameBar
				call printScreen
				ret
			gameProcess endp
		
			; *** buildLand - BUILDS THE LAND
			; * ACCEPT:
			; *		landIndex - the index of the character (OFFSET = Y * 80 + X ; WHERE Y <= 25, X <= 80)
			; *		landIndexMinimum - the minimum position for the character
			; *		landIndexMaximum - the maximum position for the character
			; *		landLineSize - the size of continuously printed character
			; * RETURN:
			; *		buffer - the buffer to store the character
				buildLand proc 
					call clearRegisters
					
					mov bx, 1760		; position: 22 x 80
					landLoop:
						mov buffer[bx], '-'
						inc bx
						cmp bx, 1840
					jne landLoop
					
					mov bx, 0
					landLoop1:
						mov tempIndex, bx
					
						cmp tempScore, 80
						jne notFull
							mov tempScore, 0
						notFull:
					
						mov ax, landIndex[bx]
						mov cx, landIndexMinimum[bx] 
						mov dx, landIndexMaximum[bx] 
						mov si, landLineSize[bx]
						
						mov bx, ax
						sub bx, tempScore
					
						lineLoop:
							mov tempLocation, bx
							mov tempMinimum, cx

							sub cx, bx
							cmp cx, 0
							jl notOtherEnd
								mov locationDifference, cx
								mov bx, dx
								sub bx, locationDifference
							notOtherEnd:
								mov buffer[bx], '-'
							
							mov cx, tempMinimum
							mov bx, tempLocation
							inc bx
							dec si
						jnz lineLoop
						
						mov bx, tempIndex
				
						add bx, 2
						cmp bx, 14
					jne landLoop1
					
					ret
				buildLand endp
				
			; *** buildObstacles - BUILDS THE OBSTACLES
			; * ACCEPT:
			; *		obstacleLocation - current location of the start of obstacle
			; * RETURN:
			; *		none
				buildObstacles proc
				
					mov numberOfObstacles, 0
					
					mov ax, 80
					add ax, randomNumber1
					sub ax, decrementer
					add ax, randomNumber1
					sub ax, decrementer
					add ax, randomNumber2
					sub ax, decrementer
					add ax, randomNumber2
					sub ax, decrementer
					add ax, randomNumber3
					sub ax, decrementer
					cmp obstacleLocation, ax
					jle doNotReset
						call generateRandomNumber1
						call generateRandomNumber2
						call generateRandomNumber3
						mov obstacleLocation, 0
						add decrementer, 3
					doNotReset:
					
					cmp displayScore, 10
					jl doNotStartObstacle
						
						inc obstacleLocation
						
						mov ax, obstacleLocation
						mov tempLocation, ax
						
						call buildObstacle
						
						mov bx, randomNumber1
						sub bx, decrementer
						cmp obstacleLocation, bx
						jl doNotStartObstacle
							dec bx
								
							mov ax, obstacleLocation
							sub ax, bx
							mov tempLocation, ax
									
						call buildObstacle
							
						
						mov bx, randomNumber2
						sub bx, decrementer
						add bx, randomNumber1
						sub bx, decrementer
						cmp obstacleLocation, bx
						jl doNotStartObstacle
							dec bx
								
							mov ax, obstacleLocation
							sub ax, bx
							mov tempLocation, ax
									
						call buildObstacle
							
							
						mov bx, randomNumber3
						sub bx, decrementer
						add bx, randomNumber2
						sub bx, decrementer
						add bx, randomNumber1
						sub bx, decrementer
						cmp obstacleLocation, bx
						jl doNotStartObstacle
							dec bx
								
							mov ax, obstacleLocation
							sub ax, bx
							mov tempLocation, ax
									
						call buildObstacle
						
						
						mov bx, randomNumber3
						sub bx, decrementer
						add bx, randomNumber2
						sub bx, decrementer
						add bx, randomNumber1
						sub bx, decrementer
						add bx, randomNumber2
						sub bx, decrementer
						cmp obstacleLocation, bx
						jl doNotStartObstacle
							dec bx
								
							mov ax, obstacleLocation
							sub ax, bx
							mov tempLocation, ax
									
						call buildObstacle
						
						
						mov bx, randomNumber3
						sub bx, decrementer
						add bx, randomNumber2
						sub bx, decrementer
						add bx, randomNumber1
						sub bx, decrementer
						add bx, randomNumber2
						sub bx, decrementer
						add bx, randomNumber1
						sub bx, decrementer
						cmp obstacleLocation, bx
						jl doNotStartObstacle
							dec bx
								
							mov ax, obstacleLocation
							sub ax, bx
							mov tempLocation, ax
									
						call buildObstacle
							
					doNotStartObstacle:

					ret
				buildObstacles endp
			
				; *** buildObstacle - BUILDS AN INDIVIDUAL OBSTACLE
				; * ACCEPT:
				; *		tempLocation - current location of the individual obstacle
				; * RETURN:
				; *		buffer - the buffer to store the character
					buildObstacle proc
						
						; 18 * 80
						mov bx, 1520
						sub bx, tempLocation
						
						maxSize:
							cmp tempLocation, 80
							jge skipCreate
						completeSize:
							cmp buffer[bx-1], 0
							je notTheEnd
								mov endGameIndicator, 1
								mov tempIndex, bx
									mov bx, characterStartIndex
									add bx, 81
									mov buffer[bx], 'x'
									mov buffer[bx + 2], 'x'
								mov bx, tempIndex
							notTheEnd:
								mov buffer[bx], '^'
								add bx, 80
								cmp bx, 1760
						jl completeSize
							inc numberOfObstacles
						ret
						skipCreate:
						ret	
					buildObstacle endp
				
			; *** buildCharacter - BUILDS THE MAIN CHARACTER
			; * ACCEPT:
			; *		characterStartIndex - the index to start the character printing
			; * RETURN:
			; *		buffer - the buffer to store the character
				buildCharacter proc
					
					cmp jumpIndicator, 1
					jne doNotJump
						cmp goingDown, 0
						jne downward
							cmp characterStartIndex, 723
							jle downward
								sub characterStartIndex, 80
								cmp characterStartIndex, 723
								jne doNotJump
									mov goingDown, 1
								jmp doNotJump
						downward:
							cmp characterStartIndex, 1443
							jge doNotJump
								add characterStartIndex, 80
					doNotJump:
						
					cmp characterStartIndex, 1443
					jne jumping
						mov jumpIndicator, 0
						mov goingDown, 0
					jumping:
				
					mov bx, characterStartIndex
						
					cmp chosenCharacter, 0
					jne notABunny
						mov buffer[bx], '('
						mov buffer[bx+1], '\'
						mov buffer[bx+2], '_'
						mov buffer[bx+3], '/'
						mov buffer[bx+4], ')'
					
						add bx, 80
						mov buffer[bx], '('
						mov buffer[bx+1], '^'
						mov buffer[bx+2], '_'
						mov buffer[bx+3], '^'
						mov buffer[bx+4], ')'
							
						add bx, 80
						mov buffer[bx], '('
						mov buffer[bx+1], '_'
						mov buffer[bx+2], '_'
						mov buffer[bx+3], '_'
						mov buffer[bx+4], ')'
							
						add bx, 81
						jmp characterPrinted
					notABunny:
					cmp chosenCharacter, 1
					jne notAPig
						dec bx
						mov buffer[bx], 0
						mov buffer[bx+1], '^'
						mov buffer[bx+2], '_'
						mov buffer[bx+3], '_'
						mov buffer[bx+4], '^'
							
						add bx, 80
						mov buffer[bx], '('
						mov buffer[bx+1], ' '
						mov buffer[bx+2], '^'
						mov buffer[bx+3], 'o'
						mov buffer[bx+4], '^'
						mov buffer[bx+5], ')'
							
						add bx, 80
						mov buffer[bx], '('
						mov buffer[bx+1], ' '
						mov buffer[bx+2], 'u'
						mov buffer[bx+3], 'u'
						mov buffer[bx+4], ' '
						mov buffer[bx+5], ')'
							
						add bx, 82
						jmp characterPrinted
					notAPig:
						dec bx
						mov buffer[bx], ' '
						mov buffer[bx+1], '/'
						mov buffer[bx+2], '\'
						mov buffer[bx+3], '_'
						mov buffer[bx+4], '/'
						mov buffer[bx+5], '\'
						
						add bx, 80
						mov buffer[bx], '('
						mov buffer[bx+1], '='
						mov buffer[bx+2], '^'
						mov buffer[bx+3], '.'
						mov buffer[bx+4], '^'
						mov buffer[bx+5], '='
						mov buffer[bx+6], ')'
						
						add bx, 80
						mov buffer[bx], '|'
						mov buffer[bx+1], ' '
						mov buffer[bx+2], 'w'
						mov buffer[bx+3], 'w'
						mov buffer[bx+4], ' '
						mov buffer[bx+5], '|'
							
						add bx, 82
					characterPrinted:
						mov ax, score
						mov dx, 0
						mov cx, 2
						div cx
							
						cmp dx, 0
						jne oddN
							mov buffer[bx], '/'
							mov buffer[bx+1], '\'
						ret
						oddN:
							mov buffer[bx], '\'
							mov buffer[bx+1], '/'
						ret
				buildCharacter endp
					
			; *** buildGameBar -BUILDS THE SCORE BAR
			; * ACCEPT:
			; *		displayScore - the score to display
			; * RETURN:
			; *		none
				buildGameBar proc
					
					mov bx, 620
					mov buffer[bx], 'S'
					inc bx
					mov buffer[bx], 'C'
					inc bx
					mov buffer[bx], 'O'
					inc bx
					mov buffer[bx], 'R'
					inc bx
					mov buffer[bx], 'E'
					inc bx
					mov buffer[bx], ':'
					
					mov tempIndex, bx
					
					call scoreGenerator
					call clearRegisters
					
					mov bx, tempIndex
					
					add bx, 2
					mov al, scoreArray[0]
					mov buffer[bx], al
					
					inc bx
					mov al, scoreArray[1]
					mov buffer[bx], al
					
					inc bx
					mov al, scoreArray[2]
					mov buffer[bx], al
					
					ret
				buildGameBar endp
					
					scoreGenerator proc
						call clearRegisters
						
						mov ax, displayScore
						mov cl, 10
						
						mov bx, 3
						createScore:
							div cl
							add ah, 48
							
							dec bx
							mov scoreArray[bx], ah
							
							mov ah, 0
							cmp bx, 0
						jne createScore
						ret 
					scoreGenerator endp
					
			; *** handleGameKeyPress - GETS THE KEY AND STORES IT IN keyPress
			; * ACCEPT:
			; *		gameKeys - all possible keys to click in the game
			; * RETURN:
			; *		KeyPress - the key pressed
				handleGameKeyPress proc
					call clearRegisters
					
					mov ah, 00h        	
					int 16h  
							
					cmp al, 0
					jne notExtendedKeys
						cmp ah, 72
						je extendedKey
							ret
						extendedKey:
							mov keyPress, ah	
							mov jumpIndicator, 1
						ret
					notExtendedKeys:
						cmp al, 32
						je normalKey
							ret	
						normalKey:
							mov keyPress, al
							mov jumpIndicator, 1
						ret
				handleGameKeyPress endp
			
		; *** buildNameInput - BUILDS THE PAGE FOR NAME INPUT
		; * ACCEPT:
		; *		nameInputString - the string to be shown at the menu
		; * RETURN:
		; *		none
			buildNameInput proc 
				call clearRegisters
				
				mov cursorRow, 12
				mov cursorColumn, 35
				mov bx, 0
				nameInputCharacterLoop:
					mov tempIndex, bx
						
					call positionCursor
						
					mov bx, tempIndex
						
					mov al, nameInput[bx]
					mov character, al
					mov characterColor, 0Eh
					call printCharacter
				
					add cursorColumn, 5
				
					mov bx, tempIndex
					inc bx
					cmp bx, 3
				jne nameInputCharacterLoop
					
				mov cursorRow, 8
				mov cursorColumn, 22
				call positionCursor
		
				lea dx, nameInputString[0]
				mov ah, 09h
				int 21h
					
				mov cursorRow, 11
				cursorRowLoop:
					mov cursorColumn, 35
					cursorColumnLoop:
						call positionCursor
						
						mov characterColor, 0Fh
							
						cmp cursorRow, 11
							je upArrowButton
						cmp cursorRow, 13
							je downArrowButton

						upArrowButton:
							mov character, '^'
							call printCharacter
							jmp backToColumnLoop
						downArrowButton:
							mov character, 'v'
							call printCharacter
							jmp backToColumnLoop
						backToColumnLoop:
								
						add cursorColumn, 5
						cmp cursorColumn, 50
					jne cursorColumnLoop
					add cursorRow, 2
					cmp cursorRow, 15
				jne cursorRowLoop
					
				mov cursorRow, 15
				mov cursorColumn, 35
				printBlankDiamond:
					call positionCursor
						
					mov character, ' '
					call printCharacter
					
					add cursorColumn, 5
					cmp cursorColumn, 50
				jne printBlankDiamond
					
				cmp nameInputChoice, 0
					je firstLetterDiamond
				cmp nameInputChoice, 1
					je secondLetterDiamond
				cmp nameInputChoice, 2
					je thirdLetterDiamond
						
				firstLetterDiamond:
					mov cursorColumn, 35
					jmp proceedBuildNameInput
				secondLetterDiamond:
					mov cursorColumn, 40
					jmp proceedBuildNameInput
				thirdLetterDiamond:
					mov cursorColumn, 45
					
				proceedBuildNameInput:
					call positionCursor
						
					mov character, 4
					mov characterColor, 0Eh
					call printCharacter
					
				ret
			buildNameInput endp
			
		; *** handleNameInputKeyPress - GETS THE KEY AND STORES IT IN keyPress
		; * ACCEPT:
		; *		nameInputKeys - all possible keys to click in the name input panel
		; * RETURN:
		; *		keyPress - the pressed key	
			handleNameInputKeyPress proc
				call clearRegisters
			
				mov ah, 00h        	
				int 16h  
				
				cmp al, 0
				jne notExtendedKeys
					mov bx, 0
					checkIfOtherKey:
						cmp ah, nameInputKeys[bx]
						je extendedKey
							
						inc bx
						cmp bx, 5
					jne checkIfOtherKey
					ret
					extendedKey:
						mov keyPress, ah					
					ret
				notExtendedKeys:
					mov bx, 0
					checkIfAnotherKey:
						cmp al, nameInputKeys[bx]
						je normalKey
							
						inc bx
						cmp bx, 5
					jne checkIfAnotherKey
					ret	
					normalKey:
						mov keyPress, al
					ret
			handleNameInputKeyPress endp
	
		; *** handleNameInputFunction - UPDATES THE nameInput VARIABLE
		; * ACCEPT:
		; *		keyPress - the pressed key
		; * RETURN:
		; *		nameInput - the updated name input
			handleNameInputFunction proc
				call clearRegisters
					
				mov cursorColumn, 31
					
				cmp keyPress, 72
					je upArrow
				cmp keyPress, 77
					je rightArrow
				cmp keyPress, 80
					je downArrow
				cmp keyPress, 75
					je leftArrow
				cmp keyPress, 13
					je enterKey
				ret
					
				upArrow:
					mov bl, nameInputChoice
					xor bh, bh
						
					cmp nameInput[bx], 'A'
					jle doNotDecrement
						dec nameInput[bx]
					doNotDecrement:
						call buildNameInput
				ret
				rightArrow:
					cmp nameInputChoice, 2
					jge doNotRight
						inc nameInputChoice
					doNotRight:
						call buildNameInput
				ret
				downArrow:
					mov bl, nameInputChoice
					xor bh, bh
						
					cmp nameInput[bx], 'Z'
					jge doNotIncrement
						inc nameInput[bx]
					doNotIncrement:
						call buildNameInput
				ret
				leftArrow:
					cmp nameInputChoice, 0
					jle doNotLeft
						dec nameInputChoice
					doNotLeft:
						call buildNameInput
				ret
				enterKey:
						
				ret
			handleNameInputFunction endp
	
		print proc 
			xor dx,dx 
			mov cx, 10000
			cmp ax,0
			jne zero
			
			mov dl, '0'
			mov ah, 02h
			int 21h
			
			jmp lastline
			
			zero:
				cmp cx, ax
			jle printloop
			
			mov bx, ax 
			
			reduce:
				mov ax, cx
				mov cx, 10
				div cx
				xor dx,dx
				mov cx,ax
				cmp cx, bx
			jg reduce
			
			mov ax, bx
			
			printloop:
				div cx
				mov bx, dx 
				add ax, '0'
				mov dl, al 
				mov ah, 02h
				int 21h
				xor dx,dx 
				mov ax, cx 
				mov cx, 10
				div cx 
				mov cx, ax
				mov ax,bx 
				cmp cx, 0
			jne printloop	
			
			lastline:
			ret
		print endp
	
	; ***
	; THE MAIN PROGRAM
	; ***
	main    proc
	
	mov ax, @data
	mov ds, ax
	
		beginning:
			call clearPage
			call buildMenu
		gameMenu:
			call handleMenuKeyPress
			call handleMenuFunction
		
			cmp indicator, 2
				je endGame
			cmp indicator, 1
				je highScore
			cmp indicator, 0
				je startGame
			jmp gameMenu
			
		highScore:
			call buildHighScore
		jmp beginning
		startGame:
			call clearGameData
			
			call characterSelect
			
			call dificultySelect
			
			mov dx, score
			mov tempScore, dx
			gameLoop: 
				mov ah, 01h
				int 16h

				jnz gotKey 
				
					call gameProcess
					
					call clearRegisters
				
					mov ax, score
					mov dx, 0
					mov bx, 3
					div bx
					
					cmp dx, 0
					jne doNotIncrementdisplayScore
						inc displayScore
					doNotIncrementdisplayScore:
						inc score
						inc tempScore
						
					call setDelay
					
				cmp endGameIndicator, 1
				je semiEndGame
					
			jmp gameLoop   	
			gotKey:
				call handleGameKeyPress
				cmp endGameIndicator, 1
			jne gameLoop
			
			semiEndGame:
			
				mov cursorRow, 15
				mov cursorColumn, 11
				mov indicator, 4
			
				; GETS FILE CONTENT
				;opens file
				mov dx, offset file  	  ;put address of filename in dx
				mov al, 2                 ;access mode - read and write
				mov ah, 3dh               ;function 3dh - open a file
				int 21h                  
				
				jc erroropening           ;jump if carry flag set - error!
				mov handle, ax            ;save file handle for later
				
				;reads from file
				mov dx, offset fileBuffer     	;address of buffer in dx
				mov bx, handle            		;handle in bx
				mov cx, 6                		;amount of bytes to be read
				mov ah, 3fh               		;function 3fh - read from file
				int 21h  
					
				jc errorReading
				
				;closes file
				mov bx, handle           	 ;put file handle in bx
				mov ah, 3eh              	 ;function 3eh - close a file
				int 21h
				
				call clearRegisters
			
				; gets lowest score (last 3 bytes)
				mov lowestScore, 0
				mov dl, fileBuffer[3]
				sub dl, '0'
				mov al, 100
				mul dl
				add lowestScore, ax
				
				xor dx, dx
				mov dl, fileBuffer[4]
				sub dl, '0'
				mov al, 10
				mul dl
				add lowestScore, ax
				
				xor dx, dx
				mov dl, fileBuffer[5]
				sub dl, '0'
				add lowestScore, dx
				
				mov ax, lowestScore
				cmp ax, displayScore
				jg gameOverScreen
				
					getName:
					
					call buildNameInput
					nameInputLoop:
						call handleNameInputKeyPress
						call handleNameInputFunction
						cmp keyPress, 13
					jne nameInputLoop
					
					mov bx, 0
					nameLoop:
						mov al, nameInput[bx]
						mov fileBuffer[bx], al
						inc bx
						cmp bx, 3
					jne nameLoop
					
					mov ax, displayScore
					mov bl, 100
					div bl
					add al, '0'
					mov fileBuffer[3], al
					
					xor ah, ah
					mov bl, 10
					div bl
					add al, '0'
					mov fileBuffer[4], al
					
					add ah, '0'
					mov fileBuffer[5], ah
					
					
					; PUT HIGH SCODE PROCEDURES HERE
					;opens file
					mov dx, offset file   			;put address of filename in dx
					mov al, 2              		   ;access mode - read and write
					mov ah, 3dh              	   ;function 3DH - open a file
					int 21h                  	

					jc errorOpening          	   ;jump if carry flag set - error!
					
					;writes to file
					mov dx, offset fileBuffer  	  ;address of information to write
					mov bx, handle          	  ;file handle for file
					mov cx, 6		               ;amount of bytes to be written
					mov ah, 40h              	  ;function 40h - write to file
					int 21h                  
					
					jc errorWriting					;jump if carry flag set - error!
					
					;closes file
					mov bx, handle           	 ;put file handle in bx
					mov ah, 3eh              	 ;function 3eh - close a file
					int 21h
					
					mov cursorRow, 15
					mov cursorColumn, 11
					mov indicator, 4
					
				jmp beginning
				; ERROR MESSAGE PRINTING
				errorOpening:
					mov dx, offset errorOpen
					jmp callInt
				errorReading:
					mov dx, offset errorRead
					jmp callInt
				errorCreating:
					mov dx, offset errorCreate
					jmp callInt
				errorWriting:
					mov dx, offset errorWrite
					jmp callInt
				callInt:
					mov ah, 09h
					int 21h
					
					mov cursorRow, 15
					mov cursorColumn, 11
					mov indicator, 4
					
				jmp beginning
		
		gameOverScreen:
			mov ah, 01h
			int 16h

			mov cursorRow, 15
			mov cursorColumn, 11
			mov indicator, 4
			
			jnz gotEnterKey
		
				mov bx, 570
				mov buffer[bx], 'G'
				inc bx
				mov buffer[bx], 'A'
				inc bx
				mov buffer[bx], 'M'
				inc bx
				mov buffer[bx], 'E'
				add bx, 2
				mov buffer[bx], 'O'
				inc bx
				mov buffer[bx], 'V'
				inc bx
				mov buffer[bx], 'E'
				inc bx
				mov buffer[bx], 'R'
		
				call printScreen
		
		jmp gameOverScreen
		gotEnterKey:
			mov ah, 00h        	
			int 16h  
			
			cmp al, 13
			je beginning
		jmp gameOverScreen
		endGame:
		
		call clearPage
	
	mov ax, 4c00h
    int 21h
	
	main    endp
    end main