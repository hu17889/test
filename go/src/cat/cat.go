package cat

import (
    "os"
    //"fmt"
    "bufio"
    "io"
    //"flag"
    "strconv"
)


func Do(c chan int) (error) {
    endfunc := func(c chan int) {
        c<-1
    }
    defer endfunc(c)
    // for k,v:=range(os.Args) {
        // println(k,v)
    // }
    //var filePath = flag.String("p","/server/webapps/hucong/test/go/src/main/hello.go","")
    var filePath string = "/server/webapps/hucong/test/go/src/main/hello.go"
    //var hasLineNum = flag.Bool("n",false,"test bool")
    var hasLineNum bool = true
    //flag.Parse()

    file,err := os.Open(filePath)
    defer file.Close()
    if err!=nil {
        return err
    }
    
    var reader = bufio.NewReader(file)
    for i:=0;;i++ {
        var line,err = reader.ReadString('\n')
        if err == io.EOF {
            return nil
        } else if err!=nil {
            return err
        }

        if(hasLineNum==true) {
            line = strconv.Itoa(i) + " " + line
        }
        os.Stdout.WriteString(line)
    }

    return nil
}


