<!-- File: /app/View/Posts/index.ctp -->
<script>

$(document).ready(function() {
    // put all your jQuery goodness in here.
	$('.carousel').carousel({
    interval: 2000
    })
    
});
</script>


<div id="myCarousel" class="carousel">
  <!-- Carousel items -->
  <div class="carousel-inner">
 
     <?php 
	
	 echo $this->Html->div('active item',$this->Html->image("/img/cake.icon.png", array(
    "alt" => "",
    'url' => array('controller' => 'posts', 'action' => 'view', 1)
     ))); 
	 
	 echo $this->Html->div('item',$this->Html->image("/img/test-skip-icon.png", array(
    "alt" => "",
    'url' => array('controller' => 'posts', 'action' => 'view', 2)
     ))); 
	 
	 echo $this->Html->div('item',$this->Html->image("/img/test-pass-icon.png", array(
    "alt" => "",
    'url' => array('controller' => 'posts', 'action' => 'view', 3)
     ))); 
	 
	 ?>
      
  </div>

</div>

<?php
//echo $this->Html->div('carousel', $this->Html->div('carousel-inner', $this->Html->div('active item','item')));

//echo $this->Html->tag('div', $this->Html->div('carousel-inner', array($this->Html->div('active item','item1'),$this->Html->div('active item','item2'))), array('id' => 'myCarousel','class' => 'carousel'));
?>




<?php /*<div class="carousel-caption"><p>my image caption</p></div> */?>
<?php if ($this->Session->read('Auth.User.username'))
{
	
	echo "Welcome".$this->Session->read('Auth.User.username');
	
}?>

<?php /*<h1>Blog posts</h1> */?>

<table class="table table-striped">
<p><?php echo $this->Html->link('Login and Add Post', array('action' => 'add')); ?></p>
    <tr>
        
        <?php /*<th><?php echo $this->Paginator->sort('id', 'Id');?></th> */?>
        <th><?php 
		
		       echo $this->Paginator->sort('title', 'Title');
		     //echo $this->$paginate1->sort('Post.title', 'Title');
		
		?></th>
                <th>Actions</th>
        <th><?php echo $this->Paginator->sort('created', 'Created');?></th>
           <th><?php echo $this->Paginator->sort('user_id', 'Auth');?></th>
    </tr>

<!-- Here's where we loop through our $posts array, printing out post info -->
<!--?php debug($posts);?-->
    <?php foreach ($posts as $post): ?>
    <tr>
        <?php /*<td><?php echo $post['Post']['id']; ?></td> */?>
        <td>
            <?php echo $this->Html->link($post['Post']['title'], array('action' => 'view', $post['Post']['id']));?>
        </td>
        <td>
            <?php echo $this->Form->postLink(
                'Delete',
                array('action' => 'delete', $post['Post']['id']),
                array('confirm' => 'Are you sure?','class' => 'label label-important'));
            ?>
            <?php echo $this->Html->link('Edit', array('action' => 'edit', $post['Post']['id']),array('class' => 'label label-success'));?>
        </td>
        <td>
            <?php echo $post['Post']['created']; ?>
        </td>
        
        <td>
        
		  <?php echo $post['User']['username']; ?>
                         
        </td>
        
        
    </tr>
    <?php endforeach; ?>

</table>

 
 <hr style=" color: #9E9E9E; background-color: #9E9E9E; height: 3px; width: 100%;
text-align: left;">


<?php 


if ($this->Session->read('Auth.User.role')=="admin"){ 



//echo($this->Auth->user('role') == 'whatever') 


?>


<h2>Blog users List</h2>
 
 
<table class="table table-striped">
    <tr>
        <?php /* <th>Id</th> */?>
        
        
         <th><?php echo $this->Paginator->sort('User.username', 'Username');?></th>
               
        <th><?php echo $this->Paginator->sort('User.role', 'Role');?></th>
           <th><?php echo $this->Paginator->sort('User.created', 'Created');?></th>
         <th>Actions</th>
        
    
    </tr>

<!-- Here's where we loop through our $posts array, printing out post info -->

    <?php foreach ($users as $user): ?>
    <tr>
        <?php /*<td><?php echo $user['User']['id']; ?></td> */?>
        <td>
            <?php echo $user['User']['username'];?>
        </td>
        
        <td>
            <?php echo $user['User']['role']; ?>
        </td>
        <td>
        
		  <?php echo $user['User']['created']; ?>
                         
        </td>
        
        <td>
            <?php 
			
			echo $this->Form->postLink(
                'Delete',
                array('action' => 'delete', $post['User']['id']),
                array('confirm' => 'Are you sure?','class' => 'label label-important'));
			
			
			
			
            ?>
            <?php echo $this->Html->link('Edit', array('controller' => 'users','action' => 'edit', $user['User']['id']),array('class' => 'label label-success'));?>
        </td>
        
    </tr>
    <?php endforeach; ?>

</table>
<?php /* echo $this->Html->link( __('<button>Add a user</button>'), array('controller' => 'users','action' => 'add'),array('escape' => false)); */?>

<?php echo $this->Html->link( __('Add a user'), array('controller' => 'users','action' => 'add'),array('class' => 'button', 'target' => '_blank')); ?>
<?php }?>

<?php if ($this->Session->read('Auth.User.role')!= null){ ?>

 <?php echo $this->Html->link('Logout', array('controller' => 'users','action' => 'logout'));?>
 <?php }?>
 




 
 
 
 