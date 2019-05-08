<!DOCTYPE html>
<html>
  <head>
    <script src="jquery-3.4.1.min.js" typw="application/javascript"></script>
    <script src="konva.min.js"></script>
    <meta charset="utf-8" />
    <title>Konva Image Resize Demo</title>
    <style>
      body {
        margin: 0;
        padding: 0;
        overflow: hidden;
        background-color: #f0f0f0;
      }
      
      .img-item {
        height:100px;
        width:100px;
      }

    </style>
  </head>
  <body>
    <div id="control_panel">
        <button id="import_parts" onclick="selectPart()">Import</button>
        <button id="finish" onclick="savePhoto()">Finish</button>
        <button id="finish" onclick="show()">Show Boundary</button>
        <button id="finish" onclick="hide()">Hide Boundary</button>
    </div>
    <div id="img_bar"></div>
    <div id="model_preview"></div>
  </body>
  <script>
    var dir = './../upload/new/';
    var img_bar = document.getElementById('img_bar');
    var clothesDirs =  JSON.parse('<?php echo json_encode(scandir('./../upload/new/'));?>');
    clothesDirs.shift();
    clothesDirs.shift();
    for(var key in clothesDirs){
      let img_item = document.createElement('img');
      img_item.className = "img-item";
      img_item.src = dir + clothesDirs[key];
      img_item.onclick = function() {
        (async function() {
          let blob = await fetch(img_item.src).then(r => r.blob());
          let dataUrl = await new Promise(resolve => {
          let reader = new FileReader();
          reader.onload = () => importParts( reader.result);
          reader.readAsDataURL(blob);
          
          });
        })();
         
      }
      img_bar.append(img_item);
    }

    var width = window.innerWidth;
    var height = window.innerHeight;
    var rotateFrameList = [];

    var stage = new Konva.Stage({
        container: 'model_preview',
        width: width,
        height: height
    });
    var layer = new Konva.Layer();
    stage.add(layer);

    function importParts(imgSrc) {
        
        var imageObj = new Image();
        imageObj.onload = function () {
            var newImg = new Konva.Image({
                width: imageObj.width,
                height: imageObj.height,
                x: 80,
                y: 80,
                draggable: true
            });

            layer.add(newImg);
            newImg.image(imageObj);
            var rotateFrame = new Konva.Transformer({
                node: newImg,
                centeredScaling: true,
                rotationSnaps: [0, 90, 180, 270],
                resizeEnabled: true
            });
            rotateFrameList.push(rotateFrame);
            layer.add(rotateFrame);
            newImg.on('click', function() {
                this.moveToTop();
                rotateFrame.moveToTop();
                layer.draw();
            });
            newImg.on('dblclick dbltap', function() {
                this.destroy();
                rotateFrame.destroy();
                layer.draw();
              });
            layer.draw();

        };
        imageObj.src = imgSrc;
    }

    function blobtoDataURL(blob, callback) {
        var fr = new FileReader();
        fr.onload = function(e) {
            callback(e.target.result);
        };
        fr.readAsDataURL(blob);
    }

    function selectPart() {
        var input = document.createElement('input');
        input.type = 'file';

        input.onchange = e => { 
            var file = e.target.files[0];
            blobtoDataURL(file, function (dataURL){
                importParts(dataURL);
            });
        }
        input.click();
    }

    // function from https://stackoverflow.com/a/15832662/512042
    function downloadURI(uri, name) {
        var link = document.createElement('a');
        link.download = name;
        link.href = uri;
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
        delete link;
      }

    function savePhoto() {
        hide();
        var dataURL = stage.toDataURL();
        downloadURI(dataURL, 'finish.png');
    }

    function hide(){
        for (var key in rotateFrameList){
            rotateFrameList[key].hide()
        }
        layer.draw();
    }

    function show(){
        for (var key in rotateFrameList){
            rotateFrameList[key].show()
        }
        layer.draw();
    }
  </script>
</html>