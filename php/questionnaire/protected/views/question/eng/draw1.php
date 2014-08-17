<!--<canvas id = "myCanvas" width="600" height="600" style="border:2px solid;">Canvas画线技巧</canvas>-->
<form>
Participant id:<input type="text" name="qid" value="<?php echo htmlspecialchars($qid);?>"/>
    <input type="hidden" name="lang" value="<?php echo htmlspecialchars($lang);?>"/>
<input type="submit">
</form>

<div id="container"></div>
<script src="/js/kinetic.js"></script>
<script defer="defer">
// x,y =>
//colorMap = ["#FF0000","#FF3300","#FF6600","#FF9900","#FFCC00","#FFFF00", "#CCFF00","#99FF00","#66FF00","#33FF00","#00FF00","#00FF33","#00FF66","#00FF99",
//"#00FFCC","#00FFFF","#00CCFF","#0099FF","#0066FF","#0033FF","#0000FF","#3300FF","#6600FF","#9900FF","#CC00FF","#FF00FF","#FF00CC","#FF0099","#FF0066","#FF0033"];
colorMap = ["#FF0000","#BB4444","#BB7444","#FF6600","#FFCC00","#BBA344","#CCFF00","#A3BB44","#FFFF00", "#66FF00", "#4DB34D","#00FFFF",
 "#448CBB","#0099FF","#0033FF", "#3C57C4","#573CC4", "#808080", "#9900FF", "#8D3CC4", "#C43CC4", "#FF00FF", "#FF0099", "#FF0099", "#C43C57", "#FF0033"]
pointMap = {
    "1_1" : [1,1],
    "2_1" : [3,1],
    "3_1" : [5,1],
    "4_1" : [7,1],
    "1_2" : [1,3],
    "2_2" : [3,3],
    "3_2" : [5,3],
    "4_2" : [7,3],
    "1_3" : [1,5],
    "2_3" : [3,5],
    "3_3" : [5,5],
    "4_3" : [7,5],
    "1_4" : [1,7],
    "2_4" : [3,7],
    "3_4" : [5,7],
    "4_4" : [7,7]
};
width = height = 600;

textwidth = 180;
colnamewidth = 100;
var stage = new Kinetic.Stage({
    container: 'container',
        width: width+colnamewidth+textwidth,
        height: height+colnamewidth
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

// text name
textarray = [
    [width/8-60, height+50,"Equidistant Location"],
    [3*width/8-80, height+80,"Unit with Devices Damaged"],
    [5*width/8-80, height+50,"Spare Power Supply"],
    [7*width/8-80, height+80,"Estimated Repair Time"],
];
for(x in textarray) {
	var text1 = new Kinetic.Text({
		x: textarray[x][0],
			y: textarray[x][1],
			text:textarray[x][2],
			fontSize: 15,
			fontFamily: '黑体',
			fill: 'black',
	});
	layer.add(text1);
}
textarray = [
    [width+30, height/8,"A"],
    [width+30, 3*height/8,"B"],
    [width+30, 5*height/8,"C"],
    [width+30, 7*height/8,"D"],
];
for(x in textarray) {
	var text1 = new Kinetic.Text({
		x: textarray[x][0],
			y: textarray[x][1],
			text:textarray[x][2],
			fontSize: 20,
			fontFamily: '黑体',
			fill: 'black',
	});
	layer.add(text1);
}


swidth = width+colnamewidth
for(x in colorMap) {
	seg = height/colorMap.length;
	var rect = new Kinetic.Rect({
		x: swidth,
		y: seg*x,
		width: textwidth/2,
		height: seg,
		fill: colorMap[x],
		stroke: 'black',
		strokeWidth: 4
	});
	x = parseInt(x);
	if(x < 20) {
		from = x*4+1;
		to = (x+1)*4;
		text = from + " - " + to;
	} else {
		from = 80 + (x-20)*10+1;
		to = 80 + (x-19)*10;
		text = from + " - " + to;
	}
	//console.log(x,from,to);
	var complexText = new Kinetic.Text({
		x: swidth+textwidth/2+10,
		y: seg*x,
		text: text,
		fontSize: 18,
		fontFamily: 'Calibri',
		fill: '#555',
	});
	layer.add(rect);
	layer.add(complexText);
}

// point
for(i=1;i<8;i+=2) {
    for(j=1;j<8;j+=2) {
        var circle = new Kinetic.Circle({
            x: width*i/8,
                y: height*j/8,
                radius: 1,
                fill: 'black',
                stroke: 'black',
                strokeWidth: 1
        });
        layer.add(circle);
    }
}

//points = [[width/8,height/8],[3*width/8,5*height/8],[7*width/8,5*height/8]];
points = [];
<?php foreach($points as $point) {?>
p = pointMap["<?php echo $point["x"];?>_<?php echo $point["y"];?>"];
points.push([p[0]*width/8,p[1]*height/8]);
<?php } ?>
	
num = 0;
p0 = points[0];
p1 = points[1];
ps = points[0];
pe = points[1];
xScale = p1[0]-p0[0];
yScale = p1[1]-p0[1];
// line
colorNum = 0;
var anim = new Kinetic.Animation(function(frame) {
    // 可以修改速率
    fast = 1;
    xadd = xScale/(frame.frameRate*fast); 
    yadd = yScale/(frame.frameRate*fast);
    // 终止条件
    if(((pe[0]-ps[0])*(p1[0]-p0[0])<=0)&&((pe[1]-ps[1])*(p1[1]-p0[1])<=0)) {
		// 画点
        if(num+1>=points.length) return;
		if(num>80) {
			colorNum = 20 + Math.floor(num/10);
		} else {
			colorNum = Math.floor(num/4);
		}
		if(points.length>80) {
			pointnum = 20 + Math.ceil((points.length-80)/10);
		} else {
			pointnum = Math.ceil((points.length)/4);
		}
		step = 80/pointnum
//console.log(pointnum,colorNum,(pointnum-colorNum)*3.5,step)
		var tp = new Kinetic.Circle({
            x: p0[0],
			y: p0[1],
			radius: (pointnum-colorNum)*step,
			fill: colorMap[colorNum],
			stroke: colorMap[colorNum],
			strokeWidth: 1
		});
    	layer.add(tp);

        num++;
        if(num+1>=points.length) return;
        p0 = points[num];
        p1 = points[num+1];
        ps = points[num];
        pe = points[num+1];
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
stage.add(layer);




</script>
