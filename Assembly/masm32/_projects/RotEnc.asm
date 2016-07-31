.model small
.stack 100h
.data
	arr db ?,?,?,?,?,?,?,?,?,?
.code

    main    proc
   
	mov ax, @data
    mov ds, ax
	
		mov bx, 0 ; initializes the bx register to 0
		
		a:
			mov al, 01h ; accepts an input from a user and stores it in the ax register
			int 21h
			
			mov arr[bx], al ; moves the value of the input to the array

			inc bx ; increments the bx register by 1
			cmp bx, 10 ; compares the value of the bx register to 10
		jne a ; if equal, the loop exits
		
		mov dl, 0ah ; adds a new line
		mov ah, 02h
		int 21h
		
		b:
			mov dl, arr[bx-10] ; moves the current array value to the dx register (bx initially contains 10)
	
			cmp dl, 97 ; compares the current value in the dx register to 97 (ascii value for lowercase a)
			jge g ; if the current value is greater than or equal to 97, code will jump to label g; else, continue line per line
	
			; ROT13 for uppercase letters
			d:
				add dl, 13
				cmp dl, 90
			jg f
			e:
				add dl, 26
			f:
				sub dl, 26
			
			cmp dl, 97 ; this is to skip the ROT13 for lowercase letters
			jl z

			; ROT13 for lowercase letters
			g:
				sub dl, 13
				cmp dl, 97
			jl i
			h:
				sub dl, 26
			i:
				add dl, 26
			
			z:
			mov ah, 02h ; prints the value inside the dl register
			int 21h
			
			inc bx ; increments the bx register by 1
			cmp bx, 20 ; compares the value of the bx register to 20 (11-20, 10 times)
		jne b ; if equal, the loop exits
	
	mov ax, 4c00h
    int 21h

    main    endp
    end main