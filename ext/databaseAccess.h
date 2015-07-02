/*************************************************************************
	> File Name: databaseAccess.h
	> Author: 
	> Mail: 
	> Created Time: 2015年06月18日 星期四 16时23分00秒
 ************************************************************************/

#ifndef _DATABASEACCESS_H
#define _DATABASEACCESS_H
#endif
#include<stdio.h>
#include<stdlib.h>
#include"mysql.h"

MYSQL *conn=NULL;
char *host = "localhost";
char *user = "root";
char *password = "root";
char *database = "oj";

MYSQL * getConn();
void closeConn(MYSQL *conn);
