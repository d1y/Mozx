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
	let temp = `.videos_push_`
	let eleOBJ = {
		img: $(($('.prURL').prevAll())[1]),
		title: $(`${temp}title`),
		tags: $(`${temp}tags`),
		desc: $(`${temp}desc`)
	}
	function isURL(str) {
		return !!str.match(/(((^https?:(?:\/\/)?)(?:[-;:&=\+\$,\w]+@)?[A-Za-z0-9.-]+|(?:www.|[-;:&=\+\$,\w]+@)[A-Za-z0-9.-]+)((?:\/[\+~%\/.\w-_]*)?\??(?:[-\+=&;%@.\w_]*)#?(?:[\w]*))?)$/g);
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
				if (!data) return
				result = data
				let imgEle = eleOBJ.img
				imgEle.show()
				imgEle.children('img').attr('src',data.pic)
				imgEle.children('input').val(data.pic)
				eleOBJ.title.val(data.title)
				eleOBJ.tags.val(data.tname)
				eleOBJ.desc.val(data.desc)
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
			if (!value) value = 'av51352507'
			if (isURL(value)) {
				let url = new URL(value)
				if (url.host == 'www.bilibili.com') {
					value = url.pathname.replace(/[^\d]/g,'')
				}
			} else {
				if (value.substr(0,2) == 'av') value = value.substr(2)
			}
			let av = value
			let va = getAVinfo(av)
			let count = va.pages.length
			for (let i=0; i<count; i++) {
				listWrap.append(
					genACG(`${biliPlay}?aid=${av}&page=${i+1}`,va.pages[i].part)
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
	function genACG(url,title = '未设置',frame = 1) {
		return `<li class="row overflow-hidden w-100 mt-2">
			<div class="col-6">
				<h5 contenteditable="true" data-frame="${frame}">${title}</h5>
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
		r[2] = parseInt(r[2]).toString() == 'NaN' ? 0 : r[2]
		let con = genACG(r[0],r[1],r[2])
		if (e.shiftKey) {
			listWrap.prepend(con)
		} else {
			listWrap.append(con)
		}
	})
	window.dropWrap = e=> {
		$(e).parent().parent().remove()
	}
	function btoaString(arr) {
		return btoa(encodeURI(JSON.stringify(arr)))
	}
	function atobString(str) {
		return JSON.parse(decodeURI(atob(str)))
	}
	function genVideosInfo() {
		let list = listWrap.find('li');
		if (list.length == 0 ) return 'fail'
		let result = {}
		result.list = []
		$.each(list,(n,item)=> {
			let currEle = $(item).find('h5,p'),
					h5 = currEle[0],
					p = currEle[1]
			result.list.push({
				title: $(h5).text().trim(),
				url: $(p).text().trim(),
				frame: $(h5).attr('data-frame')
			})
		})
		result.list = btoaString(result.list)
		result.cover = btoaString(eleOBJ.img.children('input').val())
		result.title = btoaString(eleOBJ.title.val().trim())
		result.tags = btoaString(eleOBJ.tags.val().trim())
		result.intro = btoaString(eleOBJ.desc.val())
		result.type = 'post'
		result.is =  'videos'
		return result
	}
	function val($o) {
		return $o.val().trim()
	}
	function genMusicInfo() {
		let errorText = 'fail', cls = '.music_push_'
		let imgSRC = $('.upload-cover').css('background-image')
		imgSRC = JSON.parse(imgSRC.split("(")[1].split(")")[0])
		if (!imgSRC || !isURL(imgSRC)) return '封面不是url 或不存在'
		let list = $('.upList .upList-item')
		let span,input,values = []
		if (!list.length) return '只有一个个数'
		$.each(list,(i,item)=> {
			span = $(item).find('span').text().trim()
			input = $(item).find('input').val().trim()
			if (span == '可编辑标题' || input == '') return true
			values.push({ title:span, url:input })
		})
		let pushTitle = $(`${cls}title`),
				pushStyle = $(`${cls}style`),
				pushDesc = $(`${cls}desc`)
		return {
			cover: btoaString(imgSRC),
			list:  btoaString(values),
			title: btoaString(val(pushTitle)),
			style: btoaString(val(pushStyle)),
			intro: btoaString(val(pushDesc)),
			type: 'post',
			is:   'music'
		}
	}
	function genPostInfo() {
		let _title = btoaString(val($('.write_title'))),
				_cover = btoaString(val($('.write_input'))),
				_tags = btoaString(val($('.write_tags'))),
				_show = btoaString(val($('.write_show'))),
				_md = btoaString(JSON.stringify(val($('#text-input'))))
		return {
			title:_title,
			cover:_cover,
			tags:_tags,
			show:_show,
			md:_md,
			type: 'post',
			is: 'write'
		}
	}
	let pushVideosData = {list:''},
			pushMusicData = {list:''},
			pushWriteData = {content:''}
	$('.push-btn').on('click',function() {
		let ERROR = {
			icon: 'error',
			title: '不允许重复提交'
		}
		switch ($(this).attr('data-post')) {
    	case 'videos':
				let data = genVideosInfo()
				if (data.list == pushVideosData.list || typeof(data) == 'string') {
					return swal(ERROR)
				}
				$.ajax({
					url: `/api/index.php`,
					method: `post`,
					data,
					success(msg) {
						pushVideosData = data
						console.log(msg)
					},
					error: e=> console.log(e)
				})
				break;
			case 'music':
				let value = genMusicInfo();
				if (pushVideosData.list == value.list) {
					return swal(ERROR)
				}
				if (typeof(value) == 'string') {
					ERROR.title = '未知错误'
					return swal(ERROR)
				}
				$.ajax({
					url: `/api/index.php`,
					data: value,
					method: 'post',
					success(data) {
						pushMusicData = value
					},
					error: e=> console.error(e)
				})
				break;
			case 'write':
				let jump = genPostInfo()
				$.ajax({
					url: `/api/index.php`,
					data: jump,
					method: 'post',
					success(data) {
						console.log(data)
					},
					error: e=> console.error(e)
				})
			default:
				break;
		}
	})
	$('.upload-cover').on('click',function(e) {
		if (e.shiftKey) {
			window.open('https://sm.ms')
		} else {
			swal({
				content: 'input',
				cancel: true,
				confirm: true
			}).then(value=> {
				value = `https://files.catbox.moe/qvi5zr.jpg`
				if (!value) return
				if (isURL(value)) {
					$(this).css({
						backgroundImage: `url(${value})`
					})
				} else {
					swal('请输入正确的图片地址')
				}
			})
		}
	})
	$('.upAdd').on('click',()=> {
		$('.upList').append($(`
		<div class="upList-item row">
			<div class="input-group mb-3 col-8">
				<div class="input-group-prepend" style="width: auto;">
					<span class="input-group-text bg-primary text-white" style="outline:none;" contenteditable="true">
						可编辑标题
					</span>
				</div>
				<input type="text" class="form-control">
			</div>
			<div class="col-2">
				<button type="button" class="btn btn-primary" onclick="removeJUMP(this)">删除</button>
			</div>
		</div>
		`))
	})
	window.removeJUMP = ele => {
		let father = $(ele).parent().parent()
		father.remove()
	}
	let writeCover = $('.write_cover'),
			writeInput = $('.write_input'),
			writeToggle = $('.write_toggle')
	writeInput.hide()
	writeToggle.on('click',e=> {
		writeInput.toggle()
	})
	writeInput.on('input',function() {
		let data = $(this).val()
		if (isURL(data)) writeCover.attr('src',data)
	})
	$('button[data-open]').on('click',function() {
		let open = $(this).attr('data-open')
		window.location.href = open
	})
})