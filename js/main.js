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
		let activeList = $(".push-wrap .push-item")
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
	window.openSM = e => {
		let url = $(e).attr('data-open')
		window.open(
			url,
			 'newwindow',
			 'height=500, width=500,top=50, left=50, toolbar=no,menubar=no, scrollbars=no,resizable=no, location=no, status=no'
		)
	}
	
	$(".prURL").on('click',function(){
		let ele = ($(this).prevAll())[1]
		$(ele).toggle('slow')
		let cur = $(ele).children('input')
	})
	$('.upload-bili').on('click',()=> {
		swal('bilibili frame',{
			content: {
				element: "input",
				attributes: {
					placeholder: "url,total number",
					type: "text",
				},
			},
			buttons: {
				cancel: true,
				confirm: "Confirm",
			},
		});
	})
	let biliPlay = `http://player.bilibili.com/player.html`
	let addInput = $('.addInput').get(0),
			listWrap = $('.upload-list-wrap')
	let pushKey = `videos_add_input`
	{
		let tmp = window.localStorage.getItem(pushKey)
		if (tmp) $(addInput).val(tmp)
	}
	$(addInput).on('input',function() {
		let value = $(this).val().trim()
		if (!value) return
		window.localStorage.setItem(pushKey,value)
	})
	function genACG(url,title = '未设置') {
		return `<li>
      <h5 contenteditable="true">${title}</h5>
			<p contenteditable="true" class="font-weight-normal">${url}</p>
			<button class="btn btn-danger" onclick="dropWrap(this)">删除</button>
    </li>`
	}
	$('.videos_btn').on('click',e=> {
		let t = $(addInput).val().trim()
		if (!t) {
			swal({
				icon: `error`,
				title: `格式为: 链接 / 类型 / 标题`
			})
			return
		}
		let r = t.split(',')
		for (let i=0; i<r.lenght; i++) {
			r[i] = r[i].trim()
		}
		let con = genACG(r[0],r[2])
		listWrap.append(con)
	})
	window.dropWrap = e=> {
		$(e).parent().remove()
	}
})