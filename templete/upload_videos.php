<div>
  <h2 class="mb-4"> <span class="text-danger">#</span> 文件上传<span style="font-size:50%;padding-left:5px">可上传多P,最多<code>20</code>P,格式支持 MP4</span></h2>
  <hr>
  <ul class="p-2 pl-5 pt-4 upload-list-wrap" style="list-style-type: decimal;max-height: 50vh;overflow:auto;"></ul>
  <div class="p-2">
    <button type="button" class="btn btn-primary" data-open="https://streamja.com/" onclick="openSM(this)">上传视频</button>
    <button type="button" class="btn btn-success upload-bili">哔哩哔哩</button>
    <input placeholder="xxx,x,xxx" class="btn inline-block border addInput" style="min-width:300px;max-width:60%;text-align:left;">
    <button type="button" class="btn btn-danger videos_btn">上传</button>
  </div>
  <hr>
  <h2 class="mb-4"> <span class="text-danger">#</span> 基本信息 </h2>
  <p>视频封面设置</p>
  <hr>
  <div class="p-2">
    <div class="pb-3 collapse">
      <img src="" alt="" style="max-height: 20vh;padding-bottom:10px">
      <input type="text" class="form-control">
    </div>
    <button type="button" class="btn btn-primary" data-open="https://smms.netlify.com/" onclick="openSM(this)">上传图片</button>
    <button type="button" class="btn btn-danger prURL">URL</button>
  </div>
  <hr>
  <p>标题</p>
  <input type="text" class="form-control videos_push_title">
  <p>标签</p>
  <input type="text" class="form-control videos_push_tags" placeholder="标签格式: xxx,xxx,xxx">
  <div></div>
  <p>简介</p>
  <textarea name="" id="" cols="30" rows="10" class="form-control videos_push_desc" placeholder="尽量写一些关于这个视频的内容"></textarea>
  <div class="mt-4">
    <button type="button" class="btn btn-primary pl-5 pr-5 mr-4">投稿</button>
    <button type="button" class="btn btn-primary pl-5 pr-5">预览</button>
  </div>
</div>