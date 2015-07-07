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

pid_t pid;

void 
sig_chld(int signo){
    int who = RUSAGE_CHILDREN;
    struct rusage usage;
    int ret;
    if ((ret = getrusage(who, &usage)) == -1)
        exit(EXIT_FAILURE);
    printf("%lu\t%lu\n",usage.ru_utime.tv_sec,usage.ru_utime.tv_usec);
    printf("%lu\t%lu\n",usage.ru_stime.tv_sec,usage.ru_stime.tv_usec);
    printf("%lu\n",usage.ru_maxrss);
}

void
sig_alrm(int signo)
{
    kill(pid,SIGKILL);
}

int
main(int argc,char *argv[])
{
    struct sigaction act_chld,act_alrm;
    int seconds = 5;//设置子进程的最大运行时间
    int fd[2];
    if(argc != 3){
        perror("Usage: run_program $program $inputTestData");
        exit(EXIT_FAILURE);
    }

    //构造运行命令 cmdstr < inputfile
    int cmd_length = strlen(argv[1]) + strlen(argv[2]) + 5;
    char *cmd = malloc(cmd_length);
    memset(cmd,'\0',cmd_length);
    strncat(cmd,argv[1],strlen(argv[1]));
    strncat(cmd," ",strlen(" "));
    strncat(cmd,argv[2],strlen(argv[2]));
    
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

    //创建管道
    if (pipe(fd) < 0)
        exit(EXIT_FAILURE);
    
    //创建子进程
    if((pid = fork()) < 0){
        perror("fork failure");
    }else if (pid == 0){
        dup2(fd[0],STDIN_FILENO);
        close(fd[0]);
        close(fd[1]);
        execl(argv[1],argv[1],(char *)0,NULL);
    }else{
        close(fd[0]);
        write(fd[1],argv[2],strlen(argv[2]));
        alarm(seconds);
        waitpid(pid,NULL,0);
        alarm(0);
        free(cmd);
    }
}
