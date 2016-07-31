.model small 
.data
	delayTime db 2
	randomNumber db 0
	
	foodInitializer db 0
	foodPositionRow db 0
	foodPositionColumn db 0
	
	headCharacter db 60
	headRowPosition db 12
	headColumnPosition db 40
	
	bodyCharacter db 4
	
	tempIndex dw 0
	
	snakeLength dw 0
	snakeDirection db 100
	snakeBodyPositionRows db 100 dup(0)
	snakeBodyPositionColumns db 100 dup(0)
	
	score db 3 dup(0)
	indicator db 0
	endOfSnake db 0
	
	string db 'Score:$','Game Over$'
	horizontal db '--------------------------------------------------------------------------------$'
	
	foodOnBody db 1
	
	cursorRow db 0
	cursorColumn db 0
	
	possibleKeys db 72,75,77,80,97,100,115,119,27
	
.stack 100h
.code
	reset proc
		xor ax,ax
		xor bx,bx
		xor cx,cx
		xor dx,dx
		ret
	reset endp
	
	delay proc
		mov ah, 00
		int 1Ah
		mov bx, dx

		jmp_delay:
			int 1Ah
			sub dx, bx
			cmp dl, delayTime
		jl jmp_delay
		ret
	delay endp
	
	mainProccesses proc
		call snakeDirectionSetter
		cmp endOfSnake, 1
			je endSnake
			call refreshPage
			call snakeBuilder
			call foodMaker
			call scorePrinter
			call headerPrinter
		endSnake:
		ret
	mainProccesses endp
	
		refreshPage proc
			mov ax, 0600h
			mov bh, 07h
			xor cx, cx
			mov dx, 184fh
			int 10h
			ret
		refreshPage endp
	
		snakeDirectionSetter proc
			
			call delay
			call reset
					
				cmp snakeDirection, 72
					je moveUp
				cmp snakeDirection, 119
					je moveUp
					
				cmp snakeDirection, 77
					je moveRight
				cmp snakeDirection, 100
					je moveRight
					
				cmp snakeDirection, 80
					je moveDown
				cmp snakeDirection, 115
					je moveDown
				
				cmp snakeDirection, 75
					je moveLeft
				cmp snakeDirection, 97
					je moveLeft
		
			moveUp:
				mov dh, headRowPosition
				sub dh, 1
					
				cmp dh, 3
				jge goUp
					mov dh, 24
				goUp:
					mov headRowPosition, dh
					mov headCharacter, 94
					mov delayTime, 2
			jmp checkSnake
			moveRight:
				mov dh, headColumnPosition
				add dh, 1
					
				cmp dh, 79
				jle goRight
					mov dh, 0
				goRight:
					mov headColumnPosition, dh
					mov headCharacter, 62
					mov delayTime, 2
			jmp checkSnake
			moveDown:
				mov dh, headRowPosition
				add dh, 1
					
				cmp dh, 24
				jle goDown
					mov dh, 3
				goDown:
					mov headRowPosition, dh
					mov headCharacter, 86
					mov delayTime, 2
			jmp checkSnake
			moveLeft:
				mov dh, headColumnPosition
				sub dh, 1
					
				cmp dh, 0
				jge goLeft
					mov dh, 79
				goLeft:
					mov headColumnPosition, dh
					mov headCharacter, 60
					mov delayTime, 2
			
			checkSnake:
			
			call reset
			
			; PUT HERE THE LOOP FOR CHECKING IF CURRENT POSITION IS AT THE BODY
				cmp snakeLength, 0
				je constructSnake ; skips collision check if head only
			
				mov bx, 0
				checkCollision:
					mov ah, snakeBodyPositionRows[bx]
					mov al, snakeBodyPositionColumns[bx]
					
					cmp ah, headRowPosition
					jne continueChecking
						cmp al, headColumnPosition
						jne continueChecking
							mov endOfSnake, 1
							ret
					continueChecking:
					inc bx
					cmp bx, snakeLength
				jne checkCollision
			
			constructSnake:
				call reset
				mov bx, snakeLength
				
				cmp bx, 0
				je skipBuild ; skips snake body coordinate setter if head only
				
				buildSnake:
					mov al, snakeBodyPositionRows[bx-1]
					mov ah, snakeBodyPositionColumns[bx-1]
				
					mov snakeBodyPositionRows[bx], al
					mov snakeBodyPositionColumns[bx], ah
				
					dec bx
					cmp bx, 0
				jne buildSnake
				skipBuild:
					mov dh, headRowPosition
					mov dl, headColumnPosition					
					mov snakeBodyPositionRows[bx], dh
					mov snakeBodyPositionColumns[bx], dl
				ret
		snakeDirectionSetter endp
		
		snakeBuilder proc
			mov bx, 0
			builderLoop:
				
				mov dh, snakeBodyPositionRows[bx]
				mov dl, snakeBodyPositionColumns[bx]
				mov cursorRow, dh
				mov cursorColumn, dl
				call cursorPositioner
				
				cmp bx, 0
				je head
					mov tempIndex, bx
					call reset
					
					mov al, bodyCharacter
					call characterPrinter
				jmp body
				head:
					mov tempIndex, bx
					call reset
					
					mov al, headCharacter
					call characterPrinter
				body:
				
				call reset
				mov bx, tempIndex
				
				inc bx
				cmp bx, snakeLength
			jle builderLoop
			 
			ret
		snakeBuilder endp
		
		foodMaker proc
			
			call reset
			
			mov dh, headRowPosition
			mov dl, headColumnPosition
			
			cmp foodInitializer, 0
			je first
			
			cmp dh, foodPositionRow
			jne donotmovefood
				cmp dl, foodPositionColumn
				jne donotmovefood
					inc snakeLength
					first:
						call randomCoordinatesGenerator
						mov foodInitializer, 1
			donotmovefood:
			
			call reset
			
			mov dh, foodPositionRow
			mov dl, foodPositionColumn
			mov cursorRow, dh
			mov cursorColumn, dl
			call cursorPositioner
				
			call reset
				
			cmp snakeLength, 0
			je skipFoodCheck
				
			mov bx, 0
			mov dh, foodPositionRow
			mov dl, foodPositionColumn
			foodOnBodyChecker:
				
				cmp dh, snakeBodyPositionRows[bx]
				jne notOnBody
					cmp dl, snakeBodyPositionColumns[bx]
					jne notOnBody
						jmp first
					
				notOnBody:
				inc bx
				cmp bx, snakeLength
			jne foodOnBodyChecker
				
			skipFoodCheck:
				
			mov al, 4
			call characterPrinter
				
			ret
		foodMaker endp
			
			randomCoordinatesGenerator proc
				
				mov bx, 22
				call random
				mov al, randomNumber
				add al, 3
				mov foodPositionRow, al
				
				call reset
				
				mov bx, 80
				call random
				mov al, randomNumber
				mov foodPositionColumn, al
				
				ret
			randomCoordinatesGenerator endp
			
				random proc
					mov ah, 00h
					int 1Ah
					
					mov ax, dx
					xor dx, dx
					
					div bx
					
					mov randomNumber, dl
					ret
				random endp
				
		scorePrinter proc
				
			call reset
				
			mov ax, snakeLength
			mov bx, 3
			mov cl, 10
				
				createScore:
					dec bx
					
					mov ah, 0
					div cl
						
					add ah, 48
					mov score[bx], ah
					
					cmp bx, 0
				jne createScore
				
				displayScore:
				
					mov tempIndex, bx
					
					call reset
					mov bx, tempIndex
					
					mov cursorRow, 1
					mov cursorColumn, bl
					call cursorPositioner
					
					call reset
					mov bx, tempIndex
				
					mov al, score[bx]
					call characterPrinter
					
					call reset
					mov bx, tempIndex
				
					inc bx
					cmp bx, 3
				jne displayScore
				
				call reset
			ret 
		scorePrinter endp
		
		headerPrinter proc
		
			mov cursorRow, 0
			mov cursorColumn, 0
			call cursorPositioner
				
			call reset
				
			mov dx, offset string[0]
			mov ah, 09h
			int 21h
				
			call reset
		
			mov cursorRow, 2
			mov cursorColumn, 0
			call cursorPositioner
		
			call reset
		
			mov dx, offset horizontal
			mov ah, 09h
			int 21h
			
			ret
		headerPrinter endp
		
			cursorPositioner proc
				mov dh, cursorRow
				mov dl, cursorColumn
				xor bh, bh
				mov ah, 02h
				int 10h
				ret
			cursorPositioner endp
			
			characterPrinter proc
				mov dl, 0Fh
				mov bl, dl
				xor bh, bh
				mov cx, 1
				mov ah, 09h
				int 10h
				ret
			characterPrinter endp
		
	main    proc
	
	mov ax, @data
	mov ds, ax
	
		; hides cursor
		mov cx, 3200h
		mov ah, 01h
		int 10h
	
		; sets video mode 80 x 25
		mov ax, 0300h
		int 10h
		
		call mainProccesses
		
		; start of algorithm
		snakeProgramLoop:
			
			waitForKey: 
				mov ah, 01h
				int 16h

                jnz gotKey 
				
				call mainProccesses
				
				cmp endOfSnake, 1
					je endProgram
				
			jmp waitForKey   	
			gotKey:
				mov ah, 00h        	
				int 16h          
			
				cmp al, 0 ; checks if extended ascii values are present (for arrow keys)
				jne notExtended
					
					mov bx, 0
					checkIfOtherKey:
						cmp ah, possibleKeys[bx]
						je extendedKey
						
						inc bx
						cmp bx, 9
					jne checkIfOtherKey
					jmp anotherKey
						extendedKey:
						
							;cmp ah, 
						
							mov snakeDirection, ah
						jmp anotherKey
				notExtended:
					
					mov bx, 0
					checkIfAnotherKey:
						cmp al, possibleKeys[bx]
						je normalKey
						
						inc bx
						cmp bx, 9
					jne checkIfAnotherKey
					jmp anotherKey
						normalKey:				
							mov snakeDirection, al
				
				anotherKey:
				
				cmp snakeDirection, 27
				je endProgram
				
		jmp snakeProgramLoop
		
		endProgram:
		
			mov cursorRow, 0
			mov cursorColumn, 71
			call cursorPositioner
		
			call reset
		
			mov dx, offset string[7]
			mov ah, 09h
			int 21h
			
			mov cursorRow, 2
			mov cursorColumn, 0
			call cursorPositioner
		
	mov ax, 4c00h
    int 21h
	
	main    endp
    end main