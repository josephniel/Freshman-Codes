title Test1

.model small
.data
    message db 'The best and most beautiful things in the world cannot be seen or even touched - they must be felt with the heart.', 10, '$'
    message2 db 'I can', 39 ,'t change the direction of the wind, but I can adjust my sails to always reach my destination.', 10, '$'

.stack 100h
.code
    main proc

    mov ax, @data
    mov ds, ax

    lea dx, message
    mov ah, 09h
    int 21h

    lea dx, message2
    mov ah, 09h
    int 21h

    mov ax, 4c00h
    int 21h

    main endp

    end main