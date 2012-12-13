package main

import (
	"fmt"
	st "stack"
    mList "m_list"
)

func mymap(doFunc func(int) int,params []int) []int {
    for key,value := range(params) {
        params[key] = doFunc(value)
    }
    return params
}



func main() {
	// a:=[3]int{1,2,3}
	// var t = true
	// s := "string"
    // fmt.Println(a)
    // fmt.Println(t)
    // fmt.Printf("%x",s)
	// var s *stack.Stack
	// s := new(st.Stack)
	// s := st.NewStack()
	// s.Push(1)
	// s.Push(2)
	// s.Pushs(3,4,5)
    // fmt.Printf("%v",*s)
	// ret,err := s.Pop()
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

	// ret,err = s.Pop()
	// println(ret,err)
	// ret,err = s.Pop()
	// println(ret,err.Error())
	// fmt.Print(err)
    // fmt.Printf("%v",*s)

}
