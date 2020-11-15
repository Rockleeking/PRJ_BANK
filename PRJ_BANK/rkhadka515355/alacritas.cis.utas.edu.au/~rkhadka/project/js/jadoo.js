$(document).ready(function(){
		$(".cat").change(function() {
			if(this.checked) {
			$(".catimg").prop('type','visible');
			}else{
			$(".catimg").prop('type','hidden');
		}
});$(".tiger").change(function() {
			if(this.checked) {
			$(".tigerimg").prop('type','visible');
			}else{
			$(".tigerimg").prop('type','hidden');
		}
});$(".frog").change(function() {
			if(this.checked) {
			$(".frogimg").prop('type','visible');
			}else{
			$(".frogimg").prop('type','hidden');
		}
});$(".zebra").change(function() {
			if(this.checked) {
			$(".zebraimg").prop('type','visible');
			}else{
			$(".zebraimg").prop('type','hidden');
		}
});$(".pig").change(function() {
			if(this.checked) {
			$(".pigimg").prop('type','visible');
			}else{
			$(".pigimg").prop('type','hidden');
		}
});
		});
		