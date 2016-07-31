.model small
.data
	messages db 0ah,'Enter first number:  ','$','Enter second number: ','$',0ah,'Sum:        ','$',0ah,'Difference: ','$',0ah,'Product:    ','$',0ah,'Quotient:   ','$',0ah,'Modulo:     ','$',0ah,'Maximum:    ','$',0ah,'Minimum:    ','$',0ah,'Average:    ','$'
	numbers db 0, 0
	additionalstrings db '-','$','.5','$','Does not exist!','$','No possible modulo!','$'
	indicator db 0
	output db 0,0,0,0
	product db 0
.stack 100h
.code

	inputconcatinator proc

		mov indicator, 0
	
		input:
			mov ax, @data
			
			mov al, 01h
			int 21h
		
			cmp al, 13
			je exitinput
		
			sub al, 48
			
			mov cl, al
			
			mov al, numbers[bx]
			mov dl, 10
			mul dl
			
			mov numbers[bx], al
			mov al, cl
			add numbers[bx], al
			
			inc indicator
			cmp indicator, 2
		jne input
		
		call newline
		
		exitinput:
		ret
	inputconcatinator endp
	
	newline proc
		mov dl, 0ah
		mov ah, 02h
		int 21h
		ret
	newline endp
	
	displaymessage proc
		lea dx, messages[bx]
		mov ah, 09h
		int 21h
		ret
	displaymessage endp

	displayoutput proc
	
		mov bx, 4
		mov cl, 10
		
		storeanswer:
			dec bx
			
			mov ah, 0
			div cl
				
			add ah, 48
			mov output[bx], ah
		
			cmp bx, 0
		jne storeanswer
			
		mov indicator, 0
			
		displayanswer:
		
			cmp indicator, 1
			je continue
			cmp output[bx], 48
			je skip
		
			continue: 
			mov indicator, 1
		
			mov dl, output[bx]
			mov ah, 02h
			int 21h
				
			skip:	
			inc bx
			cmp bx, 4
		jne displayanswer
		
		cmp indicator, 0
		jne skipzeroprint
			mov dl, 48
			mov ah, 02h
			int 21h
		skipzeroprint:
		ret
	displayoutput endp

    main    proc
   
	mov ax, @data
    mov ds, ax
	
		mov bx, 0
		call displaymessage
		
		call inputconcatinator
		
		mov bx, 23
		call displaymessage
		
		mov bx, 1
		call inputconcatinator
		
		; SUM
		mov bx, 45 
		call displaymessage
		
			mov al, numbers[0]
			add al, numbers[1]
			call displayoutput
			
		; DIFFERENCE
		mov bx, 59 
		call displaymessage
		
			mov al, numbers[0]
			cmp al, numbers[1]
			jge positive
				lea dx, additionalstrings[0]
				mov ah, 09h
				int 21h
			
				mov al, numbers[1]
				sub al, numbers[0]
				
				jmp enddifference
			positive:
				mov al, numbers[0]
				sub al, numbers[1]
			enddifference:
				call displayoutput
		
		; PRODUCT
		mov bx, 73 
		call displaymessage
		
			mov al, numbers[0]
			mov bl, numbers[1]
			mul bl
		
			mov ch, ah
			
			cmp ah, 0
			je eightbitproduct
				call displayoutput
				jmp endproduct
			eightbitproduct:
				call displayoutput
			endproduct:
		
		; QUOTIENT
		mov bx, 87 
		call displaymessage
		
			mov al, numbers[0]
			mov ah, 0
			mov bl, numbers[1]
			
			cmp bl, 0
			je doesnotexist
				div bl
				mov ch, ah ; saves the modulo
				call displayoutput
				jmp endquotient
			doesnotexist:
				lea dx, additionalstrings[5]
				mov ah, 09h
				int 21h
			endquotient:
				
		; MODULO
		mov bx, 101 
		call displaymessage
		
			cmp numbers[1], 0
			je nomodulo
				mov al, ch
				call displayoutput
				jmp endmodulo
			nomodulo:
				lea dx, additionalstrings[21]
				mov ah, 09h
				int 21h
			endmodulo:
		
		; MAXIMUM
		mov bx, 115 
		call displaymessage
		
			mov al, numbers[0]
			cmp al, numbers[1]
			jg max
				mov al, numbers[1]
				call displayoutput
				jmp skipmax
			max:
				mov al, numbers[0]
				call displayoutput
			skipmax:
			
		; MINIMUM
		mov bx, 129
		call displaymessage	
			
			mov al, numbers[0]
			cmp al, numbers[1]
			jg min
				mov al, numbers[0]
				call displayoutput
				jmp skipmin
			min:
				mov al, numbers[1]
				call displayoutput
			skipmin:
			
		; AVERAGE
		mov bx, 143 
		call displaymessage
			
			mov al, numbers[0]
			add al, numbers[1]
			xor ah, ah
			mov bl, 2
			div bl

			mov ch, ah
			
			call displayoutput
			
			cmp ch, 0
			je skipdecimal
				lea dx, additionalstrings[2]
				mov ah, 09h
				int 21h
			skipdecimal:
				call newline
			
	mov ax, 4c00h
    int 21h

    main    endp
    end main