<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <script src="jquery-3.4.1.min.js" type="application/javascript"></script>
    <script src="popper.min.js" type="application/javascript"></script>
      <script src="js/bootstrap.min.js" type="application/javascript"></script>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    <script type="text/javascript" src="crop.js"></script>
    <style>
      canvas {
        box-shadow: 0 0 10px black;
        margin: 20px;
      }
      .dropbtn {
        background-color: #4caf50;
        color: white;
        padding: 16px;
        font-size: 16px;
        border: none;
      }

      .dropdown {
        position: relative;
        display: inline-block;
      }

      .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f1f1f1;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
      }

      .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
      }

      .dropdown-content a:hover {
        background-color: #ddd;
      }

      .dropdown:hover .dropdown-content {
        display: block;
      }

      .dropdown:hover .dropbtn {
        background-color: #3e8e41;
      }
    </style>
  </head>
  <body>
  <div class="container">

  <nav class="nav nav-pills flex-column flex-sm-row">
      <a class="flex-sm-fill text-sm-center nav-link active" href="index.php">Cropping</a>
      <a class="flex-sm-fill text-sm-center nav-link" href="assemblePhoto.php">Assemble</a>
  </nav>
    <table>
      <tr>
        <td>
          <div id="container">
            <canvas
              width="217"
              height="275"
              id="myCanvas"
              style="position:relative;margin-left:0px;margin-top:0px;"
            ></canvas>
          </div>
          <div class="dropdown">
              <button><a id="left_arm" href="#">Left Arm</a></button>
              <button><a id="body" href="#">Body</a></button>
              <button><a id="right_arm" href="#">Right Arm</a></button>
              <button><a id="trouser" href="#">Trouser/Dress</a></button>
              <button><a id="head" href="#">Head</a></button>
          </div>
          <form class="form-inline">
            <input class="form-control" type="button" id="crop" value="Crop" />
            <div id="png" style="display:block;">
            </div>
              <input class="form-control" type="button" id="finish" value="Finish" />
          </form>
            <br />
              *Refresh to restart.
          <div id="oldposx" style="display:none;"></div>
          <div id="oldposy" style="display:none;"></div>
          <div id="posx" style="display:none;"></div>
          <div id="posy" style="display:none;"></div>
          <div id="url_src" style="display:none;">
            <?php
              echo $_GET['link'];
            ?>
          </div>
          <div id="name_src" style="display:none;"><?php
              echo $_GET['filename'];
            ?></div>
        </td>
        <td>
          <i id="editing_message">Let's Start Cropping</i>
          <table>
            <td>
              <div id="myimg_left_arm"></div>
              <div id="left_tag"></div>
            </td>
            <td>
              <div id="myimg_head"></div>
              <div id="head_tag"></div>
            </td>
            <td>
              <div id="myimg_body"></div>
              <div id="body_tag"></div>
            </td>
            <td>
              <div id="myimg_trouser"></div>
              <div id="trouser_tag"></div>
            </td>
            <td>
              <div id="myimg_right_arm"></div>
              <div id="right_tag"></div>
            </td>
          </table>
          <!--preview of image after upload-->
        </td>
      </tr>
    </table>
    </div>
  </body>
</html>
