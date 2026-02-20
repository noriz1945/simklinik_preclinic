

  <style type="text/css">
    .colorpicker {
      width: 20px;
      height: 20px;
      border: black thin solid;
      display: inline-block;
    }
  </style>
  <script type="text/javascript">
    var canvas, ctx, flag = false,
      prevX = 0,
      currX = 0,
      prevY = 0,
      currY = 0,
      dot_flag = false;

    var x = "red",
      y = 2;

    //var adjustX = -20;
    function init(background_img) {
      box_drawing_canvas = document.getElementById('box_drawing_canvas');
      canvas_holder = document.getElementById('canvas_holder');

      canvas = document.getElementById('can');
      ctx = canvas.getContext("2d");
      w = canvas.width;
      h = canvas.height;

      var img = new Image; // First create the image...
      img.onload = function() { // ...then set the onload handler...
        ctx.drawImage(img, 0, 0, w, h);
      };
      img.src = "<?php echo base_url('assets/tpldoc/'); ?>" + background_img; // *then* set the .src and start it loading.

      canvas.addEventListener("mousemove", function(e) {
        findxy('move', e)
      }, false);
      canvas.addEventListener("mousedown", function(e) {
        findxy('down', e)
      }, false);
      canvas.addEventListener("mouseup", function(e) {
        findxy('up', e)
      }, false);
      canvas.addEventListener("mouseout", function(e) {
        findxy('out', e)
      }, false);
    }

    function color(obj) {
      switch (obj.id) {
        case "green":
          x = "green";
          break;
        case "blue":
          x = "blue";
          break;
        case "red":
          x = "red";
          break;
        case "yellow":
          x = "yellow";
          break;
        case "orange":
          x = "orange";
          break;
        case "black":
          x = "black";
          break;
        case "white":
          x = "white";
          break;
      }
      if (x == "white") y = 14;
      else y = 2;

    }

    function draw() {
      ctx.beginPath();
      ctx.moveTo(prevX, prevY);
      ctx.lineTo(currX, currY);
      ctx.strokeStyle = x;
      ctx.lineWidth = y;
      ctx.stroke();
      ctx.closePath();
    }

    function erase() {
      var m = confirm("Want to clear");
      if (m) {
        ctx.clearRect(0, 0, w, h);
        document.getElementById("canvasimg").style.display = "none";
      }
    }

    function save() {
      document.getElementById("canvasimg").style.border = "2px solid";
      var dataURL = canvas.toDataURL();
      document.getElementById("canvasimg").src = dataURL;
      document.getElementById("urlblob").value = dataURL;
      document.getElementById("canvasimg").style.display = "inline";
    }

    function findxy(res, e) {
      if (res == 'down') {
        prevX = currX;
        prevY = currY;

				var el = '#can';
				elX = getPosX(el);
				elY = getPosY(el);

				var mosX = e.clientX;     // Get the horizontal coordinate
				var mosY = e.clientY;     // Get the vertical coordinate

				var scro_y = $(window).scrollTop();
				currX = mosX - elX;
				currY = mosY - elY + scro_y;


        flag = true;
        dot_flag = true;
        if (dot_flag) {
          ctx.beginPath();
          ctx.fillStyle = x;
          ctx.fillRect(currX, currY, 2, 2);
          ctx.closePath();
          dot_flag = false;
        }
      }
      if (res == 'up' || res == "out") {
        flag = false;
      }
      if (res == 'move') {
        if (flag) {
          prevX = currX;
          prevY = currY;

					var el = '#can';
					elX = getPosX(el);
					elY = getPosY(el);

					var mosX = e.clientX;     // Get the horizontal coordinate
					var mosY = e.clientY;     // Get the vertical coordinate

					//currX = mosX - elX;
					//currY = mosY - elY;
					//var scro_x = $(window).scrollLeft();
					var scro_y = $(window).scrollTop();

					currX = mosX - elX;
					currY = mosY - elY + scro_y;

					/*
					$('#cur_x').val(currX);
					$('#cur_y').val(currY);

					$('#mos_x').val(mosX);
					$('#mos_y').val(mosY);

					$('#el_x').val(elX);
					$('#el_y').val(elY);
					*/
          draw();
        }
      }
    }
  </script>
