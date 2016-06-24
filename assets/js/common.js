$(function(){
	
	$("#modal_trigger").leanModal({top : 200, overlay : 0.6, closeButton: ".modal_close" });
	// Calling Login Form
	$("#login_form").click(function(){
		$(".social_login").hide();
		$(".user_login").show();
		return false;
	});

	// Calling Register Form
	$("#register_form").click(function(){
		$(".social_login").hide();
		$(".user_register").show();
		$(".header_title").text('Register');
		return false;
	});

	// Going back to Social Forms
	$(".back_btn").click(function(){
		$(".user_login").hide();
		$(".user_register").hide();
		$(".social_login").show();
		$(".header_title").text('Login');
		return false;
	});
	
	$('.popup-with-zoom-anim').magnificPopup({
		type: 'inline',
		fixedContentPos: false,
		fixedBgPos: true,
		overflowY: 'auto',
		closeBtnInside: true,
		preloader: false,
		midClick: true,
		removalDelay: 300,
		mainClass: 'my-mfp-zoom-in'
	});
	
	smallSlider($("#flexiselDemo1"),4,2,2,3);
	smallSlider($("#flexiselDemo"),4,2,2,3);	
	  
});

function smallSlider(element,Vi,pVi,lVi,tVi)
{
	element.flexisel({
		visibleItems: Vi,
		animationSpeed: 1000,
		autoPlay: true,
		autoPlaySpeed: 3000,    		
		pauseOnHover: true,
		enableResponsiveBreakpoints: true,
		responsiveBreakpoints: { 
			portrait: { 
				changePoint:480,
				visibleItems: pVi
			}, 
			landscape: { 
				changePoint:640,
				visibleItems: lVi
			},
			tablet: { 
				changePoint:768,
				visibleItems: tVi
			}
		}
	});
}