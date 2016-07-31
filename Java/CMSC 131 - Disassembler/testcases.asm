;===IF===
.model small 
.stack 100h 
.data 
	var db ?
	msg1 db "Five! :)","$"
	msg2 db "Continue","$"
.code 

main proc 

mov ax, @data 
mov ds, ax 
	
	mov ah, 5
	mov var, ah
	cmp var, 5 
	jne label1 
		mov dx, offset msg1
		mov ah, 09h
		int 21h
		
	label1:
	mov dx, offset msg2
	mov ah, 09h
	int 21h
	
mov ax, 4c00h 
int 21h 

main endp 
end main

;===IF ELSE===
.model small 
.stack 100h 
.data 
	var db ?
.code 

main proc 

mov ax, @data 
mov ds, ax 
	
	mov var, 4
	cmp var, 5 
	jne label1 
		mov ah, 2
		mov dl, 48
		int 21h
		jmp label2 

	label1: 
		mov dl, 49
		mov ah, 02h
		int 21h

	label2:
		mov ah, 2
		mov dl, 48
		int 21h
	
mov ax, 4c00h 
int 21h 

main endp 
end main


;===WHILE===
.model small 
.stack 100h 
.data 
	var db ?
.code 

main proc 

mov ax, @data 
mov ds, ax 
	
	mov var, 0
	while1:
	inc var
	cmp var, 5 
	jg exit 
		mov ah, 02h
		mov dl, 3
		int 21h
		jmp while1

	exit:
	
	mov ah, 02h
	mov dl, 5
	int 21h

	
mov ax, 4c00h 
int 21h 

main endp 
end main

;==GENERAL TEST 1==
title testCase
.model small
.stack 100h
.data
	message db "Outside the loop!" , "$"
	message2 db "Outside the loop using offset!" , "$"
	message3 db "I'm inside if!!", "$"
	message4 db "I'm inside else!!", "$"
	message5 db "I'm inside while!! ", "$"
	message6 db "I'm inside do-while!! ", "$"
	variable db ?
	ctr db 0	
.code

main proc

mov ax, @data
mov ds, ax
		;assigning to variable
		mov variable, 'z'
		;prints character
		mov dl, variable
		mov ah, 02h
		int 21h
		;print character a
		mov dl, 'a'
		mov ah, 02h
		int 21h
		;print new line
		mov dl, 10
		mov ah, 02h
		int 21h
		;print message variable
		lea dx, message
		mov ah, 09h
		int 21h
		;print new line
		mov dl, 10
		mov ah, 02h
		int 21h
		;print message variable using offset
		mov dx, offset message2
		mov ah, 09h
		int 21h
		
		;print new line
		mov dl, 10
		mov ah, 02h
		int 21h
		
		;add and print result
		mov al, 49
		add al, 1
		
		mov dl, al
		mov ah, 02h
		int 21h
		
		;print new line
		mov dl, 10
		mov ah, 02h
		int 21h
		
		;sub and print result
		mov al, 49
		sub al, 1
		
		mov dl, al
		mov ah, 02h
		int 21h
		
		;print new line
		mov dl, 10
		mov ah, 02h
		int 21h
		
		;if statement
		mov al, 49
		
		cmp al, 49
		jne endIfstatement
			lea dx, message3
			mov ah, 09h
			int 21h
		
		endIfstatement:
		
		;print new line
		mov dl, 10
		mov ah, 02h
		int 21h
		
		;if-else statement
		mov al, 48
		
		cmp al, 48
		jne elseStatement
			lea dx, message3
			mov ah, 09h
			int 21h
		jmp endIfelse
		elseStatement:
			lea dx, message4
			mov ah, 09h
			int 21h	
		endIfelse:
	
	;print new line
	mov dl, 10
	mov ah, 02h
	int 21h
	
	mov ctr, 0
	do:
    
		lea dx, message6
		mov ah, 09h
		int 21h
		
		mov dl, 10
		mov ah, 02h
		int 21h
				
		inc ctr
		cmp ctr, 3
    jle do ; select xx so that it branches to true
	
	;print new line
	mov dl, 10
	mov ah, 02h
	int 21h
	
mov ax, 4c00h
int 21h
	
main endp
end main
