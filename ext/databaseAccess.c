/*************************************************************************
	> File Name: databaseAccess.c
	> Author: 
	> Mail: 
	> Created Time: 2015年06月18日 星期四 16时45分10秒
 ************************************************************************/

#include<stdio.h>
#include"databaseAccess.h"

MYSQL *
getConn()
{
    conn = mysql_init(NULL);
    if(conn == NULL)
        return NULL;
    conn = mysql_real_connect(conn,host,user,password,database);
    if (conn == null)
        return NULL;
    return conn;
}

void 
closeConn(MYSQL *conn)
{
    mysql_close(conn);
}
