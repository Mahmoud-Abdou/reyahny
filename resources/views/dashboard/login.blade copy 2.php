<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        #map,html,body{
        height:100%;
        margin:0;
        padding:0;
    }
    </style>
</head>
<body>
    <div id="map">
        <button id="delete-button" class="btn">Delete selected shape</button>
        <button id="save-button" class="btn">Save all</button>
      </div>
      
    </body>
    <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAIvDNzqsaGuVUOeF6EXtMEtIus4Hf9tXg&sensor=false&libraries=drawing,geometry,places&v=3&callback=initialize"></script>
<script>
    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom:10,
            center: new google.maps.LatLng(22.344, 114.048),
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            noClear:true
        });
        map.controls[google.maps.ControlPosition.RIGHT_BOTTOM]
          .push(document.getElementById('save-button'));
        map.controls[google.maps.ControlPosition.RIGHT_BOTTOM]
          .push(document.getElementById('delete-button'));
        var polyOptions = {
            strokeWeight: 3,
            fillOpacity: 0.2
        };
        
        var shapes={
          collection:{},
          selectedShape:null,
          add:function(e){
            var shape=e.overlay,
                that=this;
            shape.type=e.type;
            shape.id=new Date().getTime()+'_'+Math.floor(Math.random()*1000);
            this.collection[shape.id]=shape;
            this.setSelection(shape);
            google.maps.event.addListener(shape,'click',function(){
              that.setSelection(this);
            });
          },
          setSelection:function(shape){
            if(this.selectedShape!==shape){
              this.clearSelection();
              this.selectedShape = shape;
              shape.set('draggable',true);
              shape.set('editable',true);
            }
          },
          deleteSelected:function(){
          
            if(this.selectedShape){
              var shape= this.selectedShape;
              this.clearSelection();
              shape.setMap(null);
              delete this.collection[shape.id];
            }
           },
          
          
          clearSelection:function(){
            if(this.selectedShape){
              this.selectedShape.set('draggable',false);
              this.selectedShape.set('editable',false);
              this.selectedShape=null;
            }
          },
          save:function(){
            var collection=[];
            for(var k in this.collection){
              var shape=this.collection[k],
                  types=google.maps.drawing.OverlayType;
              switch(shape.type){
                case types.POLYGON:
                   collection.push({ type:shape.type,
                                     path:google.maps.geometry.encoding
                                      .encodePath(shape.getPath())});
                  break;
                default:
                  alert('implement a storage-method for '+shape.type)
              }
            }
            //collection is the result
            console.log(collection);
          }
        };
        
         var drawingManager = new google.maps.drawing.DrawingManager({
            drawingControl: true,
            drawingControlOptions: {
                drawingModes: [google.maps.drawing.OverlayType.POLYGON]
            },
            drawingMode: google.maps.drawing.OverlayType.POLYGON,
            polygonOptions: polyOptions,
            map: map
        });

        google.maps.event.addListener(drawingManager, 'overlaycomplete', function(e) {
            drawingManager.setDrawingMode(null);
            shapes.add(e);
        });


        google.maps.event.addListener(drawingManager, 
                                      'drawingmode_changed', 
                                      function(){shapes.clearSelection();});
        google.maps.event.addListener(map, 
                                      'click', 
                                      function(){shapes.clearSelection();});
        google.maps.event.addDomListener(document.getElementById('delete-button'), 
                                      'click', 
                                      function(){shapes.deleteSelected();});
        google.maps.event.addDomListener(document.getElementById('save-button'), 
                                      'click', 
                                      function(){shapes.save();});

    }
</script>
</html>