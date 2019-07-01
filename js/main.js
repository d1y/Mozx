$(() => {
	{
		function fetchWindow() {
			let currBody = document.body.offsetHeight;
			let currScreen = window.innerHeight;
			if (currBody <= currScreen) {
				$("#footer-bar").addClass("footer-fixed")
			} else {
				$("#footer-bar").removeClass("footer-fixed")
			}
		}
		fetchWindow()
		window.onresize = fetchWindow
	} 
	{
		let pushList = $(".push")
		let activeList = $(".push-wrap .collapse")
		let u = new URL(window.location.href)
		for (let i = 0; i < pushList.length; i++) {
			let cur = $(pushList[i])
			cur.on('click', function () {
				u.searchParams.set('go', $(this).attr('data-go'))
				window.history.replaceState(null, null, u.search) 
				{
					for (let i = 0; i < activeList.length; i++) {
						$(pushList[i]).removeClass('active')
						$(activeList[i]).removeClass('show')
					}
				}
				$(pushList[i]).addClass('active')
				$(activeList[i]).addClass('show')
				return false
			})

		}
	}
	window.openSM = () => {
		window.open(
			`https://smms.netlify.com/`,
			 'newwindow',
			 'height=500, width=500,top=50, left=50, toolbar=no,menubar=no, scrollbars=no,resizable=no, location=no, status=no'
		)
	}
	
	$(".prURL").on('click',function(){
		let ele = ($(this).prevAll())[1]
		$(ele).toggle('slow')
		let cur = $(ele).children('input')
	})
})