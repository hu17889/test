package main

import (
	"fmt"
	st "stack"
)



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
	s := st.NewDoStack()
	println(s)
    fmt.Printf("%v",*s)
	// ret,err = s.Pop()
	// println(ret,err)
	// ret,err = s.Pop()
	// println(ret,err.Error())
	// fmt.Print(err)
    // fmt.Printf("%v",*s)

}
