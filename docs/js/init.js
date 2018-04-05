document.addEventListener('DOMContentLoaded', function () {
	var eyes, createEyes, eye, pupil, eyelid_top, eyelid_bottom;
	var eyes = [];
	var monster_face = document.querySelector('.monster-eyes-container');
	var monster_rect = monster_face.getBoundingClientRect();
	monster_face.addEventListener('click', function (event) {
		x = event.pageX - monster_rect.left;
		y = event.pageY - monster_rect.top;
		var createEyes = function () {
			eye = document.createElement('div');
			eye.classList.add('monster-eye');
			eye.style.left = x + 'px';
			eye.style.top = y + 'px';
			pupil = document.createElement('div');
			pupil.classList.add('monster-pupil');
			eyelid_top = document.createElement('div');
			eyelid_top.classList.add('monster-eyelid', 'top-eyelid');
			eyelid_bottom = document.createElement('div');
			eyelid_bottom.classList.add('monster-eyelid', 'bottom-eyelid');
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
	document.addEventListener('mousemove', function (event) {
		x = event.pageX;
		y = event.pageY;
		eyes.forEach(function (eye) {
			var offsets = eye.pupil.getBoundingClientRect();
			var left = (offsets.left - x)
			var top = (offsets.top - y)
			var radius = Math.atan2(top, left);
			eye.cont.style.webkitTransform = 'rotate(' + radius + 'rad)';
		});
	});
});
