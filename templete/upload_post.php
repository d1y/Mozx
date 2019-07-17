<?php $h = 50 ?>
<link href="https://cdn.bootcss.com/github-markdown-css/3.0.1/github-markdown.min.css" rel="stylesheet">
<div class="p-5">
  <p class="mb-2">标题</p>
  <input type="text" class="form-control mb-4 write_title">
  <p class="mb-3">封面</p>
  <div>
    <img class="write_cover" style="max-width: 40%;min-width: 5%;" src="" alt="">
  </div>
  <div class="mb-3">
    <input type="text" class="form-control mt-2 mb-3 write_input">
    <button type="button" class="btn btn-primary mr-2" onclick="openSM(this)" data-open="https://smms.netlify.com/">上传图片</button>
    <button type="button" class="btn btn-secondary write_toggle">URL</button>
  </div>
  <p class="mb-3">标签</p>
  <input type="text" class="form-control mb-4 write_tags">
  <p class="mb-3">一句话介绍</p>
  <input type="text" class="form-control mb-4 write_show">
  <p class="text-secondary"><code class="text-danger">*</code> 仅支持 <code class="text-danger">markdown</code>  语法</p>
  <div class="row" style="margin:0;">
    <div class="col rounded border shadow pt-2 mr-2">
      <textarea id="text-input" class="form-control write_content" oninput="this.editor.update()" rows="6" cols="60"
      style="height:<?php echo $h ?>vh"></textarea>
    </div>
    <div class="col rounded border shadow pt-2" style="heigth:100%; overflow:auto;">
      <div id="preview" class="markdown-body"
      style="height:<?php echo $h ?>vh"></div>
    </div>
  </div>
  <div class="mt-5 text-center">
    <button type="button" data-post="write" class="btn btn-primary btn-lg btn-block push-btn">提交文章</button>
  </div>
</div>
<script src="https://cdn.bootcss.com/markdown.js/0.5.0/markdown.min.js"></script>
<script>
  {
    function Editor(input, preview) {
      this.update = function () {
        preview.innerHTML = markdown.toHTML(input.value);
      };
      input.editor = this;
      this.update();
    }
    new Editor($("#text-input").get(0), $("#preview").get(0));
  }
</script>