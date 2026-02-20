<!doctype html>
<html>

<head>
    <?php $this->theme->head('theme_default'); ?>


    <style type="text/css">
        /* Important part */
        .modal-dialog {
            width: 1024px;
            overflow-y: initial !important
        }

        .modal-body {
            height: 450px;
            overflow-y: auto;
        }

        .colorpicker {
            width: 20px;
            height: 20px;
            border: black thin solid;
            display: inline-block;
        }
    </style>
</head>
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
            currX = e.clientX - canvas.offsetLeft - canvas_holder.offsetLeft;
            currY = e.clientY - canvas.offsetTop - canvas_holder.offsetTop;

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
                //console.log(canvas.offsetLeft);
                currX = e.clientX - canvas.offsetLeft - canvas_holder.offsetLeft;
                //console.log(canvas.offsetTop);
                currY = e.clientY - canvas.offsetTop - canvas_holder.offsetTop;
                draw();
            }
        }
    }
</script>
<!--    <body onload="init()">	-->
<?php $this->theme->wrapper_open('theme_default', 'Gambar Dokter'); ?>
<div class="container-fluid">

    <div class="row">
        <div class="col-md-5" id="canvas_holder">
            <!--<canvas id="can" width="400" height="400" style="position:absolute;top:10%;left:10%;border:2px solid;"></canvas>-->
            <canvas id="can" width="500" height="500" style=" position:absolute;top:10%;left:10%;border:2px solid;"></canvas>
        </div>
        <div class="col-md-2">

            <div style="top:12%;left:43%;">Choose Color</div>
            <div class="colorpicker" id="green" onclick="color(this)"></div>
            <div class="colorpicker" style="background:blue;" id="blue" onclick="color(this)"></div>
            <div class="colorpicker" style="background:red;" id="red" onclick="color(this)"></div>
            <div class="colorpicker" style="background:yellow;" id="yellow" onclick="color(this)"></div>
            <div class="colorpicker" style="background:orange;" id="orange" onclick="color(this)"></div>
            <div class="colorpicker" style="background:black;" id="black" onclick="color(this)"></div>
            <div style="top:20%;left:43%;">Eraser</div>
            <div style="top:22%;left:45%;width:15px;height:15px;background:white;border:2px solid;" id="white" onclick="color(this)"></div>
        </div>
        <div class="col-md-5">
            <!--<img id="canvasimg" style="position:absolute;top:10%;left:52%;display:none;">-->
            <img id="canvasimg" width="500" height="500" style="top:10%;left:10%;border:2px solid;">
        </div>
    </div>



</div>
<div class="row">
    <div class="col-md-12">
        <img onclick="javascript:set_canvas('tetek.jpeg')" src="<?php echo base_url('assets/tpldoc/tetek.jpeg'); ?>" width="100" height="100">
        <img onclick="javascript:set_canvas('anatomi.jpg')" src="<?php echo base_url('assets/tpldoc/anatomi.jpg'); ?>" width="100" height="100">
    </div>

    <div class="col-md-12">

        <input type="text" class="form-control input-default urlblob" id="urlblob" name="urlblob" value="">
        <button type="button" class="btn btn-success" onclick="javascript: save_drawing();"> <i class="fa fa-check"></i> SIMPAN BLOB</button>

        <input type="button" value="save" id="btn" size="30" onclick="save()" style="position:absolute;top:55%;left:10%;">
        <input type="button" value="clear" id="clr" size="23" onclick="erase()" style="position:absolute;top:55%;left:15%;">
        <input type="button" value="change" id="change" size="23" onclick="changeBackground()" style="position:absolute;top:55%;left:20%;">
    </div>
</div>


<?php $this->theme->wrapper_close('theme_default'); ?>
<?php $this->theme->script('theme_default'); ?>
<script>
    function set_canvas(background_img) {
        init(background_img);
    }

    var save_method;

    function save_drawing() {
        var url;
        save_method = 'add';

        if (save_method == 'add') {
            url = '<?php echo site_url('drawing/save_drawing'); ?>';
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
    init();
</script>
</body>

</html>