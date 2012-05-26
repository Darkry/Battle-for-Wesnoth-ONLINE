var unitSelect = false;
var unitSelectCoor = null;
var unitSelectId = null;

function getHovered(x, y) {
    var coor = getCoor(y,x);
    var classVar = coor["x"]+"a"+coor["y"];
    if($('div.unit.'+classVar).length != 0) {
        return $('#units div.'+classVar);
    }
    if($('#playground div.'+classVar).length != 0) {
        return $('#playground div.'+classVar);
    }
    return false;
};

function getCoor(top1, left) {
    var coor = new Array();
    coor["x"] = (left / 54) + 1;
    if((coor["x"] % 2) == 0) {
        var i = 36;
    }
    else {
        var i = 0;
    }
    coor["y"] = ((top1 - i) / 72) + 1;
    return coor;
}

function getPosition(x, y) {
    if((x%2)==0)
        i = 36;
    else
        i = 0;
    result = new Array();
    result["x"] = (x-1) * 54;
    result["y"] = ((y -1) * 72)+i;
    return result;
}

function getNeighbour(x,y) {
    var returnVal = new Array();
    if(x%2 == 1) {
        returnVal[1] = new Array(x,y-1);
        returnVal[2] = new Array(x+1,y-1);
        returnVal[3] = new Array(x+1,y);
        returnVal[4] = new Array(x,y+1);
        returnVal[5] = new Array(x-1,y);
        returnVal[6] = new Array(x-1,y-1);
    }
    else if(x%2 == 0) {
        returnVal[1] = new Array(x,y-1);
        returnVal[2] = new Array(x+1,y);
        returnVal[3] = new Array(x+1,y+1);
        returnVal[4] = new Array(x,y+1);
        returnVal[5] = new Array(x-1,y+1);
        returnVal[6] = new Array(x-1,y);
    }
    return returnVal;
}

function markVisit(visited, toVisit, movement) {
    if(toVisit.length == 0) {
        return;
    }
    var visit = toVisit.shift();
    var index = visited.length;
    visited[index] = visit["x"]+"a"+visit["y"];
    if(visit["dist"] > movement || $('#playground div.'+visit["x"]+'a'+visit["y"]).length == 0) {
        markVisit(visited, toVisit, movement);
        return;
    }
    if(visit["dist"] < movement) {
        var neighbours = getNeighbour(visit["x"], visit["y"]);
        var visitedString = visited.toString();
        for(i = 1; i < neighbours.length; i++) {
            index = toVisit.length;
            if(visitedString.search(neighbours[i][0]+"a"+neighbours[i][1]) == -1) { //NEFUNGUJE
                toVisit[index] = new Array();
                toVisit[index]["x"] = neighbours[i][0];
                toVisit[index]["y"] = neighbours[i][1];
                toVisit[index]["dist"] = visit["dist"]+1;
            }
        }
    }
    $('div.'+visit["x"]+'a'+visit["y"]).find('div.disabled').removeClass('disabled');
    markVisit(visited, toVisit, movement);
    return;
}

$(document).ready(function() {    
    $('#mapHover').live("click", function(e) {
        var offset = $(this).offset();
        var newTarget = getHovered(offset.left, offset.top);
        if (newTarget) $(newTarget).trigger('click');
    });


    $('#playground div.ground, #units div.unit').live("hover",function() {
        var x = $(this).css('left');
        var y = $(this).css('top');
        $('#mapHover').css({
            'top': y,
            'left': x,
            'display': 'block'
        });
    });

    $('#playground div.ground').each(function() {
        $(this).mouseenter(function() {
            if(unitSelect == true) {
                $('#playground div.ground div.path').each(function() {
                    $(this).removeClass('path');
                });
                if($(this).find('div.disabled').length == 0) {
                    var offset = $(this).offset();
                    var groundCoor = getCoor(offset.top, offset.left);
                    findPath(unitSelectCoor["x"], unitSelectCoor["y"], groundCoor["x"], groundCoor["y"]); //calling A*
                }
            }
        });
    });

    $('#playground div.ground').live("click", function() {
        if(unitSelect == true && $(this).find("div.disabled").length < 1) {
            var offset = $(this).offset();
            var groundCoor = getCoor(offset.top, offset.left);
            $.get(moveUrl+"&unitId="+unitSelectId+"&tox="+groundCoor["x"]+"&toy="+groundCoor["y"]);
            unitSelect = false;
            $('#playground div.ground').each(function() {
                $(this).find("div").removeClass("disabled").removeClass("path");
            });
        }
    });

    $('div.unit').live("click", function() {
        $('#playground div.ground').each(function() {
            $(this).html("<div class=\"disabled\"></div>");
        });
        
        var movement = $(this).find('div.data.movement').text();
        //var movement = prompt("Movement:","");
        var offset = $(this).offset();
        var coor = getCoor(offset.top, offset.left);
        $(this).prev().addClass('selected');
        
        var visited = new Array();
        var toVisit = new Array();
        toVisit[0] = coor;
        toVisit[0]["dist"] = 0;
        // starttime=new Date();
        markVisit(visited, toVisit, movement);
        // endtime=new Date();
        // alert(endtime-starttime);
        unitSelect = true;
        unitSelectCoor = new Array();
        unitSelectCoor["x"] = coor["x"];
        unitSelectCoor["y"] = coor["y"];
        unitSelectId = $(this).attr("uid");
    });
});