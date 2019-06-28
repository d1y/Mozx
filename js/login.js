$(() => {
  let userWrap = $("#inputUserName"),
    	pwdWrap = $("#inputPassword")
  $('#btn').on('click', e=> {
		let flag = e.currentTarget.dataset.type;
    let user = userWrap.val().trim();
    let pwd = pwdWrap.val().trim();
		if (!user || !pwd) return;
		if (flag == 'up') { // sign up
			$.ajax({
				url: '/api/index.php',
				method: 'POST',
				data: {
					type: 'user',
					is: 1,
					user,
					pwd
				},
				success(data) {
					console.log(data)
				},
				error: e=> console.log(e)
			})
		} else if (flag == 'in') { // sign in
			$.ajax({
	      url: '/api/index.php',
	      method: 'POST',
	      data: {
	        type: 'user',
	        is: 0,
	        user,
	        pwd
	      },
	      success(data) {
	        let title = data.msg;
	        let icon = `success`;
	        let text = ``;
					let code = 100; // 100 - 200 - 400
	        if (data.code == 400) {
	          icon = `error`;
	        };
	        if (data.msg == "密码错误") {
	          text = `· 请检查你输入的密码(*^*) ·`
	        } else if (data.msg == "账号不存在") {
						code = 400;
	          text = `· 我擦没有账号,快去注册一个去:( ·`
	        } else {
						code = 200
	          text = `· 填写正确,将跳转到用户界面 ·`
	        }
	        swal({
	        	title,text,icon,
	        	allowOutsideClick: true
	        }).then(is=>{
						if (is) {
							switch (code) {
								case 100:
									pwdWrap.val('')
									break;
								case 200:
									window.locatino.href = './home'
									break;
								default:
									window.location.href = '/page/reg.php'
							}
						}
					})
	      },
	      error: e => console.log(e)
	    })
		}
  })
  $("#forget").on('click',()=> {
  	swal({
  		title: '提示',
  		text: '打工是不可能打工的,找回密码也是不可能的'
  	})
  	return false
  })
});
