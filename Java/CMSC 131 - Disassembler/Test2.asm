title Test2

.model small
.data
x db 9
y db 100
z db ?

.stack 100h
.code
    main proc

    mov ax, @data
    mov ds, ax

    mov ah, x
    add ah, y
    mov z, ah


    cmp z, 0
    jl else_if_block
        ; prepare for printing
        add x, '0'

        mov dl, x
        mov ah, 02h
        int 21h
    jmp endif_
else_if_block:
    cmp z, 0
    je else_block
        ; prepare for printing
        add z, '0'

        mov dl, z
        mov ah, 02h
        int 21h
    jmp endif_
else_block:
    cmp z, 0
    je else_block
        ; prepare for printing
        add y, '0'

        mov dl, y
        mov ah, 02h
        int 21h
endif_:

    mov ax, 4c00h
    int 21h

    main endp

    end main