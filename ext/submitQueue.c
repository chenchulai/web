/*************************************************************************
	> File Name: submitQueue.c
	> Author: 
	> Mail: 
	> Created Time: 2015年06月18日 星期四 11时26分43秒
    >该文件描述了使用线程安全的方法实现了以队列方式组织oj提交的代码。
 ************************************************************************/

#include<stdlib.h>
#include<pthread.h>

//定义了提交编译及运行所需的数据结构
struct submit {
    struct submit *next;
    char *language;
    int probelmId;
    char *source;
};

struct queue {
    struct submit *q_head;
    struct submit *q_tail;
    pthread_mutex_t  q_lock;
};

//初始化队列
int 
queue_init(struct queue *qp){
    int err;
    qp->q_head = NULL;
    qp->q_tail = NULL;
    err = pthread_mutex_init(&qp->q_lock,NULL);
    if (err != 0)
        return err;
    return 0;
}

//在队头插入数据
void submit_insert(struct queue *qp, struct submit *sm){
    pthread_mutex_lock(&qp->q_lock);
    sm->next = qp->q_head;
    if (qp->q_head == NULL)
        qp->q_tail = sm;
    qp->q_head = sm;
    pthread_mutex_unlock(&qp->q_lock);
}

//在队伍尾部添加数据
void
submit_append(struct queue *qp,struct submit *sm){
    pthread_mutex_lock(&qp->q_lock);
    sm->next = NULL;
    if(qp->q_tail != NULL)
       qp->q_tail->next = sm;
    else{
        qp->q_head = sm;
        qp->q_tail = sm;
    }
    pthread_mutex_unlock(&qp->q_lock);
}

//从队列头部移除信息
struct submit * 
submit_pop(struct queue *qp)
{
    pthread_mutex_lock(&qp->q_lock);
    struct submit *result = NULL ;
    if(qp->q_head != NULL){
        result = qp->q_head;
        qp->q_head = result->next; 
    }    
    return NULL;
    pthread_mutex_unlock(&qp->q_lock);
}
