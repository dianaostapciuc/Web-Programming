var emptyCell = 16 // keeping track of the initially empty cell

$(function(){
    // each table cell gets an img with the class puzzle
    $("td").append($("<img></img>").addClass("puzzle"));
    var positions = ["0px", "-137.5px", "-275px", "-412.5px"]
    
    var ids = []

    // assign random ids to each cell
    for(i=0;i<16;i++){
        ok = true
        while(ok){
            ok = false
            pos = 1 + Math.floor(Math.random() * 1000)%16;
            for(j=0;j<ids.length;j++)
                if(ids[j] == pos)
                {
                    ok = true
                }
        } // verify for id to be unique
        ids.push(pos)
        // index of initially empty cell
        if(pos == 16)
            emptyCell = i
    }

    console.log(emptyCell, ids)
    var id = 0

    // setting up the puzzle
    for(i=0;i<4;i++)
    {
        for(j=0;j<4;j++){
            if(id!=emptyCell){
                $("#"+ids[id]+" img").css("background-position", positions[j]+" "+positions[i])
            }
            else{
                $("#"+ids[id]+" img").removeClass("puzzle")
                $("#"+ids[id]+" img").addClass("empty")
            }
            
            id+=1
        }
    }

    $("td").click(function(){
        id = $(this).attr("id")
        if(id == ids[emptyCell]){
            return
        } // if we click the empty cell, nothing happens
        else{
            // get the cells around the one we clicked on
            var $td = $(this)
            var index = $td.index(), $tr =$td.parent();
            var $nbrs = $td.prev(); //find the previous td
            $nbrs = $nbrs.add($td.next());//find the next td
            $nbrs = $nbrs.add($tr.prev().find('td').eq(index));//find the td with the same index in previous row
            $nbrs = $nbrs.add($tr.next().find('td').eq(index));//find the td with the same index in next row

            // check if any neighbours are empty
            found = false
            var empty = 0
            for(i=0;i<$($nbrs).length;i++){
                if($($nbrs[i]).attr("id") == ids[emptyCell]){
                    found = true
                    empty = $($nbrs[i])
                }
            }

            if(!found){
                return
            }
            else{
                // swap background positions of clicked cell and empty cell
                var pos = $("#"+$(this).attr("id")+" img").css("background-position")
                console.log(pos, empty.attr("id"))
                $("#"+empty.attr("id")+" img").removeClass("empty")
                $("#"+empty.attr("id")+" img").addClass("puzzle")
                $("#"+empty.attr("id")+" img").css("background-position", pos)
                $("#"+$(this).attr("id")+" img").removeClass("puzzle")
                $("#"+$(this).attr("id")+" img").addClass("empty")

                // update the empty cell index
                for(i=0;i<ids.length;i++)
                {
                    if(ids[i] == $(this).attr("id"))
                    {
                        emptyCell = i
                        break
                    }
                }
            }
        }
    })
});
