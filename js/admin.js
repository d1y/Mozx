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
        data-user="${e.username}"
        data-toggle="modal" 
        data-target="#exampleModal"
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
  function loadUserData(call, page = 1, count = 10) {
    $.ajax({
      url: '/api/index.php',
      method: 'POST',
      data: {
        type: 'user',
        is: 'view',
        page,
        count
      },
      success: data=> call(data),
      error: e => console.log(e)
    })
  }
  if (currentQuery == 'user') {
    loadUserData(data=> {
      oldPage.attr('data-page', data.currentpage)
      nextPage.attr('data-page', data.totalpage)
      if (data.currentpage == 1) oldPage.attr('disabled',true)
      if (data.totalpage <= 1) nextPage.attr('disabled',true)
      uploadTable(data.data)
    })
  }
  function uploadTable($arr, $flag = false) {
    if ($flag) $(tbodyWrap).html('')
    $arr.forEach(item=> {
      $(tbodyWrap).append(genTable(item))
    })
  }
  window.userFoucs = e => {
    let currPage = $(e).attr('data-page')
    if (e.dataset.type == 'old') {
      if (currPage > 1) {
        --currPage
        $(e).attr('data-page',currPage)
        if (currPage <= 1) $(e).attr('disabled',true)
        nextPage.attr('disabled',false)
        loadUserData(data=> uploadTable(data.data,true),currPage)
      } else {
        $(e).attr('disabled',true)
      }
    } else {
      let old = oldPage.attr('data-page')
      if (old >= currPage) {
        $(e).attr('disabled',true)
      } else {
        ++old
        loadUserData(data=> uploadTable(data.data,true),old)
        let flag = old >= nextPage.attr('data-page')
        oldPage.attr('disabled',false)
        nextPage.attr('disabled',flag)
        oldPage.attr('data-page',old)
      }
    }

  }
  let editUser = t => {

  }
})