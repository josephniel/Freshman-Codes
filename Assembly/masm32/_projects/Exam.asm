.model small 
.stack 100h
.data
	delayTime 				db 10
	
	currentRow 				db 12
	currentColumn 			db 40
	currentColor 			db 0Fh
	
	portalRow 				db 	16 dup(0)
	portalColumn 			db 	16 dup(0)
	portalNextRow 			db 	16 dup(0)
	portalNextColumn		db 	16 dup(0)
	portalCharacter 		db 	93,	91,	40,	41,	62,	60,	123,125,118,94,	94,	118,118,94,	93,	91
	portalOpening 			db 	2,	4,	4,	2,	2,	4,	4,	2,	3,	1,	1,	3,	3,	1,	2,	4
	portalColor 			db 	01h,01h,02h,02h,03h,03h,04h,04h,05h,05h,06h,06h,07h,07h,08h,08h
	
	randomDelayTime 		db	5,	2,	1,	2,	2,	1,	1,	3,	2,	1,	3,	2,	3,	1,	2,	2
	
	randomNumber 			db 	0
	randomRow				db 	0
	randomColumn			db 	0
	
	top 					db 	0
	right 					db 	0
	bottom 					db 	0
	left 					db 	0
	
	tempIndex 				dw 	0
	screenSize 				dw 	0
	
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

	refreshPage proc
		mov ax, 0600h
		mov bh, 07h
		xor cx, cx
		mov dx, 184fh
		int 10h
		ret
	refreshPage endp
	
		createPage proc
			
			mov bx, 0
			createLoop:
				
				mov tempIndex, bx
					call portalPlacer
					call reset
				mov bx, tempIndex
				
				inc bx
				cmp bx, 16
			jne createLoop
			
			mov bx, 0
			createPortal:
				
				mov tempIndex, bx
					call portalTransportPlacer
					call reset
				mov bx, tempIndex
				
				inc bx
				cmp bx, 16
			jne createPortal
			
			
			call reset
			call portalPrinter
			
			ret
		createPage endp
		
			portalPrinter proc
			
				mov bx, 0
				printLoop:
					mov tempIndex, bx
				
					mov dh, portalRow[bx]
					mov dl, portalColumn[bx]
					xor bh, bh
					mov ah, 02h
					int 10h
					
					call reset
					mov bx, tempIndex
					
					mov al, portalCharacter[bx]
					mov dl, portalColor[bx]
					mov bl, dl
					xor bh, bh
					mov cx, 1
					mov ah, 09h
					int 10h
				
					call reset
					mov bx, tempIndex
				
					inc bx
					cmp bx, 16
				jne printLoop
			
				ret
			portalPrinter endp
		
			portalPlacer proc
			
				callRandomGenerator:		
				
				call reset
				
				mov bx, tempIndex
				
				mov cl, randomDelayTime[bx]
				mov delayTime, cl
				call delay
				
				call reset
				
				call randomCoordinatesGenerator
				call reset
				
				mov bx, tempIndex
				
				mov dh, randomRow
				mov dl, randomColumn
				
				mov portalRow[bx], dh
				mov portalColumn[bx], dl
				
				mov tempIndex, bx
				
				cmp bx, 0
				je skipCheck
				
					mov bx, 0	
					checkerLoop:
						cmp dh, portalRow[bx]
						jne doesNotIntersect
							cmp dl, portalColumn[bx]
							jne doesNotIntersect
								jmp callRandomGenerator
						doesNotIntersect:
						inc bx
						cmp bx, tempIndex
					jl checkerLoop	
				
				skipCheck:
				ret
			portalPlacer endp
				
			portalTransportPlacer proc

					mov ax, tempIndex
					mov bx, 2
						
					div bx
						
					mov bx, tempIndex
						
					cmp dl, 0
					je addOne
						sub bx, 2
					addOne:
						inc bx
					
				mov dh, portalRow[bx]
				mov dl, portalColumn[bx]
					
				mov bx, tempIndex
					
				cmp portalOpening[bx], 1
					je topOpening
				cmp portalOpening[bx], 2
					je rightOpening
				cmp portalOpening[bx], 3
					je bottomOpening
				cmp portalOpening[bx], 4
					je leftOpening
					
				topOpening:
					dec dh
					jmp transport
				rightOpening:
					inc dl
					jmp transport
				bottomOpening:
					inc dh
					jmp transport
				leftOpening:
					dec dl
						
				transport:
					mov portalNextRow[bx], dh
					mov portalNextColumn[bx], dl
				ret
			portalTransportPlacer endp
				
				randomCoordinatesGenerator proc
					
					mov bx, 22
					mov screenSize, bx
					call random
					mov al, randomNumber
					add al, 3
					mov randomRow, al
					
					call reset
						
					mov bx, 80
					mov screenSize, bx
					call random
					mov al, randomNumber
					mov randomColumn, al
			
					ret
				randomCoordinatesGenerator endp
				
					random proc
						mov ah, 00h
						int 1Ah
						
						mov ax, dx
						xor dx, dx
						
						div bx
						
						inc dl
						add dl, dl
						
						mov al, dl
						mov bl, dl
						
						mul bl
						
						mov bx, tempIndex
						sub al, delayTime[bx]
						
						xor dx, dx
						
						mov bx, screenSize
						div bx
						
						mov randomNumber, dl
						ret
					random endp
	
	portalPositionChecker proc
	
		mov dl, currentColumn
		mov dh, currentRow
	
		mov bx, 0
	
		positionCheckerLoop:			
			cmp dh, portalRow[bx]
			jne notPortal
				cmp dl, portalColumn[bx]
				jne notPortal
					
					;mov notOnPortal, 0
					
					cmp portalOpening[bx], 1
						je topO
					cmp portalOpening[bx], 2
						je rightO
					cmp portalOpening[bx], 3
						je bottomO
					cmp portalOpening[bx], 4
						je leftO
						
					topO:
						cmp top, 1
						jne wall
						jmp teleport
					rightO:
						cmp right, 1
						jne wall
						jmp teleport
					bottomO:
						cmp bottom, 1
						jne wall
						jmp teleport
					leftO:
						cmp left, 1
						jne wall
					
					teleport:
						mov cl, portalNextColumn[bx]
						mov ch,  portalNextRow[bx]
						
						mov al, portalOpening[bx]
						
						cmp cl, 80
							jne skip1
								cmp al, 4
									jne skip1
									mov cl, 0
							jmp skip2
						skip1:
						cmp cl, 0
							jne skip2
								cmp al, 2
									jne skip2
							mov cl, 79
						skip2:
						cmp ch, 25
							jne skip3
								cmp al, 1
									jne skip3
									mov ch, 0
							jmp skip4
						skip3:
						cmp ch, 0
							jne skip4
								cmp al, 3
									jne skip3
									mov ch, 24
						skip4:

						mov currentColumn, cl
						mov currentRow, ch
						
						mov al, portalColor[bx]
						mov currentColor, al
						
						ret
					wall:
						call wallChecker
						ret
			notPortal:	
			;mov notOnPortal, 1
			inc bx
			cmp bx, 16
		jne positionCheckerLoop
		ret
	portalPositionChecker endp
		
		wallChecker proc 
		
			cmp top, 0
				jne donotmovetop
			cmp bottom, 0
				jne donotmovebottom
			cmp left, 0
				jne donotmoveleft
			cmp right, 0
				jne donotmoveright
			
			donotmovetop:
				add dh, 1
			jmp cont
			donotmovebottom:
				sub dh, 1
			jmp cont
			donotmoveleft:
				add dl, 1
			jmp cont
			donotmoveright:
				sub dl, 1
			jmp cont
			
			cont:
				mov currentColumn, dl
				mov currentRow, dh
			ret
			
		wallChecker endp
	
	cursorMover proc

		call portalPositionChecker
	
		mov dh, currentRow 
		mov dl, currentColumn 
		xor bh, bh
		mov ah, 02h
		int 10h
		
		ret
	cursorMover endp
	
	arrowPrinter proc
		mov al, 4
		xor bh, bh
		mov bl, currentColor
		mov cx, 1
		mov ah, 09h
		int 10h
		ret
	arrowPrinter endp

	main    proc
	
	mov ax, @data
	mov ds, ax
	
		; hides the cursor
		mov cx, 3200h
		mov ah, 01h
		int 10h
	
		; sets video mode to 80 x 25
		mov ax, 0300h
		int 10h
	
		; Refreshes the screen
		call refreshPage
	
		; Creates the random portals
		call createPage
	
		; moves the cursor to its initial position (12,40)
		call cursorMover
	
		; prints initial character (diamond)
		call arrowPrinter
	
	
		recursion:
		
			mov ax, @data ; Still uncertain of why program works with this line
			
			;asks for input to be stored in al register
			mov al, 01h
			int 21h
		
			cmp al, 27 ; if the key pressed is ESC, the program exits the loop 
			je endRecursion
			
			; jumps if up arrow is pressed
			cmp al, 72
				je upArrowPressed
			cmp al, 119
				je upArrowPressed
			
			; jumps if right arrow is pressed
			cmp al, 77
				je rightArrowPressed
			cmp al, 100
				je rightArrowPressed
			
			; jumps if down arrow is pressed
			cmp al, 80
				je downArrowPressed
			cmp al, 115
				je downArrowPressed
		
			; jumps if left arrow is pressed
			cmp al, 75
				je leftArrowPressed
			cmp al, 97
				je leftArrowPressed
		
			; jumps if a different key is pressed
			jmp nearEnd
			
			; condition for up
			upArrowPressed:
				mov dh, currentRow
				sub dh, 1
				
				cmp dh, 0
				jge donotgotobottom
				
					mov dh, 24
				
				donotgotobottom:
					mov currentRow, dh
					
					mov top, 1
					mov right, 0
					mov bottom, 0
					mov left, 0
				
				jmp nearEnd
				
			; condition for right
			rightArrowPressed:
				mov dl, currentColumn
				add dl, 1
				
				cmp dl, 79
				jle donotgotoright
				
					mov dl, 0
				
				donotgotoright:
					mov currentColumn, dl
					
					mov top, 0
					mov right, 1
					mov bottom, 0
					mov left, 0
				
				jmp nearEnd
			
			; condition for down
			downArrowPressed:
				mov dh, currentRow
				add dh, 1
				
				cmp dh, 24
				jle donotgototop
				
					mov dh, 0
				
				donotgototop:
					mov currentRow, dh
					
					mov top, 0
					mov right, 0
					mov bottom, 1
					mov left, 0
			
					jmp nearEnd
			
			; condition for left
			leftArrowPressed:
				mov dl, currentColumn
				sub dl, 1
				
				cmp dl, 0
				jge donotgotoleft
				
					mov dl, 79
				
				donotgotoleft:
					mov currentColumn, dl
					
					mov top, 0
					mov right, 0
					mov bottom, 0
					mov left, 1

			; condition for different key pressed
			nearEnd:
			
				;refreshes the page
				call refreshPage
				
				call portalPrinter
				
				; moves the cursor to the next position
				call cursorMover
				
				;prints arrow
				call arrowPrinter
		
			finalEnd:
		jmp recursion
	
	endRecursion:
	
	mov ax, 4c00h
    int 21h
	
	main    endp
    end main