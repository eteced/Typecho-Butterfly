<?php if (!defined('__TYPECHO_ROOT_DIR__')) {
	exit;
} ?>
<?php $this->need('page_header.php'); ?>
<main class="layout" id="content-inner">
	<div class="recent-posts category_ui" id="recent-posts">
		<?php if ($this->have()) : ?>
			<?php
			$coverIndex = 1;
			while ($this->next()) :
				if($this->options->coverPosition === 'cross'){
					$sideClass = ($coverIndex % 2 == 0) ? 'right' : 'left';
				}else{
					$sideClass  = $this->options->coverPosition;
				}
			?>
				<div class="recent-post-item">
					<?php if (noCover($this)) : ?>
						<wehao class="post_cover  <?php echo $sideClass; ?>">
							<a href="<?php $this->permalink() ?>">
								<img class="post-bg" data-lazy-src="<?php echo get_ArticleThumbnail($this); ?>" src="<?php echo GetLazyLoad() ?>" onerror="this.onerror=null;this.src='<?php $this->options->themeUrl('img/404.jpg'); ?>'"></a>
						</wehao>
					<?php endif ?>
					<div class="recent-post-info<?php echo noCover($this) ? '' : ' no-cover'; ?>">
						<a class="article-title" href="<?php $this->permalink(); ?>"><?php $this->title(); ?></a>
						<div class="article-meta-wrap">
							<?php $this->sticky(); ?>
							<span class="post-meta-date" style="display:none;">
								<i class="far fa-calendar-alt"></i>
								<?php _e('发表于  '); ?> <?php $this->date(); ?>
								<time class="post-meta-date-created" datetime="<?php $this->date('c'); ?>">
								</time>
							</span>
							<i class="fas fa-history"></i>
							<span class="article-meta-label">更新于</span>
							<?php echo date('Y-m-d', $this->modified); ?>
							<time class="post-meta-date-updated" datetime="<?php echo date('Y-m-d', $this->modified); ?>" title="更新于 ">
							</time>
							<span class="article-meta">
								<span class="article-meta__separator">|</span>
								<i class="fas fa-inbox article-meta__icon"></i>
								<span class="post-meta-date">
									<?php _e('分类: '); ?>
									<?php $this->category(' '); ?>
								</span>
								<span class="article-meta__separator">|</span>
								<span class="post-meta-date" itemprop="author">
									<?php _e('作者: '); ?>
									<a itemprop="name" href="<?php $this->author->permalink(); ?>" rel="author">
										<?php $this->author(); ?>
									</a>
								</span>
								<span class="article-meta__separator">|</span>
								<i class="fas fa-comments"></i>
								<span class="post-meta-date" itemprop="interactionCount">
									<a itemprop="discussionUrl" href="<?php $this->permalink(); ?>#comments">
										<?php $this->commentsNum('0条评论', '1 条评论', '%d 条评论'); ?>
									</a>
								</span>
							</span>
						</div>
						<div class="content">
						<?php
							if ($this->fields->StatusArticle == "on"){
								echo $this->excerpt(130);;
								echo '<br><a href="', $this->permalink(), '" title="', $this->title(), '">前去评论</a>';
							} else {
								summaryContent($this);
								echo '<br><a href="', $this->permalink(), '" title="', $this->title(), '">阅读全文...</a>';
							}
						?>
						</div>
					</div>
				</div>
			<?php
				if (noCover($this)) {
					$coverIndex++;
				}

			endwhile; ?>
		<?php else : ?>
			<article class="post">
				<h2 class="post-title"><?php _e('没有找到内容'); ?></h2>
			</article>
		<?php endif; ?>
		<nav id="pagination">
			<?php $this->pageNav('<i class="fas fa-chevron-left fa-fw"></i>', '<i class="fas fa-chevron-right fa-fw"></i>', 1, '...', ['wrapTag' => 'div', 'wrapClass' => 'pagination', 'itemTag' => '', 'prevClass' => 'extend prev', 'nextClass' => 'extend next', 'currentClass' => 'page-number current']); ?>
		</nav>
	</div><!-- end #main -->
	<?php $this->need('sidebar.php'); ?>
</main>
<?php $this->need('footer.php'); ?>