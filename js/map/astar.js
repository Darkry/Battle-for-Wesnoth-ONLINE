/* 
* A* algorithm for finding shortest path
*/	
//kontroluje jestli je pole pro jednotku dostupné
function hex_accessible(x,y) {
    if(document.getElementById("unit"+x+"a"+y) == null)
        return true;
    else
        return false;
}
                
//spočítá vzdálenost dvou políček
function hex_distance(x1,y1,x2,y2) {
    return Math.abs(x2-x1) + Math.abs(y2-y1);
}

function markPath(x, y) {
    $("div.ground."+x+"a"+y).html("<div class=\"path\"></div>");
}
		
// A* Pathfinding with Manhatan Heuristics for Hexagons.
function findPath(start_x, start_y, end_x, end_y) {
    // Check cases path is impossible from the start.
    var error=0; //chyby
    if(start_x == end_x && start_y == end_y) error=1; //stejný cíl jako start
    if(!hex_accessible(end_x,end_y)) error=1; //pole konce není dostupné
    if(error==1) {
        return false;
    }
    // Init
    var openlist = new Array(mapsize_x*mapsize_y+2); //seznam všech polí, která jsou otevřená -> true pokud je otevřeno
    var openlist_x = new Array(mapsize_x); //jejich x-ové souřadnice
    var openlist_y = new Array(mapsize_y); //jejich ypsilonové souřadnice
    var statelist = MultiDimensionalArray(mapsize_x+1,mapsize_y+1); // current open or closed state
    var openlist_g = MultiDimensionalArray(mapsize_x+1,mapsize_y+1); //pro každé políčko ukládá jeho hodnotu G -> "náklady" na dostání se z bodu výchozího (start) na toto pole
    var openlist_f = MultiDimensionalArray(mapsize_x+1,mapsize_y+1); //pro každé pole ukládá jeho hodnotu F -> G+H
    var openlist_h = MultiDimensionalArray(mapsize_x+1,mapsize_y+1); //pro každé pole ukládá jeho hodnotu H -> odhadované "náklady" na dostání se z tohoto políčka do cíle
    var parent_x = MultiDimensionalArray(mapsize_x+1,mapsize_y+1); //ukládá x-ovou souřadnici rodiče každého pole
    var parent_y = MultiDimensionalArray(mapsize_x+1,mapsize_y+1); //ukládá y-novou souřadnici rodiče každého pole
    var path = MultiDimensionalArray(mapsize_x*mapsize_y+2,2); //cesta nalezená

    var select_x = 0; //pole se kterým pracujeme
    var select_y = 0; //pole se kterým pracujeme
    var node_x = 0;
    var node_y = 0;
    var counter = 1; // Openlist_ID counter
    var selected_id = 0; // Actual Openlist ID
			
    // Add start coordinates to openlist.
    openlist[1] = true;
    openlist_x[1] = start_x;
    openlist_y[1] = start_y;
    openlist_f[start_x][start_y] = 0;
    openlist_h[start_x][start_y] = 0;
    openlist_g[start_x][start_y] = 0;
    statelist[start_x][start_y] = true; 
			
    // Try to find the path until the target coordinate is found
    while (statelist[end_x][end_y] != true) {
        set_first = true;
        // Find lowest F in openlist
        for (var i in openlist) {
            if(openlist[i] == true){ //true značí, že je otevřeno
                select_x = openlist_x[i]; 
                select_y = openlist_y[i]; 
                if(set_first == true) { //první průběh
                    lowest_found = openlist_f[select_x][select_y];
                    set_first = false;
                }
                if (openlist_f[select_x][select_y] <= lowest_found) { //pokud je to "lepší cesta" == má nižší f
                    lowest_found = openlist_f[select_x][select_y];
                    lowest_x = openlist_x[i];
                    lowest_y = openlist_y[i];
                    selected_id = i;
                }
            }
        }
        if(set_first==true) { //předchozí cyklus neproběhl ani jednou
            // open_list is empty
            alert('No possible route can be found.');
            return false;
        }
        // add it lowest F as closed to the statelist and remove from openlist
        statelist[lowest_x][lowest_y] = 2; //-> 2 znamená closed list
        openlist[selected_id]= false;
        // Add connected nodes to the openlist
        for(i=1;i<7;i++) {
            // Run node update for 6 neighbouring tiles.
            var neighbour = getNeighbour(lowest_x, lowest_y);
            neighbour = neighbour[i];
            node_x = neighbour[0];
            node_y = neighbour[1];
            
            if (hex_accessible([node_x],[node_y])) { //pokud je hex přístupný
                if(statelist[node_x][node_y] == true) {
                    if(openlist_g[node_x][node_y] < openlist_g[lowest_x][lowest_y]) { //pokud existuje na toto políčko snažší cesta než přes rodiče, změníme rodiče
                        parent_x[lowest_x][lowest_y] = node_x;
                        parent_y[lowest_x][lowest_y] = node_y;
                        openlist_g[lowest_x][lowest_y] = openlist_g[node_x][node_y] + 10;
                        openlist_f[lowest_x][lowest_y] = openlist_g[lowest_x][lowest_y] + openlist_h[lowest_x][lowest_y];
                    }
                } else if (statelist[node_x][node_y] == 2) {
                // its on closed list do nothing.
                } else {
                    counter++;
                    // add to open list
                    openlist[counter] = true;
                    openlist_x[counter] = node_x;
                    openlist_y[counter] = node_y;
                    statelist[node_x][node_y] = true;
                    // Set parent
                    parent_x[node_x][node_y] = lowest_x;
                    parent_y[node_x][node_y] = lowest_y;
                    // update H , G and F
                    var ydist = end_y - node_y;
                    if ( ydist < 0 ) ydist = ydist*-1;
                    var xdist = end_x - node_x;
                    if ( xdist < 0 ) xdist = xdist*-1;	
                    openlist_h[node_x][node_y] = hex_distance(node_x,node_y,end_x,end_y) * 10;
                    openlist_g[node_x][node_y] = openlist_g[lowest_x][lowest_y] + 10;
                    openlist_f[node_x][node_y] = openlist_g[node_x][node_y] + openlist_h[node_x][node_y];
                    
                }
            }
        }
    }
			
    // Get Path
    temp_x=end_x;
    temp_y=end_y;
    
    counter = 0;
    while(temp_x != start_x || temp_y != start_y) {
        counter++;
        path[counter][1] = temp_x;
        path[counter][2] = temp_y;
        temp_x = parent_x[path[counter][1]][path[counter][2]];
        temp_y = parent_y[path[counter][1]][path[counter][2]];
    }
    counter++;
    path[counter][1] = start_x;
    path[counter][2] = start_y;
	//	alert(counter);	
    // Draw path.
    while(counter!=0) {
        markPath(path[counter][1], path[counter][2]);
        counter--;
    }
}