.model small 
.stack 100h
.data
	currentRow db 0
	currentColumn db 0
	top db 0
	right db 0
	bottom db 0
	left db 0
.code

	refreshPage proc
		mov ax, 0600h
		mov bh, 07h
		xor cx, cx
		mov dx, 184fh
		int 10h
		ret
	refreshPage endp

	arrowPrinter proc
	
		cmp top, 1
		je upArrowPrint
		cmp right, 1
		je rightArrowPrint
		cmp bottom, 1
		je downArrowPrint
		cmp left, 1
		je leftArrowPrint
		
		jmp initialDisplay
			
		upArrowPrint:
			mov al, 94
			jmp finish
		downArrowPrint:
			mov al, 118
			jmp finish
		leftArrowPrint:
			mov al, 60
			jmp finish
		rightArrowPrint:
			mov al, 62
			jmp finish
		
		initialDisplay:
			mov al, 4
		
		finish:
			xor bh, bh
			mov bl, 07h
			mov cx, 1
			mov ah, 09h
			int 10h
		ret
	arrowPrinter endp
	
	cursorMover proc
		mov dh, currentRow 
		mov dl, currentColumn 
		xor bh, bh
		mov ah, 02h
		int 10h
		ret
	cursorMover endp
	
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
	
		; moves the cursor to its initial position (0,0)
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