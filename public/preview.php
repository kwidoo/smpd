<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="robots" content="noindex,nofollow">
<title>Responsive Design Previewer - Simulator - Emulator - Viewer - Tester</title>
<meta name="description" content="A tool to help test / simulate responsive layouts in different resolutions, iphone, ipad etc. Online alternative to browser inspectors.">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="icon" type="image/x-icon" href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAALEgAACxIB0t1+/AAAABx0RVh0U29mdHdhcmUAQWRvYmUgRmlyZXdvcmtzIENTNui8sowAAAAWdEVYdENyZWF0aW9uIFRpbWUAMDIvMjgvMTgh9jS1AAAAdklEQVQ4je2SsQ2AMAwEPyirpMhO2cR1NkiRzVxkmKdAIAQBjECi4UrLfr3+7UhiTa2VqgoLMUb47VBVkXM2CYgIBtPmCd8LeGAfnIgAmEJKKV07OErd0sbSQi/52cmlgyf8Am89EmCrrIcjiVIKW2u3j0MIGAEcWCjv60CEywAAAABJRU5ErkJggg==">
<style>
#loading { width: 100vw; height: 100vh; position: fixed; top: 0; left: 0; z-index: 9999999999999999; }
#loading #loader { position: absolute; top: 50%; left: 50%; width: 2.5rem; height: 2.5rem; margin-top: -2.5rem; margin-left: -2.5rem; }
html { display: table; width: 100vw; height: 100vh; min-height: 100%; overflow-x: hidden; }
body { display: table-cell; vertical-align: middle; min-height: 100%; overflow-x: hidden; background: #888; background: linear-gradient(#888,#333); background: -webkit-linear-gradient(#888,#333); padding-top: 38px; }
.menu { display: block; top: 0; left: 0; height: 38px; z-index: 999999999; opacity: 0.5; -webkit-transition: all 0.5s; -moz-transition: all 0.5s; transition: all 0.5s; }
.menu:hover { opacity: 1; }
.close-url { display: none; }
.btn-label { display: none; }
.warning { height: auto; display: none; }
h1, h2 { display: none; }
@media (max-width: 1279px) { .menu { display: none; } .warning { display: block; position: fixed; top: 0; left: 0; width: 100%; } }
iframe { width: 100%; height: 100%; outline: 0; border: 0; }
#preview { display: block; padding: 0; margin: 0 auto 0 auto !important; outline: 0; border: 0; border-radius: 0; min-width: 356px; min-height: 340px; background: #fff url('data:image/gif;base64,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') center center no-repeat; -webkit-transition: all 0.5s; -moz-transition: all 0.5s; transition: all 0.5s; }
#preview.xborder { border: 10px solid black; border-bottom-width: 10px; border-radius: 10px; }
#preview.scale-down { transform: scale(0.6); -webkit-transform: scale(0.6); transform-origin: 0 0; -webkit-transform-origin: 0 0; margin: 5px auto 0 auto !important; -webkit-font-smoothing: subpixel-antialiased; }
.ui-resizable { border: none; }
.ui-resizable-handle { border: 0px solid red; }
.ui-resizable-se { z-index: 9999999; border: none; bottom: 0px; right: 16px; width: 16px; height: 16px; background: transparent url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQAgMAAABinRfyAAAACVBMVEX///8AAAD///9+749PAAAAAXRSTlMAQObYZgAAADFJREFUeF4VyLENACAIAEFtHMIRGYkBSGBKvS++uPXbduxaoEGNCiUKNKhRoUSBGtUDmXYQ/0/Lg94AAAAASUVORK5CYII=') center center no-repeat !important; }
.ui-resizable-se:hover { cursor: se-resize !important; }
#preview.ui-resizable-resizing { -webkit-transition: all 0s !important; transition: all 0s !important; }
.ui-resizable-ghost { background: none !important; }
.ui-resizable-helper { }
.modal-dialog { margin-top: 38px; }
.pointer-events-none { pointer-events: none; }
</style>
</head>
<body>

<h1>Responsive Design Previewer / Simulator</h1>
<h2>A tool to help test / simulate responsive layouts in different resolutions, iphone, ipad etc. Online alternative to browser inspectors.</h2>

<div id="loading" class="bg-dark">
<div id="loader" class="text-light"><p><i class="fa fa-4x fa-spin fa-spinner"></i></p>Loading...</div>
</div>

<div class="menu position-fixed align-items-center w-100">
<div class="form-row no-gutters bg-dark p-1">

<div class="col-3 col-url">
<form method="get" action="preview.php">
<div class="input-group input-group-sm">
<div class="input-group-prepend"><span class="input-group-text bg-secondary text-light border-0">URL</span></div>
<div class="input-group-append close-url"><button class="btn btn-sm btn-danger" type="button" title="Close"><i class="fa fa-times" aria-hidden="true"></i></button></div>
<input class="form-control form-control-sm url" type="text" name="url" value="<?php if ($_GET['url']) { echo $_GET['url']; } else { echo "https://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).""; } ?>" required>
<div class="input-group-append"><button class="btn btn-sm btn-primary" type="submit" title="GO"><i class="fa fa-arrow-right" aria-hidden="true"></i></button></div>
</div>
</form>
</div>

<div class="col-3 col-hide">
<div class="input-group input-group-sm">
<div class="input-group-prepend"><span class="input-group-text bg-secondary text-light border-0">Device</span></div>
<select class="custom-select custom-select-sm rounded-right" id="device">

<option class="desktop" value="desktop">Desktop</option>

<optgroup label="Common Laptop Resolutions">
<option data-width="1366" data-height="768">Laptop - (1366 x 768)</option>
<option data-width="1280" data-height="1024">Laptop - (1280 x 1024)</option>
<option data-width="1280" data-height="800">Laptop - (1280 x 800)</option>
<option data-width="1024" data-height="800">Laptop - (1024 x 800)</option>
</optgroup>

<optgroup label="Common Mobiles">
<option data-width="375" data-height="812">Apple iPhone X - (375 x 812)</option>
<option data-width="414" data-height="736">Apple iPhone 6+, 6s+, 7+, 8+ - (414 x 736)</option>
<option data-width="375" data-height="667">Apple iPhone 7, iPhone 8 - (375 x 667)</option>
<option data-width="375" data-height="667">Apple iPhone 6, 6s - (375 x 667)</option>
<option data-width="320" data-height="568">Apple iPhone 5 - (320 x 568)</option>
<option data-width="320" data-height="480" value="default">Apple iPhone 4 - (320 x 480)</option>
<option data-width="320" data-height="480">Apple iPhone 3 - (320 x 480)</option>
<option data-width="320" data-height="568">Apple iPod Touch - (320 x 568)</option>
<option data-width="360" data-height="640">LG G5 - (360 x 640)</option>
<option data-width="360" data-height="640">LG G4 - (360 x 640)</option>
<option data-width="360" data-height="640">LG G3 - (360 x 640)</option>
<option data-width="384" data-height="640">LG Optimus G - (384 x 640)</option>
<option data-width="360" data-height="740">Samsung Galaxy S8+ - (360 x 740)</option>
<option data-width="360" data-height="740">Samsung Galaxy S8 - (360 x 740)</option>
<option data-width="360" data-height="640">Samsung Galaxy S7, S7 edge - (360 x 640)</option>
<option data-width="360" data-height="640">Samsung Galaxy S6 - (360 x 640)</option>
<option data-width="360" data-height="640">Samsung Galaxy S5 - (360 x 640)</option>
<option data-width="360" data-height="640">Samsung Galaxy S4 - (360 x 640)</option>
<option data-width="360" data-height="640">Samsung Galaxy S4 mini - (360 x 640)</option>
<option data-width="360" data-height="640">Samsung Galaxy S3 - (360 x 640)</option>
<option data-width="320" data-height="533">Samsung Galaxy S3 mini - (320 x 533)</option>
<option data-width="320" data-height="533">Samsung Galaxy S2 - (320 x 533)</option>
<option data-width="320" data-height="533">Samsung Galaxy S - (320 x 533)</option>
<option data-width="360" data-height="600">Samsung Galaxy Nexus - (360 x 600)</option>
<option data-width="360" data-height="740">Samsung Galaxy Note 8 - (360 x 740)</option>
<option data-width="360" data-height="640">Samsung Galaxy Note 4 - (360 x 640)</option>
<option data-width="360" data-height="640">Samsung Galaxy Note 3 - (360 x 640)</option>
<option data-width="360" data-height="640">Samsung Galaxy Note 2 - (360 x 640)</option>
<option data-width="400" data-height="640">Samsung Galaxy Note - (400 x 640)</option>
<option data-width="360" data-height="640">LG Nexus 5 - (360 x 640)</option>
<option data-width="384" data-height="640">LG Nexus 4 - (384 x 640)</option>
<option data-width="432" data-height="768">Microsoft Lumia 1520 - (432 x 768)</option>
<option data-width="320" data-height="480">Microsoft Lumia 1020 - (320 x 480)</option>
<option data-width="320" data-height="480">Microsoft Lumia 925 - (320 x 480)</option>
<option data-width="320" data-height="480">Microsoft Lumia 920 - (320 x 480)</option>
<option data-width="320" data-height="480">Microsoft Lumia 900 - (320 x 480)</option>
<option data-width="320" data-height="480">Microsoft Lumia 830 - (320 x 480)</option>
<option data-width="320" data-height="480">Microsoft Lumia 620 - (320 x 480)</option>
<option data-width="412" data-height="690">Motorola Nexus 6 - (412 x 690)</option>
<option data-width="360" data-height="640">HTC One - (360 x 640)</option>
<option data-width="320" data-height="480">HTC 8X - (320 x 480)</option>
<option data-width="360" data-height="640">HTC Evo 3D - (360 x 640)</option>
<option data-width="360" data-height="598">Sony Xperia Z3 - (360 x 598)</option>
<option data-width="360" data-height="640">Sony Xperia Z - (360 x 640)</option>
<option data-width="360" data-height="640">Sony Xperia S - (360 x 640)</option>
<option data-width="360" data-height="640">Sony Xperia P - (360 x 640)</option>
<option data-width="360" data-height="640">Xiaomi Mi 4 - (360 x 640)</option>
<option data-width="360" data-height="640">Xiaomi Mi 3 - (360 x 640)</option>
<option data-width="360" data-height="640">Lenovo K900 - (360 x 640)</option>
<option data-width="360" data-height="640">Pantech Vega #6 - (360 x 640)</option>
<option data-width="390" data-height="695">Blackberry Leap - (390 x 695)</option>
<option data-width="504" data-height="504">Blackberry Passport - (504 x 504)</option>
<option data-width="390" data-height="390">Blackberry Classic - (390 x 390)</option>
<option data-width="346" data-height="346">Blackberry Q10 - (346 x 346)</option>
<option data-width="360" data-height="640">Blackberry Z30 - (360 x 640)</option>
<option data-width="384" data-height="640">Blackberry Z10 - (384 x 640)</option>
<option data-width="360" data-height="480">Blackberry Torch 9800 - (360 x 480)</option>
<option data-width="360" data-height="640">ZTE Grand S - (360 x 640)</option>
<option data-width="320" data-height="480">ZTE Open (Firefox OS) - (320 x 480)</option>
</optgroup>

<optgroup label="Common Tablets">
<option data-width="1024" data-height="1366">Apple iPad Pro - (1024 x 1366)</option>
<option data-width="768" data-height="1024">Apple iPad Pro 9.7 - (768 x 1024)</option>
<option data-width="768" data-height="1024">Apple iPad 3, 4, Air, Air2 - (768 x 1024)</option>
<option data-width="768" data-height="1024">Apple iPad 1, 2 - (768 x 1024)</option>
<option data-width="768" data-height="1024">Apple iPad mini 2, 3, 4 - (768 x 1024)</option>
<option data-width="768" data-height="1024">Apple iPad mini - (768 x 1024)</option>
<option data-width="800" data-height="1280">Samsung Galaxy Tab 3 10" - (800 x 1280)</option>
<option data-width="800" data-height="1280">Samsung Galaxy Tab 2 10" - (800 x 1280)</option>
<option data-width="800" data-height="1280">Samsung Galaxy Tab (8.9") - (800 x 1280)</option>
<option data-width="600" data-height="1024">Samsung Galaxy Tab 2 (7") - (600 x 1024)</option>
<option data-width="800" data-height="1280">Samsung Nexus 10 - (800 x 1280)</option>
<option data-width="768" data-height="1024">HTC Nexus 9 - (768 x 1024)</option>
<option data-width="600" data-height="960">Asus Nexus 7 (v2) - (600 x 960)</option>
<option data-width="604" data-height="966">Asus Nexus 7 (v1) - (604 x 966)</option>
<option data-width="600" data-height="960">LG G Pad 8.3 - (600 x 960)</option>
<option data-width="800" data-height="1280">Amazon Kindle Fire HD 8.9 - (800 x 1280)</option>
<option data-width="480" data-height="800">Amazon Kindle Fire HD 7 - (480 x 800)</option>
<option data-width="600" data-height="1024">Amazon Kindle Fire - (600 x 1024)</option>
<option data-width="1024" data-height="1440">Microsoft Surface Pro 3 - (1024 x 1440)</option>
<option data-width="720" data-height="1280">Microsoft Surface Pro 2 - (720 x 1280)</option>
<option data-width="720" data-height="1280">Microsoft Surface Pro - (720 x 1280)</option>
<option data-width="768" data-height="1366">Microsoft Surface - (768 x 1366)</option>
<option data-width="600" data-height="1024">Blackberry Playbook - (600 x 1024)</option>
</optgroup>

<optgroup label="Bootstrap 4 Breakpoints">
<option data-width="576" data-height="800">Bootstrap 4 SM (W576)</option>
<option data-width="768" data-height="800">Bootstrap 4 MD (W768)</option>
<option data-width="992" data-height="800">Bootstrap 4 LG (W992)</option>
<option data-width="1200" data-height="800">Bootstrap 4 XL (W1200)</option>
</optgroup>

<optgroup label="Bootstrap 3 Breakpoints">
<option data-width="480" data-height="800">Bootstrap 3 XS (W480)</option>
<option data-width="768" data-height="800">Bootstrap 3 SM (W768)</option>
<option data-width="992" data-height="800">Bootstrap 3 MD (W992)</option>
<option data-width="1200" data-height="800">Bootstrap LG (W1200)</option>
</optgroup>

<optgroup label="Foundation 6 Breakpoints">
<option data-width="640" data-height="800">Medium (W480)</option>
<option data-width="1024" data-height="800">Large (W1024)</option>
</optgroup>

</select>

<div class="input-group-append go-desktop dimensions"><a href="javascript:;" class="btn btn-primary" title="Back to Desktop"><i class="fa fa-desktop" aria-hidden="true"></i></a></div>

</div>
</div>

<div class="col-1 col-hide dimensions">
<div class="input-group input-group-sm">
<div class="input-group-prepend"><span class="input-group-text bg-secondary text-light border-0">W</span></div>
<input class="form-control form-control-sm deviceW" type="number" value="0" min="320" onclick="select()">
</div>
</div>

<div class="col-1 col-hide dimensions">
<div class="input-group input-group-sm">
<div class="input-group-prepend"><span class="input-group-text bg-secondary text-light border-0">H</span></div>
<input class="form-control form-control-sm deviceH" type="number" value="0" min="320" onclick="select()">
</div>
</div>

<div class="col col-hide col-hide-desktop dimensions"><a class="btn btn-sm btn-primary btn-block rotate dimensions" href="javascript:;" title="Toggle Orientation"><i class="fa fa-mobile fa-rotate-90" aria-hidden="true"></i></a></div>
<div class="col col-hide col-hide-desktop dimensions"><a class="btn btn-sm btn-primary btn-block scale-down dimensions" href="javascript:;" title="Toggle Scale"><i class="fa fa-compress" aria-hidden="true"></i></a></div>
<div class="col col-hide"><a class="btn btn-sm btn-primary btn-block fullscreen-toggle" href="javascript:;" title="Toggle Fullscreen"><i class="fa fa-window-restore" aria-hidden="true"></i></a></div>
<div class="col col-hide"><a class="btn btn-sm btn-primary btn-block refresh-iframe" href="javascript:;" title="Refresh Page"><i class="fa fa-refresh" aria-hidden="true"></i></a></div>
<div class="col col-hide"><a class="btn btn-sm btn-block btn-info" href="javascript:;" title="About" data-toggle="modal" data-target="#about"><i class="fa fa-info-circle" aria-hidden="true"></i></a></div>
<div class="col col-hide"><a class="btn btn-sm btn-block btn-danger remove-iframe" href="javascript:;" title="Close Previewer"><i class="fa fa-times-circle" aria-hidden="true"></i></a></div>

</div>
</div>

<div class="warning hidden bg-warning text-center p-2"><i class="fa fa-warning text-danger" aria-hidden="true"></i> Intended for use on large screens, 1280px or above... Please resize your browser, or <a class="btn btn-sm btn-danger" href="./">Exit</a></div>

<div id="preview" class="portrait">
<iframe src="./"></iframe>
</div>

<div class="modal fade" id="about" tabindex="-1" role="dialog" aria-labelledby="about" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-header bg-info text-light rounded-0 justify-content-center">
<h5 class="modal-title text-center">Responsive Design Previewer <span class="badge badge-pill badge-light">v1.0.3</span></h5>
</div>
<div class="modal-body text-center px-0">
<p class="lead text-weight-bold"><em>A tool to help test responsive layouts</em></p>
<hr>
<small>To simulate touch events, open your browser inspector</small><br>
<small>If an entered URL doesn't work, check your browser console</small><br>
<small>You can easily add more devices / breakpoints if you wish</small><br>
<small>You can manually resize the preview using the bottom right handle</small><br>
<small>The minimum custom width / height is 320px</small><br>
<small><a href="https://www.mydevice.io/#compare-devices" rel="nofollow" target="_blank">Devices Reference</a></small>
<hr>
<b>Enjoy!</b>
<hr>
<p><small>&copy; 2018 <a href="https://www.xcartmods.co.uk" target="_blank">www.xcartmods.co.uk</a></small></p>
<p class="mb-0"><a class="text-dark" href="https://github.com/xcartmods/Responsive-Design-Previewer" target="_blank"><i class="fa fa-2x fa-github"></i></a></p>
</div>
<div class="modal-footer bg-warning p-0">
<button type="button" class="btn btn-block btn-info rounded-0 p-3" data-dismiss="modal"><b>OK</b></button>
</div>
</div>
</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>

<script>
$(function($) {

$(window).on('load', function() {
    $('#loader').fadeOut(1000);
    $('#loading').delay(500).fadeOut('slow');
});

// https://github.com/kayahr/jquery-fullscreen-plugin
function d(c){var b,a;if(!this.length)return this;b=this[0];b.ownerDocument?a=b.ownerDocument:(a=b,b=a.documentElement);if(null==c){if(!a.exitFullscreen&&!a.webkitExitFullscreen&&!a.webkitCancelFullScreen&&!a.msExitFullscreen&&!a.mozCancelFullScreen)return null;c=!!a.fullscreenElement||!!a.msFullscreenElement||!!a.webkitIsFullScreen||!!a.mozFullScreen;return!c?c:a.fullscreenElement||a.webkitFullscreenElement||a.webkitCurrentFullScreenElement||a.msFullscreenElement||a.mozFullScreenElement||c}c?(c=b.requestFullscreen||b.webkitRequestFullscreen||b.webkitRequestFullScreen||b.msRequestFullscreen||b.mozRequestFullScreen)&&c.call(b):(c=a.exitFullscreen||a.webkitExitFullscreen||a.webkitCancelFullScreen||a.msExitFullscreen||a.mozCancelFullScreen)&&c.call(a);return this}jQuery.fn.fullScreen=d;jQuery.fn.toggleFullScreen=function(){return d.call(this,!d.call(this))};var e,f,g;e=document;e.webkitCancelFullScreen?(f="webkitfullscreenchange",g="webkitfullscreenerror"):e.msExitFullscreen?(f="MSFullscreenChange",g="MSFullscreenError"):e.mozCancelFullScreen?(f="mozfullscreenchange",g="mozfullscreenerror"):(f="fullscreenchange",g="fullscreenerror");jQuery(document).bind(f,function(){jQuery(document).trigger(new jQuery.Event("fullscreenchange"))});jQuery(document).bind(g,function(){jQuery(document).trigger(new jQuery.Event("fullscreenerror"))});

	$.QueryString = (function(a) {
		if (a == "") return {};
		var b = {};
		for (var i = 0; i < a.length; ++i) {
			var p=a[i].split('=');
			if (p.length != 2) continue;
			b[p[0]] = decodeURIComponent(p[1].replace(/\+/g, " "));
		}
		return b;
	})(window.location.search.substr(1).split('&'));

	var goto = $.QueryString["url"];

	if (goto != "") {
		$('iframe').attr('src', goto);
	}

	$.fn.clickToggle = function(a,b) {
		function ct(){ [b,a][this._tog^=1].call(this); }
		return this.on("click", ct);
	};

	$('input.url').on('click', function(){
		$('.col-hide').hide();
		$('.col-url').addClass('col-12');
		$('.close-url').show();
	});

	$('.close-url').on('click', function(){
		$('.col-hide').show();
		var selected = $('select#device').find(':selected').val();
		if (selected == "desktop") {
			$('.dimensions').hide();
			$('.col-hide-desktop').hide();
		} else {
			$('.dimensions').show();
			$('.col-hide-desktop').show();
		}
		$('.col-url').removeClass('col-12');
		$('.close-url').hide();
	});

	$('.dimensions').css('display','none');
	$('#device').addClass('rounded-right');

	$('#preview').css('height', $(window).height() - 38).css('width', $(window).width()).removeClass('xborder');

	var scrollbar = 16;
	var border = 20;
	var resizable = true; // set to false to disable resizing

	$('select#device').on('change', function() {
		var selected = $(this).find(':selected').attr('class');
		if (selected == "desktop") {
			$('#preview').css('width', '100%').css('height', $(window).height() - 38).css('overflow', 'hidden').removeClass('xborder');
			$('.dimensions').css('display','none');
			$('#device').addClass('rounded-right');
			if (resizable) {
				$("#preview").resizable("destroy");
			}
		} else {
			var thisWidth = parseFloat($(this).find(':selected').attr('data-width')) + scrollbar + border;
			var thisHeight = parseFloat($(this).find(':selected').attr('data-height')) + border;
			$('#preview').css('width', thisWidth + 'px').css('height', thisHeight + 'px').css('overflow', 'hidden').addClass('xborder');
			$('.dimensions').css('display', 'block');
			var this_Width = thisWidth - scrollbar - border;
			var this_Height = thisHeight - border;
			$('input.deviceW').val(this_Width);
			$('input.deviceH').val(this_Height);
			$('#device').removeClass('rounded-right');
			if (resizable) {
				$("#preview").resizable({
					handles: "se",
					ghost: true,
					animate: false,
					minWidth: 320,
					minHeight: 320,
					helper: "ui-resizable-helper",
					start: function(event, ui) {
						$('iframe').css('display', 'none');
					},
					resize: function(event, ui) {
					},
					stop: function(event, ui) {
						$('input.deviceW').val($(".ui-resizable-helper").width() - scrollbar);
						$('input.deviceH').val($(".ui-resizable-helper").height());
						$('iframe').css('display', 'block');
					}
				});
			}
			$('.col-hide-desktop').show();
		}
		$('i.fa-mobile').addClass('fa-rotate-90');
	});

	$('select#device').val('default').trigger("change");

	$('.go-desktop a').on('click', function(){
		$('#preview').removeClass('scale-down');
		$("select#device").val($("select#device option:first").val()).trigger("change");
	});

	$('input.deviceW').bind("keyup change blur paste", function() {
		var widthChange = parseFloat($(this).val()) + scrollbar + border;
		if ($(this).val().length > 2 && $(this).val() > 319) {
			$('#preview').css('width', widthChange + 'px');
			$(this).removeClass('is-invalid');
		} else {
			$(this).addClass('is-invalid');
		}
	});

	$('input.deviceH').bind("keyup change blur paste", function() {
		var heightChange = parseFloat($(this).val()) + scrollbar + border;
		if ($(this).val().length > 2 && $(this).val() > 319) {
			$('#preview').css('height', heightChange + 'px');
			$(this).removeClass('is-invalid');
		} else {
			$(this).addClass('is-invalid');
		}
	});

	$('a.rotate').clickToggle(function() {
		$('#preview').removeClass('portrait').addClass('landscape');
		var tempWidth = parseFloat($("input.deviceW").val());
		var tempHeight = parseFloat($("input.deviceH").val());
		$('input.deviceW').val(tempHeight).trigger("change");
		$('input.deviceH').val(tempWidth).trigger("change");
		var thisWidth = parseFloat($("input.deviceW").val()) + scrollbar + border;
		var thisHeight = parseFloat($("input.deviceH").val()) + border;
		$('.landscape').css('width', thisWidth + 'px').css('height', thisHeight + 'px');
		$('i.fa-mobile').toggleClass('fa-rotate-90');
		$('a.rotate').addClass('pointer-events-none');
		setTimeout(function(){ 
			$('a.rotate').removeClass('pointer-events-none');
		}, 500);
	}, function() {
		$('#preview').removeClass('landscape').addClass('portrait');
		var tempWidth = parseFloat($("input.deviceW").val());
		var tempHeight = parseFloat($("input.deviceH").val());
		$('input.deviceW').val(tempHeight).trigger("change");
		$('input.deviceH').val(tempWidth).trigger("change");
		var thisWidth = parseFloat($("input.deviceW").val()) + scrollbar + border;
		var thisHeight = parseFloat($("input.deviceH").val()) + border;
		$('.portrait').css('width', thisWidth + 'px').css('height', thisHeight + 'px');
		$('i.fa-mobile').toggleClass('fa-rotate-90');
		$('a.rotate').addClass('pointer-events-none');
		setTimeout(function(){ 
			$('a.rotate').removeClass('pointer-events-none');
		}, 500);
	});

	$('a.scale-down').clickToggle(function() {
		$('#preview').addClass('scale-down');
		$('a.scale-down i').removeClass('fa-compress').addClass('fa-expand');
		$('a.scale-down').addClass('pointer-events-none');
		setTimeout(function(){ 
			$('a.scale-down').removeClass('pointer-events-none');
		}, 500);
	}, function() {
		$('#preview').removeClass('scale-down');
		$('a.scale-down i').removeClass('fa-expand').addClass('fa-compress');
		$('a.scale-down').addClass('pointer-events-none');
		setTimeout(function(){ 
			$('a.scale-down').removeClass('pointer-events-none');
		}, 500);
	});

	$('a.fullscreen-toggle').clickToggle(function() {
		$(document).fullScreen(true);
		$('a.fullscreen-toggle i').removeClass('fa-window-restore').addClass('fa-window-maximize');
		$('a.fullscreen-toggle').addClass('pointer-events-none');
		setTimeout(function(){ 
			$('a.fullscreen-toggle').removeClass('pointer-events-none');
		}, 500);
	}, function() {
		$(document).fullScreen(false);
		$('a.fullscreen-toggle i').removeClass('fa-window-maximize').addClass('fa-window-restore');
		$('a.fullscreen-toggle').addClass('pointer-events-none');
		setTimeout(function(){ 
			$('a.fullscreen-toggle').removeClass('pointer-events-none');
		}, 500);
	});

	$('a.refresh-iframe').on('click', function(){
		var iframeurl = $('iframe').contents().get(0).location.href.split('#')[0];
		$('iframe').attr("src", iframeurl);
	});

	$('a.remove-iframe').on('click', function(){
		var iframeurl = $('iframe').contents().get(0).location.href.split('#')[0];
		location.href = iframeurl;
	});

});
</script>
</body>
</html>
