<!-- File: /app/View/Posts/edit.ctp -->

<h2>Edit User</h2>
<?php
    echo $this->Form->create('User', array('action' => 'edit'));
    echo $this->Form->input('username');
	echo $this->Form->input('password');
    echo $this->Form->input('id', array('type' => 'hidden'));
    echo $this->Form->end('Save Post');