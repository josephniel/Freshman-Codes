#include<stdio.h>
#include<stdlib.h>

int choice;

typedef struct{
	char lastname[100];
	char firstname[100];
	char middlename[100];
	char studentnum[10];
	char course[100];
	int contactnum;
	char email[100];
} studentdirectory;

void menu(void)
{
	printf("\n*********************************************");
	printf("\nMENU");
	printf("\n*********************************************");
	printf("\n[1] Add new Record");
	printf("\n[2] Delete a Record");
	printf("\n[3] Search for a Record");
	printf("\n[4] Display all Records");
	printf("\n[5] Save to a File");
	printf("\n[6] Exit");
	printf("\n*********************************************");
	printf("\nChoose a number: ");
}

void add_new_record(studentdirectory *a)
{	
	printf("\nInput student's last name: ");
	scanf("%*c%[^\n]",a->lastname);
	printf("\nInput student's first name: ");
	scanf("%*c%[^\n]",a->firstname);
	printf("\nInput student's middle name: ");
	scanf("%*c%[^\n]",a->middlename);
	printf("\nInput %s %s's student number: ",a->firstname,a->lastname);
	scanf("%*c%[^\n]",a->studentnum);
	printf("\nInput %s %s's course: ",a->firstname,a->lastname);
	scanf("%*c%[^\n]",a->course);
	printf("\nInput %s %s's contact number: ",a->firstname,a->lastname);
	scanf("%d",&a->contactnum);
	printf("\nInput %s %s's email address: ",a->firstname,a->lastname);
	scanf("%*c%[^\n]",a->email);
}

void delete_a_record(void)
{

}

void search_for_a_record(void)
{

}

void display_all_records(void)
{

}

void save_to_a_file(void)
{

}

void prompt_if_save(void)
{

}

main()
{
    studentdirectory *directory;
	do {
	
		menu();
		scanf("%d",&choice);

		switch(choice) {
			case 1:
				directory = (studentdirectory *)malloc(sizeof(directory));
				add_new_record(directory); 

				break;
			case 2: 
				delete_a_record(); 
				break;
			case 3: 
				search_for_a_record(); 
				break;
			case 4: 
				display_all_records();
				break;
			case 5: 
				save_to_a_file(); 
				break;
			case 6: 
				prompt_if_save(); 
				break;
			default: 
				printf("Choice not found. Please select a number from the list above only."); 
				break;
		}
	} 
	while(choice!=6);
}
