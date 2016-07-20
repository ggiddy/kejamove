<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_addons_columns_to_moverequests_table extends CI_Migration {

	public function up()
	{
		$fields = array(      
                  'house_cleaning' => array(
                  	'type'       => 'BOOLEAN',
                  	'constraint' => 1,
                  	'null'       => TRUE,
                        'default'    => FALSE   
                  ),

                  'interior_decorator' => array(
                        'type'       => 'BOOLEAN',
                        'constraint' => 1,
                        'null'       => TRUE,
                        'default'    => FALSE      
                  )
            );

            $this->dbforge->add_column('moverequests', $fields);
	}

	public function down()
	{
		$this->dbforge->drop_column('moverequests', ['house_cleaning', 'interior_decorator']);
	}
}