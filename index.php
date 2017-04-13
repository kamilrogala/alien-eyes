<!DOCTYPE html>
<html lang="pl" dir="ltr">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<base href="<? echo $_SERVER['SCRIPT_URI']; ?>">
		<meta charset="utf-8">
		<title>Alien Eyes</title>
		<style>
			.lbox{position:relative;transition:all .2s ease;position:fixed;top:0;left:0;width:100%;height:100%;background:#000;z-index:999999999;}
			.loader:before{content:"";position:absolute;top:0px;left:-25px;height:12px;width:12px;border-radius:12px;-webkit-animation:loader10g 3s ease-in-out infinite;animation:loader10g 3s ease-in-out infinite;}
			.loader{position:fixed;z-index:9999999999;width:12px;height:12px;left:50%;top:50%;margin-top:-6px;margin-left:-6px;border-radius:12px;-webkit-animation:loader10m 3s ease-in-out infinite;animation:loader10m 3s ease-in-out infinite;}
			.loader:after{content:"";position:absolute;top:0px;left:25px;height:10px;width:10px;border-radius:10px;-webkit-animation:loader10d 3s ease-in-out infinite;animation:loader10d 3s ease-in-out infinite;}
			@-webkit-keyframes loader10g{0%{background-color:rgba(255,255,255,.2);}25%{background-color:rgba(255,255,255,1);}50%{background-color:rgba(255,255,255,.2);}75%{background-color:rgba(255,255,255,.2);}100%{background-color:rgba(255,255,255,.2);}}
			@keyframes loader10g{0%{background-color:rgba(255,255,255,.2);}25%{background-color:rgba(255,255,255,1);}50%{background-color:rgba(255,255,255,.2);}75%{background-color:rgba(255,255,255,.2);}100%{background-color:rgba(255,255,255,.2);}}
			@-webkit-keyframes loader10m{0%{background-color:rgba(255,255,255,.2);}25%{background-color:rgba(255,255,255,.2);}50%{background-color:rgba(255,255,255,1);}75%{background-color:rgba(255,255,255,.2);}100%{background-color:rgba(255,255,255,.2);}}
			@keyframes loader10m{0%{background-color:rgba(255,255,255,.2);}25%{background-color:rgba(255,255,255,.2);}50%{background-color:rgba(255,255,255,1);}75%{background-color:rgba(255,255,255,.2);}100%{background-color:rgba(255,255,255,.2);}}
			@-webkit-keyframes loader10d{0%{background-color:rgba(255,255,255,.2);}25%{background-color:rgba(255,255,255,.2);}50%{background-color:rgba(255,255,255,.2);}75%{background-color:rgba(255,255,255,1);}100%{background-color:rgba(255,255,255,.2);}}
			@keyframes loader10d{0%{background-color:rgba(255,255,255,.2);}25%{background-color:rgba(255,255,255,.2);}50%{background-color:rgba(255,255,255,.2);}75%{background-color:rgba(255,255,255,1);}100%{background-color:rgba(255,255,255,.2);}}
		</style>
		<script src="https://code.jquery.com/jquery-2.0.0.min.js" integrity="sha256-1IKHGl6UjLSIT6CXLqmKgavKBXtr0/jJlaGMEkh+dhw=" crossorigin="anonymous"></script>
		<link href="<? echo $_SERVER['SCRIPT_URI']; ?>css/template.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<div class="lbox"><div class="loader"></div></div>
		<div class="monster-container">
			<div class="monster-head">
			</div>
			<div class="monster-face">
				<div class="monster-ear left-ear"></div>
				<div class="monster-ear right-ear"></div>
				<div class="monster-eyes-container">
					<div class="monster-eye monster-eye-main">
						<div class="monster-eyelid top-eyelid"></div>
						<div class="monster-eyelid bottom-eyelid"></div>
						<div class="monster-pupil"></div>
					</div>
				</div>
				<div class="monster-mouth"></div>
			</div>
			<div class="monster-body"></div>
		</div>
		<div class="instruction">Click on alien face to add some extra eye.</div>
		<script>
			(function($) {
				$(window).load(function() {
					$('.loader').fadeOut();
					$('.lbox').delay(350).fadeOut('slow');
					$('body').delay(350).css({'overflow':'visible'});
				});
			})(jQuery);
			var eyes,createEyes,eye,pupil,eyelid_top,eyelid_bottom;
			var eyes = [];
			var monster_face = document.querySelector('.monster-eyes-container');
			var monster_rect = monster_face.getBoundingClientRect();
			monster_face.addEventListener("click", function (event) {
				x = event.pageX - monster_rect.left;
				y = event.pageY - monster_rect.top;
				var createEyes = function () {
					eye = document.createElement("div");
					eye.classList.add("monster-eye");
					eye.style.left = x + 'px';
					eye.style.top = y + 'px';
					pupil = document.createElement("div");
					pupil.classList.add("monster-pupil");
					eyelid_top = document.createElement("div");
					eyelid_top.classList.add("monster-eyelid", "top-eyelid");
					eyelid_bottom = document.createElement("div");
					eyelid_bottom.classList.add("monster-eyelid", "bottom-eyelid");
					eye.appendChild(pupil);
					eye.appendChild(eyelid_top);
					eye.appendChild(eyelid_bottom);
					monster_face.appendChild(eye);
					eyes.push({
						cont: eye,
						eyelid_top: eyelid_top,
						eyelid_bottom: eyelid_bottom,
						pupil: pupil
					});
					return eyes;
				}
				eyes = createEyes();
			});
			document.addEventListener("mousemove", function (event) {
				x = event.pageX;
				y = event.pageY;
				eyes.forEach(function (eye) {
					var offsets = eye.pupil.getBoundingClientRect();
					var left = (offsets.left - x)
					var top = (offsets.top - y)
					var radius = Math.atan2(top, left);
					eye.cont.style.webkitTransform = "rotate(" + radius + "rad)";
				});
			});
		</script>
	</body>
</html>