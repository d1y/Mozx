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
	function isURL(url) {
    let re1 = /(\w+):\/\/([^\:|\/]+)(\:\d*)?(.*\/)([^#|\?|\n]+)?(#.*)?(\?.*)?/i;
    //re.exec(url);
    let arr = url.match(re1);
    if (arr) {
        let domain = arr[2];
        let re2 = /^(.+\.)(com|edu|gov|int|mil|net|org|biz|info|name|museum|coop|aero|[a-z][a-z])$/;
        if (!re2.test(domain)) {
            return false;
        }
        else {
            return true;
        }
    } else {
        return false;
    }
	}
	function getAVinfo(id) {
		let result = []
		$.ajax({
			url: '/api/index.php',
			data: {
				type: 'bili',
				get: 'info',
				aid: id
			},
			async: false,
			success(data) {
				data = data.data
				result = data
				let imgEle = $(($('.prURL').prevAll())[1])
				imgEle.show()
				imgEle.children('img').attr('src',data.pic)
				imgEle.children('input').val(data.pic)
				let temp = `.videos_push_`
				$(`${temp}title`).val(data.title)
				$(`${temp}tags`).val(data.tname)
				$(`${temp}desc`).val(data.desc)
			}
		})
		return result
	}
	{
		let wrap = $(($('.prURL').prevAll())[1])
		wrap.children('input').on('input',function() {
			wrap.children('img').attr('src',$(this).val())
		})
	}
	let biliPlay = `http://player.bilibili.com/player.html`
	$('.upload-bili').on('click',()=> {
		swal('bilibili frame',{
			content: {
				element: "input",
				attributes: {
					placeholder: "av号,多P",
					type: "text",
				},
			},
			buttons: {
				cancel: true,
				confirm: "Confirm",
			},
		}).then(value=> {
			let result = []
			let dv = value.split(','),
					av = dv[0],
					count = dv[1] || 1
			let va = getAVinfo(av)
			function AVeach(id, len) {
				for (let i=0; i<len; i++) {
					let ux = new URL(biliPlay)
					ux.searchParams.set('aid', id)
					ux.searchParams.set('page',i+1)
					result.push({
						title: va.pages[i].part,
						url: ux.href
					})
				}
			}
			if (isURL(av)) {
				let url = new URL(av)
				if (url.host == 'www.bilibili.com' && /\/video\//g.test(url.pathname)) {
					let tmp = url.pathname
					let tmp1 = tmp.substr(tmp.search('av')+2)
					let tmp2 = tmp1
					if (tmp1[tmp1.length-1] == '/') tmp2 = tmp1.substr(0,tmp1.length-1)
					AVeach(tmp2,count)
				}
			} else {
				let id = av,
						su = av.substr(0,2)
				if (su == 'av') id = av.substr(2)
				AVeach(id,count)
			}
			for (let i=0; i<result.length; i++) {
				listWrap.append(
					genACG(result[i].url,result[i].title)
				)
			}
		})
	})
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
		return `<li class="row overflow-hidden w-100 mt-2">
			<div class="col-6">
				<h5 contenteditable="true">${title}</h5>
				<p contenteditable="true" class="font-weight-normal opc">${url}</p>
			</div>
			<div class="col-2 text-right">
				<button class="btn btn-danger" onclick="dropWrap(this)">删除</button>
			</div>
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
			r[i] = r[i].trim();
		};

		let con = genACG(r[0],r[1])
		if (e.shiftKey) {
			listWrap.prepend(con)
		} else {
			listWrap.append(con)
		}
	})
	window.dropWrap = e=> {
		$(e).parent().parent().remove()
	}
})