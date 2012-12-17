package cat

import (
    "os"
    //"fmt"
    "bufio"
    "io"
    "flag"
    "strconv"
)


func Do() (error) {
    // for k,v:=range(os.Args) {
        // println(k,v)
    // }
    var filePath = flag.String("p","/server/webapps/hucong/test/go/src/main/hello.go","")
    var hasLineNum = flag.Bool("n",false,"test bool")
    flag.Parse()

    file,err := os.Open(*filePath)
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

        if(*hasLineNum==true) {
            line = strconv.Itoa(i) + " " + line
        }
        os.Stdout.WriteString(line)
    }

    return nil
}


