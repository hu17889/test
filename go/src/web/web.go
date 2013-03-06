package web

import(
    "net"
    "os"
    "fmt"
    "io/ioutil"
    "time"
    "strconv"
)


type Web struct{
    hcon net.Conn
}

func NewWeb() *Web {
    return &Web{}
}

func (w *Web) TestDial() {
    var err error
    w.hcon,err = net.Dial("tcp","127.0.0.1:80")
    checkError(err)

    _,err = w.hcon.Write([]byte("HEAD / HTTP/1.0\r\n\r\n"))
    checkError(err)

    /*
    var result
    result,err = readFully(conn)
    checkError(err)

    fmt.Println(string(result))

    os.Exit(0)
    */

}

func (w *Web) TestParseIp() (addr net.IP, err error) {
    if len(os.Args)!=2 {
        return net.IP(""), fmt.Errorf("Usage: %s ip-addr\n",os.Args[0])
    }

    name := os.Args[1]
    addr = net.ParseIP(name)
    if addr == nil {
        return net.IP(""), fmt.Errorf("Invalid address\n")
    } else {
        return net.IP(""), fmt.Errorf("The address is: %s", addr)
    }
    return addr, nil
}

func (w *Web)GetHead() {
    if len(os.Args)!=2 {
        fmt.Printf("Usage: %s host-prot\n",os.Args[0])
    }
    service := os.Args[1]
    tcpAddr, err := net.ResolveTCPAddr("tcp4",service)
    checkError(err)

    conn,err := net.DialTCP("tcp4",nil,tcpAddr)
    checkError(err);

    _,err = conn.Write([]byte("HEAD / HTTP/1.0\r\n\r\n"))
    checkError(err);

    result,err := ioutil.ReadAll(conn)
    checkError(err);

    fmt.Printf(string(result))
    os.Exit(0)
}

func (w *Web)TestListenTcp() {
    service := ":1200"
    tcpAddr, err := net.ResolveTCPAddr("ip4",service)
    checkError(err)

    listener, err := net.ListenTCP("tcp",tcpAddr)
    checkError(err)

    for {
        conn,err := listener.Accept()
        if err!=nil {
            continue
        }

        daytime := time.Now().String()
        conn.Write([]byte(daytime))
        conn.Close()
    }
}

//------------------
// 回显

// client
func (w *Web) Client() {
    //tcpAddr,err := net.ResolveTCPAddr("tcp4","10.16.15.63:1201")
    tcpAddr,err := net.ResolveTCPAddr("tcp4",":1201")
    checkError(err)

    conn,err := net.DialTCP("tcp4",nil,tcpAddr)
    checkError(err)

    var buf [512]byte
    for {
        inStr := string("")
        n,err := fmt.Scan(&inStr)
        checkError(err)

        n,err = conn.Write([]byte(inStr))
        checkError(err)
        println("send "+strconv.Itoa(n)+":"+inStr)

        n,err = conn.Read(buf[0:])
        checkError(err)
        println("read "+strconv.Itoa(n)+string(buf[0:]))
    }
    conn.Close()

}


// server
func (w *Web) Echo() {
    service := ":1201"
    tcpAddr,err := net.ResolveTCPAddr("tcp4",service)
    checkError(err)

    listener,err := net.ListenTCP("tcp",tcpAddr)
    for {
        conn,err := listener.Accept()
        println("connect succ!")
        if err!=nil {
            continue
        }
        go w.handleConnn(conn)
    }
}

func (w *Web) handleConnn(conn net.Conn) {
    defer conn.Close()
    var buf [512]byte
    for {
        n,err := conn.Read(buf[0:])
        if err != nil {
            return
        }

        _,err2 := conn.Write(buf[0:n])
        if err2 != nil {
            return
        }
    }
}

//---------------------
// common

func checkError(err error) {
    if err != nil {
        fmt.Fprintf(os.Stderr, "Fatal error:%s", err.Error())
        os.Exit(1)
    }
}
