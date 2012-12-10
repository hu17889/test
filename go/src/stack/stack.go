package stack



import (
	"errors"
	"fmt"
)

func NewStack() *Stack {
	return &Stack{}

}

func NewDoStack() *DoStack {
	dos := &DoStack{}
	dos.s = NewStack()
	return dos
}

type DoStack struct {
	s *Stack
}

type Stack struct {
	top int
	data [10]int
}

func (s Stack)Highth() int {
	return  len(s.data)
}


func (s *Stack)Pushs(param ...int) (err error) {
	if(s.Highth()-s.top < len(param)) {
		err = errors.New("no enough space")
	}
	for _,val := range(param) {
		if err = s.Push(val); err!=nil {
			return err
		}
	}
	return
}

func (s *Stack)Push(param int) (err error) {
	if s.top!=s.Highth() {
		s.data[s.top] = param
		s.top++
	} else {
		err = errors.New("no enough space")
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
