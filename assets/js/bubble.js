var d3 = require('d3');

if(d3){
    console.log("Il est là");

}else{
    console.log("Il n'est pas là");
}

dataset = {
    //<?php =json_encode($dataset)?> // don't forget to sanitize
    "children":   [
                    {"Name":"psg" ,"Count": 200},
                    {"Name":"neymar" ,"Count": 158},
                    {"Name":"didier" ,"Count": 55},
                    {"Name":"matuidi" ,"Count": 56},
                    {"Name":"15 de france" ,"Count": 257},
                    {"Name":"Triathlon" ,"Count": 35}
                 ]
};

var diameter = 600;
var color = d3.scaleOrdinal(d3.schemeCategory20);

var bubble = d3.pack(dataset)
    .size([diameter, diameter])
    .padding(1.5);

var svg = d3.select("body")
    .append("svg")
    .attr("width", diameter)
    .attr("height", diameter)
    .attr("class", "bubble");

var nodes = d3.hierarchy(dataset)
    .sum(function(d) { return d.Count; });

var node = svg.selectAll(".node")
    .data(bubble(nodes).descendants())
    .enter()
    .filter(function(d){
        return  !d.children
    })
    .append("g")
    .attr("class", "node")
    .attr("transform", function(d) {
        return "translate(" + d.x + "," + d.y + ")";
    });

node.append("title")
    .text(function(d) {
        return d.Name + ": " + d.Count;
    });

node.append("circle")
    .attr("r", function(d) {
        return d.r;
    })
    .style("fill", "#0054D2");

//Le "mot" le plus mentionné
node.append("text")
    .attr("dy", ".2em")
    .style("text-anchor", "middle")
    .text(function(d) {
        return d.data.Name.substring(0, d.r / 3);
    })
    .attr("font-family", "sans-serif")
    .attr("font-size", function(d){
        return d.r/5;
    })
    .attr("fill", "white");

//Le nombre inscrit dans la bulle
node.append("text")
    .attr("dy", "1.3em")
    .style("text-anchor", "middle")
    .text(function(d) {
        return d.data.Count;
    })
    .attr("font-family",  "Gill Sans", "Gill Sans MT")
    .attr("font-size", function(d){
        return d.r/5;
    })
    .attr("fill", "white");

 node.append("text")
 .attr("x", 8)
        .attr("y", ".31em")
        .select("a")    
        .attr("xlink:href", function (d) {
            return "http://example.com/" + d.data.Link;
        })
        .text(function (d) {
            return d.data.Name.substring(0, d.r / 3);
        });



d3.select(self.frameElement)
    .style("height", diameter + "px");
