<div class="clearfix mt-5">
  <div class="row">
    <div class="col-2 text-right">
      <div class="upload-cover"></div>
    </div>
    <div class="col-8">
      <div>
        <button type="button" onclick="openSM(this)" data-open="https://catbox.moe" name="" id="" class="btn btn-primary">本地上传</button>
        <button type="button" name="" id="" disable class="btn btn-primary disabled">网易云</button>
        <button type="button" name="" id="" disable class="btn btn-primary disabled">QQ音乐</button>
        <button type="button" name="" id="" disable class="btn btn-primary disabled">虾米音乐</button>
      </div>
      <div class="upList mt-4">
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
      </div>
      <p class="mt-2">
        <button type="button" name="" id="" class="upAdd btn btn-primary">添加地址</button>
      </p>
      <p class="mt-4 mb-3">稿件标题</p>
      <input type="text" class="form-control music_push_title">
      <p class="mt-4 mb-3">所属风格</p>
      <input type="text" class="form-control music_push_style">
      <p class="mt-4 mb-3">简介</p>
      <textarea cols="30" rows="10" class="form-control music_push_desc"></textarea>
      <hr>
      <div class="mt-2 text-center">
        <button type="button" class="btn btn-primary btn-lg btn-block push-btn" data-post="music">上传</button>
      </div>
    </div>
  </div>
</div>