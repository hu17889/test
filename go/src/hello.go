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
	s := st.NewStack()
	s.Push(1)
	s.Push(2)
    fmt.Printf("%v",*s)
}
