/*************************************************************************
	> File Name: tell_wait.c
	> Author: 
	> Mail: 
	> Created Time: 2015年07月05日 星期日 10时59分25秒
 ************************************************************************/

#include<stdio.h>
#include<signal.h>
#include<unistd.h>
#include<stdlib.h>

static volatile sig_atomic_t sigflag;
static sigset_t newmask,oldmask,zeromask;

static void 
sig_usr(int signo)
{
    sigflag = 1;
}

void
TELL_WAIT(void)
{
    if (signal(SIGUSR1, sig_usr) == SIG_ERR){
        perror("signal(SIGUSR1) error");
        exit(EXIT_FAILURE);
    }
    if (signal(SIGUSR2, sig_usr) == SIG_ERR){
        perror("signal(SIGUSR2) error");
        exit(EXIT_FAILURE);
    }

    sigemptyset(&zeromask);
    sigemptyset(&newmask);
    sigaddset(&newmask,SIGUSR1);
    sigaddset(&newmask,SIGUSR2);

    if (sigprocmask(SIG_BLOCK, &newmask, &oldmask) < 0){
        perror("SIG_BLOCK error");
        exit(EXIT_FAILURE);
    }
}

void
TELL_PARENT(pid_t pid)
{
    kill(pid, SIGUSR2);   
}

void
WAIT_PARENT(void)
{
    printf("wait parent\n");
    while (sigflag == 0)
        sigsuspend(&zeromask);
    printf("running\n");

    sigflag = 0;

    if (sigprocmask(SIG_SETMASK, &oldmask,NULL) < 0){
        perror("SIG_SETMASK error");
        exit(EXIT_FAILURE);
    }
}

void
TELL_CHILD(pid_t pid)
{
    kill(pid,SIGUSR1);
}

void
WAIT_CHILD(void)
{
    while (sigflag == 0)
        sigsuspend(&zeromask);
    sigflag = 0;

    if(sigprocmask(SIG_SETMASK, &oldmask, NULL) < 0){
        perror("SIG_SETMASK error");
        exit(EXIT_FAILURE);
    }
}
