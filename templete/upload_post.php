<?php $h = 50 ?>
<link href="https://cdn.bootcss.com/github-markdown-css/3.0.1/github-markdown.min.css" rel="stylesheet">
<div class="p-5">
  <p class="mb-2">标题</p>
  <input type="text" class="form-control mb-4">
  <p class="mb-3">封面</p>
  <div class="mb-3">
    <button type="button" class="btn btn-primary mr-2">上传图片</button>
    <button type="button" class="btn btn-secondary">URL</button>
  </div>
  <p class="mb-3">标签</p>
  <input type="text" class="form-control mb-4">
  <p class="mb-3">一句话介绍</p>
  <input type="text" class="form-control mb-4">
  <p class="text-secondary"><code class="text-danger">*</code> 仅支持 <code class="text-danger">markdown</code>  语法</p>
  <div class="row" style="margin:0;">
    <div class="col rounded border shadow pt-2 mr-2">
      <textarea id="text-input" class="form-control" oninput="this.editor.update()" rows="6" cols="60"
      style="height:<?php echo $h ?>vh"></textarea>
    </div>
    <div class="col rounded border shadow pt-2">
      <div id="preview" class="markdown-body"
      style="height:<?php echo $h ?>vh"></div>
    </div>
  </div>
  <div class="mt-5 text-center">
    <button type="button" name="" id="" class="btn btn-primary btn-lg btn-block">提交文章</button>
  </div>
</div>