<script src="https://cdn.bootcss.com/jquery/3.4.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.bootcss.com/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdn.bootcss.com/Swiper/4.5.0/js/swiper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/darkmode-js@1.3.4/lib/darkmode-js.min.js"></script>
<script src="https://cdn.bootcss.com/pace/1.0.2/pace.min.js"></script>
<script src="https://cdn.bootcss.com/markdown.js/0.5.0/markdown.min.js"></script>
<script src="/js/main.js"></script>
<script>
  new Darkmode({
    label: '🌓'
  }).showWidget(); 
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