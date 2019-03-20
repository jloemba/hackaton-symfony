/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)
require('../bootstrap/css/bootstrap.min.css');
require('../css/app.css');

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
 const $ = require('jquery');
//var greet = require('.//greet');

console.log('Hello Webpack Encore! Edit me in assets/js/app.js');


    $(document).on({
        ajaxStart: function () {
            $('.fond_blanc').css("display", "flex");
            $('.fond_blanc').css("width", "100%");
            $('.fond_blanc').css("height", "100%");
            $('.fond_blanc').css("position", "absolute");
            $('.fond_blanc').css("z-index", "1");
            $('.fond_blanc').css("align-content", "center");
            $('.fond_blanc').css("justify-content", "center");
            $('.dialog-animation').css("height", "50%");
            $('.dialog-animation').css("margin", "auto");
        },
        ajaxStop: function () {
            $('.dialog-animation').css("display", "none");
            $('.fond_blanc').css("display", "none");
        }
    });

    dataset = {
        "children": [{"Name":"PSG","Count":4319},
            {"Name":"Manchester","Count":4159},
            {"Name":"Neymar","Count":2583},
            {"Name":"Playoff","Count":2074},
            {"Name":"Serena Williams","Count":1894},
            {"Name":"FIFA","Count":1809}]
    };
    
    var diameter = 600;
    var color = d3.scaleOrdinal(d3.schemeCategory20);
    
    var bubble = d3.pack(dataset)
        .size([diameter, diameter])
        .padding(1.5);
    
    var svg = d3.select("#bulles")
        .append("svg")
        .attr("width", diameter)
        .attr("height", diameter)
        .attr("class", "bubble")
        .style("margin", "auto")
        .style("display", "block")
        .style("margin-top", "30");
    
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
        .style("fill", function(d,i) {
            return color(i);
        });
    
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
    
    
    d3.select(self.frameElement)
        .style("height", diameter + "px");
    
    
