/*************************************************************************
	> File Name: run_program.c
	> Author: 
	> Mail: 
	> Created Time: 2015年06月26日 星期五 15时31分26秒
    > 该程序用于运行外来程序
 ************************************************************************/

#include<stdio.h>
#include<stdlib.h>
#include<string.h>
#include<unistd.h>
#include<sys/wait.h>
#include<sys/types.h>
#include<sys/stat.h>
#include<sys/resource.h>
#include<errno.h>
#include<signal.h>
//#include"tell_wait.h"

//pid_t pid;

void 
sig_chld(int signo){
    int who = RUSAGE_CHILDREN;
    struct rusage usage;
    int ret;
    if ((ret = getrusage(who, &usage)) == -1)
        exit(EXIT_FAILURE);
    printf("usage.ru_utime.tv_sec=%lu\tusage.ru_utime.tv_usec=%lu\n",usage.ru_utime.tv_sec,usage.ru_utime.tv_usec);
    printf("usage.ru_utime.tv_sec=%lu\tusage.ru_utime.tv_usec=%lu\n",usage.ru_stime.tv_sec,usage.ru_stime.tv_usec);
    printf("usage.ru_maxrss=%lu\n",usage.ru_maxrss);
}

void
sig_alrm(int signo)
{
    printf("time out\n");
    sig_chld(signo);
    //向该进程所在进程组发送SIGKILL信号
    kill(0,SIGKILL);
}

int
main(int argc,char *argv[])
{
    struct sigaction act_chld,act_alrm;
    int seconds = 5;//设置进程的最大运行时间

    //构造运行命令 cmdstr < inputfile 2>&1
    char cmd[512];
    memset(cmd,'\0',512);
    strncat(cmd,argv[1],strlen(argv[1]));
    strncat(cmd," < ",strlen(" < "));
    strncat(cmd,argv[2],strlen(argv[2]));
    strncat(cmd," 2>&1",strlen(" 2>&1"));
    
    //安装sigchld信号
    //signal(SIGCHLD,sig_chld);
    act_chld.sa_handler = sig_chld;
    sigemptyset(&act_chld.sa_mask);
    act_chld.sa_flags = 0;
    if (sigaction(SIGCHLD,&act_chld,NULL) < 0)
        exit(EXIT_FAILURE);
    //安装SIGALRM信号
    //signal(SIGALRM,sig_alrm);
    act_alrm.sa_handler = sig_alrm;
    sigemptyset(&act_alrm.sa_mask);
    act_alrm.sa_flags = 0;
    if (sigaction(SIGALRM,&act_alrm,NULL) < 0)
        exit(EXIT_FAILURE);
    
    alarm(seconds);
    system(cmd);
    alarm(0);

    /*TELL_WAIT();
    
    //创建子进程
    if((pid = fork()) < 0){
        perror("fork failure");
        exit(EXIT_FAILURE);
    }else if (pid == 0){
        WAIT_PARENT();
        system(cmd);
    }else{
        alarm(seconds);
        TELL_CHILD(pid);
        waitpid(pid,NULL,0);
        alarm(0);
    }*/
}
