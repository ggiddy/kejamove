<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Modify_moverequests_table extends CI_Migration {

	public function up()
	{
		$fields = array(
                  'vehicle' => array(
                  	'type' => 'VARCHAR',
                  	'constraint' => 100, 
      	            'null' => TRUE
                  ),
                  'distance' => array(
                  	'type' => 'INT',
                  	'constraint' => 11, 
      	            'unsigned' => TRUE,
      	            'null' => TRUE    
                  ),
                  'floor' => array(
                  	'type' => 'VARCHAR',
                  	'constraint' => 100,
                  	'null' => TRUE   
                  ),
                  'helpers' => array(
                  	'type' => 'INT',
                  	'constraint' => 11, 
      	            'unsigned' => TRUE,
      	            'null' => TRUE    
                  ),
                  'pickuptime' => array(
                  	'type' => 'INT',
                  	'constraint' => 6, 
      	            'unsigned' => TRUE,
      	            'null' => TRUE    
                  ),
                  'packaging' => array(
                  	'type' => 'VARCHAR',
                  	'constraint' => 100,
                  	'null' => TRUE 
                  ),
                  'totalcost' => array(
                  	'type' => 'INT',
                  	'constraint' => 11,
                  	'unsigned' => TRUE,
                  	'null' => TRUE 
                  )
            );

		$this->dbforge->add_column('moverequests', $fields);
	}

	public function down()
	{
		$columns = array('vehicle', 'distance', 'floor', 'helpers', 'pickuptime', 'packaging', 'totalcost');
		$this->dbforge->drop_column('moverequests', $columns);
	}
}