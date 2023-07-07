<?php 
interface iDaoModeCrud {
              public function create( $nome, $telefone, $email );
              public function read( $id );
              public function update( $id, $nome, $telefone, $emailt );
              public function delete( $param );
          }