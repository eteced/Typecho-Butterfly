<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('page_header.php'); ?>
<main class="layout" id="content-inner">
<div id="page" >
    <article class="post-content" id="article-container">
       <?php
        $db = Typecho_Db::get();
        $sql = $db->select()->from('table.comments')
         ->where('cid = ?', $this->cid)
         ->where('mail = ?', $this->remember('mail', true))
         ->limit(1);
         $result = $db->fetchAll($sql);
         if ($this->user->hasLogin() || $result) {
         $content = preg_replace("/\[hide\](.*?)\[\/hide\]/sm", '<div class="reply-content">$1</div>', $this->content);
         } else {
         $content = preg_replace("/\[hide\](.*?)\[\/hide\]/sm", '<p class="need-reply">此处内容 <a href="#comments">回复</a> 可见</p>', $this->content);
         }
        echo $content;
       ?>
    </article>
    <?php if($this->fields->ShowReward === 'show' || $this->options->ShowGlobalReward === 'show') : ?>
   <div class="post-reward">
  <div class="reward-button button--animated">
    <i class="fas fa-qrcode"></i>打赏</div>
  <div class="reward-main">
    <ul class="reward-all">
<?php if ($this->options->RewardInfo) : ?>
        <?php
        if (strpos($this->options->RewardInfo, '||') !== false) {
            $list = "";
            $txt = $this->options->RewardInfo;
            $string_arr = explode("\r\n", $txt);
            $long = count($string_arr);
            for ($i = 0; $i < $long; $i++) {
                $list = $list . 
                '<li class="reward-item">
                <a href="' . explode("||", $string_arr[$i])[1] . '" rel="external nofollow noreferrer" target="_blank">
                <img class="post-qr-code-img entered loaded" data-lazy-src="' . explode("||", $string_arr[$i])[1] . '" alt="' . explode("||", $string_arr[$i])[0] . '" src="'.GetLazyLoad().'">
                 <div class="post-qr-code-desc">' . explode("||", $string_arr[$i])[0] . '</div>
                </a>
                </li>';
            }
            echo $list;
        }
        ?>
    <?php endif; ?>  
    </ul>
  </div>
</div>
<?php endif; ?>
    <?php $this->need('comments.php'); ?>
</div>
<?php $this->need('post_sidebar.php'); ?>

<script type="text/javascript" src="<?php $this->options->themeUrl('js/clipboard.min.js'); ?>"></script>
<?php if (!empty($this->options->beautifyBlock) && in_array('showLineNumber',
    $this->options->beautifyBlock)): ?> 
<script type="text/javascript">
	(function(){
		var pres = document.querySelectorAll('pre');
		var lineNumberClassName = 'line-numbers';
		pres.forEach(function (item, index) {
			item.className = item.className == '' ? lineNumberClassName : item.className + ' ' + lineNumberClassName;
		});
	})();
</script>
<?php endif; ?>
</main>
<!-- end #main-->
<?php $this->need('footer.php'); ?>