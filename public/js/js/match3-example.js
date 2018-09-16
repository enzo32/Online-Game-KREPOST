// The function gets called when the window is fully loaded
$(document).ready(function(){
    // Get the canvas and context
    var mycanvas = $("#viewport");
    var hod = 0; // 0 - player 1, 1 - player 2
    
    var countdown = $('#countdown span'),
    //but = $('button'),
    timer;
    //var canvas = document.getElementById("viewport");
    //var context = canvas.getContext("2d");
    //var hod = 0;
    
    // Timing and frames per second
    var lastframe = 0;
    var fpstime = 0;
    var framecount = 0;
    var fps = 0;
    
    // Mouse dragging
    var drag = false;
    
    // Level object
    var level = {
        x: 40,         // X position
        y: 10,         // Y position
        columns: 8,     // Number of tile columns
        rows: 8,        // Number of tile rows
        tilewidth: 70,  // Visual width of a tile
        tileheight: 70, // Visual height of a tile
        tiles: [],      // The two-dimensional tile array
        selectedtile: { selected: false, column: 0, row: 0 }
    };

var imgs = [
        ['img/tiles/airElement.jpg'],
        ['img/tiles/earthElement.jpg'],
        ['img/tiles/fireElement.jpg'],
        ['img/tiles/deathElement.jpg'],
        ['img/tiles/astralElement.jpg'],
        ['img/tiles/waterElement.jpg'],
        ['img/tiles/mightElement.jpg'],
        ['img/tiles/shieldElement.jpg']];

    // All of the different tile colors in RGB
    var tilecolors = [[255, 128, 128],
                      [128, 255, 128],
                      [128, 128, 255],
                      [255, 255, 128],
                      [255, 128, 255],
                      [128, 255, 255],
                      [255, 255, 255]];
    
    // Clusters and moves that were found
    var clusters = [];  // { column, row, length, horizontal }
    var moves = [];     // { column1, row1, column2, row2 }

    // Current move
    var currentmove = { column1: 0, row1: 0, column2: 0, row2: 0 };
    
    // Game states
    var gamestates = { init: 0, ready: 1, resolve: 2 };
    var gamestate = gamestates.init;
    
    // Score
    var score = 0;
    
    // Animation variables
    var animationstate = 0;
    var animationtime = 0;
    var animationtimetotal = 0.3;
    
    // Show available moves
    var showmoves = false;
    
    // The AI bot
    var aibot = false;
    
    // Game Over
    var gameover = false;
    
    // Gui buttons
    var buttons = [ { x: 30, y: 240, width: 150, height: 50, text: "New Game"},
                    { x: 30, y: 300, width: 150, height: 50, text: "Show Moves"},
                    { x: 30, y: 360, width: 150, height: 50, text: "Enable AI Bot"}];
    
    //**************************************************************************//
    // Initialize the game
    function init() {
        
        // Add mouse events
        mycanvas.on("mousemove", onMouseMove);
        mycanvas.on("mousedown", onMouseDown);
        mycanvas.on("mouseup", onMouseUp);
        mycanvas.on("mouseout", onMouseOut);
        
        // Initialize the two-dimensional tile array
        for (var i=0; i<level.columns; i++) {
            level.tiles[i] = [];
            for (var j=0; j<level.rows; j++) {
                // Define a tile type and a shift parameter for animation
                level.tiles[i][j] = { type: 0, shift:0 }
            }
        }
        
        // New game
        newGame();
        
        // Enter main loop
        main(0);
    }
    
    //*****************************************************************//
     // Start a new game
    function newGame() {
        // Reset score
        score = 0;
        
        // Set the gamestate to ready
        gamestate = gamestates.ready;
        
        // Reset game over
        //gameover = false;
        $("#player1").block();
        hod = 2;
        
        // Create the level
        createLevel();
        
        // Find initial clusters and moves
        findMoves();
        findClusters(); 
        playerchange(hod);
        
    }
    //*****************************************************************//
    // Create a random level
    function createLevel() {
        var done = false;
        
        // Keep generating levels until it is correct
        while (!done) {
        
            // Create a level with random tiles
            for (var i=0; i<level.columns; i++) {
                
                for (var j=0; j<level.rows; j++) {
                    
                    level.tiles[i][j].type = getRandomTile();
                    
                }
            }
            
            // Resolve the clusters
            resolveClusters();
            
            // Check if there are valid moves
            findMoves();
            
            // Done when there is a valid move
           
            if (moves.length > 0) {
                done = true;
            }
        }
    }
    //*****************************************************************//
        
    // Find available moves
    function findMoves() {
        // Reset moves
        moves = []
        
        // Check horizontal swaps
        for (var j=0; j<level.rows; j++) {
            for (var i=0; i<level.columns-1; i++) {
                // Swap, find clusters and swap back
               
                
                swap(i, j, i+1, j);
                findClusters();
                swap(i, j, i+1, j);
                
                // Check if the swap made a cluster
                if (clusters.length > 0) {
                    // Found a move
                    moves.push({column1: i, row1: j, column2: i+1, row2: j});
                }
            }
        }
        
        // Check vertical swaps
        for (var i=0; i<level.columns; i++) {
            for (var j=0; j<level.rows-1; j++) {
                // Swap, find clusters and swap back
                swap(i, j, i, j+1);
                findClusters();
             
                swap(i, j, i, j+1);
                
                // Check if the swap made a cluster
                if (clusters.length > 0) {
                    // Found a move
                    
                    moves.push({column1: i, row1: j, column2: i, row2: j+1});
                }
            }
        }
        
        // Reset clusters
        clusters = []
    }
    //*********************************************************************//
    function findClusters() {
        
        // Reset clusters
        clusters = []
        
        // Find horizontal clusters
        for (var j=0; j<level.rows; j++) {
            
           
            // Start with a single tile, cluster of 1
            var matchlength = 1;
            for (var i=0; i<level.columns; i++) {
                var checkcluster = false;
                
                if (i == level.columns-1) {
                    // Last tile
                    checkcluster = true;
                } else {
                    
                    
                    // Check the type of the next tile
                    if (level.tiles[i][j].type == level.tiles[i+1][j].type && level.tiles[i][j].type != -1) {
                        
                        // Same type as the previous tile, increase matchlength
                        matchlength += 1;
                    } else {
                        // Different type
                        checkcluster = true;
                    }
                }
                
                // Check if there was a cluster
                if (checkcluster) {
                    if (matchlength >= 3) {
                        // Found a horizontal cluster
                        clusters.push({ column: i+1-matchlength, row:j,
                                        length: matchlength, horizontal: true });
                    }
                    
                    matchlength = 1;
                }
            }
        }

        // Find vertical clusters
        for (var i=0; i<level.columns; i++) {
            // Start with a single tile, cluster of 1
            var matchlength = 1;
            for (var j=0; j<level.rows; j++) {
                var checkcluster = false;
                
                if (j == level.rows-1) {
                    // Last tile
                    checkcluster = true;
                } else {
                    // Check the type of the next tile
                    if (level.tiles[i][j].type == level.tiles[i][j+1].type &&
                        level.tiles[i][j].type != -1) {
                        // Same type as the previous tile, increase matchlength
                        matchlength += 1;
                    } else {
                        // Different type
                        checkcluster = true;
                    }
                }
                
                // Check if there was a cluster
                if (checkcluster) {
                  
                    if (matchlength >= 3) {
                      
                        // Found a vertical cluster
                        clusters.push({ column: i, row:j+1-matchlength,
                                        length: matchlength, horizontal: false });
                    }
                    
                    matchlength = 1;
                }
            }
        }
    }
    //*********************************************************************//
    function main(tframe) {
        
        // Request animation frames
        window.requestAnimationFrame(main);
        
        // Update and render the game
        update(tframe);
        
        render();
       
    }
    //*********************************************************************//
    
    
    // Update the game state
    function update(tframe) {
        
        var dt = (tframe - lastframe) / 1000;
        lastframe = tframe;
        
        // Update the fps counter
        updateFps(dt);
  
        if (gamestate == gamestates.ready) {
            // Game is ready for player input
            // Check for game over
            if (moves.length <= 0) {
                newGame();
                //gameover = true;
            }
            
            // Let the AI bot make a move, if enabled
            if (aibot) {
                animationtime += dt;
                if (animationtime > animationtimetotal) {
                    // Check if there are moves available
                    findMoves();
                    
                    if (moves.length > 0) {
                        // Get a random valid move
                        var move = moves[Math.floor(Math.random() * moves.length)];
                        
                        // Simulate a player using the mouse to swap two tiles
                        mouseSwap(move.column1, move.row1, move.column2, move.row2);
                    } else {
                        // No moves left, Game Over. We could start a new game.
                        // newGame();
                    }
                    animationtime = 0;
                }
            }
        } else if (gamestate == gamestates.resolve) {
            // Game is busy resolving and animating clusters
            animationtime += dt;
            
            if (animationstate == 0) {
                // Clusters need to be found and removed
                if (animationtime > animationtimetotal) {
                    // Find clusters
                    findClusters();
                    
                    if (clusters.length > 0) {
                        // Add points to the score
                        
                        for (var i=0; i<clusters.length; i++) {
                            // Add extra points for longer clusters
                            
                            score += 100 * (clusters[i].length - 2);;
                            
                            
                        }
                    
                        // Clusters found, remove them
                        removeClusters();
                        
                        
                        // Tiles need to be shifted
                        animationstate = 1;
                    } else {
                      
                        // No clusters found, animation complete
                        gamestate = gamestates.ready;
                        
                    }
                    animationtime = 0;
                    
                }
            } else if (animationstate == 1) {
                
                // Tiles need to be shifted
                if (animationtime > animationtimetotal) {
                    // Shift tiles
                    shiftTiles();
                    
                    // New clusters need to be found
                    animationstate = 0;
                    animationtime = 0;
                    
                    // Check if there are new clusters
                    findClusters();
                    
                    if (clusters.length <= 0) {
                       
                        if(hod === 1){
                            $("#player1").unblock();
                            playerchange(hod);
                            $("#player2").block();
                            hod=0;
                           }else{
                               $("#player2").unblock();
                               playerchange(hod);
                               hod=1;
                               $("#player1").block();
                           }
                        
                        // Animation complete
                        gamestate = gamestates.ready;
                        

                        
                    }
                    
                }
                
            } else if (animationstate == 2) {
               
                
                // Swapping tiles animation
                if (animationtime > animationtimetotal) {
                    // Swap the tiles
                    swap(currentmove.column1, currentmove.row1, currentmove.column2, currentmove.row2);
                    
                    // Check if the swap made a cluster
                    findClusters();
                    if (clusters.length > 0) {
                        // Valid swap, found one or more clusters
                        // Prepare animation states
                        animationstate = 0;
                        animationtime = 0;
                        gamestate = gamestates.resolve;
                    } else {
                        // Invalid swap, Rewind swapping animation
                        animationstate = 3;
                        animationtime = 0;
                    }
                    
                    // Update moves and clusters
                    findMoves();
                    findClusters();
                    
                }
            } else if (animationstate == 3) {
                // Rewind swapping animation
               
                if (animationtime > animationtimetotal) {
                    // Invalid swap, swap back
                    swap(currentmove.column1, currentmove.row1, currentmove.column2, currentmove.row2);
                    // Animation complete
                    gamestate = gamestates.ready;
                }
            }
            
            // Update moves and clusters
            findMoves();
            findClusters();
            
        }
    }
    //*********************************************************************//
    
    function updateFps(dt) {
        if (fpstime > 0.25) {
            // Calculate fps
            fps = Math.round(framecount / fpstime);
            
            // Reset time and framecount
            fpstime = 0;
            framecount = 0;
        }
        
        // Increase time and framecount
        fpstime += dt;
        framecount++;
    }
    //*********************************************************************//
    
    // Draw text that is centered
    function drawCenterText(text, x, y, width) {
       
        mycanvas.drawText({
        fillStyle: "#ffffff",
        fontFamily: 'Verdana',
        text: text,    
        fontSize: 24,
        x:x + (width)/2,
        y:y
        });

    }
    //*********************************************************************//
    
    // Render the game
    function render() {
        // Draw the frame
        drawFrame();
        
        // Draw score
//        mycanvas.drawText({
//        fillStyle: "#000000",
//        fontFamily: 'Verdana',
//        text: "Score:" + score,    
//        fontSize: 24,
//        x:60,y:level.y+40,
//        width: 150
//        });
        
        // Draw buttons
       // drawButtons();
        
        // Draw level background
        var levelwidth = level.columns * level.tilewidth;
        var levelheight = level.rows * level.tileheight;
        mycanvas.drawRect({
        fillStyle: "#000000",
        x: level.x - 4, y: level.y - 4,
        fromCenter: false,
        width: levelwidth + 8,
        height: levelheight + 8,
        });
       
        
        // Render tiles
        renderTiles();
        
        // Render clusters
        renderClusters();
        
        // Render moves, when there are no clusters
        if (showmoves && clusters.length <= 0 && gamestate == gamestates.ready) {
            renderMoves();
        }
        
        // Game Over overlay
//        if (gameover) {
//            mycanvas.drawRect({
//        fillStyle: 'rgba(0, 0, 0, 0.8)',
//        x: level.x, y: level.y,
//        fromCenter: false,
//        width: levelwidth,
//        height: levelheight,
//        });
//            
//            mycanvas.drawText({
//        fillStyle: "#ffffff",
//        fontFamily: 'Verdana',
//        text: "Game Over!",    
//        fontSize: 24,
//        x:level.x,y:level.y + levelheight / 2 + 10, 
//        width: levelwidth
//        });
//        
//        }
    }
    
    //*********************************************************************//
    // Draw a frame with a border
    function drawFrame() {
        // Draw background and a border

        mycanvas.drawRect({
        fillStyle: '#d0d0d0',
        x: 0, y: 0,
        fromCenter: false,
        width: $(mycanvas)[0].width,
        height: $(mycanvas)[0].height
        });
        
        mycanvas.drawRect({
        fillStyle: '#e8eaec',
        x: 1, y: 1,
        fromCenter: false,
        width: $(mycanvas)[0].width-2,
        height: $(mycanvas)[0].height-2
            
            
        });
// Draw header
//        mycanvas.drawRect({
//        fillStyle: '#303030',
//        x: 0, y: 0,
//        fromCenter: false,
//        width: $(mycanvas)[0].width,
//        height: 65,
//            
//            
//        });
//      
        // Draw title
//        mycanvas.drawText({
//        fillStyle: "#ffffff",
//        fontFamily: 'Verdana',
//        text: "Match3 Example - Rembound.com",    
//        fontSize: 24,
//        x:220,y:15, 
//        });
        
        
        // Display fps
        
//        mycanvas.drawText({
//        fillStyle: "#ffffff",
//        fontFamily: 'Verdana',
//        text: "Fps " + fps,    
//        fontSize: 18,
//        x:45,y:50, 
//        });

        
    }
    
    //*********************************************************************//
    // Draw buttons
//    function drawButtons() {
//        for (var i=0; i<buttons.length; i++) {
//            // Draw button shape
//        mycanvas.drawRect({
//        fillStyle: '#000000',
//        x: buttons[i].x, y: buttons[i].y,
//        fromCenter: false,
//        width: buttons[i].width,
//        height: buttons[i].height,
//        });
//        mycanvas.drawText({
//        fillStyle: "#ffffff",
//        fontFamily: 'Verdana',
//        text: buttons[i].text,    
//        fontSize: 18,
//        x:buttons[i].x + (buttons[i].width)/2,y:buttons[i].y+30, 
//        });
//
//        }
//    }
    //*********************************************************************//
    
    // Render tiles
    function renderTiles() {
        for (var i=0; i<level.columns; i++) {
            for (var j=0; j<level.rows; j++) {
               
                // Get the shift of the tile for animation
                var shift = level.tiles[i][j].shift;
                
                // Calculate the tile coordinates
                var coord = getTileCoordinate(i, j, 0, (animationtime / animationtimetotal) * shift);
                
                // Check if there is a tile present
                if (level.tiles[i][j].type >= 0) {
                    // Get the color of the tile
                    
                    var col = imgs[level.tiles[i][j].type];
                    
                    // Draw the tile using the color
                    drawTile(coord.tilex, coord.tiley, col[0]);
                }
                
                // Draw the selected tile
                if (level.selectedtile.selected) {
                    if (level.selectedtile.column == i && level.selectedtile.row == j) {
                        // Draw a red tile
                        drawTile2(coord.tilex, coord.tiley, col[0]);
                    }
                }
            }
        }
        
        // Render the swap animation
        if (gamestate == gamestates.resolve && (animationstate == 2 || animationstate == 3)) {
            
           
            
            // Calculate the x and y shift
            var shiftx = currentmove.column2 - currentmove.column1;
            var shifty = currentmove.row2 - currentmove.row1;
         
            // First tile
            var coord1 = getTileCoordinate(currentmove.column1, currentmove.row1, 0, 0);
            var coord1shift = getTileCoordinate(currentmove.column1, currentmove.row1, (animationtime / animationtimetotal) * shiftx, (animationtime / animationtimetotal) * shifty);
            var col1 = tilecolors[level.tiles[currentmove.column1][currentmove.row1].type];
            
            // Second tile
            var coord2 = getTileCoordinate(currentmove.column2, currentmove.row2, 0, 0);
            var coord2shift = getTileCoordinate(currentmove.column2, currentmove.row2, (animationtime / animationtimetotal) * -shiftx, (animationtime / animationtimetotal) * -shifty);
            var col2 = tilecolors[level.tiles[currentmove.column2][currentmove.row2].type];
            
            // Draw a black background
            drawTile(coord1.tilex, coord1.tiley, 0);
            drawTile(coord2.tilex, coord2.tiley, 0);
            
            // Change the order, depending on the animation state
            if (animationstate == 2) {
                // Draw the tiles
                drawTile(coord1shift.tilex, coord1shift.tiley, col1[0]);
                drawTile(coord2shift.tilex, coord2shift.tiley, col2[0]);
                
            } else {
            
                // Draw the tiles
                drawTile(coord2shift.tilex, coord2shift.tiley, col2[0]);
                drawTile(coord1shift.tilex, coord1shift.tiley, col1[0]);
            }
        }
    }
    
    
    //*********************************************************************//
     function playerchange(nomer){
       
         if(nomer === 1){
                aibot = false;
             
             //startCountdown();
            }else if(nomer === 2){
                aibot = true;
                //startCountdown();
            }else{
                aibot = true;
                //startCountdown();
            } 
         
         buttons[2].text = (aibot?"Disable":"Enable") + " AI Bot";
        
        
    }
    //*********************************************************************//
    
    // Get the tile coordinate
    function getTileCoordinate(column, row, columnoffset, rowoffset) {
        var tilex = level.x + (column + columnoffset) * level.tilewidth;
        var tiley = level.y + (row + rowoffset) * level.tileheight;
      
        return { tilex: tilex, tiley: tiley};
    }
    //*********************************************************************//
    function drawTile2(x,y,r){
        //console.log(this.mt.tiles);
        mycanvas.drawImage({
            source: r,
            x: x-8,
            y:y-5,
            width:80,
            height:80,
            //rotate:40,
            fromCenter:false
            
            
        });
    }
    //*********************************************************************//
    // Draw a tile with a color
    function drawTile(x, y, r) {
        //console.log("x", x);
        //console.log("y", y);
        //console.log("r", r);
        //alert();
        
        mycanvas.drawImage({
            source: r,
            x: x,
            y:y,
            //rotate:40,
            fromCenter:false
            
            
        });
//        
//        mycanvas.drawRect({
//        fillStyle: "rgb(" + r + "," + g + "," + b + ")",
//        x: x + 2, y: y + 2,
//        fromCenter: false,
//        width: level.tilewidth - 4,
//        height: level.tileheight - 4,
//            
//        });
     
    }
    //*********************************************************************//
    
    // Render clusters
    function renderClusters() {
       
        for (var i=0; i<clusters.length; i++) {
            // Calculate the tile coordinates
            var coord = getTileCoordinate(clusters[i].column, clusters[i].row, 0, 0);
            
            if (clusters[i].horizontal) {
                // Draw a horizontal line
                mycanvas.drawRect({
        fillStyle: "#00ff00",
        x: coord.tilex + level.tilewidth/2, y: coord.tiley + level.tileheight/2 - 4,
        fromCenter: false,
        width: (clusters[i].length - 1) * level.tilewidth,
        height: 8,
        });
            } else {
                // Draw a vertical line
                mycanvas.drawRect({
        fillStyle: "#0000ff",
        x: coord.tilex + level.tilewidth/2 - 4, y: coord.tiley + level.tileheight/2,
        fromCenter: false,
        width: 8,
        height: (clusters[i].length - 1) * level.tileheight,
        });

            }
        }
    }
    //*********************************************************************//
    
    // Render moves
    function renderMoves() {
        for (var i=0; i<moves.length; i++) {
            // Calculate coordinates of tile 1 and 2
            var coord1 = getTileCoordinate(moves[i].column1, moves[i].row1, 0, 0);
            var coord2 = getTileCoordinate(moves[i].column2, moves[i].row2, 0, 0);
            
            // Draw a line from tile 1 to tile 2
            mycanvas.drawLine({
                strokeStyle: "#ff0000",
                strokeWidth:5,
                rounded:false,
                closed:true,
                x1: coord1.tilex + level.tilewidth/2,
        x2: coord2.tilex + level.tilewidth/2,
        y1: coord1.tiley + level.tileheight/2,         
        y2: coord2.tiley + level.tileheight/2,
            });           
        }
    }
    //*********************************************************************//
       
    // Get a random tile
    function getRandomTile() {
        return Math.floor(Math.random() * tilecolors.length);
    }
    //*********************************************************************//
    
    // Remove clusters and insert tiles
    function resolveClusters() {
       
        // Check for clusters
        findClusters();
        
        // While there are clusters left
        while (clusters.length > 0) {
       
            // Remove clusters
            removeClusters();
        
            // Shift tiles
            shiftTiles();
        
            // Check if there are clusters left
            findClusters();
        }
    }
    
    //*********************************************************************//
    
    // Loop over the cluster tiles and execute a function
    function loopClusters(func) {
       
        for (var i=0; i<clusters.length; i++) {
            //  { column, row, length, horizontal }
            var cluster = clusters[i];
            var coffset = 0;
            var roffset = 0;
            for (var j=0; j<cluster.length; j++) {
                func(i, cluster.column+coffset, cluster.row+roffset, cluster);
                
                if (cluster.horizontal) {
                  
                    coffset++;
                } else {
                    roffset++;
                }
            }
        }
    }
    //*********************************************************************//
    
    // Remove the clusters
    function removeClusters() {
        
        // Change the type of the tiles to -1, indicating a removed tile
      buh();
      loopClusters(function(index, column, row, cluster) { 
          level.tiles[column][row].type = -1; 
      
      });
      
      
      
     
        // Calculate how much a tile should be shifted downwards
        for (var i=0; i<level.columns; i++) {
            var shift = 0;
          
            for (var j=level.rows-1; j>=0; j--) {
                //// Loop from bottom to top
                if (level.tiles[i][j].type == -1) {
                    // Tile is removed, increase shift
                  
                    shift++;
                    level.tiles[i][j].shift = 0;
                  
                } else {
                   
                    // Set the shift
                    level.tiles[i][j].shift = shift;
                }
                
            }
            
        }
        
       
    }
    //*********************************************************************//
     // красная
    $("#redbutP1").click(function(){
        redManna(0);
    });
    $("#redbutP2").click(function(){
        redManna(1);
    });
    
    // зеленая
    $("#greenbutP1").click(function(){
        greenManna(0);
    });
    $("#greenbutP2").click(function(){
        greenManna(1);
    })
    
    // синяя
    $("#bluebutP1").click(function(){
        blumannaManna(0);
    });
    $("#bluebutP2").click(function(){
        blumannaManna(1);
    });
    
    // белая
    $("#whitebutP1").click(function(){
        whitemannaManna(0);
    });
    $("#whitebutP2").click(function(){
        whitemannaManna(1);
    });
    $("#astralbutP1").click(function(){
        astralmannaManna(0);
    });
    $("#astralbutP2").click(function(){
        astralmannaManna(1);
    });
    $("#deathbutP1").click(function(){
        deathmannaManna(0);
    });
    $("#astralbutP2").click(function(){
        deathmannaManna(1);
    });
    
    
    //*********************************************************************//
  function buh(){
     
        var clusterusers;
        var colorusers;
      
        for(var i = 0; i<clusters.length; i++){
            clusterusers = clusters[i];
           
            colorusers = level.tiles[clusterusers.column][clusterusers.row].type;
            if(hod === 0){
                //console.log("colorusers", colorusers);
                //alert();
                       if(colorusers === 0){ // манна для огня
                        var t = $('#whitemanna');
                        var val = Number($(t).val());
                        $(t).val(val + clusterusers.length);
                        
                    }else if(colorusers === 1){ //манна для земли
                        var t = $('#greenmanna');
                        var val = Number($(t).val());
                        $(t).val(val + clusterusers.length);

                    }else if(colorusers === 2){ // манна для воды
                        var t = $('#redmanna');
                        var val = Number($(t).val());
                        $(t).val(val + clusterusers.length);

                    }else if(colorusers === 3){
                        var t = $('#deathmanna');
                        var val = Number($(t).val());
                        $(t).val(val + clusterusers.length);
                        

                    }else if(colorusers === 4){
                        var t = $('#astralmanna');
                        var val = Number($(t).val());
                        $(t).val(val + clusterusers.length);
                        

                    }else if(colorusers === 5){
                        var t = $('#blumanna');
                        var val = Number($(t).val());
                        $(t).val(val + clusterusers.length);
                        

                    }else if(colorusers === 6){ // манна для воздуха
                        attackPlayer(hod, clusterusers.length);

                    }else if(colorusers === 7 ){
                        deffancePlayer(hod, clusterusers.length);
                    }
                
               }else{
                   if(colorusers === 0){
                var t = $('#whitemannaAI');
                var val = Number($(t).val());
                $(t).val(val + clusterusers.length);
                
            }else if(colorusers === 1){
                var t = $('#greenmannaAI');
                var val = Number($(t).val());
                $(t).val(val + clusterusers.length);
                
            }else if(colorusers === 2){
                var t = $('#redmannaAI');
                var val = Number($(t).val());
                $(t).val(val + clusterusers.length);
               
            }else if(colorusers === 3){
                var t = $('#deathmannaAI');
                        var val = Number($(t).val());
                        $(t).val(val + clusterusers.length);
                
            }else if(colorusers === 4){
                var t = $('#astralmannaAI');
                        var val = Number($(t).val());
                        $(t).val(val + clusterusers.length);
                
            }else if(colorusers === 5){
                var t = $('#blumannaAI');
                        var val = Number($(t).val());
                        $(t).val(val + clusterusers.length);
                
            }else if(colorusers === 6){
                attackPlayer(hod, clusterusers.length);
                
            }else if(colorusers === 7){
                     deffancePlayer(hod, clusterusers.length);
                     }
               }
            
            
        }
        
        
    }
  //*********************************************************************//
    
    // Shift tiles and insert new tiles
    function shiftTiles() {
        // Shift tiles
      
        for (var i=0; i<level.columns; i++) {
            for (var j=level.rows-1; j>=0; j--) {
                // Loop from bottom to top
                if (level.tiles[i][j].type == -1) {
                    // Insert new random tile
                    level.tiles[i][j].type = getRandomTile();
                } else {
                    // Swap tile to shift it
                    var shift = level.tiles[i][j].shift;
                    if (shift > 0) {
                      
                        swap(i, j, i, j+shift)
                    }
                }
                
                // Reset shift
                level.tiles[i][j].shift = 0;
            }
        }
    }
    //*********************************************************************//
    
    // Get the tile under the mouse
    function getMouseTile(pos) {
        // Calculate the index of the tile
        var tx = Math.floor((pos.x - level.x) / level.tilewidth);
        var ty = Math.floor((pos.y - level.y) / level.tileheight);
       
        // Check if the tile is valid
        if (tx >= 0 && tx < level.columns && ty >= 0 && ty < level.rows) {
            // Tile is valid
            return {
                valid: true,
                x: tx,
                y: ty,
                tiles: level.tiles[tx][ty].type
            };
        }
        
        // No valid tile
        return {
            valid: false,
            x: 0,
            y: 0
        };
    }
    //*********************************************************************//
    
    // Check if two tiles can be swapped
    function canSwap(x1, y1, x2, y2) {
        // Check if the tile is a direct neighbor of the selected tile
        if ((Math.abs(x1 - x2) == 1 && y1 == y2) ||
            (Math.abs(y1 - y2) == 1 && x1 == x2)) {
          
            return true;
        }
        
        return false;
    }
    //*********************************************************************//
    
    // Swap two tiles in the level
    function swap(x1, y1, x2, y2) {
        var typeswap = level.tiles[x1][y1].type;
       
        level.tiles[x1][y1].type = level.tiles[x2][y2].type;
       
        level.tiles[x2][y2].type = typeswap;
    }
    //*********************************************************************//
    
    // Swap two tiles as a player action
    function mouseSwap(c1, r1, c2, r2) {
        // Save the current move
        currentmove = {column1: c1, row1: r1, column2: c2, row2: r2};
    
        // Deselect
        level.selectedtile.selected = false;
        
        // Start animation
        animationstate = 2;
        animationtime = 0;
        gamestate = gamestates.resolve;
    }
    //*********************************************************************//
    
    // On mouse movement
    function onMouseMove(e) {
      
        // Get the mouse position
        var pos = getMousePos(mycanvas, e);
      
        // Check if we are dragging with a tile selected
        if (drag && level.selectedtile.selected) {
            // Get the tile under the mouse
          
            mt = getMouseTile(pos);
          
            if (mt.valid) {
                // Valid tile
                
                // Check if the tiles can be swapped
                if (canSwap(mt.x, mt.y, level.selectedtile.column, level.selectedtile.row)){
                    // Swap the tiles
                  
                    mouseSwap(mt.x, mt.y, level.selectedtile.column, level.selectedtile.row);
                }
            }
        }
    }
    //*********************************************************************//
    
    // On mouse button click
    function onMouseDown(e) {
      
        // Get the mouse position
        var pos = getMousePos(mycanvas, e);
      
        // Start dragging
        if (!drag) {
         
            // Get the tile under the mouse
            mt = getMouseTile(pos);
            
            if (mt.valid) {
              
                // Valid tile
                var swapped = false;
                if (level.selectedtile.selected) {
                 
                    if (mt.x == level.selectedtile.column && mt.y == level.selectedtile.row) {
                        // Same tile selected, deselect
                      
                        level.selectedtile.selected = false;
                        drag = true;
                        return;
                    } else if (canSwap(mt.x, mt.y, level.selectedtile.column, level.selectedtile.row)){
                        // Tiles can be swapped, swap the tiles
                     
                        mouseSwap(mt.x, mt.y, level.selectedtile.column, level.selectedtile.row);
                        swapped = true;
                    }
                }
                
                if (!swapped) {
                  
                    // Set the new selected tile
                    level.selectedtile.column = mt.x;
                    level.selectedtile.row = mt.y;
                    level.selectedtile.selected = true;
                }
            } else {
             
                // Invalid tile
                level.selectedtile.selected = false;
            }
            
            // Start dragging
            drag = true;
        }
        
        // Check if a button was clicked
//        for (var i=0; i<buttons.length; i++) {
//            if (pos.x >= buttons[i].x && pos.x < buttons[i].x+buttons[i].width &&
//                pos.y >= buttons[i].y && pos.y < buttons[i].y+buttons[i].height) {
//                
//                // Button i was clicked
//                if (i == 0) {
//                    // New Game
//                    newGame();
//                } else if (i == 1) {
//                    // Show Moves
//                    showmoves = !showmoves;
//                    buttons[i].text = (showmoves?"Hide":"Show") + " Moves";
//                } else if (i == 2) {
//                    // AI Bot
//                    aibot = !aibot;
//                    buttons[i].text = (aibot?"Disable":"Enable") + " AI Bot";
//                }
//            }
//        }
    }
    //*********************************************************************//
    
    function onMouseUp(e) {
        // Reset dragging
        drag = false;
    }
    //*********************************************************************//
    
    function onMouseOut(e) {
        // Reset dragging
        drag = false;
    }
    //*********************************************************************//
    
    // Get the mouse position
    function getMousePos(mycanvas, e) {
        var rect = $(mycanvas)[0].getBoundingClientRect();
        return {
            x: Math.round((e.clientX - rect.left)/(rect.right - rect.left)*$(mycanvas)[0].width),
            y: Math.round((e.clientY - rect.top)/(rect.bottom - rect.top)*$(mycanvas)[0].height)
        };
    }
    //*********************************************************************//
    
    // Call init to start the game
    init();
    //*********************************************************************//
    
    
    
    function startCountdown(){
        clearInterval(timer);
    var startFrom = 90;
    countdown.text(startFrom).parent('p').show();
    timer = setInterval(function(){
        countdown.text(--startFrom);
        
        if(startFrom <= 0) {
            if(hod === 1){
                    playerchange(1);
               }else{
                   playerchange(0);
               }
            clearInterval(timer);
        }
    },1000);
}
    
    
});