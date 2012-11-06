package stack



import (
	"errors"
	"fmt"
)

func NewStack() *Stack {
	return &Stack{}

}

type Stack struct {
	top int
	data [10]int
}

func (s Stack)Highth() int {
	return  len(s.data)
}

func (s *Stack)Push(param ...interface{}) (ret bool) {
	if s.top!=s.Highth() {
		s.data[s.top] = param
		s.top++
		ret = true
	} else {
		ret = false
	}
	return
}

func (s *Stack)Pop() (ret int, err error) {
	if s.top==0 {
		err = errors.New("empty stack")
	} else {
		s.top--
		ret = s.data[s.top]
	}
	return
}

func (s Stack) String() string {
	if(s.top==0) {
		return "[]"
	}
	str := ""
	for i:=0;i<s.top;i++ {
		str += "[" + fmt.Sprintf("%v %v",i,s.data[i]) + "] "
	}
	return str
}
