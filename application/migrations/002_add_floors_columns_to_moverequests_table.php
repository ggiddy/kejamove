<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_floors_columns_to_moverequests_table extends CI_Migration {

	public function up()
	{
		$floor = array(      
                  'floor' => array(
                        'name'       => 'floor_from',
                  	'type'       => 'INT',
                  	'constraint' => 11,
                  	'null'       => TRUE   
                  )
            );

            $this->dbforge->modify_column('moverequests', $floor);

            $fields = array(
                  'floor_to'         => array(
                        'type'       => 'INT',
                        'constraint' => 11,
                        'null'       => TRUE  
                  )
            );

		$this->dbforge->add_column('moverequests', $fields);
	}

	public function down()
	{
            //change name back to previous name
            $floor = array(      
                  'floor_from' => array(
                        'name' => 'floor',
                        'type' => 'VARCHAR',
                        'constraint' => 100,
                        'null' => TRUE   
                  ),
            );

            $this->dbforge->modify_column('moverequests', $floor);

            //drop the created columns
		$columns = array('floor_to');
		$this->dbforge->drop_column('moverequests', $columns);
	}
}