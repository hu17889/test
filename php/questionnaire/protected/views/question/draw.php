<!--<canvas id = "myCanvas" width="600" height="600" style="border:2px solid;">Canvas画线技巧</canvas>-->
<div id="container"></div>
<script src="/js/kinetic.js"></script>
<script defer="defer">
width = height = 600;

var stage = new Kinetic.Stage({
    container: 'container',
        width: width,
        height: height 
});

var layer = new Kinetic.Layer();
initLine = [
    [[width/4, 0, width/4, height],"red",1],
    [[width/2, 0, width/2, height],"blue",3],
    [[3*width/4, 0, 3*width/4, height],"red",1],
    [[0, height/4, width, height/4],"red",1],
    [[0, height/2, width, height/2],"blue",3],
    [[0, 3*height/4, width, 3*height/4],"red",1]
];
for(x in initLine) {
    var line = new Kinetic.Line({
        points: initLine[x][0],
            stroke: initLine[x][1],
            strokeWidth: initLine[x][2]
    });
    layer.add(line);
}

// point
for(i=1;i<8;i+=2) {
    for(j=1;j<8;j+=2) {
        var circle = new Kinetic.Circle({
            x: width*i/8,
                y: height*j/8,
                radius: 4,
                fill: 'black',
                stroke: 'black',
                strokeWidth: 1
        });
        layer.add(circle);
    }
}
stage.add(layer);

points = [[width/8,height/8],[3*width/8,5*height/8],[7*width/8,5*height/8]];
num = 0;
p0 = points[0];
p1 = points[1];
xScale = p1[0]-p0[0];
yScale = p1[1]-p0[1];
// line
var anim = new Kinetic.Animation(function(frame) {
    // 可以修改速率
    fast = 1;
    xadd = xScale/(frame.frameRate*fast); 
    yadd = yScale/(frame.frameRate*fast);
    if(p0[0]>=p1[0]) {
        num++;
        if(num+1>=points.length) return;
        p0 = points[num];
        p1 = points[num+1];
        xScale = p1[0]-p0[0];
        yScale = p1[1]-p0[1];
        return;
    }
    pt = [p0[0]+xadd, p0[1]+yadd];
    var line = new Kinetic.Line({
        points: [p0,pt],
            stroke: 'black',
            strokeWidth: 1
    });
    p0 = pt;
    layer.add(line);
}, layer);
anim.start();




x = function() {
height = width = 600;
var myCanvas = document.getElementById("myCanvas");
var context =  myCanvas.getContext("2d");
context.strokeStyle = "rgba(255,0,0,1)";
context.fillStyle = "#FF0000";
//x轴
context.moveTo(width/2, 0);
context.lineTo(width/2, height);
//y轴
context.moveTo(0, height/2);
context.lineTo(width, height/2);
context.stroke();//画线
context.restore();

context.beginPath();
context.strokeStyle = "rgba(0,0,255,1)";
context.moveTo(width/4, 0);
context.lineTo(width/4, height);
context.moveTo(3*width/4, 0);
context.lineTo(3*width/4, height);

//context.fill();//填充
context.stroke();//画线
//context.beginPath(); //清空子路径
//context.closePath(); //闭合路径

};
</script>