<!--    <body onload="init()">	-->
  <div class="row">
    <div class="col-md-10" id="canvas_holder">
      <!--<canvas id="can" width="400" height="400" style="position:absolute;top:10%;left:10%;border:2px solid;"></canvas>-->
      <canvas id="can" width="700" height="450" style=" top:10%;left:10%;border:2px solid;"></canvas>
    </div>
    <div class="col-md-2">
      <div style="top:12%;left:43%;">Choose Color</div>
      <div class="colorpicker" style="background:blue;" id="blue" onclick="color(this)"></div> <br>
      <div class="colorpicker" style="background:red;" id="red" onclick="color(this)"></div> <br>
      <div class="colorpicker" style="background:yellow;" id="yellow" onclick="color(this)"></div> <br>
      <div class="colorpicker" style="background:orange;" id="orange" onclick="color(this)"></div> <br>
    </div>
    <div class="col-md-5">
      <!--<img id="canvasimg" style="position:absolute;top:10%;left:52%;display:none;">-->
      <img id="canvasimg" width="700" height="450" style="top:10%;left:10%;border:2px solid;display:none;">
    </div>
  </div>

  <div class="col-md-12">
    <img onclick="javascript:set_canvas('poli_bedah_onkologi.jpeg')" src="<?php echo base_url('assets/tpldoc/poli_bedah_onkologi.jpeg'); ?>" width="100" height="100">
    <img onclick="javascript:set_canvas('anatomi.jpg')" src="<?php echo base_url('assets/tpldoc/anatomi.jpg'); ?>" width="100" height="100">
    <img onclick="javascript:set_canvas('poli_bedah_pria.jpg')" src="<?php echo base_url('assets/tpldoc/poli_bedah_pria.jpg'); ?>" width="100" height="100">
    <img onclick="javascript:set_canvas('poli_bedah_wanita.jpg')" src="<?php echo base_url('assets/tpldoc/poli_bedah_wanita.jpg'); ?>" width="100" height="100">
    <img onclick="javascript:set_canvas('poli_gigi.jpg')" src="<?php echo base_url('assets/tpldoc/poli_gigi.jpg'); ?>" width="100" height="100">
    <img onclick="javascript:set_canvas('poli_mata.png')" src="<?php echo base_url('assets/tpldoc/poli_mata.png'); ?>" width="100" height="100">
    <img onclick="javascript:set_canvas('poli_tht.jpg')" src="<?php echo base_url('assets/tpldoc/poli_tht.jpg'); ?>" width="100" height="100">
    <img onclick="javascript:set_canvas('paru.png')" src="<?php echo base_url('assets/tpldoc/paru.png'); ?>" width="100" height="100">
    <img onclick="javascript:set_canvas('perbandingan_paru.png')" src="<?php echo base_url('assets/tpldoc/perbandingan_paru.png'); ?>" width="100" height="100">
    <img onclick="javascript:set_canvas('tengkorak.jpg')" src="<?php echo base_url('assets/tpldoc/tengkorak.jpg'); ?>" width="100" height="100">
    <img onclick="javascript:set_canvas('fundus.jpg')" src="<?php echo base_url('assets/tpldoc/fundus.jpg'); ?>" width="100" height="100">
    <img onclick="javascript:set_canvas('front_eye.jpeg')" src="<?php echo base_url('assets/tpldoc/front_eye.jpeg'); ?>" width="100" height="100">
    <img onclick="javascript:set_canvas('ginjal.jpeg')" src="<?php echo base_url('assets/tpldoc/ginjal.jpeg'); ?>" width="100" height="100">
  </div>

  <div class="col-md-12" style="padding-top: 15px;">
    <div class="row">
      <div class="col-md-3">
        <button type="button" class="btn btn-info" onclick="javascript: save();"> <i class="fa fa-eye"></i> PREVIEW & SAVE AS DRAFT </button>
      </div>
      <div class="col-md-3">
        <button type="button" class="btn btn-warning" onclick="javascript: erase();"> <i class="fa fa-eraser"></i> CLEAR</button>
      </div>
      <div class="col-md-3">
        <input type="hidden" readonly class="form-control input-default urlblob" id="urlblob" name="urlblob" value="">
        <button type="button" class="btn btn-success" onclick="javascript: save_drawing('<?php echo $id_reg ?>','<?php echo $id_pasien ?>');"> <i class="fa fa-check"></i> SIMPAN</button>
      </div>
    </div>

    <div class="row">
      <div class="col-md-3">
      	<input type="hidden" id="cur_x">
      	<input type="hidden" id="mos_x">
        <input type="hidden" id="el_x">
      </div>
      <div class="col-md-3">
      	<input type="hidden" id="cur_y">
      	<input type="hidden" id="mos_y">
        <input type="hidden" id="el_y">
      </div>
      <!--
      <div class="col-md-3">
      	<input type="text" id="mos_xx"></div>
      <div class="col-md-3">
      	<input type="text" id="mos_yy">
      </div>
      -->
    </div>

  </div>


<script>
  function set_canvas(background_img) {
    init(background_img);
  }

  var save_method;

  function save_drawing(id_reg,id_pasien) {
    var url;
    save_method = 'add';

    if (save_method == 'add') {
      url = '<?php echo site_url('drawing/save_drawing'); ?>/'+id_reg+'/'+id_pasien;
      title = 'Data Berhasil Disimpan';
    } else {
      url = '<?php echo site_url('soap_awal/soap_awal_edit_act'); ?>';
      title = 'Data Berhasil Diupdate';
    }
    var data_submit = $('#urlblob').val();
    $.ajax({
      type: 'POST',
      data: {
        "blob": data_submit
      },
      //dataType: 'JSON',
      dataType: 'text',
      url: url,
      success: function(data) {
        //console.log(data_submit);
        console.log(data);
        Swal.fire({
          type: 'success',
          title: title,
          showConfirmButton: false,
          timer: 1000
        });

        window.setTimeout(function() {
          //location.reload();
        }, 1000);
      },
      error: function(jqXHR, textStatus, errorThrown) {
        //console.log(data);
        alert('Error Add / Update Data');
      }
    });

  }
</script>
<script>
function getPosX(el)
{
	var eLeft = $(el).offset().left; //get the offset top of the element
  //log(eTop - $(window).scrollTop());
	lx = eLeft;
	return lx;
}
function getPosY(el)
{
	var eTop = $(el).offset().top; //get the offset top of the element
  //log(eTop - $(window).scrollTop());
	ly = eTop;
	return ly;
}
</script>
<script>
  init();
</script>
