package main

import (
	"fmt"
	st "stack"
    mList "m_list"
    "cat"
    //rp "runtime/pprof"
    //"os"
    "web"
)

func mymap(doFunc func(int) int,params []int) []int {
    for key,value := range(params) {
        params[key] = doFunc(value)
    }
    return params
}

func fi() {
}



func main() {
    // for k,v:=range(os.Args) {
        // println(k,v)
    // }

    w := web.NewWeb()
    w.TestDial()

    return
    
    c := make(chan int)
    go cat.Do(c)
    go cat.Do(c)
    println(<-c)
    println(<-c)
    return

    err := cat.Do(c)
    println(err)
    return

    test := func(param int) int {
        param += 1
        return param
    }
    
    fmt.Printf("%v",mymap(test,[]int{-1,0,1,2}))
	s := st.NewDoStack()
    fmt.Printf("%v",*s)


    d := mList.NewDoList()
    d.TestList()
    d.TestMList()

}
