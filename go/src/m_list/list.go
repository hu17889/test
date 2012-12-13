package m_list

import (
    "fmt"
    clist "container/list"
)

func NewDoList() *DoList {
    doList := &DoList{}
    doList.l = clist.New()
    doList.ml = NewMList()
    return doList
}

type DoList struct {
    l *clist.List
    ml *MList
}

func (d DoList) TestList() {
    l := d.l
    l.PushFront(1)
    l.PushFront(2)
    l.PushBack(3)
    for e:=l.Front();e!=nil;e=e.Next() {
        fmt.Printf("%d",e.Value)
        //println(e.Value)
    }
    println(l.Len())
}

func (d DoList) TestMList() {
    l := d.ml
    l.PushFront(1)
    l.PushFront(2)
    fmt.Printf("%v",*l)
    // l.PushBack(3)
    for e:=l.Front();e!=nil;e=e.Next() {
       fmt.Printf("%d",e.Value)
    }
    println(l.Len())
}

type MElem struct {
    Value interface{}
    next *MElem
    prev *MElem
}

func (e MElem) Next() *MElem {
    return e.next
}

func (e MElem) Prev() *MElem {
    return e.prev
}

type MList struct {
    head *MElem
}

func NewMList() *MList {
    return &MList{}
}

func (l MList) Front() *MElem {
    return l.head
}

func (l *MList) PushFront(v interface{}) (e *MElem) {
    e = &MElem{}
    e.Value = v

    if(l.head==nil) {
        l.head=e
        return
    }
    
    e.next = l.head
    l.head.prev = e
    l.head = e
    return
}

func (l MList) Len() (ret int) {
    ret = 0
    for e:=l.head;e!=nil;e=e.next {
        ret++
    }
    return
}
