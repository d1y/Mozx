$(()=> {
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
		for (let i=0; i<pushList.length; i++) {
			let cur = $(pushList[i])
			cur.on('click',function() {
				u.searchParams.set('go',$(this).attr('data-go'))
				window.history.replaceState(null,null,u.search)
				{
					for (let i=0; i<activeList.length; i++) {
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
})
