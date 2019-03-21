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
 
var d3 = require('d3');

//var fond_blanc = document.getElementsByClassName('fond_blanc');

// $(document).on({
    
//     ajaxStart: function () {
        
//         $('.fond_blanc').css("display", "flex");
//         $('.fond_blanc').css("width", "100%");
//         $('.fond_blanc').css("height", "100%");
//         $('.fond_blanc').css("position", "absolute");
//         $('.fond_blanc').css("z-index", "1");
//         $('.fond_blanc').css("align-content", "center");
//         $('.fond_blanc').css("justify-content", "center");
//         $('.dialog-animation').css("height", "50%");
//         $('.dialog-animation').css("margin", "auto");
//     },
//     ajaxStop: function () {
//         $('.dialog-animation').css("display", "none");
//         $('.fond_blanc').css("display", "none");
//     }
// });



// $( document ).ready(function() {
    
//     $.ajax({  
//         url:        '/bubble/load',  
//         type:       'POST',   
//         dataType:   'json',  
//         async:      true,
//         beforeSend : function() {
//             console.log('ajax en cours ...');
//         },
//         success: function(data, status) {
//             console.log('ajax fini');  
//             bulle(data);
//         },  
//         error : function(xhr, textStatus, errorThrown) {  
//            alert('Ajax request failed.');  
//         }  
//      });
// });


function bulle(data){
    
    $("#bulle").html('');

dataset = {
    "children":   data
};

var diameter = 600;
//var color = d3.scaleOrdinal(d3.schemeCategory20);

var bubble = d3.pack(dataset)
    .size([diameter, diameter])
    .padding(1.5);

var svg = d3.select("#bulle")
    .append("svg")
    .attr("width", diameter)
    .attr("height", diameter)
    .attr("class", "bubble");

var nodes = d3.hierarchy(dataset)
    .sum(function(d) { return d.social_score; });

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
        return d.Name + ": " + d.social_score;
    });

    //Avoir le cercle qui forme la bulle en bleu avec un lien href.
    node.append("a")
    .attr("xlink:href", function (d) {
        return d.data.Name;
    })
    .attr("class","bubble-link")
    .attr("d",0)
    .append("circle")
    .attr("r", function(d) {
        return d.r;
    })
    .style("fill", "#0054D2");


    //Pour éviter que le clique sur la bulle change de page
    $("a.bubble-link").click(function(event){
        event.preventDefault();
    });

    $("svg.bubble").css("display","flex"); //Le conteneur des bulles
    //$("").css("display","block"); //Le conteneur des bulles
    //$("button.link-return").css("display","none");

    //Le flag de la bulle 
    $("a.bubble-link").click(function(d){ // Le clic sur les bulles
        if($(this)[0].getAttribute("d")==0){ //SI 0 => Les bulles réapparaîssent

            $(this)[0].setAttribute("d",1);
            $("svg.bubble").css("display","none");
            $("button.link-return").css("display","block");
            $("button.link-return").click(function(d){
                $("svg.bubble").css("display","block");
                $(this).css("display","none");
            });

            // L'appel AJAX
            $.ajax({  
                url:        '/bubble/load',  
                type:       'POST',   
                dataType:   'json',  
                async:      true,
                data : { 'motCle' : val_input,
                         'flag' : flag}  ,
                
                success: function(data, status) {  
                     bulle(data);     
                },  
                error : function(xhr, textStatus, errorThrown) {  
                   alert('Ajax request failed.');  
                }  
             });  
            

        }else{ //SI 1 => Les bulles disparaîssent , le bouton revenir au bulle apparaît
            $(this)[0].setAttribute("d",0);
            $("svg.bubble").css("display","flex");
            $("button.link-return").css("display","none");
        }   
    });

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
        return d.data.social_score;
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
        .append("g")
        .attr("class", "node")
        .attr("transform", function(d) {
            return "translate(" + d.x + "," + d.y + ")";
        });

    node.append("title")
        .text(function(d) {
            return d.Name + ": " + d.social_score;
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
            return d.data.social_score;
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
}
    
$("#img_search").on("click", function(event){

    var val_input = $('#input_search_web').val();
    var flag = 0;
    
    $.ajax({  
       url:        '/bubble/load',  
       type:       'POST',   
       dataType:   'json',  
       async:      true,
        data : { 'motCle' : val_input,
        'flag' : flag},
       success: function(data, status) {
           if( data.length != 0 ){
                bulle(data);
           }
       },  
       error : function(xhr, textStatus, errorThrown) {  
          alert('Ajax request failed.');  
       }  
    });  
 }); 


