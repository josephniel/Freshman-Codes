#include<stdio.h>

#define size 10

typedef struct{
	char firstname[30], middlename[30], lastname[30];
}fullname;

typedef struct{
	int units[1], hours[1];
	char name[30], section[4], time[20], day[7], room[20];
	float grade;
}subjectinfo;

typedef struct{
	char college[50], degree[30], sy[8], term[2], studentnum[10];
}otherinfo;

main(){
	fullname full[size];
	subjectinfo subj[size];
	otherinfo other[size];
	int i,j,a,b,c,d;	

	for(i=0;i<=size;i++){	
		a = i;
		printf("\nEnter student %d's student number: ",a+1);
		scanf("%s",other[i].studentnum);
		printf("\n\tEnter student %s's lastname: ",other[i].studentnum);
		scanf("%*c%[^\n]",full[i].lastname);
		printf("\n\tEnter student %s's firstname: ",other[i].studentnum);
		scanf("%*c%[^\n]",full[i].firstname);
		printf("\n\tEnter student %s's middlename: ",other[i].studentnum);
		scanf("%*c%[^\n]",full[i].middlename);
	
		printf("\nEnter %s, %s %s's college: ",full[i].lastname,full[i].firstname,full[i].middlename);
		scanf("%*c%[^\n]",other[i].college);
		printf("\nEnter %s, %s %s's degree: ",full[i].lastname,full[i].firstname,full[i].middlename);
		scanf("%*c%[^\n]",other[i].degree);
		printf("\nEnter school year: ");
		scanf("%*c%[^\n]",other[i].sy);
		printf("\nEnter term: ");
		scanf("%*c%[^\n]",other[i].term);

		printf("\nHow many subjects does %s, %s %s have?: ",full[i].lastname,full[i].firstname,full[i].middlename);
		scanf("%d",&b);
		printf("\nRemember to write in uppecase the subjects.\n");
		for(j=0;j<b;j++){
			c = j;
			printf("\nEnter subject %d: ",c+1);
			scanf("%*c%[^\n]",subj[i].name);
			printf("\n\tEnter %s's number of units: ",subj[i].name);
			scanf("%d",subj[i].units);
			printf("\n\tEnter %s's number of hours/week: ",subj[i].name);
			scanf("%d",subj[i].hours);
			printf("\n\tEnter %s's section code: ",subj[i].name);
			scanf("%s",subj[i].section);
			printf("\n\tEnter %s's time span: ",subj[i].name);
			scanf("%*c%[^\n]",subj[i].time);
			printf("\n\tEnter %s's meeting date/s: ",subj[i].name);
			scanf("%*c%[^\n]",subj[i].day);
			printf("\n\tEnter %s's room:",subj[i].name);
			scanf("%*c%[^\n]",subj[i].room);
			printf("\n\tEnter %s, %s %s's %s final grade: ",full[i].lastname,full[i].firstname,full[i].middlename,subj[j].name);
			scanf("%f",&subj[i].grade);
			}
		}
	
		do{
		
		}while(subj[i].name!='CMSC 11 LAB1B');
	
}
