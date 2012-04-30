<!-- File: /app/View/Posts/view.ctp -->

<h2><?php echo h($post['Post']['title'])?></h2>

<p><small>Created: <?php echo $post['Post']['created']?></small></p>

<p><?php echo $post['Post']['body']?></p>