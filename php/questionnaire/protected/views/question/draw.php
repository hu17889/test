<!--<canvas id = "myCanvas" width="600" height="600" style="border:2px solid;">Canvas画线技巧</canvas>-->
<form>
问卷id:<input type="text" name="qid" value=""/>
<input type="submit">
</form>

<div id="container"></div>
<script src="/js/kinetic.js"></script>
<script defer="defer">
// x,y =>
pointMap = {
    "1_1" : [7,1],
    "2_1" : [5,1],
    "3_1" : [5,3],
    "4_1" : [7,3],
    "1_2" : [3,1],
    "2_2" : [1,1],
    "3_2" : [1,3],
    "4_2" : [3,3],
    "1_3" : [3,5],
    "2_3" : [1,5],
    "3_3" : [1,7],
    "4_3" : [3,7],
    "1_4" : [7,5],
    "2_4" : [5,5],
    "3_4" : [5,7],
    "4_4" : [7,7]
};
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

//points = [[width/8,height/8],[3*width/8,5*height/8],[7*width/8,5*height/8]];
points = [];
<?php foreach($points as $point) {?>
p = pointMap["<?php echo $point["x"];?>_<?php echo $point["y"];?>"];
points.push([p[0]*width/8,p[1]*height/8]);
<?php } ?>
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




</script>
