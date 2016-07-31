.model small 
.stack 100h
.data
	currentRow db 12
	currentColumn db 40
	currentColor db 0Fh

	portalRow db 1,22,5,11,7,19,8,19,9,23,2,23
	portalColumn db 1,65,6,22,70,7,55,6,40,41,22,68
	portalNextRow db 22,1,11,5,19,7,19,8,24,8,22,3
	portalNextColumn db 66,0,21,7,8,69,5,56,41,40,68,22
	portalCharacter db 93,91,40,41,62,60,123,125,118,94,94,118
	portalColor db 09h,09h,04h,04h,02h,02h,05h,05h,03h,03h,0Eh,0Eh
	portalOpening db 2,4,4,2,2,4,4,2,3,1,1,3
	
	top db 0
	right db 0
	bottom db 0
	left db 0
.code

	mainProccesses proc
		call refreshPage
		call createPage
		call cursorMover
		call arrowPrinter
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

	createPage proc
		mov bx, 0
		createLoop:
			mov si, bx
			
			mov dh, portalRow[bx] 
			mov dl, portalColumn[bx]
			xor bh, bh
			mov ah, 02h
			int 10h
			
			mov bx, si
			
			mov al, portalCharacter[bx]
			mov dl, portalColor[bx]
			mov bl, dl
			xor bh, bh
			mov cx, 1
			mov ah, 09h
			int 10h
			
			mov bx, si
			
			inc bx
			cmp bx, 12
		jne createLoop
		ret
	createPage endp
	
	portalPositionChecker proc
	
		mov dl, currentColumn
		mov dh, currentRow
	
		mov bx, 0
	
		positionCheckerLoop:			
			cmp dh, portalRow[bx]
			jne notPortal
				cmp dl, portalColumn[bx]
				jne notPortal
					
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
						mov currentColumn, cl
						mov currentRow, ch
						
						mov al, portalColor[bx]
						mov currentColor, al
						
						ret
					wall:
						call wallChecker
						ret
			notPortal:		
			inc bx
			cmp bx, 12
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
	
		mov cx, 3200h
		mov ah, 01h
		int 10h
	
		mov ax, 0300h
		int 10h
		
		call mainProccesses
		
		recursion:
			mov ax, @data ; Still uncertain of why program works with this line
			
			mov al, 01h
			int 21h
		
			cmp al, 27
				je endRecursion
			
			mov top, 0
			mov right, 0
			mov bottom, 0
			mov left, 0
			
			cmp al, 72
				je upArrowPressed
			cmp al, 119
				je upArrowPressed
			
			cmp al, 77
				je rightArrowPressed
			cmp al, 100
				je rightArrowPressed
			
			cmp al, 80
				je downArrowPressed
			cmp al, 115
				je downArrowPressed
		
			cmp al, 75
				je leftArrowPressed
			cmp al, 97
				je leftArrowPressed
		
			jmp nearEnd
			
			upArrowPressed:
				mov dh, currentRow
				sub dh, 1
				cmp dh, 0
				jge donotgoup
					mov dh, 24
				donotgoup:
					mov currentRow, dh
					mov top, 1
				jmp nearEnd
				
			rightArrowPressed:
				mov dl, currentColumn
				add dl, 1
				cmp dl, 79
				jle donotgotoright
					mov dl, 0
				donotgotoright:
					mov currentColumn, dl
					mov right, 1
				jmp nearEnd
			
			downArrowPressed:
				mov dh, currentRow
				add dh, 1
				cmp dh, 24
				jle donotgodown
					mov dh, 0
				donotgodown:
					mov currentRow, dh
					mov bottom, 1
				jmp nearEnd
			
			leftArrowPressed:
				mov dl, currentColumn
				sub dl, 1
				cmp dl, 0
				jge donotgotoleft
					mov dl, 79
				donotgotoleft:
					mov currentColumn, dl
					mov left, 1

			nearEnd:
				call mainProccesses
			finalEnd:
		jmp recursion
		
	endRecursion:
	
	mov ax, 4c00h
    int 21h
	
	main    endp
    end main