$(() => {
  let genTable = e => {
    return $(`
    <tr>
      <th scope="row">${e.id}</th>
      <td>${e.nickname}</td>
      <td>${e.username}</td>
      <td>${e.login}</td>
      <td>
        <button class="btn btn-success" 
        data-id="${e.id}" 
        data-nick="${e.nickname}"
        data-toggle="modal" 
        data-target="#exampleModal"
        onclick="editUser(this)"
        >编辑</button>
      </td>
    </tr>
    `)
  }
  let currentQuery = (new URL(window.location.href)).searchParams.get('type');
  let wrap = $('#userTable');
  let tbodyWrap = wrap.find('tbody')[0];
  let oldPage = $('#oldPage'),
    nextPage = $('#nextPage')

  let url = `/api/index.php`;

  function loadUserData(call, page = 1, count = 10) {
    $.ajax({
      url,
      method: 'POST',
      data: {
        type: 'user',
        is: 'view',
        page,
        count
      },
      success: data => call(data),
      error: e => console.log(e)
    })
  }
  if (currentQuery == 'user') {
    loadUserData(data => {
      $('#nextBtn')
        .attr('data-total', data.totalpage)
        .attr('data-current', data.currentpage)
      uploadTable(data.data)
      if (data.totalpage <= 1) {
        $('#nextBtn').remove()
      }
    })
  }

  function uploadTable($arr, $flag = false) {
    if ($flag) $(tbodyWrap).html('')
    $arr.forEach(item => {
      $(tbodyWrap).append(genTable(item))
    })
  }
  $('#nextBtn').on('click',function() {
    let curr = $(this).attr('data-current'),
        total = $(this).attr('data-total')
    if (curr >= total) {
      $(this).remove()
    } else {
      ++curr
      if (curr >= total) $(this).remove()
      loadUserData(data => uploadTable(data.data), curr)
    }
  })
  window.editUser = t => {
    let ele = $(t),
      id = ele.attr('data-id'),
      nick = ele.attr('data-nick');
    $('#post-id').val(id)
    $('#post-nickname').val(nick)
  }
  $("#confirm_user").on('click', function() {
    let id = $('#post-id').val()
    let nickname = $('#post-nickname').val()
    let pwd = $('#post-pwd').val()
    $.ajax({
      url,
      method: 'POST',
      async: false,
      data: {
        type: `user`,
        is: 'update',
        id,
        nickname,
        pwd
      },
      success(data) {
        console.log(data)
      }
    })
    return true
  })
  $('#confirm_del').on('click', () => {
    let id = $('#post-id').val()
    if (!id) return;
    swal({
      title: '确定删除?',
      confirm: true,
      cancel: true
    }).then(flag => {
      if (!flag) return;
      $.ajax({
        url,
        method: 'post',
        data: {
          type: `user`,
          is: 'delete',
          id
        },
        success(data) {
          console.log(data)
        }
      })
    })
  })
  $('button[data-type="del_all"]').on('click', () => {
    swal('Are you ok?')
      .then(flag => {
        if (flag) {
          $.ajax({
            url,
            method: 'post',
            data: {
              type: `user`,
              is: `delete`,
              all: true
            },
            success(data) {
              console.log(data)
            }
          })
        }
      })
  })
  $('button[data-type="del_user"').on('click',() => {
    swal({
      text: `输入用户的id即可删除`,
      content: "input",
      button: {
        text: "确定删除",
        closeModal: true,
      }
    }).then(name => {
      $.ajax({
        url,
        method: 'post',
        data: {
          type: `user`,
          is: `info`,
          id: name
        },
        success(data) {
          console.log(data)
        }
      })
    })
  })
  $('button[data-type="add_user"]').on('click',()=> {
    swal({
      title: '输入登录用户名',
      content: `input`,
      button: {
        text: '下一步',
        closeModal: true
      }
    }).then(user=> {
      if (!user) return
      swal({
        title: '输入密码',
        content: `input`,
        button: {
          text: '下一步',
          closeModal: true
        }
      }).then(pwd=> {
        if (pwd) {
         $.ajax({
           url,
           method: 'POST',
           data: {
            type: `user`,
            is: `reg`,
            user: user,
            pwd
           },
           success(data) {
             swal(data.msg)
           }
         }) 
        }
      })
    })
  })
  $('#confirm_admin').on('click',e=> {
    let auth = 1;
    if (e.shiftKey) auth = 2
    swal({
      title: '请传递一个id',
      content: 'input'
    }).then(data=> {
      data = data.trim()
      if (!data) return
      $.ajax({
        url,
        method: 'post',
        data: {
          type: 'user',
          is: 'admin',
          key: '==QVFZSQmQwOUVXVDA9MxYDOwATM',
          id: data,
          auth
        },
        success(data) {
          console.log(data)
        }
      })
    })
  })
  $('#confirm_search').on('keydown',function(e) {
    if (e.keyCode == 13) {
      saySearch($(this).val())
    }
  })
  $('#confirm_search').next().on('click',e=> {
      saySearch($('#confirm_search').val())
  })
  function saySearch(key) {
    function gen(arr) {
      html = '';
      for (let i=0; i<arr.length; i++) {
        let curr = arr[i]
        html += `
          <li class="row">
            <input style="border: none" class="col text-secondary" onclick="$(this).select();document.execCommand('Copy', false, null);" value="${curr.id}">
            <p class="col">${curr.username}</p>
          </li>
        `
      }
      return $(`
      <div>
        <ul>
          ${html}
        </ul>
        <p class="text-secondary">点击id复制</p>
      </div>
      `)[0]
    }
    $.ajax({
      url,
      async: false,
      method: 'post',
      data: {
        type: `user`,
        is: 'search',
        keyword: key
      },
      success(data) {
        let result = data.result
        let genHTML = gen(result)
        swal({
          content: genHTML
        })
      }
    })
  }
})