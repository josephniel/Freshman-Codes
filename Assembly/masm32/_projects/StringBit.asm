.model small
.data
	messages db 0ah,'Input number:      ','$','Binary Equivalent:','$'
	binaryDigits db 16 dup(0)
	number dw 0
	indicator db 0
.stack 100h
.code

	nibbler proc
	
		cmp indicator, 1
		je included
		
		mov cx, bx		
		mov dx, 0
		
		repeater:
			cmp binaryDigits[bx], 48
			jne included
			inc bx
			inc dx
			cmp dx, 4
		jne repeater
		ret
		
		included:
		
		mov indicator, 1
		
		mov dl, 32
		mov ah, 02h
		int 21h
		
		mov bx, cx
		add cx, 4
		
		print:
			mov dl, binaryDigits[bx]
			mov ah, 02h
			int 21h
			
			inc bx
			cmp bx, cx
		jne print
		ret
	nibbler endp

	newline proc
		mov dx, 0ah 
		mov ah, 02h
		int 21h
		ret
	newline endp
	
    main    proc
   
	mov ax, @data
    mov ds, ax
	
		lea dx, messages[0]
		mov ah, 09h
		int 21h
	
		mov bx, 0
		
		input:
			mov ax, @data
			
			mov al, 01h
			int 21h
		
			cmp al, 13
			je exitinput
		
			sub al, 48
		
			mov cl, al
			
			mov ax, number
			mov dx, 10
			mul dx
			
			mov number, ax
			mov al, cl
			xor ah, ah ; IKAW LANG PALA HINAHANAP KO NG 2 ARAW NA HUHUHU
			add number, ax
			
			inc bx 
			cmp bx, 5
		jne input
		
		call newline
		
		exitinput:
		mov cx, bx
		mov bx, 0
		
		binary:
			shl number, 1
			jc one
				mov binaryDigits[bx], 48
			jmp skip
			one:
				mov binaryDigits[bx], 49
			skip:
			inc bx
			cmp bx, 16
		jne binary
		
		lea dx, messages[21]
		mov ah, 09h
		int 21h
		
		mov indicator, 0
		mov bx, 0
		
		recursion:
			call nibbler
			cmp bx, 16
		jne recursion
			
		call newline
			
	mov ax, 4c00h
    int 21h

    main    endp
    end main